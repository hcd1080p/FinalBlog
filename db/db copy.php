<?php

class Database{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "blog";
    public $res;
    public $conn;

    public function __construct(){
        try{
            session_start();
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db_name);
        }catch(Exception $e){
            die("database connection error!. <br>". $e);
        }
    }

    public function __destruct(){
        $this->conn->close();
    }
}

class Account extends Database{


    public function validateEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 'Invalid Email';
        } 
        return '';
    }

    public function emailInUse($email){
        $count = "";

        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM `user` WHERE `email` = ?");
        $stmt->bind_param('s', $email); 
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if($count > 0){
            return 'Email is already in use.';    
        }
        return '';        
    }

    public function validatePassword($password){
        if (!preg_match('/^(?=.*\S).{8,}$/', $password)) {
            return 'Password must be at least 8 characters long and cannot contain spaces.';
        } 
        return '';
    }

    public function confirmPassword($password, $confirmPass){
        if ($password !== $confirmPass) {
            return 'Password do not match.';
        }
        return '';
    }

    public function createAccount($username, $email, $password, $confirmPass, $role="user"){
        try{
            if(empty($this->validateEmail($email)) && empty($this->validatePassword($password)) && empty($this->confirmPassword($password, $confirmPass)) && empty($this->emailInUse($email))){
                
                $password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $this->conn->prepare("INSERT INTO `user`(`full_name`, `email`, `password`, `role`) VALUES (?,?,?,?)");
                $stmt->bind_param('ssss', $username, $email, $password, $role); 
                $stmt->execute();
                $stmt->close();
                header('location: index.php');     
            }
        }catch(Exception $e){
            echo "Error creating account! <br>" .$e;
        }
    }

    public function loginAccount($email, $password){
        try{
            if(empty($this->validateEmail($email)) && empty($this->validatePassword($password)) && !empty($this->emailInUse($email))){

                $savedPass = $id = $role =$name ="";

                $stmt = $this->conn->prepare("SELECT `id`, `full_name`, `password`, `role` FROM `user` WHERE `email` = ?");
                $stmt->bind_param('s', $email); 
                $stmt->execute();
                $stmt->bind_result($id, $name, $savedPass, $role);
                $stmt->fetch();
                $stmt->close();
                
                $verify_password = password_verify($password, $savedPass);
                if(!$verify_password){
                    return 'Wrong Password!';
                } else {
                    $_SESSION['id'] = $id;
                    $_SESSION['name'] = $name;
                    if($role === "admin" ){
                        header('location: dashboard.php');
                    }else{
                        header('location: index.php');
                    }
                    exit();
                }
            } else {
                return "<script>alert( `You don't have an account!`)</script>";
            }
        }catch(Exception $e){
            echo "Error logging in! <br>" .$e;
        }
    }

}

    
class CRUD{

    public function insert($table, $data) {
        try {
            $table_columns = implode(',', array_keys($data));
            $prep=$types = "";

            foreach ($data as $key => $value) {
                $prep .= '?,';
                $types .= substr(gettype($value), 0, 1);
            }
            $prep = substr($prep, 0, -1);
            $stmt = $this->conn->prepare("INSERT INTO $table($table_columns) VALUES ($prep)");
            $stmt->bind_param($types, ...array_values($data));
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            die("Error while inserting data! <br>" . $e);
        }
    }

    public function select($table, $row = "*", $where = NULL) {
        try {
            if (!is_null($where)) {
                $cond = $types = "";

                foreach ($where as $key => $value) {
                    $cond .= $key . " = ? AND ";
                    $types .= substr(gettype($value), 0, 1);
                }
                $cond = substr($cond, 0, -4);
                $stmt = $this->conn->prepare("SELECT $row FROM $table WHERE $cond");
                $stmt->bind_param($types, ...array_values($where));
            } else {
                $stmt = $this->conn->prepare("SELECT $row FROM $table");
            }
            $stmt->execute();
            $this->res = $stmt->get_result();
        } catch (Exception $e) {
            die("Error requesting data! <br>" . $e);
        }
    }

    public function update($table, $data, $where) {
        try {
            $prep = $types = "";
            foreach ($data as $key => $value) {
                $prep .= $key . " = ?, ";
                $types .= substr(gettype($value), 0, 1);
            }
            $prep = substr($prep, 0, -2); 
            $cond = "";
            foreach ($where as $key => $value) {
                $cond .= $key . " = ? AND ";
                $types .= substr(gettype($value), 0, 1);
            }
            $cond = substr($cond, 0, -4); 

            $stmt = $this->conn->prepare("UPDATE $table SET $prep WHERE $cond");
            $stmt->bind_param($types, ...array_merge(array_values($data), array_values($where)));
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            die("Error while updating data! <br>" . $e);
        }
    }

    public function delete($table, $where) {
        try {
            $cond = $types = "";
            foreach ($where as $key => $value) {
                $cond .= $key . " = ? AND ";
                $types .= substr(gettype($value), 0, 1);
            }
            $cond = substr($cond, 0, -4); 

            $stmt = $this->conn->prepare("DELETE FROM $table WHERE $cond");
            $stmt->bind_param($types, ...array_values($where));
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            die("Error while deleting data! <br>" . $e);
        }
    }

    public function validateImage($image) {
        
        if($image['error'] === UPLOAD_ERR_NO_FILE) {
            return 'Image is required.';
        }
        return true;
    }

    public function insertImage($image) {

        $imgErr = $this->validateImage($image);

        $file_ext = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));

        if (in_array($file_ext, array('jpg', 'jpeg', 'png'))) {
            $filename = $image["name"];
            $tempname = $image["tmp_name"];
            $folder = "./img/".$filename;

            $stmt = $this->conn->prepare("INSERT INTO blogs(img) VALUES (?)");
            $stmt->bind_param("s", $filename);
            $stmt->execute();


            if (move_uploaded_file($tempname, $folder)) {
                $message = "Image uploaded successfully!</h3>";
                header("Location: blog_mngt.php");
            } else {
                echo "<h3>  Failed to upload image!</h3>";
            }
        } else {
            echo "<h3>  Only JPG, JPEG, and PNG files are allowed!</h3>";
        }
    }


}

?>