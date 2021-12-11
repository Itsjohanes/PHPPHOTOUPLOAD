<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Picture Upload</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
        $uploadok = 1;
        $imagefiletype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (isset($_POST['submit'])) {
            $check = getimagesize($_FILES['uploadfile']['tmp_name']);
            if ($check != false) {
                echo "file image";
                $uploadok = 1;
            } else {
                echo "bukan gambar";
                $uploadok = 0;
            }
        }
        if (file_exists($target_file)) {
            echo "file sudah ada";
            $uploadok  = 0;
        }
        if ($_FILES['uploadfile']['size'] > 500000) {
            echo "file terlalu besar";
            $uploadok = 0;
        }
        if ($imagefiletype != 'jpg' && $imagefiletype != 'png' && $imagefiletype != 'gif' && $imagefiletype != 'jpeg') {
            $uploadok = 0;
        } else {
            $uploadok = 1;
        }
        if ($uploadok == 0) {
            echo "gagal bro";
        } else {
            if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target_file)) {
                echo "file uploaded";
            } else {
                echo "error";
            }
        }
    }

    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <input type="file" name="uploadfile">
        <input type="submit" name="submit">


    </form>
</body>

</html>