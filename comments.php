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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title></title>
</head>
<body>
    <input type="checkbox" id="menu-toggle">
        <?php include 'sidebar.php'; ?>
        
        <main>
            <div class="page-header">
                <h1>Comments Management</h1>
                <small>Comments</small>
            </div>
            
            <div class="page-content">
                <div class="records table-responsive">
                    
                    <div>
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th><span></span>TITLE</th>
                                    <th><span></span> COMMENT</th>
                                    <th><span></span> USER</th>
                                    <th><span></span> DATE</th>
                                </tr>
                            </thead>
                            <tbody id="tBodyBlog"></tbody>
                        </table>
                        </div>
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