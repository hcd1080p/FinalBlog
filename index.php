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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/blogs.css">
    <title>1080P BLOGS</title>
</head>
<body>
  <header>
    <div class="wrapper">
    <?php include 'navbar.php'; ?>

    <div class = "banner">
        <div class = "container">
          <h1 class = "banner-title">
            <span>1080P</span> Tech Blogs
          </h1>
          <p>everything that you want to know about technology</p>
          <form>
            <input type = "hidden" class = "search-input" id="search_value" placeholder="Search blog . . .">
          </form>
        </div>
      </div>
      </header>

      
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
          <a href="about.php" class="read-more">Read More</a>
        </div>
      </div>
    </section>

    <h3 class="blogs-home">Latest Blogs</h3>
    <section class="post container" id="postContainer"></section>

    <div class="see-all-container">
      <a href="blogs.php" class="see-all-btn">See All Blogs</a>
    </div>

    <?php include 'footer.php'; ?>

    <script type="text/javascript">
        $(document).ready(function() {
            activePage();
            userLoggedIn(<?=$id?>);
            displayBlogs(3);   
        });
    </script>
</body>
</html>