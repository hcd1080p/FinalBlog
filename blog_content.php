<?php

require "db/db.php";
$myDB = new Database();

$id = isset($_SESSION['id']) ? $_SESSION['id'] : 'null';
$blogId = $_GET['blogId'];
$myDB->select('blogs', "*", $where = ['id' => $blogId]);
$blog_data = $myDB->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/blog_content.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <title></title>
</head>
<body>
    
    <header>
        <?php include 'navbar.php'; ?>
    </header>
    <?php while ($row = mysqli_fetch_assoc($blog_data)): ?>
    <section class="post-header">
        <div class="header-content post-container">
            <h1 class="header-title"><?=$row['title']?></h1>
            <img src="<?=$row['img']?>" class="header-img">

            <div class="post-meta">
                <span class="post-author"><i class="fas fa-user"></i><?=$row['author']?></span>
                <span class="post-date"><i class="fas fa-calendar"></i><?=$row['date_modified'] !== '0000-00-00' ? $row['date_modified'] : $row['date_added']?></span>
                <span class="post-category"><i class="fas fa-tag"></i><?=$row['category']?></span>
            </div>
            
        </div>
    </section>
    <section class="post-content post-container">
        <p class="post-text"><?=$row['content']?></p>
    </section>

   <section class="post-interactions post-container">
        <div class="interaction-buttons" style="position:relative;">
            <button class="button like-btn">
                <i class="fas fa-thumbs-up"></i> Like (<span id="like-count"><?=$row['likes']?></span>)
            </button>
            <button class="button share-btn" id="shareBtn">
                <i class="fas fa-share"></i> Share
            </button>

            <div id="popupContainer">
                <p>Shareable link:</p>
                <input type="text" id="shareableLink" value="<?= "http://localhost/FINAL1080pblogs/blog_content.php?blogId=" . $blogId ?>" readonly>
            </div>
        </div>
        <?php endwhile; ?>

        <div class="comment-section">
            <h3 class="comment-title">Leave a Comment</h3>
            <form action="db/request.php" method="POST" class="comment-form">
                <input type="hidden" name="blogID" value="<?=$blogId?>">
                <textarea name="comment" class="comment-input" rows="4" placeholder="Write your comment here..."></textarea>
                <button type="submit" class="button submit-comment" name="add_comment">Submit</button>
            </form>

            <div class="comments-display" id="comment"></div>

        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script>
        $(document).ready(function(){
            displayComments(<?=$blogId?>);

            $('.like-btn').on('click', function(){
                var userId = <?=$id?>;
                var blogId = <?=$blogId?>;
                if(userId === null){
                    window.location.href = "./signin.php";
                }else {
                    $.ajax({
                        url: 'db/request.php',
                        method: 'POST',
                        data: {
                            "like_blog": true,
                            "blogId": blogId,
                        },
                        success: function(response) {
                            const result = JSON.parse(response);
                            if (result.status === 'success') {
                                $('#like-count').text(result.likes);
                            }
                        },
                        error: function() {
                            alert("Something went wrong. Please try again.");
                        }
                    });
                }
            });

            $('#shareBtn').on('click', function(){
                var popup = $('#popupContainer');
                if (popup.is(':visible')) {
                    popup.hide(); 
                } else {
                    popup.show(); 
                }
            });

            $('#shareableLink').focus(function() {
                $(this).select();
            });

            $(document).click(function(event) { 
                if(!$(event.target).closest('.interaction-buttons, #popupContainer').length) {
                    if($('#popupContainer').is(':visible')) {
                        $('#popupContainer').hide();
                    }
                }        
            });
        });
    </script>
</body>
</html>
