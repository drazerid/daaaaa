<?php
require(dirname(__FILE__).'/bootstrap.php');

echo set_header();
echo "<div class=\"wrapper\">\n";
echo topsection();
echo $newuname ? topnav($newuname) : topnav($uname);

echo "	<div class=\"container\">\n";
echo "		<div class=\"cleft\">\n";
if($t && $p){
	
	$d = $newuname ? $newuname : $uname;
	echo view_topic($t, $p, $d);
}
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