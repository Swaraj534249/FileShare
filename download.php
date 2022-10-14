<?php

include 'dbconnection.php';

if (isset($_GET['fileName'])) {
  $fileName = $_GET['fileName'];
  $download = "select * FROM `uploadedfiles` WHERE `fileName`='$fileName'";
  $query = mysqli_query($con, $download);
  $result = mysqli_fetch_array($query);

  // $fileName = basename($_GET['file']);
  $filePath = "upload-file/" . $fileName;


  if (file_exists($filePath)) {
    //   $mime_type = mime_content_type($filename);
    header('Content-Type: application/octet-stream');
    header('Content-Description: File Transfer');
    header("Content-Disposition: attachment; filename=" . basename($filePath));
    header("Expires: 0");
    header("Cache-Control: must-revalidate");
    header('Pragma: public');
    header('Content-Length: ' . filesize('upload-file/' . $fileName));

    readfile("upload-file/" . $fileName);
  } else {
    echo "file not found";
  }
}
header('location:display.php');
