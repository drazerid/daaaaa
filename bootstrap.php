<?php
session_start();
require(dirname(__FILE__).'/libs/functions.php');
require(dirname(__FILE__).'/libs/site.php');
$section = isset($_GET['section']) ? $_GET['section'] : '';
$t = isset($_GET['t']) ? $_GET['t'] : '';
$p = isset($_GET['p']) ? $_GET['p'] : '';
$uname = isset($_SESSION['uname']) ? $_SESSION['uname'] : '';
$newuname = isset($_SESSION['new_uname']) ? $_SESSION['new_uname'] : '';
$uid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$getuname = isset($_GET['uname']) ? $_GET['uname'] : '';


if($act == 'Login'){ login($_POST['email'], $_POST['passw']); }
elseif($act == 'Register'){ register($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['passw']); }
elseif($act == 'Update Profile'){ update_profile($uname, $_POST['uid'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['passw'], $_POST['website']); }
elseif($act == 'Add Category'){ add_category($_POST['cat_name']); }
elseif($act == 'Submit New Post'){ save_new_post($_POST['cat_id'], $_POST['title'], $_POST['descript']); }
elseif($act == 'Update Post'){ edit_post($_POST['cat_id'], $_POST['topic_id'], $_POST['title'], $_POST['descript']); }
elseif($act == 'Reply'){ save_new_reply($_POST['pid'], $_POST['hid'], $_SESSION['user_id'], $_POST['reply'], $_POST['parent_id']); }
elseif($section == 'logout'){ logout(); }

?>