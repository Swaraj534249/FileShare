<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flash Share - Home to file shares between team members</title>

  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php include 'header.php'; ?>
  <div id="main" class="nosidebar">

    <div id="content">

      <div class="contextual">
        <button class="icon icon-add" onclick="$('#uploadHolder').toggle()" name="icon-up">New file</button>
      </div>

      <h2>Files</h2>

      <!-- <div id="myDIV">
        
      </div> -->
      <div id="uploadHolder">
        <?php
        include 'upload.php';
        ?>
      </div>

      <!-- <script>
        function myUpload() {
          var x = document.getElementById("myDIV");
          if (x.style.display === "block") {
            x.style.display = "none";
          } else {
            x.style.display = "block";
          }
        }
      </script> -->

      <div id="table_sort" class="autoscroll">
        <table class="list files table table-sortable">
          <thead style="text-align: center;">
            <tr>
              <th class="sort">File</th>
              <th class="sort">Date</th>
              <th class="sort">Size</th>
              <th>Preview</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php

            include 'dbconnection.php';

            if (isset($_GET['id'])) {
              $id = $_GET['id'];
              $delete = "DELETE FROM `uploadedfiles` WHERE `id`='$id'";
              $query = mysqli_query($con, $delete);
            }

            $selectquery = "SELECT * FROM uploadedfiles";

            $query = mysqli_query($con, $selectquery);

            $result = mysqli_fetch_array($query);

            while ($result = mysqli_fetch_array($query)) {
            ?>
              <tr>
                <td><a href="download.php?fileName=<?php echo $result['fileName']; ?> " class="dis-btn" id="display"><?php echo $result['fileName']; ?></a></td>
                <td><?php echo $result['date']; ?></td>
                <td><?php echo $result['size']; ?></td>
                <td><img src="<?php echo $result['file']; ?>" width="80"> </td>
                <td class="last-col">
                  <a href="display.php?id=<?php echo $result['id']; ?> " class="del-btn" id="delete"></a>

                </td>
              </tr>
            <?php
            }


            ?>
          </tbody>
        </table>
      </div>

      <div style="clear:both;"></div>

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
  <script src="js/core.js"></script>
  <script src="js/tablesort.js"></script>
</body>

</html>