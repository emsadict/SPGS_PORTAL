<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fetch Transcript</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Fetch Student Transcript</h1>
        <form method="post" action="transcript_view_pdf.php" target="_blank">
            <div class="mb-3">
                <label for="matricno" class="form-label">Enter Matric Number:</label>
                <input type="text" id="matricno" name="matricno" class="form-control" required>
            </div>
            <div class="text-center">
                <input type="submit" value="Fetch Transcript" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
