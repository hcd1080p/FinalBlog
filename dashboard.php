<?php
    require "db/db.php";
    $myDB = new Database();

    if(!isset($_SESSION['id'])){
        header("Location: signin.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
</head>
<body>
   <input type="checkbox" id="menu-toggle">
        <?php include 'sidebar.php'; ?>
        <main>
            <div class="page-header">
                <h1>Dashboard</h1>
                <small>Home / Dashboard</small>
            </div>
            
            <div class="page-content">
                <div class="analytics">
                    <div class="card">
                        <div class="card-head">
                            <h2>107,200</h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>Total number of users</small>
                            <div class="card-indicator">
                                <div class="indicator one" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2>340,230</h2>
                            <span class="las la-thumbs-up"></span>
                        </div>
                        <div class="card-progress">
                            <small>Total likes</small>
                            <div class="card-indicator">
                                <div class="indicator two" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2>$653,200</h2>
                            <span class="las la-comments"></span>
                        </div>
                        <div class="card-progress">
                            <small>Total comments</small>
                            <div class="card-indicator">
                                <div class="indicator three" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2>47,500</h2>
                            <span class="las la-share"></span>
                        </div>
                        <div class="card-progress">
                            <small>Total shares</small>
                            <div class="card-indicator">
                                <div class="indicator four" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="records table-responsive">
                    <div class="record-header">
                        <div class="add">
                            <h2>Recent Blogs</h2>
                        </div>

                        <div class="browse">
                            <input type="text" placeholder="Search" class="record-search" id="search_value" placeholder="Search blog..." onkeyup="loadBlogs()">
                            <span class="fas fa-search search-icon"></span>
                        </div>
                    </div>

                    <div>
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th><span></span>TITLE</th>
                                    <th><span></span> CATEGORY</th>
                                    <th><span></span> PICTURE</th>
                                    <th><span></span> CONTENT</th>
                                    <th><span></span> AUTHOR</th>
                                    <th><span></span> DATE ADDED</th>
                                    <th><span></span> DATE MODIFIED</th>
                                    <th><span></span> ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody id="tBodyBlog"></tbody>
                        </table>
                    </div>
                </div>
            </div>    
        </main>   
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            loadBlogs();
        });
    </script>
</body>
</html>