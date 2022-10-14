<?php
session_start();

$file = $_FILES['uploadedFile'];
function check_file_uploaded_name($file)
{
  (bool) ((preg_match("`^[-0-9A-Z_\.]+$`i", $file)) ? true : false);
}
include 'dbconnection.php';
// echo "$file";
$message = $file;
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {

  $fileTmpPath = $file['tmp_name'];
  $fileName = $file['name'];
  $fileSize = $file['size'];
  $fileType = $file['type'];
  print_r($file);

  if ($file['error'] === UPLOAD_ERR_OK) {
    // get details of the uploaded file


    // print_r($file);
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

    if (in_array($fileExtension, $allowedfileExtensions)) {
      // directory in which the uploaded file will be moved
      $uploadFileDir = 'upload-file/';
      $dest_path = $uploadFileDir . $fileName;

      date_default_timezone_set("Asia/Kolkata");
      $date = date("M d Y");
      $time = date("G:i A");
      $dateTime = $date . '  ' . $time;

      // $size = round($fileSize / 1024, 2) . " Kb";

      if ($fileSize >= 1073741824) {
        $size = number_format($fileSize / 1073741824, 2) . ' GB';
      } elseif ($fileSize >= 1048576) {
        $size = number_format($fileSize / 1048576, 2) . ' MB';
      } elseif ($fileSize >= 1024) {
        $size = number_format($fileSize / 1024, 2) . ' KB';
      } elseif ($fileSize > 1) {
        $size = $fileSize . ' fileSize';
      } elseif ($fileSize == 1) {
        $size = $fileSize . ' byte';
      } else {
        $size = '0 fileSize';
      }

      if (move_uploaded_file($fileTmpPath, $dest_path)) {

        $insertquery = "insert into uploadedfiles(fileName,date,size,file) values('$fileName', '$dateTime', '$size', '$dest_path')";


        $query = mysqli_query($con, $insertquery);

        $message = 'File is successfully uploaded.';
      } else {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    } else {

      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  } else {

    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $file['error'];
  }
}
$_SESSION['message'] = $message;
header('location:display.php');
