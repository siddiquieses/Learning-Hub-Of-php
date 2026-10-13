<?php
session_start();
include '../connection.php';

if (isset($_POST['uploading'])) {
    for ($i = 0; $i < count($_FILES['uploadimage']['name']); $i++) {

        $imagename = $_FILES['uploadimage']['name'][ $i ];
        $tempname = $_FILES['uploadimage']['tmp_name'][ $i ];
        $type = $_FILES['uploadimage']['type'][ $i ];
        $size = $_FILES['uploadimage']['size'][ $i ];
        $folder = "images/" . $imagename;

        if ($type == "image/jpeg" || $type == "image/png" || $type == "image/jpg") {
            if ($size < 1000000) {
                move_uploaded_file($tempname, $folder);
                $sql = "INSERT INTO `images`(`imagespath`) VALUES ('$folder')";
                $run = mysqli_query($connection, $sql);
                echo "<script>
  alert('image uploaded successfully');
 </script>
";
            } else {
                echo "<script>
  alert('image not  uploaded successfully');
 </script>
";
            }
        }


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

<?php
function displayImages()
{
    global $connection;
    $query = "SELECT * FROM `images`";
    $run = mysqli_query($connection, $query);
    $rows = mysqli_num_rows($run);
    if ($rows != 0) {
        echo "<table border='1' style='border-collapse:collapse; width:100%; text-align:center; margin-top:20px;'>";
        echo "<tr> 
   <th>Id</th>
   <th>Image</th>
   </tr>";
        while ($data = mysqli_fetch_assoc($run)) {
            echo "<tr> 
       <td>" . $data['id'] . "</td>   
       <td><img src='" . $data['imagespath'] . "' width='100' height='100'></td>  
     </tr>";

        }
        echo "</table>";

    }
}

?>
<?php
displayImages()


    ?>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Upload Images</label>
        <input type="file" name="uploadimage[]" multiple>
        <input type="submit" value="upload" name="uploading">
    </form>
</body>

</html>