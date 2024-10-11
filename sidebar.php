<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <script type="text/javascript" src="js/js.js"></script>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>1080P</h3>
        </div>
        
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/bg.jpg)"></div>
                <h4><?=$_SESSION['name']?></h4>
                <small>ADMIN</small>
            </div>

            <nav class="side-menu">
                <ul>
                    <li>
                       <a href="dashboard.php" id="dashboard" class="">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                       <a href="comments.php" id="comments" class="">
                            <span class="las la-user-alt"></span>
                            <small>Comments</small>
                        </a>
                    </li>
                    <li>
                       <a href="blog_mngt.php" id="blogs" class="">
                            <span class="las la-blog"></span>
                            <small>Blogs</small>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                
                <div class="header-menu">
                    <form action="db/request.php" method="post">
                        <div class="user">
                            <span class="las la-power-off"></span>
                            <input type="submit" id="logout" name="logout" value="Logout">
                        </div>
                    </form>
                </div>
            </div>
        </header>
    </div>

    <script>
        $(document).ready(function(){
            activePage();
        })
        const menuLinks = document.querySelectorAll('.side-menu a');

        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                menuLinks.forEach(item => item.classList.remove('active'));

                this.classList.add('active');
            });
        });
</script>

</body>
</html>