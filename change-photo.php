<?php
require(dirname(__FILE__).'/bootstrap.php');

echo set_header();
echo "<div class=\"wrapper\">\n";
echo topsection();
echo topnav($uname);

echo "	<div class=\"container\">\n";
echo "		<div class=\"cleft\">\n";
echo $newuname ? photo_uploader_form($newuname) : photo_uploader_form($uname);

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