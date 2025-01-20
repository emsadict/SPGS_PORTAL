<?php
ob_start();  // Start output buffering to prevent premature output

require_once('tcpdf/tcpdf.php');
require('phpqrcode/qrlib.php');

// Suppress PNG warnings
error_reporting(E_ERROR | E_PARSE);

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
    $sql_name = "SELECT surname, onames, regno FROM screened_candidates_2022 WHERE regno = ?";
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

    // Fetch faculty from registration table
    $sql_faculty = "SELECT faculty FROM registration WHERE matricno = ?";
    $stmt_faculty = $conn->prepare($sql_faculty);
    $stmt_faculty->bind_param("s", $matricno);
    $stmt_faculty->execute();
    $result_facultyname = $stmt_faculty->get_result();
    $student_faculty = $result_facultyname->fetch_assoc();


    if ($student_details && $result_registration->num_rows > 0) {
        // Generate QR Code
        $qrcode_url = 'https://spgs.unimed.edu.ng';
        $qrcode_filename = 'qrcode.png';
        QRcode::png($qrcode_url, $qrcode_filename, 'L', 4, 2);

        $transcript_number = "PG/TRC/PH/" . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); // Random number for demonstration
        // Initialize TCPDF object
        $pdf = new TCPDF();

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SPGS Portal');
        $pdf->SetTitle('Student Transcript');
        $pdf->SetSubject('Transcript');

        // Add a page
        $pdf->AddPage();
        //page header
        $pdf->Image('logo.jpg',10, 10, 30, 30);
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(190, 6, "UNIVERSITY OF MEDICAL SCIENCES", 0, 1,'C');
        $pdf->Cell(190, 6, "THE POSTGRADUATE SCHOOL", 0, 1,'C');
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->Cell(190, 4, "PMB 536, Ondo City, Ondo State, Nigeria", 0, 1,'C');
        $pdf->Cell(190, 2, "https://spgs.unimed.edu.ng    pgschool@unimed.edu.ng     +234 706 186 2181", 0, 1,'C');
        
        


        // Add watermark on every page
        $pdf->SetAlpha(0.6);  // Set a higher transparency level for visibility
      //  $pdf->Image('watermark.png', 30, 50, 150, 150, '', '', '', false, 300, '', false, false, 0); // Add watermark to the background
        $pdf->SetAlpha(1); // Reset transparency

        // Add QR Code to the PDF
        $pdf->Image($qrcode_filename, 170, 10, 30, 30); // QR Code position and size

        // Title
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Ln(10);
        $pdf->Cell(40, 4, "Transcript for Matric No: $matricno", 0, 1 );
        //$pdf->Ln(10);

         // Transcript Number
        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->Cell(40, 4, "Transcript Number: $transcript_number", 0, 1);
       // $pdf->Ln(5);

        // Issue Date
        $issue_date = date('Y-m-d');
        $pdf->Cell(40, 4, "Date of Issue: $issue_date", 0, 1);
        $pdf->Ln(6);



        // Student details
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(40, 4, "Name: " . $student_name, 0, 1);
        $pdf->Cell(40, 4, "Department: " . $student_details['dept'], 0, 1);
        $pdf->Cell(40, 4, "Faculty: " . $student_faculty['faculty'], 0, 1);
        $pdf->Cell(40, 4, "Session of Admission: " . $admission_details['session'], 0, 1);
        $pdf->Cell(40, 4, "Session Graduated: " . $student_details['session'], 0, 1);
        $pdf->Ln(6);

        // Initialize arrays to separate results by semester
        $semesters = ['First Semester' => [], 'Second Semester' => [], 'Third Semester' => []];

        // Fetch and organize course details by semester
        while ($row_registration = $result_registration->fetch_assoc()) {
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
        $total_weighted_scores_all_semesters = 0;
        $total_units_all_semesters = 0;

        foreach ($semesters as $semester_name => $semester_courses) {
            if (!empty($semester_courses)) {
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->Cell(190, 10, $semester_name.' SEMESTER', 0, 1);

                // Table Headers
                $pdf->Image('watermark.png', 30, 50, 150, 150, '', '', '', false, 300, '', false, false, 0);
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->Cell(10, 10, 'S/N', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Course Code', 1, 0, 'C');
                $pdf->Cell(80, 10, 'Course Title', 1, 0, 'C');  // Fixed width
                $pdf->Cell(20, 10, 'Units', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Mark (%)', 1, 0, 'C');
                $pdf->Cell(20, 10, 'Grade', 1, 0, 'C');
                $pdf->Ln();

                $serial_number = 1;
                $total_weighted_scores = 0;
                $total_units = 0;

                // Display Course Data in Table
                foreach ($semester_courses as $course) {
                  // $pdf->SetFont('helvetica', '', 10);
                    $pdf->Cell(10, 11, $serial_number, 1, 0, 'C');
                    $pdf->Cell(30, 11, $course['courseCode'], 1, 0, 'C');
                    
                    // Word wrap for Course Title if it exceeds 6 words
                    $words = explode(' ', $course['courseTitle']);
                    if (count($words) > 6) {
                        $pdf->MultiCell(80, 11, $course['courseTitle'], 1, 'L', 0, 0); // MultiCell wraps text within the cell
                    } else {
                        $pdf->Cell(80, 11, $course['courseTitle'], 1, 0, 'L');
                    }

                    $pdf->Cell(20, 11, $course['creditUnits'], 1, 0, 'C');
                    $pdf->Cell(30, 11, $course['markObtained'], 1, 0, 'C');
                    $pdf->Cell(20, 11, $course['grade'], 1, 0, 'C');
                    $pdf->Ln();

                    $serial_number++;
                    $total_weighted_scores += $course['markObtained'] * $course['creditUnits'];
                    $total_units += $course['creditUnits'];


                }

                // Calculate GPA for the semester
                $gpa = $total_weighted_scores / $total_units;
                $total_weighted_scores_all_semesters += $total_weighted_scores;
                $total_units_all_semesters += $total_units;

                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->Cell(160, 10, "Semester Weighted Average: " . number_format($gpa, 2), 0, 1, 'R');
            }
        }

        // Cumulative GPA
        $cgpa = $total_weighted_scores_all_semesters / $total_units_all_semesters;
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(160, 10, "Cumulative Weighted Average: " . number_format($cgpa, 2), 0, 1, 'R');
// Fetching degree awarded details (dept, programme, title) from 'screened_candidates_2022' table
$sql_degree = "SELECT dept, programme, title FROM screened_candidates_2022 WHERE regno = ?";
$stmt_degree = $conn->prepare($sql_degree);
$stmt_degree->bind_param("s", $matricno);
$stmt_degree->execute();
$result_degree = $stmt_degree->get_result();

if ($result_degree->num_rows > 0) {
    $degree_data = $result_degree->fetch_assoc();
    $dept = $degree_data['dept'];
    $programme = $degree_data['programme'];
    $title = $degree_data['title'];

    // Coin the degree awarded
 if (strtolower($programme) == 'masters' && strtolower($dept) == 'msc public health') {
        $degree_awarded = "Master of Science in Public Health";
    } 
    elseif(strtolower($programme) == 'masters' && strtolower($dept) == 'health law and policy') {
        $degree_awarded = "Master of Science in Health Law and Policy";
    }
    elseif (strtolower($programme) == 'postgraduate diploma') {
        $degree_awarded = "Postgraduate Diploma in $dept ($title)";
    } elseif (strtolower($programme) == 'doctorate') {
        $degree_awarded = "Doctorate of $dept ($title)";
    } else {
        $degree_awarded = "$programme of $dept ($title)"; // Default case
    }

    // Display the Degree Awarded
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(190, 10, "Degree Awarded: " . $degree_awarded, 0, 1);
    $pdf->Ln(5);
} else {
    echo "No degree information found for the provided Matric No.";
}
        // Grade Interpretation Table
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(100, 10, "Interpretation of Grades", 0, 1, 'C');
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(50, 6, "70 and Above", 1, 0, 'C' ); 
        $pdf->Cell(50, 6, "A", 1, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(50, 6, "60 – 69 ", 1, 0, 'C');
        $pdf->Cell(50, 6, "B",1, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(50, 6, "50 – 59", 1, 0, 'C');
        $pdf->Cell(50, 6, "C", 1, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(50, 6, "45 – 49", 1, 0, 'C');
        $pdf->Cell(50, 6, "D", 1, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(50, 6, "Below 45", 1, 0, 'C');
        $pdf->Cell(50, 6, "F", 1, 0, 'C');
        $pdf->Ln(10);
        $pdf->Ln(10);

        // Signature Line
        $pdf->Ln(4);
        $pdf->Cell(190, 2, "__________________________", 0, 'L');
        $pdf->Cell(190, 2, "Idowu S. Omowole", 0, 'L');
        $pdf->Cell(190, 2, "Secretary, Postgraduate School", 0, 'L');

        // Footer with the POWERED BY: ICT UNIMED text
        //$pdf->SetY(-2);  // Position footer at the bottom of the page
        $pdf->Ln(20);
        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->Cell(190, 2, 'POWERED BY: ICT UNIMED', 0, 0, 'C');
        // Adding space for a signature
        // Output PDF to browser
        ob_end_clean();
        $pdf->Output('transcript.pdf', 'I');
    } else {
        echo "No results found for Matric No: $matricno.";
    }
}

// Function to calculate grade based on total score
function calculateGrade($total_score) {
    if ($total_score >= 70) {
        return 'A';
    } elseif ($total_score >= 60) {
        return 'B';
    } elseif ($total_score >= 50) {
        return 'C';
    } elseif ($total_score >= 45) {
        return 'D';
    } elseif ($total_score >= 40) {
        return 'E';
    } else {
        return 'F';
    }
}
?>