<?php
require(dirname(dirname(__FILE__)).'/libs/config.php');

// user registration
function register($a, $b, $c, $d){
	$a = esc($a);
	$b = esc($b);
	$c = esc($c);
	$d = esc($d);
	$err = array();
	$t = time();
	$p = md5($d);
	$u = strtolower(substr($a, 0, 1) . str_replace(' ', '', $b));
	if(empty($a) || empty($b) || empty($c) || empty($d)){
		$err[] = 'Harap mengisi seluruh data baik nama, email maupun password.';
	}
	if(!count($err)){
		if(num(sql("SELECT email FROM forkit_users WHERE email='{$c}'")) == 0){
			sql("INSERT INTO forkit_users VALUES('', '{$a}', '{$b}', '{$u}', '{$c}', '{$p}', 'N', 'N', '1', '1', '{$t}', '{$t}', '0', '0', '0', '0', '0', 'N', 'N')");
			$_SESSION['uname'] = $u;
		} else {
			$err[] = 'Maaf, alamat email ini sudah terpakai. Coba yang lain.';
		}
	}
	if(count($err)){ $_SESSION['reg']['msg'] = implode('<br>', $err); }
	if(count($err)){ red(URL."/register.php"); }
	else{ red(URL."/index.php?uname=$u"); }
	exit;
}

// user registration
function update_profile($uname, $uid, $a, $b, $c, $d, $e){
	$a = esc($a);
	$b = esc($b);
	$c = esc($c);
	$d = esc($d);
	$e = esc($e);
	$err = array();
	$t = time();
	$p = md5($d);
	$u = strtolower(substr($a, 0, 1) . str_replace(' ', '', $b));
	$sql = ext(sql("SELECT * FROM forkit_users WHERE user_id='{$uid}'"));
	$fname = ($a == '') ? $sql['fname'] : $a ;
	$lname = ($b == '') ? $sql['lname'] : $b;
	$email = ($c == '') ? $sql['email'] : $c;
	$website = ($e == '') ? $sql['website'] : $e;
	$passw = ($d == '') ? $sql['passw'] : $p;
	$sex = $_POST['sex'];
	$marriage = $_POST['marriage'];
	$bdate_day = $_POST['bdate_day'];
	$bdate_month = $_POST['bdate_month'];
	$bdate_year = $_POST['bdate_year'];
	$birthdate = $bdate_day."-".$bdate_month."-".$bdate_year;
	$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
	
	$newphone = ($phone == '') ? $sql['phone'] : $phone;

	if(!count($err)){
		sql("UPDATE forkit_users SET fname='{$fname}', lname='{$lname}', uname='{$u}', email='{$email}', passw='{$passw}', website='{$website}', sex='{$sex}', marriage='{$marriage}', phone='{$newphone}', bdate='{$birthdate}' WHERE user_id='{$uid}'");
		$_SESSION['new_uname'] = $u;
		$_SESSION['user_id'] = find_user_id($u);
	}
	if(count($err)){ $_SESSION['update-profile']['msg'] = implode('<br>', $err); }
	if(count($err)){ red(URL."/edit-profile.php?uname={$uname}"); }
	else{
		red(URL."/user.php?uname=".$_SESSION['new_uname']);
	}
	exit;
}

// user login
function login($a, $b){
	$a = esc($a);
	$b = esc($b);
	$err = array();
	if(empty($a) || empty($b)){
		$err[] = 'Harap mengisi seluruh data untuk login baik email maupun password.';
	}
	if(!count($err)){
		$sql = ext(sql("SELECT * FROM forkit_users WHERE email='{$a}' OR uname='{$a}' AND passw='".md5($b)."'"));
		if($sql){
			$_SESSION['user_id'] = $sql['user_id'];
			$_SESSION['uname'] = $sql['uname'];
			$_SESSION['user_level'] = $sql['user_level'];
			sql("UPDATE forkit_users SET user_status='1', user_updated='".time()."' WHERE uname='".$_SESSION['uname']."'");
		} else {
			$err[] = 'Maaf, email dan password tidak cocok. Silahkan coba lagi.';
		}
	}
	if(count($err)){ $_SESSION['log']['msg'] = implode('<br>', $err); }
	if(count($err)){ red(URL."/login.php"); }
	else{ 
		if(isset($_SESSION['user_level']) && $_SESSION['user_level'] == '9'){
			red(URL."/admin.php");
		} else {
			red(URL."/index.php?uname=".$_SESSION['uname']); 
		}
	}
	exit;
}

// user logout
function logout(){
	if(isset($_SESSION['uname']) || isset($_SESSION['new_uname'])){
		sql("UPDATE forkit_users SET user_status='0', user_updated='".time()."' WHERE uname='".$_SESSION['uname']."' OR uname='".$_SESSION['new_uname']."'");
	}
	session_destroy();
	red(URL);
	exit;
}

// add category
function add_category($a){
	$a = esc($a);
	$err  =array();
	$t = time();
	$a_arr = explode(",", $a);
	for($i = 0; $i < count($a_arr); $i++){
		if(num(sql("SELECT cat_name FROM forkit_cats WHERE cat_name='{$a_arr[$i]}'")) == 0){
			sql("INSERT INTO forkit_cats VALUES('', '{$a_arr[$i]}', '1', '{$t}', '{$t}')");
		} else {
			$err[] = $a_arr[$i]." ";
		}
	}
	if(count($err)){ $_SESSION['add_cat']['msg'] = implode('<br>', $err); }
	red(URL."/admin.php?section=category");
	exit;
}

// new post
function save_new_post($t, $title, $descript){
	$t = (int) $t;
	$title = esc($title);
	$descript = esc($descript);
	$err = array();
	$w = time();
	$valid = array("jpg", "png", "gif", "bmp");
	$name = $_FILES['photo']['name'];
	$size = $_FILES['photo']['size'];
	$tmp = $_FILES['photo']['tmp_name'];
	
	if(empty($title) || empty($descript)){
		$err[] = 'Please enter title and description';
	}
	if(!$t){
		$err[] = 'Please select a category first';
	}
	if(!count($err)){
		if(num(sql("SELECT title FROM forkit_topics WHERE title='{$title}'")) == 0){
			sql("INSERT INTO forkit_topics VALUES('', '{$t}', '".$_SESSION['user_id']."', '{$title}', '{$descript}', '0', '{$w}', '{$w}', '1')");
			$topicid = mysql_insert_id();
			
			sql("INSERT INTO forkit_forum_photos(topic_id) VALUES('{$topicid}')");
			
			if(strlen($name)){
				list($txt,$ext) = explode(".", $name);
				if(in_array($ext, $valid)){
					if($size < (1024*1024)){
						$newid = mysql_insert_id();
						$newname = $topicid . "." . $ext;
						move_uploaded_file($tmp, "photos/posts/".$newname);
					} else {
						$err[] = 'Image file size is too large';
					}
				} else {
					$err[] = 'Image file extension is not valid';
				}
			}
		}
	}	
	if(count($err)){ $_SESSION['topic']['msg'] = implode('<br>', $err); }
	if(count($err)){ red(URL."/post.php?t={$t}"); }
	else { red(URL."/cat.php?t={$t}"); }
	exit;
}

// edit post
function edit_post($t, $p, $title, $descript){
	$t = (int) $t;
	$p = (int) $p;
	$title = esc($title);
	$descript = esc($descript);
	$err = array();
	$w = time();
	$valid = array("jpg", "png", "gif", "bmp");
	$name = $_FILES['photo']['name'];
	$size = $_FILES['photo']['size'];
	$tmp = $_FILES['photo']['tmp_name'];
	
	if(empty($title) || empty($descript)){
		$err[] = 'Please enter title and description';
	}
	if(!$t){
		$err[] = 'Please select a category first';
	}
	if(!count($err)){
		sql("UPDATE forkit_topics SET title='{$title}', descript='{$descript}', topic_updated='{$w}' WHERE cat_id='{$t}' AND topic_id='{$p}'");
		
		if(strlen($name)){
			list($txt,$ext) = explode(".", $name);
			if(in_array($ext, $valid)){
				if($size < (1024*1024)){
					$newname = $p . "." . $ext;
					if(file_exists("photos/posts/{$newname}")){
						unlink("photos/posts/{$newname}");
					}
					move_uploaded_file($tmp, "photos/posts/".$newname);
				} else {
					$err[] = 'Image file size is too large';
				}
			} else {
				$err[] = 'Image file extension is not valid';
			}
		}		
	}	
	if(count($err)){ $_SESSION['edit_topic']['msg'] = implode('<br>', $err); }
	if(count($err)){ red(URL."/edit-post.php?t={$t}&p={$p}"); }
	else { red(URL."/view.php?t={$t}&p={$p}"); }
	exit;
}

function find_user_id($d){
	$sql = ext(sql("SELECT uname,user_id FROM forkit_users WHERE uname='{$d}'"));
	return $sql['user_id'];
}

function find_name($d){
	$sql = ext(sql("SELECT fname,lname,uname FROM forkit_users WHERE uname='{$d}'"));
	return $sql['fname']." ".$sql['lname'];
}

function find_user_status($d){
	$sql = ext(sql("SELECT user_status,sex,uname FROM forkit_users WHERE uname='{$d}'"));
	$heshe = ($sql['sex'] == '1') ? "He" : "She";
	return $sql['user_status'] == 0 ? "{$heshe} is not online now" : "{$heshe} is online right now";
}

function find_user_level($d){
	$sql = ext(sql("SELECT user_level,uname FROM forkit_users WHERE uname='{$d}'"));
	return $sql['user_level'] == 1 ? "General User" : "Administrator";
}
		
function find_user_marriage($d){
	$sql = ext(sql("SELECT marriage,uname FROM forkit_users WHERE uname='{$d}'"));
	if($sql['marriage'] == '1'){ $m = 'Married'; }
	elseif($sql['marriage'] == '2'){ $m = 'Divorced'; }
	elseif($sql['marriage'] == '3'){ $m = 'Single'; }
	elseif($sql['marriage'] == '0') { $m = 'Marital status is not updated yet'; }
	return $m;
}

function find_user_sex($d){
	$sql = ext(sql("SELECT sex,uname FROM forkit_users WHERE uname='{$d}'"));
	return $sql['sex'] == 1 ? "Male" : "Female";
}
		
// find user photo
function find_user_photo($d){
	$sql = ext(sql("SELECT uname,photo FROM forkit_users WHERE uname='{$d}'"));
	if($sql['photo'] == 'N'){
		$photo = "<img src=\"".URL."/photos/users/noname.png\" alt=\"\" class=\"photo_profiles\">";
	} else {
		$photo = "<img src=\"".URL."/photos/users/{$sql['photo']}\" alt=\"\" class=\"photo_profiles\">";
	}
	return $photo;
}

function find_total($table, $where=''){
	if($where == ''){
		return num(sql("SELECT * FROM {$table}"));
	} else {
		return num(sql("SELECT * FROM {$table} WHERE {$where}"));
	}
}

function find_status($id){
	return ($id == 1) ? "Active" : "Disabled";
}

function find_date($id){
	return date("d-m-Y H:i", $id);
}

function save_new_reply($i, $p, $u, $reply, $pid){
	$p = (int) $p;
	$t = time();
	$reply = esc($reply);
	$err = array();
	if(empty($reply)){ $err[] = 'Please enter your comment'; }
	if(!$i){ $err[] = 'Please select a post category associated with a post'; }
	if(!$p){ $err[] = 'Please select a post to reply'; }
	if(!$u){ $err[] = 'You must be logged in first to reply this post'; }
	if(!count($err)){
		sql("INSERT INTO forkit_replies VALUES('', '{$p}', '{$u}', '{$reply}', '{$t}', '{$t}', '{$pid}')");
	}
	if(count($err)){ $_SESSION['reply']['msg'] = implode('<br>', $err); }
	red(URL."/view.php?t={$i}&p={$p}#comment_form");
	exit;
}

// display category
function display_category(){
	$s = "";
	$sql = sql("SELECT * FROM forkit_cats");
	$s .= "<div class=\"divbox\">\n";
	$s .= "	<h1>Category</h1>\n";
	$s .= "	<form method=\"post\" action=\"\" autocomplete=\"off\" class=\"frm\">\n";
	$s .= "		<input type=\"text\" name=\"cat_name\" placeholder=\"Enter new category name, you can separated it with comma but without space. Ex: Computer,Fashion, etc... then hit ENTER\" class=\"cat_name\"><input type=\"submit\" name=\"act\" value=\"Add Category\" style=\"display:none;\">\n";
	$s .= "	</form>\n";
	
	$s .= "	<table>\n";
	$s .= "	<tr class=\"tr_head\">\n";
	$s .= "		<td width=\"30\">NO</td>\n";
	$s .= "		<td width=\"300\">Category Title</td>\n";
	$s .= "		<td width=\"100\">Total Topic</td>\n";
	$s .= "		<td width=\"100\">Status</td>\n";
	$s .= "		<td width=\"100\">Created</td>\n";
	$s .= "		<td width=\"100\">Updated</td>\n";
	$s .= "		<td width=\"100\">Options</td>\n";
	$s .= "	</tr>\n";
	
	if(num($sql) == 0){
		$s .= "	<tr class=\"tr_nodata\"><td colspan=\"7\">No category yet. Please add it immediately...</td></tr>\n";
	} else {
		$no = 1;
		while($row = ext($sql)){
			$s .= "	<tr class=\"tr_data\">\n";
			$s .= "		<td>{$no}</td>\n";
			$s .= "		<td><a href=\"".URL."/admin.php?t={$row['cat_id']}\">{$row['cat_name']}</a></td>\n";
			$s .= "		<td>".find_total("forkit_topics", "cat_id='{$row['cat_id']}'")."</td>\n";
			$s .= "		<td>".find_status($row['cat_status'])."</td>\n";
			$s .= "		<td>".find_date($row['cat_created'])."</td>\n";
			$s .= "		<td>".find_date($row['cat_updated'])."</td>\n";	
			$s .= "		<td><a href=\"".URL."/admin.php?section=edit-category&t={$row['cat_id']}\"><span class=\"fa fa-edit\"></span></a> &nbsp; <a href=\"".URL."/admin.php?section=delete-category&t={$row['cat_id']}\"><span class=\"fa fa-trash-o\"></span></a></td>\n";
			$s .= "	</tr>\n";
			$no++;
		}
	}
	$s .= "	</table>\n";
	$s .= "</div>\n";
	return $s;
}

function view_cat(){
	$s = "";
	$sql = sql("SELECT * FROM forkit_cats ORDER BY cat_created DESC");
	$s .= "<div class=\"mbox\">\n";
	$s .= "	<table class=\"tcat\">\n";
	$s .= "	<tr class=\"tr_head\">\n";
	$s .= "		<td width=\"30\" align=\"center\" class=\"td_bg\"><span class=\"cat_icon1 fa fa-list\"></span></td>\n";
	$s .= "		<td width=\"150\"> &nbsp; Category Name</td>\n";
	$s .= "		<td width=\"80\" align=\"center\">Topics</td>\n";
	$s .= "		<td width=\"80\" align=\"center\">Replies</td>\n";
	$s .= "		<td width=\"300\">&nbsp; Last Post</td>\n";
	$s .= "	</tr>\n";
	
	if(num($sql) == 0){
		$s .= "	<tr class=\"tr_nodata\"><td colspan=5>Sorry, currently no category yet. Please login to add it.</td></tr>\n";
	} else {
		while($row = ext($sql)){
			$sq = sql("SELECT * FROM forkit_topics a,forkit_users b WHERE a.user_id=b.user_id AND a.cat_id='{$row['cat_id']}' AND a.topic_created<'".time()."' ORDER BY a.topic_created DESC");
			
			$s .= "	<tr class=\"tr_data\">\n";
			$s .= "		<td align=\"center\" class=\"td_bg\"><span class=\"cat_icon fa fa-chevron-right\"></td>\n";
			$s .= "		<td> &nbsp; <span style=\"font-size:12px;\">Category:</span><br> &nbsp; <a href=\"".URL."/cat.php?t={$row['cat_id']}\">{$row['cat_name']}</a></td>\n";
			$s .= "		<td align=\"center\" style=\"background:#ccc;opacity:.5; \"><span class=\"clr2\">".find_total("forkit_topics", "cat_id='{$row['cat_id']}'")."</span></td>\n";
			$s .= "		<td align=\"center\" style=\"background:#aaa;opacity:.5; \"><span class=\"clr1\">".find_total("forkit_topics b,forkit_replies c", "b.topic_id=c.topic_id AND b.cat_id='{$row['cat_id']}'")."</span></td>\n";
			
			if(num($sq) == 0){
				$s .= "		<td> &nbsp; <span style=\"font-size:12px;\">No post yet to this category. Be the first to start it!</span></td>\n";
			} else {
				$lp = ext($sq);
				$s .= "		<td> &nbsp; <span class=\"lp_small\">By: <a href=\"".URL."/user.php?uname={$lp['uname']}\">".find_name($lp['uname'])."</a>, on ".find_date($lp['topic_created'])."</span><br>&nbsp; <a href=\"".URL."/view.php?t={$row['cat_id']}&p={$lp['topic_id']}\" class=\"lp_link\">{$lp['title']}</a></td>\n";
			}
			$s .= "	</tr>\n";
		}	
	}
	$s .= "	</table>\n";
	$s .= "</div>\n";
	return $s;
}

function show_profile_picture($d){
	//$d = isset($_SESSION['uname']) ? $_SESSION['uname'] : $_SESSION['new_uname'];
	if($d){
		$s = "";
		$s .= "	<div class=\"mbox\">\n";
		$s .= "		<h1>".find_name($d)."</h1>\n";
		$sql = ext(sql("SELECT uname,photo FROM forkit_users WHERE uname='{$d}'"));
		$s .= ($sql['photo'] == 'N') ? "<img src=\"".URL."/media/images/noname.jpg\" alt=\"\" id=\"profile_photo\"><div class=\"change_photo\">" : "<img src=\"".URL."/photos/users/{$sql['photo']}\" alt=\"\" id=\"profile_photo\">";
		if($d) {
			$s .= "		<div class=\"change_photo\"><a href=\"".URL."/change-photo.php?uname={$d}\">Click to change your photo</a></div>\n";
		}
		$s .= "	</div>\n";
		return $s;
	}
}

function get_cat_name($t){
	$sql = ext(sql("SELECT cat_name,cat_id FROM forkit_cats WHERE cat_id='{$t}'"));
	return $sql['cat_name'];
}

function view_cat_content($t){
	if($t){
		$sql = sql("SELECT * FROM forkit_topics a,forkit_cats b, forkit_users c WHERE a.cat_id=b.cat_id AND a.user_id=c.user_id AND b.cat_id='{$t}'");
		$s = "";
		$s .= "<div class=\"mbox\">\n";
		$s .= "	<h1>Category: ".get_cat_name($t)."</h1>\n";
		$s .= "	<div class=\"mbox_info\"><a href=\"".URL."/post.php?t={$t}\"><span class=\"info_icon fa fa-file\"></span> <span class=\"info_text\">Create new post</span></a></div>\n";
		$s .= "	<table class=\"tpost\">\n";
		$s .= "	<tr class=\"tr_head\">\n";
		$s .= "		<td width=\"400\" align=\"left\"> &nbsp; Post Title</td>\n";
		$s .= "		<td width=\"80\" align=\"left\">Post Author</td>\n";
		$s .= "		<td width=\"80\" align=\"left\">Post Date</td>\n";
		$s .= "		<td width=\"50\" align=\"center\">Replies</td>\n";
		$s .= "	</tr>\n";
		if(num($sql) == 0){
			$s .= "	<tr class=\"tr_nodata\"><td colspan=4>Unfortunately, there is no post currently able to be viewed right now. <br>Please be the first to add a new post right by clicking the Create new post as shown above.</td></tr>\n";
		} else {
			while($row = ext($sql)){
				$s .= "	<tr class=\"tr_data\">\n";
				$s .= "		<td align=\"left\"> &nbsp; <a href=\"".URL."/view.php?t={$t}&p={$row['topic_id']}\">{$row['title']}</a></td>\n";
				$s .= "		<td align=\"left\"><a href=\"".URL."/user.php?uname={$row['uname']}\">{$row['uname']}</a></td>\n";
				$s .= "		<td align=\"left\">".find_date($row['topic_created'])."</td>\n";
				$s .= "		<td align=\"center\">".find_total("forkit_replies", "topic_id='{$row['topic_id']}'")."</td>\n";
				$s .= "	</tr>\n";
			}		
		}
		$s .= "	</table>\n";
		$s .= "</div>\n";
		return $s;	
	} else {
		return "<div class=\"no_page\"><h1>Page not found!</h1><p>Sorry, seems that the page category you are looking for is not found. This probably occured that that page has been removed or disabled by forum administrator.</p><p>Please contact forum administrator for further action.</p></div>\n";
	}
}

function post_new_topic_form($t){
	if($t){
		$s = "";
		$s .= "<div class=\"mbox\">\n";
		$s .= "	<h1>Post new topic to: ".get_cat_name($t)."</h1>\n";
		
		if(isset($_SESSION['topic']['msg'])){
			$s .= "	<div class=\"err_box\">".$_SESSION['topic']['msg']."</div>\n";
			unset($_SESSION['topic']['msg']);
		}
		
		$s .= "	<form method=\"post\" action=\"\" autocomplete=\"off\" enctype=\"multipart/form-data\" class=\"topic_form\">\n";
		$s .= "		<input type=\"text\" name=\"title\" placeholder=\"Enter post title here...\"><br>\n";
		$s .= "		<div class=\"message_buttons\">
						<input type=\"button\" value=\"Bold\" onclick=\"javascript:insert('[b]', '[/b]', 'descript');\" />
						<input type=\"button\" value=\"Italic\" onclick=\"javascript:insert('[i]', '[/i]', 'descript');\" />
						<input type=\"button\" value=\"Underlined\" onclick=\"javascript:insert('[u]', '[/u]', 'descript');\" />
						<input type=\"button\" value=\"Image\" onclick=\"javascript:insert('[img]', '[/img]', 'descript');\" />
						<input type=\"button\" value=\"Link\" onclick=\"javascript:insert('[url]', '[/url]', 'descript');\" />
						<input type=\"button\" value=\"Left\" onclick=\"javascript:insert('[left]', '[/left]', 'descript');\" />
						<input type=\"button\" value=\"Center\" onclick=\"javascript:insert('[center]', '[/center]', 'descript');\" />
						<input type=\"button\" value=\"Right\" onclick=\"javascript:insert('[right]', '[/right]', 'descript');\" />
						<input type=\"button\" value=\"Code\" onclick=\"javascript:insert('[code]', '[/code]', 'descript');\" />
					</div>\n";
		$s .= "		<textarea name=\"descript\" placeholder=\"Enter post description here...\" id=\"descript\"></textarea><br><br>\n";
		$s .= "		Please select picture, if any:<br><input type=\"file\" name=\"photo\" size=\"100\"><br>\n";
		$s .= "		<input type=\"submit\" name=\"act\" value=\"Submit New Post\">\n";
		$s .= "		<input type=\"hidden\" name=\"cat_id\" value=\"{$t}\">\n";
		$s .= "	</form>\n";	
		$s .= "</div>\n";
		return $s;
	}
}

function edit_new_topic_form($t, $p){
	if($t && $p){
		$sql = ext(sql("SELECT * FROM forkit_topics WHERE cat_id='{$t}' AND topic_id='{$p}'"));
		$s = "";
		$s .= "<div class=\"mbox\">\n";
		$s .= "	<h1>Edit topic to: ".get_cat_name($t)."</h1>\n";
		
		if(isset($_SESSION['edit_topic']['msg'])){
			$s .= "	<div class=\"err_box\">".$_SESSION['edit_topic']['msg']."</div>\n";
			unset($_SESSION['edit_topic']['msg']);
		}
		
		$s .= "	<form method=\"post\" action=\"\" autocomplete=\"off\" enctype=\"multipart/form-data\" class=\"topic_form\">\n";
		$s .= "		<input type=\"text\" name=\"title\" placeholder=\"Enter post title here...\" value=\"{$sql['title']}\"><br>\n";
		$s .= "		<div class=\"message_buttons\">
						<input type=\"button\" value=\"Bold\" onclick=\"javascript:insert('[b]', '[/b]', 'descript');\" />
						<input type=\"button\" value=\"Italic\" onclick=\"javascript:insert('[i]', '[/i]', 'descript');\" />
						<input type=\"button\" value=\"Underlined\" onclick=\"javascript:insert('[u]', '[/u]', 'descript');\" />
						<input type=\"button\" value=\"Image\" onclick=\"javascript:insert('[img]', '[/img]', 'descript');\" />
						<input type=\"button\" value=\"Link\" onclick=\"javascript:insert('[url]', '[/url]', 'descript');\" />
						<input type=\"button\" value=\"Left\" onclick=\"javascript:insert('[left]', '[/left]', 'descript');\" />
						<input type=\"button\" value=\"Center\" onclick=\"javascript:insert('[center]', '[/center]', 'descript');\" />
						<input type=\"button\" value=\"Right\" onclick=\"javascript:insert('[right]', '[/right]', 'descript');\" />
						<input type=\"button\" value=\"Code\" onclick=\"javascript:insert('[code]', '[/code]', 'descript');\" />
					</div>\n";
		$s .= "		<textarea name=\"descript\" placeholder=\"Enter post description here...\" id=\"descript\">{$sql['descript']}</textarea><br><br>\n";
		$s .= "		Please select picture, if any:<br><input type=\"file\" name=\"photo\" size=\"100\"><br>\n";
		$s .= "		<input type=\"submit\" name=\"act\" value=\"Update Post\">\n";
		$s .= "		<input type=\"hidden\" name=\"cat_id\" value=\"{$t}\">\n";
		$s .= "		<input type=\"hidden\" name=\"topic_id\" value=\"{$p}\">\n";
		$s .= "	</form>\n";	
		$s .= "</div>\n";
		return $s;
	}
}

function view_topic($t, $p, $u){
	if($t && $p){
		$s = "";
		sql("UPDATE forkit_topics SET views=views+1 WHERE topic_id='{$p}' AND cat_id='{$t}'");
		$sql = ext(sql("SELECT * FROM forkit_users a, forkit_topics b, forkit_cats c WHERE a.user_id=b.user_id AND b.cat_id=c.cat_id AND b.cat_id='{$t}' AND b.topic_id='{$p}'"));
	
		$s .= "<div class=\"mbox\">\n";
		$s .= "	<h1>{$sql['title']}</h1>\n";
		$s .= "	<div class=\"det_box\">\n";
		$s .= "		<span class=\"det_icon_user fa fa-user\"></span><span class=\"det_text\">By <a href=\"".URL."/user.php?uname={$sql['uname']}\">".find_name($sql['uname'])."</a></span>\n";
		$s .= "		<span class=\"det_icon_date fa fa-calendar\"></span><span class=\"det_text\">".find_date($sql['topic_created'])."</span>\n";
		$s .= "		<span class=\"det_icon_view fa fa-eye\"></span><span class=\"det_text\">{$sql['views']} times</span>\n";
		$s .= "		<span class=\"det_icon_comment fa fa-comment\"></span><span class=\"det_text\">Comment: ".find_total("forkit_replies", "topic_id='{$sql['topic_id']}'")."</span>\n";
		
		$s .= "	</div>\n";
		$img = sql("SELECT photo_id FROM forkit_forum_photos WHERE topic_id='{$p}'");
		if(num($img) >= 1){
			while($r = ext($img)){
				$s .= "	<img src=\"".URL."/photos/posts/{$r['photo_id']}.jpg\" alt=\"\" align=\"left\" class=\"photo\">\n";
			}
		} else {
			$s .= "	<div class=\"image_not_found\">Sorry, image not available</div>\n";
		}
		$s .= "	<div class=\"des\">".bbcode_to_html($sql['descript'])."</div>\n";
		
		if($u){
			if($sql['user_id'] == find_user_id($u)){
				$s .= "	<div class=\"edit_topic_box\"><a href=\"".URL."/edit-post.php?t={$t}&p={$p}\"><span class=\"edit_post_icon fa fa-edit\"></span> <span class=\"edit_post_text\">Click to edit this post</span></a></div>\n";
			}
		}
		
		$s .= "</div>\n";
		
		
		$s .= "<div class=\"mbox\">\n";
		$s .= "	<h1>".find_total("forkit_replies", "topic_id='{$p}'")." thought(s)</h1>\n";
		
		$s .= "	<div class=\"cmt\">\n";
		$cmt = sql("SELECT * FROM forkit_replies a,forkit_users b, forkit_topics c WHERE a.user_id=b.user_id AND a.topic_id=c.topic_id AND c.topic_id='{$p}' AND a.parent_id=0");
		if(num($cmt) == 0){ 
			$s .= "			<div class=\"no_comments\">No comment yet for this post. Please be the first comment.</div>\n";
		} else {
			while($data = ext($cmt)){
				$s .= find_comments($data, $p, $data['uname']);
			}
		}
		$s .= "	</div>\n";		
		$s .= "</div>\n";
		
		
		if($u){
			$s .= "<div class=\"mbox\">\n";
			$s .= "	<h1>ENter your comment</h1>\n";
			$s .= "	<form method=\"post\" action=\"\" autocomplete=\"off\" id=\"comment_form\">\n";
			$s .= "		<div class=\"message_buttons\">
						<input type=\"button\" value=\"Bold\" onclick=\"javascript:insert('[b]', '[/b]', 'reply');\" />
						<input type=\"button\" value=\"Italic\" onclick=\"javascript:insert('[i]', '[/i]', 'reply');\" />
						<input type=\"button\" value=\"Underlined\" onclick=\"javascript:insert('[u]', '[/u]', 'reply');\" />
						<input type=\"button\" value=\"Image\" onclick=\"javascript:insert('[img]', '[/img]', 'reply');\" />
						<input type=\"button\" value=\"Link\" onclick=\"javascript:insert('[url]', '[/url]', 'reply');\" />
						<input type=\"button\" value=\"Left\" onclick=\"javascript:insert('[left]', '[/left]', 'reply');\" />
						<input type=\"button\" value=\"Center\" onclick=\"javascript:insert('[center]', '[/center]', 'reply');\" />
						<input type=\"button\" value=\"Right\" onclick=\"javascript:insert('[right]', '[/right]', 'reply');\" />
						<input type=\"button\" value=\"Code\" onclick=\"javascript:insert('[code]', '[/code]', 'reply');\" />
						</div>\n";
			$s .= "		<textarea name=\"reply\" id=\"reply\" placeholder=\"Please type your reply to this post here...\"></textarea><br>\n";
			$s .= "		<div id=\"q\">Emotions: <span>:)</span><span>:3</span><span>o.O</span><span>:'(</span><span>3:)</span><span>:(</span><span>:O</span><span>8)</span><span>:D</span><span>:(</span><span> <3</span><span>^_^</span><span>:*</span><span>:v</span><span>:)</span><span>-_-</span><span>8|</span><span>:p</span><span>:/</span><span>:O</span> <span>;)</span></div>\n";
			$s .= "		<input type=\"submit\" name=\"act\" value=\"Reply\"><input type=\"hidden\" name=\"pid\" value=\"{$t}\"><input type=\"hidden\" name=\"hid\" value=\"{$p}\"><input type=\"hidden\" name=\"parent_id\" value=\"0\" id=\"parent_id\"><br><br>\n";
			$s .= "	</form>\n";
			$s .= "</div>\n";
		} else {
			$s .= "	<div class=\"login_first\">Comment is disabled. Please login first to submit new comment to this post.</div>\n";
		}
		return $s;
	}
}

function find_comments($row, $p, $uname) {
	$s = "";
	$s .= "		<div class=\"comment\">\n";
	$s .= "			<div class=\"img\">".find_user_photo($row['uname'])."</div>\n";
	$s .= "			<div class=\"txt\">\n";
	
	$s .= "				<div class=\"aut\"><a href=\"".URL."/user.php?uname={$row['uname']}\">".find_name($row['uname'])."</a>, said on ".find_date($row['reply_created']).":</div>\n";
	$s .= "				<div class=\"comment_body\">".bbcode_to_html($row['reply'])."</div>\n";
			
	if($uname) {
		$s .= "				<a href='#comment_form' class='reply' id='".$row['reply_id']."'>Reply</a>\n";
	}
	
	$q = sql("SELECT * FROM forkit_replies a,forkit_users b, forkit_topics c WHERE a.user_id=b.user_id AND a.topic_id=c.topic_id AND c.topic_id='{$p}' AND a.parent_id ='{$row['reply_id']}' ORDER BY reply_created DESC");
	
	if(num($q)>0){
		$s .= "			<div class=\"replies\">\n";
		while($row = ext($q)) {
			$s .= "		" . find_comments($row, $p, $uname);
		}
		$s .= "			</div>\n";
	}
	$s .= "			</div>\n";
	$s .= "			<div class=\"clr\"></div>\n";
	$s .= "		</div>\n";
	return $s;
}

function forum_menu(){
	$s = "";
	$s .= "			<div class=\"mbox\">\n";
	$s .= "				<h1>About Forum</h1>\n";
	$s .= "				<div class=\"about\">\n";
	$s .= "					<p>\n";
	$s .= "					<span class=\"forum_icon fa fa-folder-open\"></span>\n";
	$s .= "					<span class=\"forum_txt\">This is a place for you to share and publish all of your ideas, projects, thoughts, and everything to other people from around the world.</span>\n";
	$s .= "					</p>\n";
	$s .= "					<p>And let the world be easy to find you by registering yourself to this huge community and build your great relationship with others.</p>\n";
	$s .= "				</div>\n";
	$s .= "			</div>\n";
	return $s;
}

function photo_uploader_form($uname){
	$s = "";
	$s .= "		<div class=\"mbox\">\n";
	$s .= "			<h1>Upload your new profile photo</h1>\n";
	$s .= "			<!-- simple file uploading form -->\n";
	$s .= "			<div class=\"frmlbl\">Please select a photo to be your personal profile photo:</div>\n";
	$s .= "			<form id=\"form\" action=\"upload-photo.php\" method=\"post\" enctype=\"multipart/form-data\">\n";
	$s .= "				<input id=\"uploadImage\" type=\"file\" accept=\"image/*\" name=\"image\" />\n";
	$s .= "				<input id=\"button\" type=\"submit\" value=\"Upload\">\n";
	$s .= "			</form><br>\n";
	$s .= "			<img style=\"display:none; padding:0 10px; \" id=\"loader\" src=\"media/images/loader.gif\" alt=\"Loading....\" title=\"Loading....\" />\n";
	$s .= "			<!-- preview action or error msgs -->\n";
	$s .= "			<div id=\"preview\" style=\"display:none; margin:0 20px;\"></div><br><br>\n";
	$s .= "			<a id=\"preview_link\" href=\"".URL."/user.php?uname={$uname}\">Click here to view your new profile</a><br><br>\n";
	$s .= "		</div>\n";
	return $s;
}

// user profile
function show_user_profile($uname){
	$s = "";
	$mname = isset($_GET['uname']) ? $_GET['uname'] : '';
	$username = isset($_SESSION['uname']) ? $_SESSION['uname'] : '';
	$newusername = isset($_SESSION['new_uname']) ? $_SESSION['new_uname'] : '';
	$sql = ext(sql("SELECT * FROM forkit_users WHERE uname='{$uname}'"));
	$s .= "	<div class=\"mbox\">\n";
	$s .= "		<h1>Profile of ".find_name($uname)."</h1>\n";
	$s .= "		<table class=\"prof\">\n";
	
	$net_vote = $sql['like_by'] - $sql['dislike_by'];
	$who = ($sql['sex'] == '1') ? "him" : "her";
	
	if($newusername == $mname || $username == $mname){		
		$s .= "		<tr><td colspan=2><a href=\"".URL."/edit-profile.php?uname={$mname}\"><span class=\"td_icon fa fa-edit\"></span> <span class=\"td_text\">Click here to edit your profile</span></a></td></tr>\n";
	}
	
	$s .= "		<tr><td width=\"100\">First Name</td><td width=\"400\">: &nbsp; {$sql['fname']} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  \n";
	
	if($newusername || $username) {
		$s .= "<a href=\"#\" class=\"vote_up\" id=\"{$sql['user_id']}\"><span class=\"like_icon fa fa-thumbs-o-up\"></span><span class=\"like_text\">Like {$who}</span></a> <span class=\"votes_count\" id=\"votes_count{$sql['user_id']}\">{$net_vote} likes</span> <a href=\"#\" class=\"vote_down\" id=\"{$sql['user_id']}\"><span class=\"like_icon fa fa-thumbs-o-down\"></span><span class=\"like_text\">Dislike {$who}</span></a>\n";
	}
	$s .= "</td></tr>\n";
	
	$s .= "		<tr><td>Last Name</td><td>: &nbsp; {$sql['lname']} </td></tr>\n";
	$s .= "		<tr><td>User Name</td><td>: &nbsp; {$sql['uname']} </td></tr>\n";
	$s .= "		<tr><td>Email</td><td>: &nbsp; {$sql['email']}</td></tr>\n";
	$s .= "		<tr><td>Website</td><td>: &nbsp; {$sql['website']}</td></tr>\n";
	$s .= "		<tr><td>User Level</td><td>: &nbsp; ".find_user_level($uname)."</td></tr>\n";
	$s .= "		<tr><td>Online Status</td><td>: &nbsp; ".find_user_status($uname)." &nbsp; | &nbsp; <a href=\"".URL."/pm.php?uname={$sql['uname']}\">Send {$who} a personal message now</a> </td></tr>\n";
	$s .= "		<tr><td>Total Posts</td><td>: &nbsp; ".find_total("forkit_topics", "user_id='".find_user_id($uname)."'")." posts since registered &nbsp; | &nbsp; <a href=\"".URL."/user-post.php?uname={$uname}\">Click here to view them</a></td></tr>\n";
	$s .= "		<tr><td>Total Replies</td><td>: &nbsp; ".find_total("forkit_replies", "user_id='".find_user_id($uname)."'")." replies since registered</td></tr>\n";
	$s .= "		<tr><td>Registered Date</td><td>: &nbsp; ".find_date($sql['user_created'])."</td></tr>\n";
	$s .= "		<tr><td>Last Update</td><td>: &nbsp; ".find_date($sql['user_updated'])."</td></tr>\n";
	$s .= "		<tr><td>Birth Date </td><td>: &nbsp; {$sql['bdate']}</td></tr>\n";
	$s .= "		<tr><td>Sex Gender </td><td>: &nbsp; ".find_user_sex($sql['uname'])."</td></tr>\n";
	$s .= "		<tr><td>Marital Status </td><td>: &nbsp; ".find_user_marriage($sql['uname'])."</td></tr>\n";
	$s .= "		<tr><td valign=\"top\">Photo Profile</td><td valign=\"top\">&nbsp;  &nbsp; ".find_user_photo($uname)."</td></tr>\n";
	
	if($newusername == $mname || $username == $mname){		
		$s .= "		<tr><td colspan=2><a href=\"".URL."/edit-profile.php?uname={$mname}\"><span class=\"td_icon fa fa-edit\"></span> <span class=\"td_text\">Click here to edit your profile</span></a></td></tr>\n";
	}
	
	$s .= "		</table>\n";
	$s .= "	</div>\n";
	return $s;
}

// edit profile
function edit_user_profile($uname){
	$s = "";
	$mname = isset($_GET['uname']) ? $_GET['uname'] : '';
	$username = isset($_SESSION['uname']) ? $_SESSION['uname'] : '';
	$uid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
	$sql = ext(sql("SELECT * FROM forkit_users WHERE uname='{$uname}'"));
	$s .= "	<div class=\"mbox\">\n";
	$s .= "		<h1>Editing Profile of ".find_name($uname)."</h1>\n";
	$s .= "		<form method=\"post\" action=\"ajax-upload.php\" autocomplete=\"off\" enctype=\"multipart/form-data\" class=\"edit_profile_form\" id=\"imageform\">\n";
	
	if(isset($_SESSION['update-profile']['msg'])){
		$s .= "		<div class=\"err_box\">".$_SESSION['update-profile']['msg']."</div>\n";
		unset($_SESSION['update-profile']['msg']);
	}
	
	$s .= "			<table>\n";	
	$s .= "			<tr><td width=\"100\">First Name</td><td width=\"400\"><input type=\"text\" name=\"fname\" value=\"{$sql['fname']}\"></td></tr>\n";	
	$s .= "			<tr><td>Last Name</td><td><input type=\"text\" name=\"lname\" value=\"{$sql['lname']}\"></td></tr>\n";	
	$s .= "			<tr><td>Email Address</td><td><input type=\"text\" name=\"email\" value=\"{$sql['email']}\"></td></tr>\n";	
	$s .= "			<tr><td>Password</td><td><input type=\"password\" name=\"passw\" placeholder=\"Type your new password\"></td></tr>\n";	
	$s .= "			<tr><td>Website</td><td><input type=\"text\" name=\"website\" value=\"{$sql['website']}\"></td></tr>\n";
		
	$s .= "			<tr><td>Gender</td><td><select name=\"sex\"><option value=\"++ Select Gender ++\">++ Select Gender ++</option><option value=\"1\">Laki-laki</option><option value=\"2\">Perempuan</option></select></td></tr>\n";	
	$s .= "			<tr><td>Marriage Status</td><td><select name=\"marriage\"><option value=\"++ Select Marriage ++\">++ Select Marriage ++</option><option value=\"1\">Married</option><option value=\"2\">Divorce</option><option value=\"3\">Single</option></select></td></tr>\n";	
	$s .= "			<tr><td>Phone Number</td><td><input type=\"text\" name=\"phone\" value=\"{$sql['phone']}\"></td></tr>\n";
	$s .= "			<tr><td>Birth Date</td><td>\n";
	$s .= "				<select name=\"bdate_day\">\n";
	$s .= "					<option value=\"++ Day ++\" selected=\"selected\">++ Day ++</option>\n";
	for($a = 1; $a <= 31; $a++){
		$zer_date = ($a <= 9) ? "0".$a : $a;
		$s .= "				<option value=\"{$zer_date}\">{$zer_date}</option>\n";
	}
	$s .= "				</select>\n";
	$s .= "				<select name=\"bdate_month\">\n";
	$s .= "					<option value=\"++ Month ++\" selected=\"selected\">++ Month ++</option>\n";
	for($f = 1; $f <= 12; $f++){
		$zer_month = ($f <= 9) ? "0".$f : $f;
		$s .= "				<option value=\"{$zer_month}\">{$zer_month}</option>\n";
	}
	$s .= "				</select>\n";
	$s .= "				<select name=\"bdate_year\">\n";
	$s .= "					<option value=\"++ Year ++\" selected=\"selected\">++ Year ++</option>\n";
	for($y = 1970; $y <= 2050; $y++){
		$s .= "				<option value=\"{$y}\">{$y}</option>\n";
	}
	$s .= "				</select>\n";
	$s .= "				</td>\n";
	$s .= "			</tr>\n";
	$s .= "			<tr><td colspan=2>&nbsp;  </td></tr>\n";
	$s .= "			<tr><td colspan=2>&nbsp;   <input type=\"submit\" name=\"act\" value=\"Update Profile\"><input type=\"hidden\" name=\"uid\" value=\"{$uid}\"></td></tr>\n";	
	$s .= "			</table>\n";
	$s .= "		</form>\n";
	$s .= "	</div>\n";
	return $s;
}

// all post by user
function find_user_post($uname){
	$s = "";
	$sql = sql("SELECT * FROM forkit_users a, forkit_topics b, forkit_cats c WHERE a.user_id=b.user_id AND b.cat_id=c.cat_id AND b.user_id='".find_user_id($uname)."' ORDER BY b.topic_created DESC");
	$s .= "	<div class=\"mbox\">\n";
	$s .= "		<h1>All posts by ".find_name($uname)."</h1>\n";
	$s .= "		<table class=\"upost\">\n";
	$s .= "		<tr class=\"upost_head\">\n";
	$s .= "			<td width=\"450\">Post Title</td>\n";
	$s .= "			<td width=\"100\">Created</td>\n";
	$s .= "			<td width=\"80\">Replies</td>\n";
	$s .= "		</tr>\n";
	if(num($sql) == 0 ){
		$s .= "		<tr class=\"upost_nodata\"><td colspan=3>Sorry, no post yet made by this user.</td></tr>\n";
	} else {
		while($row = ext($sql)){
			$s .= "		<tr class=\"upost_data\">\n";
			$s .= "			<td><a href=\"".URL."/view.php?t={$row['cat_id']}&p={$row['topic_id']}\">{$row['title']}</a></td>\n";
			$s .= "			<td>".find_date($row['topic_created'])."</td>\n";
			$s .= "			<td>".find_total("forkit_replies", "topic_id='{$row['topic_id']}'")."</td>\n";
			$s .= "		</tr>\n";		
		}
	}
	$s .= "		</table>\n";
	$s .= "	</div>\n";
	return $s;
}

function show_users(){
	$s = "";
	$sql = sql("SELECT user_id,uname,fname,lname,like_by,dislike_by,user_created,photo FROM forkit_users WHERE uname!='superadmin' ORDER BY user_created DESC");
	$s .= "	<div class=\"mbox\">\n";
	$s .= "		<h1>All Users</h1>\n";
	if(num($sql) == 0 ) {
		$s .= "		<div class=\"no_user\">Sorry, no user currently avalaible to show.</div>\n";
	} else {
		$s .= "		<ul id=\"koalalist1\">\n";
		while( $row = ext($sql)){
			$s .= "		<li>\n";
			$s .= "			<div>".find_name($row['uname'])."</div>\n";
			$s .= "			<img src=\"".URL."/photos/users/{$row['photo']}\" alt=\"\">\n";
			$s .= "		</li>\n";
		}
		$s .= "		</ul>\n";
	}
	$s .= "	</div>\n";
	return $s;
}

function find_forum_stats(){
	$s = "";
	$online_user = find_total("forkit_users", "user_status='1'");
	$all_user = find_total("forkit_users", "");
	$total_cats = find_total("forkit_cats", "");
	$total_topics = find_total("forkit_topics", "");
	$total_replies = find_total("forkit_replies", "");
	$s .= "	<div class=\"mbox\">\n";
	$s .= "		<h1>Forum Stats</h1>\n";
	$s .= "		<div class=\"stat_box\">\n";
	$s .= "			<div class=\"stat_left\"><span class=\"stat_icon fa fa-user\"></span><span class=\"stat_txt\">Total All Users</span></div>\n";
	$s .= "			<div class=\"stat_right\">: <span class=\"stat_nbr\">{$all_user}</span></div>\n";
	$s .= "			<div class=\"clr\"></div>\n";
	$s .= "		</div>\n";
	
	$s .= "		<div class=\"stat_box\">\n";
	$s .= "			<div class=\"stat_left\"><span class=\"stat_icon fa fa-music\"></span><span class=\"stat_txt\">Total Online Users</span></div>\n";
	$s .= "			<div class=\"stat_right\">: <span class=\"stat_nbr\">{$online_user}</span></div>\n";
	$s .= "			<div class=\"clr\"></div>\n";
	$s .= "		</div>\n";	
	
	$s .= "		<div class=\"stat_box\">\n";
	$s .= "			<div class=\"stat_left\"><span class=\"stat_icon fa fa-star\"></span><span class=\"stat_txt\">Total Forum Categories</span></div>\n";
	$s .= "			<div class=\"stat_right\">: <span class=\"stat_nbr\">{$total_cats}</span></div>\n";
	$s .= "			<div class=\"clr\"></div>\n";
	$s .= "		</div>\n";
	
	$s .= "		<div class=\"stat_box\">\n";
	$s .= "			<div class=\"stat_left\"><span class=\"stat_icon fa fa-heart\"></span><span class=\"stat_txt\">Total Forum Topics</span></div>\n";
	$s .= "			<div class=\"stat_right\">: <span class=\"stat_nbr\">{$total_topics}</span></div>\n";
	$s .= "			<div class=\"clr\"></div>\n";
	$s .= "		</div>\n";
	
	$s .= "		<div class=\"stat_box\">\n";
	$s .= "			<div class=\"stat_left\"><span class=\"stat_icon fa fa-film\"></span><span class=\"stat_txt\">Total Forum Replies</span></div>\n";
	$s .= "			<div class=\"stat_right\">: <span class=\"stat_nbr\">{$total_replies}</span></div>\n";
	$s .= "			<div class=\"clr\"></div>\n";
	$s .= "		</div>\n";
	$s .= "	</div>\n";
	return $s;
}

// pm
function find_pm($uname) {
	$s = "";
	$s .= "	<div class=\"mbox\">\n";
	$s .= "		<h1>My Personal Message</h1>\n";
	$s .= "		<ul id=\"pm_menu\">\n";
	$s .= "			<li><a href=\"".URL."/pm.php?uname={$uname}&tab=inbox\">Inbox</a></li>\n";
	$s .= "			<li><a href=\"".URL."/pm.php?uname={$uname}&tab=sentitem\">Sent Items</a></li>\n";
	$s .= "			<li><a href=\"".URL."/pm.php?uname={$uname}&tab=draft\">Drafts</a></li>\n";
	$s .= "			<li><a href=\"".URL."/pm.php?uname={$uname}&tab=spam\">Spams</a></li>\n";
	$s .= "		</ul>\n";
	
	
	$s .= "	</div>\n";
	return $s;
}


?>