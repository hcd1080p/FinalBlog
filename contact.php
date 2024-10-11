<?php

require "db/db.php";
$myDB = new Database();

$id = isset($_SESSION['id']) ? $_SESSION['id'] : 'null';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
    <link rel="stylesheet" href="css/contact.css">
    <title>1080P BLOGS</title>
</head>
<body>
  <header>
    <div class="wrapper">
        <?php include 'navbar.php'; ?>

        <div class="contact">
            <div class="heading"><span>Contact Us</span></div>
        </div>
    </div>

    <div class = "contact-body">
        <div class = "contact-info">
          <div>
            <span><i class = "fas fa-mobile-alt"></i></span>
            <span>Phone No.</span>
            <span class = "text">09123987456</span>
          </div>
          <div>
            <span><i class = "fas fa-envelope-open"></i></span>
            <span>E-mail</span>
            <span class = "text">1080pblogs@gmail.com</span>
          </div>
          <div>
            <span><i class = "fas fa-map-marker-alt"></i></span>
            <span>Address</span>
            <span class = "text">Science City of Munoz, Nueva Ecija, Philippines</span>
          </div>
        </div>

        <div class = "contact-form">
          <form>
            <div>
              <input type = "text" class = "form-control" placeholder="First Name">
              <input type = "text" class = "form-control" placeholder="Last Name">
            </div>
            <div>
              <input type = "email" class = "form-control" placeholder="E-mail">
              <input type = "text" class = "form-control" placeholder="Phone">
            </div>
            <textarea rows = "5" placeholder="Message" class = "form-control"></textarea>
          </form>
          <div class="button-wrapper">
              <input type="submit" class="send-btn" value="Send Message">
            </div>
        </div>
      </div>

      <?php include 'footer.php'; ?>
</body>
</html>