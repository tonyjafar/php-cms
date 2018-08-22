<?php


class Pager{
    var $pageContain = 4;
    var $listLength = 0;
    var $PageNum = 0;
    var $next = false;
    var $prev = false;
    
    function PageIt($postList){
        
        if (isset($_GET['page'])){
            $this -> PageNum = $_GET['page'];
            if (!is_numeric($this -> PageNum)){
                header("Location: index.php");
            }
            $pageStart = ($this -> PageNum -1)* $this -> pageContain;
            $pageEnd = $pageStart + $this -> pageContain;
            if ($this -> listLength <= $pageEnd){
                $members = array_slice($postList, $pageStart, $this -> listLength,true);
                $this -> next = false;
            }else{
                $members = array_slice($postList, $pageStart, $this -> pageContain, true);
                $this -> next = true;
            }
            if ($this -> PageNum == 1){
                $this -> prev = false;
            }else{
                $this -> prev = true;
            }
        }else{
            $this -> prev = false;
            $this -> PageNum = 1;
            if ($this -> pageContain >= $this -> listLength){
                $this -> next = false;
                $this -> prev = false;
                $members = $postList;
            }else{
                $this -> next = true;
                $this -> prev = false;
                $members = array_slice($postList, 0, $this -> pageContain, true);
            }
        }
        if (!sizeof($members) == 0){
            return $members;
        }else{
            header("Location: index.php");
        }
        
    }
}

