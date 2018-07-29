<?php
class Users{
    function CreateUser(){
            $conn = mysqli_connect("localhost", "root", "", "cms");
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            if ($username != "" && $password != ""){
                if (strlen($password) > 5){
                    $checkUser = "select username from users where username = '$username'";
                    $result = mysqli_query($conn, $checkUser);
                    if (mysqli_num_rows($result) == 0){
                        $hash = "$2y$10$";
                        $salt = "mysuperoverkillingsaltiwillnverused";
                        $hashSalt = $hash . $salt;
                        $encPass = crypt($password, $hashSalt);
                        $createUser = "insert into users (username, password) ";
                        $createUser .= "values ('$username', '$encPass')";
                        $createResult = mysqli_query($conn, $createUser);
                        if (!$createResult){
                            return "Could not create the user please try again later";
                        }
                    }else {
                        return "Username is already taken";
                    }
                }else {
                    return "Password should be 6 char long";
                }
            }else{
                return "please fill in all fields";
            }
        return "done";
    }
    
    
    function UpdateUser(){
        
    }
    
    
    function ListUsers(){
        
    }
    
    
    function DelUser(){
        
    }
    
    function LoggedIn(){
        if (isset($_COOKIE['loggedIn'])){
            $name = "loggedIn";
            $value = $_COOKIE['loggedIn'];
            $expire = time() + (60 * 60 * 24);
            setcookie($name, $value, $expire);
            return True;
        }else{
            return False;
        }
    }
    
    function Login(){
        if ($this -> LoggedIn()){
            header("Location: index.php");
        }
        $conn = mysqli_connect("localhost", "root", "", "cms");
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if ($username != "" && $password != ""){
            $getPass = "select password from users where username = '$username'";
            $result = mysqli_query($conn, $getPass);
            if ($result){
                if (mysqli_num_rows($result) > 0){
                    if ($this -> IsActive($username)){
                        $row = mysqli_fetch_assoc($result);
                        $DBPass = $row['password'];
                        if (password_verify($password, $DBPass)){
                            $name = "loggedIn";
                            $value = $username;
                            $expire = time() + (60 * 60 * 24);
                            setcookie($name, $value, $expire);
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
        unset($_COOKIE[$cookie_name]);
        setcookie($name, '', time() - 3600);
        $newURL = "index.php";
        header('Location: '.$newURL);
    }
    
    function IsAdmin($username){
        $conn = mysqli_connect("localhost", "root", "", "cms");
        $checkUser = "select admin from users where username = '$username'";
        $result = mysqli_query($conn, $checkUser);
        $row = mysqli_fetch_assoc($result);
        if ($row['admin'] == 'yes'){
            return True;
        }else{
            return False;
        }
        
    }
    
    function IsActive($username){
        $conn = mysqli_connect("localhost", "root", "", "cms");
        $checkUser = "select active from users where username = '$username'";
        $result = mysqli_query($conn, $checkUser);
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