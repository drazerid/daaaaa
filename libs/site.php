<?php
function set_header(){
	$s = "";
	$s .= "<!DOCTYPE html>\n";
	$s .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
	$s .= "<head>\n";
	$s .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n";
	$s .= "<title>".WEB."</title>\n";
	$s .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".URL."/media/css/font-awesome.css\" />\n";
	$s .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".URL."/media/css/forkit.css\" />\n";
	$s .= "</head>\n";
	$s .= "<body>\n";
	$s .= background_changer();
	return $s;
}

function set_footer(){
	$s = "";
	$s .= "<script type=\"text/javascript\" src=\"".URL."/media/js/jquery.js\"></script>\n";
	$s .= "<script type=\"text/javascript\" src=\"".URL."/media/js/jquery.form.js\"></script>\n";
	$s .= "<script type=\"text/javascript\" src=\"".URL."/media/js/jquery.emotions.js\"></script>\n";
	$s .= "<script type=\"text/javascript\" src=\"".URL."/media/js/jquery.elastic.source.js\"></script>\n";
	$s .= "<script type=\"text/javascript\" src=\"".URL."/media/js/forkit.js\"></script>\n";
	$s .= "<script type=\"text/javascript\" src=\"".URL."/media/js/jquery.mixitup.min.js\"></script>\n";
	$s .= "<script type=\"text/javascript\" src=\"".URL."/media/js/jquery.easing.min.js\"></script>\n";
	$s .= "</body>\n";
	$s .= "</html>\n";
	return $s;
}

function register_form(){
	$s = "";
	$s .= "<div class=\"formbox\">\n";
	$s .= "	<h1>Free User Registration</h1>\n";
	
	if(isset($_SESSION['reg']['msg'])){
		$s .= "	<div class=\"err_box\">".$_SESSION['reg']['msg']."</div>\n";
		unset($_SESSION['reg']['msg']);
	}
	
	$s .= "	<form method=\"post\" action=\"\" autocomplete=\"off\" class=\"frm\">\n";
	$s .= "		<input type=\"text\" name=\"fname\" placeholder=\"Enter your first name\" class=\"fname\"><br>\n";
	$s .= "		<input type=\"text\" name=\"lname\" placeholder=\"Enter your last name\" class=\"lname\"><br>\n";
	$s .= "		<input type=\"text\" name=\"email\" placeholder=\"Enter your email\" class=\"email\"><br>\n";
	$s .= "		<input type=\"password\" name=\"passw\" placeholder=\"Enter your password\" class=\"passw\"><br>\n";
	$s .= "		<input type=\"submit\" name=\"act\" value=\"Register\">\n";
	$s .= "	</form>\n";
	$s .= "	<div class=\"linkbox\">\n";
	$s .= "		<a href=\"".URL."/\"><span class=\"linkbox_icon fa fa-home\"></span><span class=\"linkbox_text\">Back to home</span></a> | \n";
	$s .= "		<a href=\"".URL."/login.php\"><span class=\"linkbox_icon fa fa-user\"></span><span class=\"linkbox_text\">Login</span></a> | \n";
	$s .= "		<a href=\"".URL."/forgot.php\"><span class=\"linkbox_icon fa fa-unlock\"></span><span class=\"linkbox_text\">Forgot Password</span></a>\n";
	$s .= "	</div>\n";
	$s .= "</div>\n";
	return $s;
}

function login_form(){
	$s = "";
	$s .= "<div class=\"formbox\">\n";
	$s .= "	<h1>User Authentication</h1>\n";
	
	if(isset($_SESSION['log']['msg'])){
		$s .= "	<div class=\"err_box\">".$_SESSION['log']['msg']."</div>\n";
		unset($_SESSION['log']['msg']);
	}
	
	$s .= "	<form method=\"post\" action=\"\" autocomplete=\"off\" class=\"frm\">\n";
	$s .= "		<input type=\"text\" name=\"email\" placeholder=\"Enter your email\" class=\"email\"><br>\n";
	$s .= "		<input type=\"password\" name=\"passw\" placeholder=\"Enter your password\" class=\"passw\"><br>\n";
	$s .= "		<input type=\"submit\" name=\"act\" value=\"Login\">\n";
	$s .= "	</form>\n";
	$s .= "	<div class=\"linkbox\">\n";
	$s .= "		<a href=\"".URL."/\"><span class=\"linkbox_icon fa fa-home\"></span><span class=\"linkbox_text\">Back to home</span></a> | \n";
	$s .= "		<a href=\"".URL."/register.php\"><span class=\"linkbox_icon fa fa-user\"></span><span class=\"linkbox_text\">Register</span></a> | \n";
	$s .= "		<a href=\"".URL."/forgot.php\"><span class=\"linkbox_icon fa fa-unlock\"></span><span class=\"linkbox_text\">Forgot Password</span></a>\n";
	$s .= "	</div>\n";
	$s .= "</div>\n";
	return $s;
}

function topsection(){
	$s = "";	
	$s .= "<div class=\"top\">\n";
	$s .= "	<div class=\"logo\"><a href=\"".URL."/\"><span class=\"logo_icon fa fa-folder-open\"></span> <span class=\"logo_text\">".WEB."</span></a></div>\n";
	$s .= "</div>\n";
	return $s;
}

function topnav($uname){
	$s = "";
	$s .= "<div class=\"topnav\">\n";
	$s .= "	<ul>\n";
	if($uname){
		$s .= "		<li><a href=\"".URL."/index.php?uname={$uname}\"><span class=\"top_icon fa fa-home\"></span></a></li>\n";
		$s .= "		<li><a href=\"".URL."/user-post.php?uname={$uname}\">All My Posts</a></li>\n";
		$s .= "		<li><a href=\"".URL."/credits.php\">Forum Credits</a></li>\n";
		$s .= "		<li><a href=\"".URL."/pm.php?uname={$uname}\">Messages</a></li>\n";
		if($uname){
			$s .= "		<li><a href=\"".URL."/user.php?uname={$uname}\">My Profile</a></li>\n";	
		} 
		$s .= "		<li><a href=\"".URL."/index.php?section=logout\">Logout</a></li>\n";	
	} else {
		$s .= "		<li><a href=\"".URL."/\"><span class=\"top_icon fa fa-home\"></span></a></li>\n";
		$s .= "		<li><a href=\"".URL."/register.php\">Register</a></li>\n";
		$s .= "		<li><a href=\"".URL."/login.php\">Login</a></li>\n";
		$s .= "		<li><a href=\"".URL."/all-user.php\">View All Users</a></li>\n";
	}
	$s .= "	</ul>\n";
	$s .= "</div>\n";
	return $s;
}

function background_changer(){
	$s = "";
	$s .= "<div class=\"background\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg1.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg2.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg3.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg4.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg5.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg6.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg7.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg8.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg9.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg10.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg11.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg12.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg13.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg14.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg15.jpg\" alt=\"\">\n";
	$s .= "	<img src=\"".URL."/media/bg/bg16.jpg\" alt=\"\">\n";
	$s .= "</div>\n";
	return $s;
}

?>