<?php
class Users{
    protected $conn;
    
    public function __construct(){
        $this -> conn = mysqli_connect("localhost", "root", "", "cms");
    }
    
    function CreateUser(){
            $username = mysqli_real_escape_string($this->conn, $_POST['username']);
            $password = mysqli_real_escape_string($this->conn, $_POST['password']);
            $password2 = mysqli_real_escape_string($this->conn, $_POST['password2']);
            if ($username != "" && $password != ""){
                if (strlen($password) > 5){
                    if ($password === $password2){
                        $checkUser = "select username from users where username = '$username'";
                        $result = mysqli_query($this->conn, $checkUser);
                        if (mysqli_num_rows($result) == 0){
                            $hash = "$2y$10$";
                            $salt = "mysuperoverkillingsaltiwillnverused";
                            $hashSalt = $hash . $salt;
                            $encPass = crypt($password, $hashSalt);
                            $createUser = "insert into users (username, password) ";
                            $createUser .= "values ('$username', '$encPass')";
                            $createResult = mysqli_query($this->conn, $createUser);
                            if (!$createResult){
                                return "Could not create the user please try again later";
                            }
                         }else {
                            return "Username is already taken";
                        }
                   }else{
                        return "Passwords do not matched";
                    }
                }else {
                    return "Password should be 6 char long";
                }
            }else{
                return "please fill in all fields";
            }
        return "done";
    }
    
    
    function GetUser(){
        if ($this -> LoggedIn()){
            $username = $_GET['username'];
            if ($_COOKIE['loggedIn'] == $username){
                return $username;
            }else{
                header('Location: index.php');
            }
        }else{
            header('Location: index.php');
        }
        
    }
    
    function ChangePass($username){
            $oldPass = mysqli_real_escape_string($this->conn, $_POST['old-password']);
            $pass1 = mysqli_real_escape_string($this->conn, $_POST['new-password']);
            $pass2 = mysqli_real_escape_string($this->conn, $_POST['password2']);
            if ($oldPass != "" && $pass1 != "" && $pass2 != ""){
                $checkOld = "select password from users where username='$username'";
                $result_checkOld = mysqli_query($this->conn, $checkOld);
                $result_checkOld = mysqli_fetch_assoc($result_checkOld);
                $oldPassDB = $result_checkOld['password'];
                if (password_verify($oldPass, $oldPassDB)){
                    if($pass1 === $pass2){
                        if (strlen($pass1) > 5){
                            $hash = "$2y$10$";
                            $salt = "mysuperoverkillingsaltiwillnverused";
                            $hashSalt = $hash . $salt;
                            $encPass = crypt($pass1, $hashSalt);
                            $update = "update users set password = '$encPass' where username = '$username'";
                            $result_update = mysqli_query($this->conn, $update);
                            if ($result_update){
                                return "OK";
                            }
                        }else{
                            return "1";
                        }
                    }else{
                        return "2"; 
                    }
                }else{
                    return "3";
                }
            }else{
                return "0";
            }
    }
    
    function LoggedIn(){
        if (isset($_COOKIE['loggedIn'])){
            $name = "loggedIn";
            $value = $_COOKIE['loggedIn'];
            $expire = time() + (60 * 60 * 24);
            setcookie($name, $value, $expire, "/");
            return True;
        }else{
            return False;
        }
    }
    
    function Login(){
        if ($this -> LoggedIn()){
            header("Location: index.php");
        }
        $username = mysqli_real_escape_string($this->conn, $_POST['username']);
        $password = mysqli_real_escape_string($this->conn, $_POST['password']);
        if ($username != "" && $password != ""){
            $getPass = "select password from users where username = '$username'";
            $result = mysqli_query($this->conn, $getPass);
            if ($result){
                if (mysqli_num_rows($result) > 0){
                    if ($this -> IsActive($username)){
                        $row = mysqli_fetch_assoc($result);
                        $DBPass = $row['password'];
                        if (password_verify($password, $DBPass)){
                            $name = "loggedIn";
                            $value = $username;
                            $expire = time() + (60 * 60 * 24);
                            setcookie($name, $value, $expire, "/");
                            header("Location: index.php");
                        }else{
                        return "Username or Password is not correct";
                        }
                    }else{
                        return "Your account is still not active, please try again later";
                    }
                }else{
                    return "Username or Password is not correct";
                }
            }else{
                return "Username or Password is not correct";
            }
        }else{
            return "Please fill in all fields";
        }
        
    }
    
    function Logout(){
        if (!$this -> LoggedIn()){
            header("Location: index.php");
        }
        $name = "loggedIn";
        $value = "";
        unset($_COOKIE[$name]);
        setcookie($name, '', time() - 3600, "/");
        $newURL = "index.php";
        header('Location: '.$newURL);
    }
    
    function IsAdmin($username){
        $checkUser = "select admin from users where username = '$username'";
        $result = mysqli_query($this->conn, $checkUser);
        $row = mysqli_fetch_assoc($result);
        if ($row['admin'] == 'yes'){
            return True;
        }else{
            return False;
        }
        
    }
    
    function IsActive($username){
        $checkUser = "select active from users where username = '$username'";
        $result = mysqli_query($this->conn, $checkUser);
        if ($result){
            $row = mysqli_fetch_assoc($result);
            if ($row['active'] == 'yes'){
                return True;
            }else{
                return False;
            }
        }
        return False;
    }
}

?>