<!DOCTYPE html>
<html>
<head>
  <title>Pepperscum - Official (GeoCities Revival)</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=980">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style type="text/css">
    body {
      background: url("images/bg_tile.png") repeat;
      color: #00ff99;
      font-family: Verdana, Arial, Helvetica, sans-serif;
    }
  </style>
</head>
<body>

<div class="container">

  <div class="banner">
    <img src="images/main_banner.png" alt="Pepperscum" width="880" height="180">
    <div class="marquee">
      <marquee behavior="scroll" direction="left" scrollamount="5">
        Out of the vault: <span class="blink">Songs About Girls</span> — Stream it now on Bandcamp!
      </marquee>
    </div>
  </div>

  <hr>

  <table class="table-wrap" cellspacing="0" cellpadding="10">
    <tr>
      <td class="sidebar">
        <p>
          <a href="index.php?page=home" class="icon-button">
            <img src="images/home.png" alt="Home" width="160" class="icon">
            <span class="icon-label">Home</span>
          </a>
        </p>
        <p>
          <a href="index.php?page=music" class="icon-button">
            <img src="images/music.png" alt="Music" width="160" class="icon">
            <span class="icon-label">Music</span>
          </a>
        </p>
        <p>
          <a href="index.php?page=guestbook" class="icon-button">
            <img src="images/book.png" alt="Guestbook" width="160" class="icon">
            <span class="icon-label">Guestbook</span>
          </a>
        </p>
      </td>
      <td class="main">
        <div class="content">
          <?php
          // ✅ Inject the view file here
          if (isset($view)) {
              require $view;
          }
          ?>
        </div>
      </td>
    </tr>
  </table>

  <hr>
<style>

</style>

<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Pepperscum — Revived from GeoCities!.</p>
    <p class="arcade">Hits <?= $hitCounter->getHits($pageName) ?></p>

</div>
  
</body>
</html>
