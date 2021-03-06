<?php
date_default_timezone_set('Asia/Jakarta');
define('URL', 'http://localhost/forkit');
define('WEB', 'Forum Kita');
mysql_connect('localhost', 'root', '');
mysql_select_db('forkit');
$act = isset($_POST['act']) ? $_POST['act'] : '';
$get = isset($_GET['get']) ? $_GET['get'] : '';

function sql($s){ return mysql_query($s); }
function num($s){ return mysql_num_rows($s); }
function ext($s){ return mysql_fetch_array($s); }
function red($s){ return header("Location:".$s); }
function esc($s){ return mysql_real_escape_string(stripslashes($s)); }


//This function let convert BBcode to HTML
function bbcode_to_html($text)
{
	$text = nl2br(htmlentities($text, ENT_QUOTES, 'UTF-8'));
	$in = array(
			'#\[b\](.*)\[/b\]#Usi',
			'#\[i\](.*)\[/i\]#Usi',
			'#\[u\](.*)\[/u\]#Usi',
			'#\[s\](.*)\[/s\]#Usi',
			'#\[img\](.*)\[/img\]#Usi',
			'#\[url\]((ht|f)tps?\:\/\/(.*))\[/url\]#Usi',
			'#\[url=((ht|f)tps?\:\/\/(.*))\](.*)\[/url\]#Usi',
			'#\[left\](.*)\[/left\]#Usi',
			'#\[center\](.*)\[/center\]#Usi',
			'#\[right\](.*)\[/right\]#Usi',
			'#\[code\](.*)\[/code\]#Usi'
		);
	$out = array(
			'<strong>$1</strong>',
			'<em>$1</em>',
			'<span style="text-decoration:underline;">$1</span>',
			'<span style="text-decoration:line-through;">$1</span>',
			'<img src="$1" alt="Image" />',
			'<a href="$1">$1</a>',
			'<a href="$1">$4</a>',
			'<div style="text-align:left;">$1</div>',
			'<div style="text-align:center;">$1</div>',
			'<div style="text-align:right;">$1</div>',
			'<div style="line-height:15px;padding:10px;background:#FCEFD9;color:#A56901;border-radius:5px;font-family:courier new;font-size:12px;text-align:left;margin:0;">$1</div>'
		);
    $count = count($in)-1;
    for($i=0;$i<=$count;$i++)
    {
        $text = preg_replace($in[$i],$out[$i],$text);
    }
	return $text;
}
//This function let convert HTML to BBcode
function html_to_bbcode($text)
{
	$text = str_replace('<br />','',$text);
	$in = array(
		'#<strong>(.*)</strong>#Usi',
		'#<em>(.*)</em>#Usi',
		'#<span style="text-decoration:underline;">(.*)</span>#Usi',
		'#<span style="text-decoration:line-through;">(.*)</span>#Usi',
		'#<img src="(.*)" alt="Image" />#Usi',
		'#<a href="(.*)">(.*)</a>#Usi',
		'#<div style="text-align:left;">(.*)</div>#Usi',
		'#<div style="text-align:center;">(.*)</div>#Usi',
		'#<div style="text-align:right;">(.*)</div>#Usi',
		'#<div style="padding:10px; background:#FCF8C2;color:#764563;border-radius:3px;font-family:courier-new;font-size:12px;auto;">(.*)</div>#Usi'
	);
	$out = array(
		'[b]$1[/b]',
		'[i]$1[/i]',
		'[u]$1[/u]',
		'[s]$1[/s]',
		'[img]$1[/img]',
		'[url=$1]$2[/url]',
		'[left]$1[/left]',
		'[center]$1[/center]',
		'[right]$1[/right]',
		'[code]$1[/code]'
	);
    $count = count($in)-1;
    for($i=0;$i<=$count;$i++)
    {
        $text = preg_replace($in[$i],$out[$i],$text);
    }
	return $text;
}
?>