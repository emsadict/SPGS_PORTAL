<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spgsportal_pgschooldb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricno = $_POST['matricno'];

    // Fetch student name from screened_candidates_2022 table using matricno
    $sql_name = "SELECT surname, onames, regno FROM screened_candidates_2022 WHERE '$matricno' = ?";
    $stmt_name = $conn->prepare($sql_name);
    $stmt_name->bind_param("s", $matricno);
    $stmt_name->execute();
    $result_name = $stmt_name->get_result();
    $name_details = $result_name->fetch_assoc();

    if (!$name_details) {
        echo "No student found with Matric No: $matricno.";
        exit();
    }

    // Format the name: "Onames Surname" with surname in uppercase
    $student_name = ucwords(strtolower($name_details['onames'])) . ' ' . strtoupper($name_details['surname']);
    $regno = $name_details['regno'];

    // Fetch admission year from admitted_2022 table using regno
    $sql_admission = "SELECT session FROM admitted_2022 WHERE regno = ?";
    $stmt_admission = $conn->prepare($sql_admission);
    $stmt_admission->bind_param("s", $regno);
    $stmt_admission->execute();
    $result_admission = $stmt_admission->get_result();
    $admission_details = $result_admission->fetch_assoc();

    // Fetch course details from the registration table using matricno
    $sql_registration = "SELECT courses, ca, exam, total, units, session, sem FROM registration WHERE matricno = ?";
    $stmt_registration = $conn->prepare($sql_registration);
    $stmt_registration->bind_param("s", $matricno);
    $stmt_registration->execute();
    $result_registration = $stmt_registration->get_result();

    // Fetch student details from resulttable
    $sql_resulttable = "SELECT * FROM resulttable WHERE matricno = ?";
    $stmt_resulttable = $conn->prepare($sql_resulttable);
    $stmt_resulttable->bind_param("s", $matricno);
    $stmt_resulttable->execute();
    $result_resulttable = $stmt_resulttable->get_result();
    $student_details = $result_resulttable->fetch_assoc();

       // fetch faculty from registration table
    $sql_faculty= "SELECT * from registration WHERE matricno = ?";
    $stmt_faculty = $conn->prepare($sql_faculty);
    $stmt_faculty->bind_param("s", $matricno);
    $stmt_faculty->execute();
    $result_facultyname = $stmt_faculty->get_result();
    $student_faculty =  $result_facultyname->fetch_assoc();

    if ($student_details && $result_registration->num_rows > 0) {
        // Display student details
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Transcript</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
            <style>
           
           body {
            background-image: url('waternah.png'); /* Inline SVG watermark */
            background-repeat: no-repeat;
            background-position: center;
            background-size: 40%; /* Adjust size of watermark */
            position: relative;
        }

        /* Transparent table to show watermark */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: transparent; /* Transparent table background */
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        .content {
            background-color: rgba(255, 255, 255, 0.9); /* Slight opacity for content, not affecting watermark */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
            </style>


        </head>
        <body>
        <!-- Watermark HTML -->



            <div class='container mt-5 content'>
                <h2 class='text-center'>Transcript for Matric No: $matricno</h2>
                <p><strong>Name:</strong> " . $student_name . "</p>
                <p><strong>Department:</strong> " . $student_details['dept'] . "</p>
                <p><strong>Faculty:</strong> " . $student_faculty['faculty'] . "</p>
                <p><strong>Session of Admission:</strong> " . $admission_details['session'] . "</p>
                <p><strong>Session Graduated:</strong> " . $student_details['session'] . "</p>
                <hr>";

        // Initialize arrays to separate results by semester
        $semesters = ['First Semester' => [], 'Second Semester' => [], 'Third Semester' => []];

        // Fetch and organize course details by semester
        while ($row_registration = $result_registration->fetch_assoc()) {
            // Explode the course, CA, exam, total, and units data
            $courses = explode("|", $row_registration['courses']);
            $ca_scores = explode("|", $row_registration['ca']);
            $exam_scores = explode("|", $row_registration['exam']);
            $total_scores = explode("|", $row_registration['total']);
            $units = explode("|", $row_registration['units']);
            $semester = ($row_registration['sem']);

            for ($i = 0; $i < count($courses); $i++) {
                // Fetch the course title from courses table
                $sql_course_title = "SELECT courseTitle FROM course WHERE courseCode = ?";
                $stmt_course_title = $conn->prepare($sql_course_title);
                $stmt_course_title->bind_param("s", $courses[$i]);
                $stmt_course_title->execute();
                $result_course_title = $stmt_course_title->get_result();
                $course_title = $result_course_title->fetch_assoc()['courseTitle'];

                // Determine the grade based on total score
                $grade = calculateGrade($total_scores[$i]);

                // Add to the corresponding semester array
                $semesters[$semester][] = [
                    'courseCode' => $courses[$i],
                    'courseTitle' => $course_title,
                    'creditUnits' => $units[$i],
                    'markObtained' => $total_scores[$i],
                    'grade' => $grade
                ];
            }
        }

        // Display results separated by semester
        foreach ($semesters as $semester_name => $semester_courses) {
            if (!empty($semester_courses)) {
                echo "<h3>$semester_name</h3>";
                echo "<table>
                        <tr>
                            <th>S/S</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Credit Units</th>
                            <th>Mark Obtained (%)</th>
                            <th>Grade</th>
                        </tr>";

                // Initialize variables for weighted average calculation
                $total_weighted_scores = 0;
                $total_units = 0;
                $serial_number = 1; // For S/S column

                foreach ($semester_courses as $course) {
                    // Calculate weighted score
                    $weighted_score = $course['markObtained'] * $course['creditUnits'];
                    $total_weighted_scores += $weighted_score;
                    $total_units += $course['creditUnits'];

                    echo "<tr>
                            <td>" . $serial_number++ . "</td>
                            <td>" . $course['courseCode'] . "</td>
                            <td style='text-align:left;'>" . $course['courseTitle'] . "</td>
                            <td >" . $course['creditUnits'] . "</td>
                            <td>" . $course['markObtained'] . "</td>
                            <td>" . $course['grade'] . "</td>
                          </tr>";
                }
                echo "</table>";

                // Display Weighted Average for the semester
                if ($total_units > 0) {
                    $weighted_average = $total_weighted_scores / $total_units;
                    echo "<h4>Weighted Average: " . number_format($weighted_average, 2) . "</h4>";
                } else {
                    echo "<h4>Weighted Average: N/A (No units found)</h4>";
                }
                echo "<hr>";
            }
        }

        // Display GPA and CGPA below the table
        echo "<p><strong>GPA:</strong> " . $student_details['gpa'] . "</p>";
        echo "<p><strong>CGPA:</strong> " . $student_details['cgpa'] . "</p>";
        echo "</div></body></html>";

        // Close the statements
        $stmt_name->close();
        $stmt_admission->close();
        $stmt_registration->close();
        $stmt_resulttable->close();
        $stmt_course_title->close();
    } else {
        echo "No transcript data found for Matric No: $matricno.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();

// Function to calculate grade based on total score
function calculateGrade($total) {
    if ($total >= 70) return 'A';
    if ($total >= 60) return 'B';
    if ($total >= 50) return 'C';
    if ($total >= 45) return 'D';
    if ($total >= 40) return 'E';
    return 'F';
}
?>
