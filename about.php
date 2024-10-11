<?php

require "db/db.php";
$myDB = new Database();

$id = isset($_SESSION['id']) ? $_SESSION['id'] : 'null';

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ABOUT</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/js.js"></script>
  <link rel="stylesheet" type="text/css" href="css/about.css">
  
</head>
<body>
<div class="wrapper">
<?php include 'navbar.php'; ?>

  <div class="blog-abt">
        <div class="heading-ABT"><span>About Us</span></div>
    <section class="about" id="about">
      <div class="row">
        <div class="img">
          <img src="img/blog.png" alt="Blog" />
        </div>
        <div class="content">
          <h3>Who We Are?</h3>
          <p>
          1080P Blogs is your go-to source for insightful articles and discussions about the latest in technology. 
          Our mission is to keep you informed, inspired, and ahead of the curve in a world where technology constantly 
          evolves. Whether you're passionate about cutting-edge gadgets, emerging trends in software development, AI 
          breakthroughs, or cybersecurity, we have something for everyone.
          </p>
          <p>
          At 1080P Blogs, we believe that technology isn't just about tools—it's about transforming the way we live, work, 
          and connect with each other. Our dedicated team is committed to delivering in-depth reviews, tutorials, and opinions 
          that help you navigate the ever-changing digital landscape.
          </p>
        </div>
      </div>
    </section>

    <h1 class="heading-team">Our Team</h1>
    <section class="team">
    <div class="profile-card">
      <div class="image">
        <img src="img/leo.jpg" alt="" class="profile-img" />
      </div>

      <div class="text-data">
        <span class="name">Leonora Pispis</span>
        <span class="job">Backbone</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div>
      

      <div class="media-buttons">
        <a href="https://www.facebook.com/profile.php?id=100008435048672" style="background: #4267b2" class="link">
          <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="mailto:pispisleonora29@gmail.com" style="background: #1da1f2" class="link">
          <i class="fa-solid fa-envelope"></i>
        </a>
        <a href="https://instagram.com/yonora_psps?igshid=ZDdkNTZiNTM=" style="background: #e1306c" class="link">
          <i class="fa-brands fa-instagram"></i>
        </a>
      </div>
    </div>
    
    <div class="profile-card">
      <div class="image">
        <img src="img/faye.jpg" alt="" class="profile-img" />
      </div>

      <div class="text-data">
        <span class="name">Hannah Faye Dugay</span>
        <span class="job">Frontrow</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div>
      

      <div class="media-buttons">
        <a href="https://www.facebook.com/hannahfaye.c.dugay" style="background: #4267b2" class="link">
          <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="mailto:dugayhannahfaye@gmail.com" style="background: #1da1f2" class="link">
          <i class="fa-solid fa-envelope"></i>
        </a>
        <a href="https://instagram.com/hnnhfy_?igshid=OTJhZDVkZWE=" style="background: #e1306c" class="link">
          <i class="fa-brands fa-instagram"></i>
        </a>
      </div>
    </div>

    </section>

    <?php include 'footer.php'; ?>

</body>
</html>