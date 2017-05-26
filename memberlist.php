<?php


// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
//                               TextfileBB
//                Website: http://tfbb.jcink.com
//               
//  Modify freely, as long as you're not turning the forum 
// into a board service of any form. Please ask for permission 
// first to redistribute any of the TextfileBB code. 
//
// Thanks.
//
// ----------------------------------------------------------------------------------------
// Module: topicdisplay.php - Last update: May 30, 2005
// ----------------------------------------------------------------------------------------
//
//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

	// "wear" are the files?!

	require("header.php");
	require("moderate.php");
	require("forum_conf.php");
?>

<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=100%% align=left class=arcade1><a href=index.php><?php echo "$forum_name" ?></a> &#187; Member List</a></td></table></div>
<br>

<?php
echo "<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=30% align=center class=headertableblock>Name</td><td width=20% align=center class=headertableblock>Contact</td>";

$s = "./accounts/";

  $handle = opendir($s);

  while ( $topic = readdir($handle ))

   {

     if( $topic == '.' || $topic == '..' )
     
     continue;
      
     $forumtopiclist [$topic] = filemtime($s."/".$topic);

     }

//

  arsort($forumtopiclist);


  while(list($t)=each($forumtopiclist))

  {


// strip the .txt off the end of the topics.

$thetopic = "$t";

$topicstrip = strrpos($thetopic, '.');

$topictitle = substr($thetopic, 0, $topicstrip);

if ($topictitle == "" || $topictitle == "guest_user") {
echo "";
} else {
$username = explode("_user",  $topictitle);
$member_txt_file = file("./id_data/member_names_num.txt");


$getkey = array_search_ci($member_txt_file, "$username[0]");
require("./accounts/{$username[0]}_user.php");

echo "<tr><td class=arcade1><a href='viewprofile.php?showuser=$getkey'>$member_txt_file[$getkey]</a></td><td class=arcade1><div align=center><A href='mail.php?replyname=$member_txt_file[$getkey]'>[ PM ]</a></div></td></tr>";
}


  }
echo "</table></div><br>";

?>

<br>
<br>
<br>
<?php
require("footer.php");
?>