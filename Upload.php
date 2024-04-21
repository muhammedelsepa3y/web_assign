<?php
include 'DB_Ops.php';
global $conn;
error_reporting(0);

// Assuming your form data is submitted to this script
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (checkUsername($conn, $_POST['user_name'])) {
    die("Error: Username already exists.");
    }

    // Check if the file is uploaded
    if (isset($_FILES["user_image"]) && $_FILES["user_image"]["error"] == 0) {
        if (!is_dir('upload')) {
            mkdir('upload', 0777, true);
        }
        $allowed = ["jpg" => "image/jpeg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
        $filename = $_FILES["user_image"]["name"];
        $filetype = $_FILES["user_image"]["type"];
        $filesize = $_FILES["user_image"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if (in_array($filetype, $allowed)) {
            // Check whether file exists before uploading it
            if (file_exists("upload/" . $filename)) {
                echo $filename . " is already exists.";
            } else {
                move_uploaded_file($_FILES["user_image"]["tmp_name"], "upload/" . $filename);
                echo "Your file was uploaded successfully.";
                
                // You can now store the $filename along with other form data into the database
                $userData = [
                    "full_name" => $_POST['full_name'],
                    "user_name" => $_POST['user_name'],
                    "birthdate" => $_POST['birthdate'],
                    "phone" => $_POST['phone'],
                    "address" => $_POST['address'],
                    "password" => $_POST['password'],
                    "user_image" => $filename,
                    "email" => $_POST['email']
                    // Populate this array with all the necessary data from $_POST and the $filename
                ];
                insertUser($conn, $userData);
            } 
        } else {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else {
        echo "Error: " . $_FILES["user_image"]["error"];
    }
}
?>
