<?php
$target_dir = "../uploads/";
$target_file = $target_dir . time().'_'. basename($_FILES["fileToUpload"]["name"]);
//
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
//  500000 means the maximum file size is 500,000 bytes (approximately 488 KB).
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $file_name = basename($target_file);
        $file_url = "../uploads/" . rawurlencode($file_name);
        echo "The file " . htmlspecialchars($file_name, ENT_QUOTES, "UTF-8") . " has been uploaded.";
        echo '<br><img src="' . htmlspecialchars($file_url, ENT_QUOTES, "UTF-8") . '" alt="Uploaded image thumbnail" width="150">';
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
