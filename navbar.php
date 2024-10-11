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
    <link rel="stylesheet" href="css/navbar.css">
    <title>1080P BLOGS</title>
</head>
<body>
  
    <nav class="nav" id="navbar">
        <div class="nav-logo">
            <p>1080P</p>
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="index.php" class="link">HOME</a></li>
                <li><a href="blogs.php" class="link">BLOGS</a></li>
                <li><a href="about.php" class="link">ABOUT</a></li>
                <li><a href="contact.php" class="link">CONTACT</a></li>
                <li class="nav-button">
                    <a href="signin.php"><button class="btn white-btn" id="loginBtn">Sign In</button></a>
                    <a href="signup.php"><button class="btn white-btn" id="registerBtn">Sign Up</button></a>
                </li>
                <li>
                    <button class="user-btn" id="userBtn">
                        <i class="bx bx-log-out"></i> Logout
                    </button>
                </li>
            </ul>
        </div>
        
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="toggleMenu()"></i>
        </div>
    </nav>

    <script type="text/javascript">
        $(document).ready(function() {
            activePage();
            userLoggedIn(<?=$id?>);
            blogPrev();
            console.log(<?=$id?>);

        });

        $(window).scroll(function() {
                var navbar = $('#navbar');
                if ($(this).scrollTop() > 110) {
                    navbar.addClass('scrolled');
                } else {
                    navbar.removeClass('scrolled');
                }
            });

        function toggleMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('show');
        }

        $('.user-btn').on('click', function(){
            window.location.href = 'userProfile.php';
        });
    </script>
</body>
</html>