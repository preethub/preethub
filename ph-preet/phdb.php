<?php

/*--------------
* phdb class
* Preethub
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
* github.com/preethub/preethub
*-------------*/



class phdb {
	
        var $link = null;       

        function __construct($db_host,$db_user,$db_pass,$db_name){
            
            $this->link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            
            if (!$this->link) die('Connect Error (' . mysqli_connect_errno() . ') '.mysqli_connect_error());
            
            mysqli_select_db($this->link, $db_name) or die(mysqli_error($this->link));
            
            return true;
        }
       function query($query){

            return mysqli_query($this->link,$query);

        }
        function count($query){
            $result = mysqli_query($this->link,$query);

            return mysqli_num_rows($result);

        }
       function select($query){
        
            $result = mysqli_query($this->link,$query);
                        if(mysqli_num_rows($result) > 0)

                while($res = mysqli_fetch_object($result))
                
                    $arr[] = $res;
                
            if($arr) return $arr;
            
            return false;
        }
       function get_row($query){
            $result = mysqli_query($this->link,$query);

            if(mysqli_num_rows($result) == 1)

            $arr = mysqli_fetch_object($result);
                            
            if($arr) return $arr;
            
            return false;
        }
        function escape($str){

            return mysqli_real_escape_string($this->link,$str);
        }	
        }        
  $phdb = new phdb(DB_HOST,DB_USER,DB_PASS,DB_NAME); 
  
   $phdb->config = TABLE_PREFIX . 'config';
 $phdb->pages = TABLE_PREFIX . 'pages';
 $phdb->users = TABLE_PREFIX . 'users'; 
  
