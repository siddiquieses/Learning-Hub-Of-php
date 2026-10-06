<?php
session_start();
include '../connection.php';

if (isset($_POST['uploading'])) {
    $imagename = $_FILES['uploadimage']['name'];
    $tempname = $_FILES['uploadimage']['tmp_name'];
    $type = $_FILES['uploadimage']['type'];
    $size = $_FILES['uploadimage']['size'];
    $folder = "images/" . $imagename;

    if ($type == "image/jpeg" || $type == "image/png" || $type == "image/jpg") {
        if ($size < 1000000) {
            move_uploaded_file($tempname, $folder);
            $sql = "INSERT INTO `images`(`imagespath`) VALUES ('$folder.$imagename')";
            $run = mysqli_query($connection, $sql);
            echo "<script>
  alert('image uploaded successfully');
 </script>
";
        }

     else {
        echo "<script>
  alert('image not  uploaded successfully');
 </script>
";
    }
} else {
    echo "<script>
  alert('image format is not supported');
 </script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Upload Images</label>
        <input type="file" name="uploadimage">
        <input type="submit" value="upload" name="uploading">
    </form>
</body>

</html>