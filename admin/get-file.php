<?php
class HandelFile{
    protected $target_dir;
    protected $target_file;
    
    function __construct(){
        $this -> target_dir = "../images/";
        $this -> target_file = $this -> target_dir . basename($_FILES['image']["name"]);
    }
    
    function ChechImage(){
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
        return True;
        } else {
            return False;
        }
    }
    
    function ChechImageName(){
        if (file_exists($this -> target_file)) {
            return False;
        }
        return True;
    }
    
    function CopyFile(){
        move_uploaded_file($_FILES["image"]["tmp_name"], $this -> target_file);
    }
    function GetName(){
        return basename($_FILES['image']["name"]);
    }
}
?>