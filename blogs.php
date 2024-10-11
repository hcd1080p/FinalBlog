<?php

require "db/db.php";
$myDB = new Database();

$id = isset($_SESSION['id']) ? $_SESSION['id'] : 'null';

$categories_query = "SELECT DISTINCT category FROM blogs";
$category_data = $myDB->conn->query($categories_query); 
$categories = [];

if ($category_data) {
    while ($category_row = mysqli_fetch_assoc($category_data)) {
        $categories[] = $category_row['category'];
    }
} else {
    echo "Error: " . $myDB->conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
    <!-- <script type="text/javascript" src="js/filter.js"></script> -->
    <link rel="stylesheet" href="css/blogs.css">
    <title>1080P BLOGS</title>
</head>
<body>
  <header>
    <div class="wrapper">
        <?php include 'navbar.php'; ?>

        <div class="blogs">
            <div class="heading"><span>Blogs</span></div>
        </div>
    </div>   
</header> 

<div class="post-filter container">
    <span class="filter-item active-filter" data-filter="all">All</span>
        <?php foreach ($categories as $category): ?>
            <span class="filter-item" data-filter="<?= strtolower($category) ?>"><?= $category ?></span>
        <?php endforeach; ?>
    
</div>

<div class="search-bar-container">
    <form class="search-form">
        <input type="text" id="search_value" placeholder="Search Blogs..." class="search-input" onkeyup="displayBlogs()">
        <i class='fas fa-search search-icon'></i>
    </form>
</div>


<section class="post container" id="postContainer">
    
</section>

<?php include 'footer.php'; ?>

<script type="text/javascript">
    $(document).ready(function() {
        activePage();
        userLoggedIn(<?=$id?>);
        displayBlogs();
        
    });

    function toggleMenu() {
        const navMenu = document.getElementById('navMenu');
        navMenu.classList.toggle('show');
    }

    $('.user-btn').on('click', function(){
        window.location.href = 'userProfile.php'
    })

    $('.filter-item').click(function(){
        const value = $(this).attr('data-filter')

        console.log(value);
        if(value !== 'all'){
            displayBlogs(null, value);
        }else{
            displayBlogs();
        }
    });
    $('.filter-item').click(function(){
        $(this).addClass('active-filter').siblings().removeClass('active-filter');
    });
</script>


</body>
</html>
