<?php

 /*------------
 * Default view 
 * Preethub
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *------------*/



//FUNCTION DEFAULT CSS
function default_css(){
	?>
	<style>
	*{
	box-sizing: border-box;
	
}

body{
	margin:0;
	padding:0;
}

a {
    text-decoration: none;
  /*  color: rgb(61, 146, 201); */
  color:#333;
}
a:hover,
a:focus {
    text-decoration: underline;
}

h2{
	margin-top:0;
}

h3 {
    font-weight: 900;
    margin:0 0 0.5em 0;
}

p{
	margin:0.25em 0 0.25em 0;
}

/* LAYOUT CSS */
.pure-img-responsive {
    max-width: 100%;
    height: auto;
}

.header {
    	background: rgb(61, 79, 93);
    color: #fff;
    text-align: center;
    top: auto;
    padding: 3em; 
}

#sidebar {
  position:relative;
  color:#000;
  padding:1em;
  background: #f0f0f0; 	
}

ul.widget{ 
 margin:0;
	padding-left:0;
}

ul.widget > li{
	border-top: solid 2px #e5e5e5;
	list-style:none;
	padding:0.5em 0 0.5em 0;
}
ul.widget > li:last-child{
	border-bottom: solid 2px #e5e5e5;
}

.brand-title,
.brand-tagline {
    margin: 0;
}
.brand-title {
    text-transform: uppercase;
}
.brand-tagline {
    font-weight: 300;
    color: rgb(176, 202, 219); 
}

.side-list {
    margin: 0;
    padding: 0;
    list-style: none;
}
.side-item {
    display: inline-block;
    *display: inline;
    zoom: 1;
}
.side-item a {
    background: transparent;
    border: 2px solid rgb(176, 202, 219);
    color: #fff;
    margin-top: 1em;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    font-size: 85%;
}
.side-item a:hover,
.side-item a:focus {
    border: 2px solid rgb(61, 146, 201);
    text-decoration: none;
}

.content-subhead {
    text-transform: uppercase;
    color: #aaa;
    border-bottom: 1px solid #eee;
    padding: 0.4em 0;
    font-size: 80%;
    font-weight: 500;
    letter-spacing: 0.1em;
}

#content {	   
    padding:1em;
    overflow:hidden;
}

.post {
    padding-bottom: 2em;
}
.post-title {
    font-size: 2em;
    color: #222;
    margin-bottom: 0.2em;
}
.post-avatar {
    border-radius: 50px;
    float: right;
    margin-left: 1em;
}
.post-description {
    font-family: Georgia, "Cambria", serif;
    color: #444;
    line-height: 1.8em;
}
.post-meta {
    color: #999;
    font-size: 90%;
    margin: 0;
}

.post-category {
    margin: 0 0.1em;
    padding: 0.3em 1em;
    color: #fff;
    background: #999;
    font-size: 80%;
}
    .post-category-design {
        background: #5aba59;
    }
    .post-category-pure {
        background: #4d85d1;
    }
    .post-category-yui {
        background: #8156a7;
    }
    .post-category-js {
        background: #df2d4f;
    }

.post-images {
    margin: 1em 0;
}
.post-image-meta {
    margin-top: -3.5em;
    margin-left: 1em;
    color: #fff;
    text-shadow: 0 1px 1px #333;
}
		
/* Button */
input[type="submit"],
.button {
  -webkit-appearance: none; 
		position: relative;
		display: inline-block;
		background: #ed786a;
		color: #fff !important;
		text-transform: uppercase;
		border-radius: 4px;
		border: 0;
		outline: 0;
		font-size: 1em;
		box-shadow: 0.125em 0.175em 0 0 rgba(0, 0, 0, 0.125);
		font-weight: 600;
		text-align: center;
		font-size: 0.85em;
		letter-spacing: 2px;
  padding:1em 0 1em 0; 
		width: 100%;		
		margin-top:1em;
	}
	
	input[type="submit"],
	.button:hover {
			background: #fd887a;
		}
		
		/* Form */

	form label {
		font-weight: 600;
		text-transform: uppercase;
		color: #888;
		display: block;
		margin: 0 0 1em 0;	
	}

	form input[type="text"],
	form input[type="email"]
	input[type="password"],
	form select,
	form textarea {
		-webkit-appearance: none;
		display: block;
		border: 0;
		background: #e8e8e8;
		width: 100%;
		box-shadow: inset 2px 2px 0px 0px rgba(0, 0, 0, 0.1);
		border-radius: 4px;
		line-height: 1.25em;
		padding: 0.75em 0 0.75em 1em;
	}

		form input[type="text"]:focus,
		form input[type="email"]
		input[type="password"]:focus,
		form select:focus,
		form textarea:focus {
			background: #f0f0f0;
		}

	form textarea {
		min-height: 11em;
	}

	form ::-webkit-input-placeholder {
		color: #555 !important;
		line-height: 1.35em;
		padding: 0 0 0 1em;
	}

	form :-moz-placeholder {
		color: #555 !important;
		padding: 0 0 0 1em;
	}

	form ::-moz-placeholder {
		color: #555 !important;
		padding: 0 0 0 1em;
	}

	form :-ms-input-placeholder {
		color: #555 !important;
		padding: 0 0 0 1em;
	}

	form ::-moz-focus-inner {
		border: 0;
	}

			
	#footer { 
 width:100%;	
	overflow: hidden; 		
	border-top: solid 2px #e5e5e5; 		
	background: #E5E8E8; 		
	padding: 1em 0 1em 0; 
	text-align:center;
	color: #888;
		}
	
.pagination{
   margin: 0;
   padding: 0;
}
.pagination li{
  display: inline; 
  padding: 6px 10px 6px 10px;
  border: 1px solid #ddd;
  margin-right: -1px;
  font: 13px/20px Arial, Helvetica, sans-serif;
  background: #FFFFFF;
}
.pagination li a{
	text-decoration:none;
	color: black;
}
.pagination li:hover{ 
background: #EEE;
}

.pagination li.current {
	background: #89B3CC;
	border: 1px solid #89B3CC;
color: #FFFFFF;
}

@media (min-width: 48em) {
    #content {
        padding: 2em 3em 0;
        width: 75%;
        float:left;
    }

    .header {
          text-align: left;
    }

    #sidebar {  
        margin-top:1em;  
        background:#fff;
        position:relative;
        float:left;
        width:25%;  
         
    }

    #footer {
        text-align: center;
    }
}	
	</style>	
<?php	
}

//FUNCTION DEFAULT HEADER VIEW
function default_header_view(){	
echo '<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>'. page_title() .'</title>
'. default_css() .'   
</head>
<body>
<header class="header">
<h1 class="brand-title">
'. get_config("site_name") .'
</h1>
<h2 class="brand-tagline">
'. get_config("site_description") .'
</h2>
</header>';
}

//FUNCTION DEFAULT SIDEBAR VIEW
function default_sidebar_view(){
echo '<section id="sidebar">
  <ul class="widget">         
     <h3>Links</h3>'; 
   if(is_logged()){  
echo '<li>          
 <a href="'. get_config("site_url") .'/ph-action.php?action=logout">Logout</a></li>';
if(loggeduser()->role === "Admin"){   	
echo '<li><a href="'. get_config("site_url") .'/ph-admin">Admin Panel</a></li>';
 }    
  }else{ 
echo '<li>          
 <a href="'. get_config("site_url") .'/ph-action.php?action=login">Login</a>
 </li>
  <li>          
 <a href="'. get_config("site_url") .'/ph-action.php?action=signup">Signup</a>
 </li>'; 
   } run_hook('sidebar'); 
echo  '</ul>
  </section>';
}

//FUNCTION DEFAULT FOOTER VIEW
function default_footer_view(){	 
echo '<footer id="footer">
       Copyright &copy; 
   '. get_config("site_name") .'  
      </footer>
  </body>
</html>';
}

//FUNCTION DEFAULT LOGIN VIEW
function default_login_view(){
//Default header
default_header_view(); 	 
echo '<section id="content">
 <div class="card">
<h3>Login</h3>
'. get_messages() .'
  <form action="ph-action.php?action=login" method="post">
    <label for="fname">User Name</label>
    <input type="text" id="fname" name="username" placeholder="Your name..">
    <label for="lname">Password</label>
    <input type="text" id="lname" name="password" placeholder="Your last name..">
    <input type="submit" value="Login" name="login">
  </form>
</div>
</section>';
//Default footer
default_footer_view(); 	
}

// FUNCTION DEFAULT SIGNUP VIEW
function default_signup_view(){
//Default header
default_header_view();	 
echo '<section id="content">
<h2> Signup </h2>
 '. get_messages() .'
  <form action="ph-action.php?action=signup" method="post">
    <label for="pname">User Name</label>
    <input type="text" id="phuname" name="username" placeholder="Your username..">
<label for="phemail">Email</label>
    <input type="text" id="phemail" name="email" placeholder="Your email..">
    <label for="phpass">Password</label>
    <input type="text" id="phpass" name="password" placeholder="Your password.."> 
    <input type="submit" value="signup" name="signup">
  </form> 
</section>';
//Default footer
default_footer_view();	
}

//FUNCTION DEFAULT PAGE VIEW
function default_page_view(){
	//Default header
default_header_view(); 
echo '<section id="content">  
      <div class="post"> 
       <h2 class="post-title"> 
 '. get_page()->page_name .'
 </h2>   
 <div class="post-description">                       
'. get_page()->content .'
         </div>
         </div>
  </section>';
 //Default sidebar
default_sidebar_view(); 
//Default footer
default_footer_view();
}
