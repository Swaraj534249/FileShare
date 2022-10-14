<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div id="top-menu">
    <div id="account">
      <ul>
        <!-- <li><a class="logout" rel="nofollow" data-method="post" href="login.php?logout='1'">Sign out</a></li> -->
      </ul>
    </div>
    <?php if (isset($_SESSION['username'])) : ?>
      <div id="loggedas">Logged in as
        <a class="user active" href="/users/10">
          <?php
          echo $_SESSION['username'];
          ?>
        </a>
      </div>
    <?php endif ?>
    <ul>
      <!-- <li><a class="home" href="/">Home</a></li>
      <li><a class="my-page" href="/my/page">My page</a></li>
      <li><a class="projects" href="/projects">Projects</a></li> -->
      <li><a class="help" href="https://www.redmine.org/guide">Help</a></li>
    </ul>
  </div>
  <div id="header">

    <a href="#" class="mobile-toggle-button js-flyout-menu-toggle-button"></a>

    <div class="heading">
      <img src="imgs/logo.png">
      <h1><span class="current-project">Flash Share</span></h1>
    </div>

    <div id="main-menu" class="tabs">
      <ul>
        <li><a class="files selected" href="display.php">Files</a></li>
      </ul>
    </div>
  </div>
  <?php
  if (isset($_SESSION['message']) && $_SESSION['message']) {
    printf('<b>%s</b>', $_SESSION['message']);
    unset($_SESSION['message']);
  }
  ?>
</body>

</html>