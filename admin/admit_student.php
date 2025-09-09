<?php
session_start();
include_once("../fun.inc.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

if (isset($_POST['submit_admission'])) {
    // Sanitize inputs
    $regno = mysqli_real_escape_string($conn, $_POST['regno']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $onames = mysqli_real_escape_string($conn, $_POST['onames']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $maritalstatus = mysqli_real_escape_string($conn, $_POST['maritalstatus']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $lg = mysqli_real_escape_string($conn, $_POST['lg']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $passport = mysqli_real_escape_string($conn, $_POST['passport']);
    $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $programme = mysqli_real_escape_string($conn, $_POST['programme']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $noksurname = mysqli_real_escape_string($conn, $_POST['noksurname']);
    $nokoname = mysqli_real_escape_string($conn, $_POST['nokoname']);
    $noktel = mysqli_real_escape_string($conn, $_POST['noktel']);
    $nokemail = mysqli_real_escape_string($conn, $_POST['nokemail']);
    $nokrel = mysqli_real_escape_string($conn, $_POST['nokrel']);
    $nokadd = mysqli_real_escape_string($conn, $_POST['nokadd']);
  //  $session = date('Y'); // You can customize this
    $session = mysqli_real_escape_string($conn, $_POST['session']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    $accpt_fee_due = mysqli_real_escape_string($conn, $_POST['accpt_fee_due']);
    $stud_due_date = mysqli_real_escape_string($conn, $_POST['stud_due_date']);
    $prog_duration = mysqli_real_escape_string($conn, $_POST['prog_duration']);
    $date_issued = mysqli_real_escape_string($conn, $_POST['date_issued']);
    $all_pay_due = mysqli_real_escape_string($conn, $_POST['all_pay_due']);
    $refD = mysqli_real_escape_string($conn, $_POST['refD']);

    // Handle admission letter upload
    $admissionLetterFileName = '';
    if (isset($_FILES['admissionletter']) && $_FILES['admissionletter']['error'] === UPLOAD_ERR_OK) {
        $fileSize = $_FILES['admissionletter']['size'];
        $ext = strtolower(pathinfo($_FILES['admissionletter']['name'], PATHINFO_EXTENSION));

        if ($fileSize > 10485760 || !in_array($ext, ['jpg', 'jpeg', 'png', 'pdf'])) {
            echo "<script>alert('Admission letter must be JPG, PNG, or PDF and ≤ 10MB'); window.history.back();</script>";
            exit;
        }

        $uploadDir = '../uploads/admission_letters/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFilename = uniqid('admission_', true) . '.' . $ext;
        $targetPath = $uploadDir . $newFilename;

        if (move_uploaded_file($_FILES['admissionletter']['tmp_name'], $targetPath)) {
            $admissionLetterFileName = $newFilename;
        }
    }

    // Insert into admitted_2022
    $sql = "INSERT INTO admitted_2022 (
        regno, surname, onames, sex, dob, maritalstatus, nationality, state, lg, email, phoneno, address, passport,
        faculty, dept, programme, title, noksurname, nokoname, noktel, nokemail, nokrel, nokadd,
        admissionletter, session, batch, accpt_fee_due, stud_due_date, prog_duration, date_issued, all_pay_due, refDate
    ) VALUES (
        '$regno', '$surname', '$onames', '$sex', '$dob', '$maritalstatus', '$nationality', '$state', '$lg', '$email', '$phoneno', '$address', '$passport',
        '$faculty', '$dept', '$programme', '$title', '$noksurname', '$nokoname', '$noktel', '$nokemail', '$nokrel', '$nokadd',
        '$admissionLetterFileName', '$session', '$batch', '$accpt_fee_due', '$stud_due_date', '$prog_duration', '$date_issued', '$all_pay_due', '$refD'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Student admitted successfully'); window.location.href='components-tabs.php';</script>";
    } else {
        echo "<script>alert('Admission failed: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
}
?>
