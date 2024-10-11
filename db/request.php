<?php
	require "db.php";
	$mydb = new Database();

	if(isset($_POST['get_blogs'])){
		$where = "";
		if(isset($_POST["id"])){
			$id = $_POST["id"];
			$where = ['id' => $id];
			$mydb->select('blogs', '*', $where);
		}elseif(isset($_POST["category"]) && $_POST["category"] !== "all"){
			$category = $_POST["category"];
			$where = ['category' => $category];
			$mydb->select('blogs', '*', $where);
		}else{
			$mydb->select('blogs');
		}
		$datas = [];
		while ($row = $mydb->res->fetch_assoc()){
			array_push($datas, $row);
		}
		echo json_encode($datas);
	}

	if(isset($_POST['get_comments'])){
		$where = "";
		if(isset($_POST["id"])){
			$id = $_POST["id"];
			$where = ['blogsID' => $id];
			$mydb->select('comments', '*', $where);
		}else{
			$mydb->select('comments');
		}
		$datas = [];
		while ($row = $mydb->res->fetch_assoc()){
			array_push($datas, $row);
		}
		echo json_encode($datas);
	}

	if(isset($_POST['like_blog'])){
		$where = "";
		if(isset($_POST["blogId"])){
			$id = $_POST["blogId"];
			$where = ['id' => $id];
			$blog_data = $mydb->select('blogs', '*', $where);
			$data = $mydb->res->fetch_assoc();
			$likes = $data['likes'];
			$likes += 1;
			$value = ['likes' => $likes];
			$mydb->update('blogs', $value, null, null, $where);
			echo json_encode(['status' => 'success', 'likes' => $likes]);
			// $_SESSION['likeCount'] = $id;
		}	
	}

	if(isset($_POST['add_blog'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $date = date('Y-m-d');
		$category = $_POST['category'];
        $userID = $_SESSION['id'];
		$author = $_SESSION['name'];
		$img = $_FILES['imageUpload'];
        

        $value = ['title' => $title, 'content' => $content, 'date_added' => $date, 'userID' => $userID, 'author' => $author, 'category' => $category];
        $image = $mydb->insert('blogs', $value, $img);
		header("location: ../blog_mngt.php");

    }

	if(isset($_POST['delete_blog']) && isset($_POST['blogID'])){
		$id = $_POST['blogID'];
		$where = ['id' => $id];
		$mydb->delete('blogs', $where);
		header("location: ../blog_mngt.php");
	}

	if(isset($_POST['update_blog'])){
		$id = $_POST['blogID'];
		$where = ['id' => $id];

		$title = $_POST['title'];
		$category = $_POST['category'];
        $content = $_POST['content'];
        $date = date('Y-m-d');
		$old_img = $_POST['old_img'];

        $new_img = $_FILES['newImageUpload'];
		$validateImage = $mydb->validateImage($new_img);
		if ($validateImage === true){
			$new_img = $_FILES['newImageUpload'];
		} else {
			$new_img = null;
		}
		
        $value = ['title' => $title, 'category' => $category, 'content' => $content, 'date_modified' => $date];
        $image = $mydb->update('blogs', $value, $new_img, $old_img, $where);
		header("location: ../blog_mngt.php");

	}

	if(isset($_POST['add_comment'])){
		if(!isset($_SESSION['id'])){
			header("location: ../signin.php");
		} else {
        	$blogID = $_POST['blogID'];
        	$comment = $_POST['comment'];
        	$date = date('Y-m-d');
        	$userID = $_SESSION['id'];
			$username = $_SESSION['name'];

        	$value = ['comment' => $comment, 'blogsID' => $blogID, 'date' => $date, 'userID' => $userID, 'username' => $username];
        	$image = $mydb->insert('comments', $value);
			header("location: ../blog_content.php?blogId=" . $blogID);
		}
    }
?>





