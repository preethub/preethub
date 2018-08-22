<?php 

class db {
        var $link = null;

        function __construct($db_host,$db_user,$db_pass,$db_name){
            
            $this->link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            
            if (!$this->link) die('Connect Error (' . mysqli_connect_errno() . ') '.mysqli_connect_error());
            
            mysqli_select_db($this->link, $db_name) or die(mysqli_error($this->link));
            
            return true;
        }
       function query($q){

            return mysqli_query($this->link,$q);

        }
        function count($q){
            $result = mysqli_query($this->link,$q);

            return mysqli_num_rows($result);

        }
       function select($q){
        
            $result = mysqli_query($this->link,$q);
                        if(mysqli_num_rows($result) > 0)

                while($res = mysqli_fetch_object($result))
                
                    $arr[] = $res;
                
            if($arr) return $arr;
            
            return false;
        }
       function get_row($q){
            $result = mysqli_query($this->link,$q);

            if(mysqli_num_rows($result) == 1)

            $arr = mysqli_fetch_object($result);
                            
            if($arr) return $arr;
            
            return false;
        }
        function escape($str){

            return mysqli_real_escape_string($this->link,$str);
        }
        function insert($q){

            if(mysqli_query($this->link,$q))
                return mysqli_insert_id($this->link); 
            return false;
        }
         }
         
