<?php
require(dirname(__FILE__).'/bootstrap.php');

echo set_header();
echo "<div class=\"top\">\n";
echo "	<div class=\"tleft\">\n";
echo "		<div class=\"tlogo\"><a href=\"".URL."/admin.php\">".WEB."</a></div>\n";
echo "	</div>\n";
echo "	<div class=\"tright\">\n";

echo "	</div>\n";
echo "	<div class=\"clr\"></div>\n";
echo "</div>\n";

echo "<div class=\"page\">\n";
echo "	<div class=\"pleft\">\n";
echo "		<div class=\"box\">\n";
echo "			<ul id=\"nav\">\n";
echo "				<li><a href=\"".URL."/admin.php\"><span class=\"box_icon fa fa-home\"></span> <span class=\"box_text\">Dashboard</span></a></li>\n";
echo "				<li><a href=\"".URL."/admin.php?section=category\"><span class=\"box_icon fa fa-home\"></span> <span class=\"box_text\">Category</span></a></li>\n";
echo "				<li><a href=\"".URL."/admin.php?section=user\"><span class=\"box_icon fa fa-home\"></span> <span class=\"box_text\">User</span></a></li>\n";
echo "				<li><a href=\"".URL."/admin.php?section=topic\"><span class=\"box_icon fa fa-home\"></span> <span class=\"box_text\">Topic</span></a></li>\n";
echo "				<li><a href=\"".URL."/admin.php?section=reply\"><span class=\"box_icon fa fa-home\"></span> <span class=\"box_text\">Reply</span></a></li>\n";
echo "				<li><a href=\"".URL."/admin.php?section=badword\"><span class=\"box_icon fa fa-home\"></span> <span class=\"box_text\">Badword</span></a></li>\n";
echo "				<li><a href=\"".URL."/admin.php?section=feedback\"><span class=\"box_icon fa fa-home\"></span> <span class=\"box_text\">Feedback</span></a></li>\n";
echo "				<li><a href=\"".URL."/admin.php?section=survey\"><span class=\"box_icon fa fa-home\"></span> <span class=\"box_text\">Survey</span></a></li>\n";
echo "				<li><a href=\"".URL."/admin.php?section=logout\"><span class=\"box_icon fa fa-home\"></span> <span class=\"box_text\">Logout</span></a></li>\n";
echo "			</ul>\n";
echo "		</div>\n";

echo "	</div>\n";
echo "	<div class=\"pright\">\n";
if($section == 'category'){
	echo display_category();
}

echo "	</div>\n";
echo "	<div class=\"clr\"></div>\n";
echo "</div>\n";
echo set_footer();
?>