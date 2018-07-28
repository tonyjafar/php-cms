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
        
    }
    
    function Login(){
        
    }
    
    function Logout(){
        
    }
    
    function IsAdmin(){
        
    }
    
    function IsActive(){
        
    }
    
}

?>