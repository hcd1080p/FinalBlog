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
    <!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
    <script type="text/javascript" src="js/js.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <title></title>
</head>
<body>
    <input type="checkbox" id="menu-toggle">
        <?php include 'sidebar.php'; ?>
        
        <main>
            <div class="page-header">
                <h1>Blogs Management</h1>
                <small>Blogs</small>
            </div>
            
            <div class="page-content">
                <div class="records table-responsive">
                    <div class="record-header">
                        <div class="add">
                            <button data-toggle="modal" data-target="#addModal">ADD</button>
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

                            <div class="modal fade" id="addModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Add Blog</h4>
                                        </div>

                                        <form method="post" action="db/request.php" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label> Title </label>
                                                    <input type="text" name="title" class="form-control" required>
                                                </div>

                                                <div class="form-group">
                                                    <label> Category </label>
                                                    <input type="text" name="category" class="form-control" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <div class="holder">
                                                        <img id="preview" src="#" alt="Preview image" width="500px"/>
                                                    </div><br>
                                                    <input type="file" name="imageUpload" class="form-control" id="imageUpload">
                                                </div>

                                                <div class="form-group">
                                                    <label>Content</label>
                                                    <textarea rows="5" name="content" class="form-control" required></textarea>
                                                </div>

                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add_blog" class="btn btn-primary">Create Blog</button>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="updateModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Update Blog</h4>
                                        </div>

                                        <form method="post" action="db/request.php" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="hidden" name="blogID" id="updateBlogID" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label> Title </label>
                                                    <input type="text" name="title" id="title" class="form-control" value="" required>
                                                </div>

                                                <div class="form-group">
                                                    <label> Category </label>
                                                    <input type="text" name="category" id="category" class="form-control" value="" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <div class="holder">
                                                        <img id="preview_old" alt="Preview image" width="500px" src="">
                                                        <input type="hidden" id="old_img" name="old_img"  value="">
                                                    </div><br>
                                                    <input type="file" name="newImageUpload" class="form-control" id="newImageUpload">
                                                </div>

                                                <div class="form-group">
                                                    <label>Content</label>
                                                    <textarea rows="5" name="content" id="content" class="form-control"  value="" required></textarea>
                                                </div>

                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="update_blog" class="btn btn-primary">Update Blog</button>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delete Blog</h4>
                                        </div>

                                        <form method="post" action="db/request.php">
                                            <div class="modal-body">
                                                Are you sure you want to delete this blog?
                                                <input type="hidden" name="blogID" id="deleteBlogID" value="">
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="delete_blog" class="btn btn-danger">Delete Blog</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>  
        </main>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            loadBlogs();

            $(document).on('click', '.btn-delete', function() {
                const blogId = $(this).data('id');
                $('#deleteBlogID').val(blogId);
                $('#deleteModal').modal('show');
            });

            $(document).on('click', '.btn-update', function() {
                const blogId = $(this).data('id');
                $('#updateBlogID').val(blogId);
                $('#updateModal').modal('show');
                showBlog(blogId);
            });
            
            $('#newImageUpload').on('change', function(event){
                var reader = new FileReader();
                reader.onload = function(){
                    var preview = document.getElementById('preview_old');
                    preview.src = reader.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(event.target.files[0]);
            })
            $('#imageUpload').on('change', function(event){
                var reader = new FileReader();
                reader.onload = function(){
                    var preview = document.getElementById('preview');
                    preview.src = reader.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(event.target.files[0]);
            })
        });
    </script>

</body>
</html>