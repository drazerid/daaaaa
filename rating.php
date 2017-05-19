<?php
require(dirname(__FILE__).'/bootstrap.php');

function getAllVotes($id){
	/**
	Returns an array whose first element is votes_up and the second one is votes_down
	**/
	$votes = array();
	$q = "SELECT * FROM forkit_users WHERE user_id = $id";
	$r = mysql_query($q);
	if(mysql_num_rows($r)==1)//id found in the table
		{
		$row = mysql_fetch_assoc($r);
		$votes[0] = $row['like_by'];
		$votes[1] = $row['dislike_by'];
	}
	return $votes;
}

function getEffectiveVotes($id){
	/**
	Returns an integer
	**/
	$votes = getAllVotes($id);
	$effectiveVote = $votes[0] - $votes[1];
	return $effectiveVote;
}
$id = isset($_POST['id']) ? $_POST['id'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
$cur_votes = getAllVotes($id);
	
if($type=='vote_up') {
	$votes_up = $cur_votes[0]+1;
	$q = "UPDATE forkit_users SET like_by = $votes_up, likedislike_by='".$_SESSION['user_id']."' WHERE user_id = $id";
} elseif($type=='vote_down') {
	$votes_down = $cur_votes[1]+1;
	$q = "UPDATE forkit_users SET dislike_by = $votes_down, likedislike_by='".$_SESSION['user_id']."' WHERE user_id = $id";
}
$r = sql($q);
if($r){
	$effectiveVote = getEffectiveVotes($id);
	echo $effectiveVote." likes";
} elseif(!$r){
	echo "Failed!";
}
?>