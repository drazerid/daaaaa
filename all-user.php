<?php
require(dirname(__FILE__).'/bootstrap.php');

echo set_header();
echo "<div class=\"wrapper\">\n";
echo topsection();
echo $newuname ? topnav($newuname) : topnav($uname);

echo "	<div class=\"container\">\n";
echo "		<div class=\"cleft\">\n";

echo "			<div class=\"mbox\">\n";
echo "				<h1>View All Users</h1>\n";
echo "				<ul id=\"filters\" class=\"clearfix\">\n";
echo "			       	<li><span class=\"filter active\" data-filter=\"online male female on_bday\">All</span></li>\n";
echo "			        <li><span class=\"filter\" data-filter=\"online\">Online User</span></li>\n";
echo "			        <li><span class=\"filter\" data-filter=\"male\">Male User</span></li>\n";
echo "			        <li><span class=\"filter\" data-filter=\"female\">Female User</span></li>\n";
echo "			        <li><span class=\"filter\" data-filter=\"on_bday\">On Birthday User</span></li>\n";
echo "				</ul>\n";

$bd = date("d-m");

echo "				<div id=\"portfoliolist\">\n";

$s1 = sql("SELECT * FROM forkit_users WHERE user_status='1' ORDER BY user_status ASC");
if(num($s1) > 0){
	while($r1 = ext($s1)){
		echo "					<div class=\"portfolio online\" data-cat=\"online\">\n";
		echo "						<div class=\"portfolio-wrapper\">\n";
		echo "							<img src=\"".URL."/photos/users/{$r1['photo']}\" alt=\"\">\n";
		echo "							<div class=\"label\">\n";
		echo "								<div class=\"label-text\">\n";
		echo "									<a href=\"".URL."/user.php?uname={$r1['uname']}\" class=\"text-title\">".find_name($r1['uname'])."</a>\n";
		echo "									<span class=\"text-category\">Like: {$r1['like_by']} &nbsp; | Dislike: {$r1['dislike_by']}</span>\n";
		echo "								</div>\n";
		echo "								<div class=\"label-bg\"></div>\n";
		echo "							</div>\n";
		echo "						</div>\n";
		echo "					</div>\n";
	}
}

$s2 = sql("SELECT * FROM forkit_users WHERE sex='1' GROUP BY sex");
if(num($s2) > 0){
	while($r2 = ext($s2)){
		echo "					<div class=\"portfolio male\" data-cat=\"male\">\n";
		echo "						<div class=\"portfolio-wrapper\">\n";
		echo "							<img src=\"".URL."/photos/users/{$r2['photo']}\" alt=\"\">\n";
		echo "							<div class=\"label\">\n";
		echo "								<div class=\"label-text\">\n";
		echo "									<a href=\"".URL."/user.php?uname={$r2['uname']}\" class=\"text-title\">".find_name($r2['uname'])."</a>\n";
		echo "									<span class=\"text-category\">Like: {$r2['like_by']} &nbsp; | Dislike: {$r2['dislike_by']}</span>\n";
		echo "								</div>\n";
		echo "								<div class=\"label-bg\"></div>\n";
		echo "							</div>\n";
		echo "						</div>\n";
		echo "					</div>\n";
	}
}

$s3= sql("SELECT * FROM forkit_users WHERE sex='2'");
if(num($s3) > 0){
	while($r3 = ext($s3)){
		echo "					<div class=\"portfolio female\" data-cat=\"female\">\n";
		echo "						<div class=\"portfolio-wrapper\">\n";
		echo "							<img src=\"".URL."/photos/users/{$r3['photo']}\" alt=\"\">\n";
		echo "							<div class=\"label\">\n";
		echo "								<div class=\"label-text\">\n";
		echo "									<a href=\"".URL."/user.php?uname={$r3['uname']}\" class=\"text-title\">".find_name($r3['uname'])."</a>\n";
		echo "									<span class=\"text-category\">Like: {$r3['like_by']} &nbsp; | Dislike: {$r3['dislike_by']}</span>\n";
		echo "								</div>\n";
		echo "								<div class=\"label-bg\"></div>\n";
		echo "							</div>\n";
		echo "						</div>\n";
		echo "					</div>\n";
	}
}

$s4 = sql("SELECT * FROM forkit_users WHERE bdate='{$bd}'");
if(num($s4) > 0){
	while($r4 = ext($s4)){
		echo "					<div class=\"portfolio on_bday\" data-cat=\"on_bday\">\n";
		echo "						<div class=\"portfolio-wrapper\">\n";
		echo "							<img src=\"".URL."/photos/users/{$r4['photo']}\" alt=\"\">\n";
		echo "							<div class=\"label\">\n";
		echo "								<div class=\"label-text\">\n";
		echo "									<a href=\"".URL."/user.php?uname={$r4['uname']}\" class=\"text-title\">".find_name($r4['uname'])."</a>\n";
		echo "									<span class=\"text-category\">Like: {$r4['like_by']} &nbsp; | Dislike: {$r4['dislike_by']}</span>\n";
		echo "								</div>\n";
		echo "								<div class=\"label-bg\"></div>\n";
		echo "							</div>\n";
		echo "						</div>\n";
		echo "					</div>\n";
	}
}
echo "					<div class=\"clr\"></div>\n";
echo "				</div>\n";
echo "			</div>\n";
echo "		</div>\n";
echo "		<div class=\"cright\">\n";

echo $newuname ? show_profile_picture($newuname) : show_profile_picture($uname);

echo forum_menu();



echo "		</div>\n";
echo "		<div class=\"clr\"></div>\n";
echo "	</div>\n";
echo "</div>\n";
echo set_footer();
?>