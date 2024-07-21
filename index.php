<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo "File successfully uploaded.\n";
        } else {
            echo "File upload failed.\n";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h1>Upload File</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Upload">
    </form>
    <h1>Uploaded Files</h1>
    <ul>
    <?php
    $files = glob('uploads/*');
    foreach ($files as $file) {
        $fileName = basename($file);
        echo "<li><a href='uploads/$fileName' download>$fileName</a></li>";
    }
    ?>
    </ul>
</body>
</html>
