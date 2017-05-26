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
// Module: footer.php - Last update: Feb 21, 2007
// Santized and Dereglobed: OK
// ----------------------------------------------------------------------------------------
//
// You can add your copyright to your site and such below, or above
// mine if you like. Just do not remove mine.
//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

// Here, we discover what location they're at.
// It explodes the php file
// and just gets the name

$explosion = explode(".php", $_SERVER['PHP_SELF']);
$kerboom = explode("/", $explosion[0]);
$howmuchexploded = count($kerboom);
$Location = $kerboom[$howmuchexploded-1];


if (isset($_COOKIE['storedcookie_textfileBB_id'])) {
$register_id = file("./id_data/member_names_num.txt");
$result = array_search_ci($register_id, $_COOKIE['storedcookie_textfileBB_id']);
$get = rtrim($register_id[$result]);
$username = rtrim($get);
} else {
$register_id = file("./id_data/member_names_num.txt");
$username = "";
}



if (isset($_COOKIE['storedcookie_textfileBB_id'])) {
$fnew_s=fopen("./sessionsfolder/$get.php", "w");

if ($Location == online) {
fwrite($fnew_s,  "Viewing Online List");
}

if ($Location == inbox) {
fwrite($fnew_s,  "Using Inbox... ");
}

if ($Location == edit_post) {
fwrite($fnew_s,  "Editing a post...");
}

if ($Location == register) {
fwrite($fnew_s,  "Registering...");
}

if ($Location == forgotpass) {
fwrite($fnew_s,  "Recovering password...");
}

if ($Location == profile) {
fwrite($fnew_s,  "Updating profile..." );
}


if ($Location == login) {
fwrite($fnew_s,  "Logging in..." );
}

if ($Location == mail) {
fwrite($fnew_s,  "Using Inbox... &#187; Composing Message" );
}


if ($Location == viewprofile) {
fwrite($fnew_s,  "Viewing Member's Profile" );
}


if ($Location == admincp) {
fwrite($fnew_s,  "Using Admin CP..." );
}




if ($Location == topicdisplay) {
fwrite($fnew_s,  "Viewing forum" );
}


if ($Location == viewtopic) {
fwrite($fnew_s,  "Viewing topic" );
}


if ($Location == new_topic) {
fwrite($fnew_s,  "&#187; Creating New Topic... " );
}

if ($Location == add_reply) {
fwrite($fnew_s,  "&#187; Replying..." );
}

if ($Location == index) {
fwrite($fnew_s,  "Viewing Board Index" );
}


if ($Location == search) {
fwrite($fnew_s,  "Searching..." );
}


fwrite($fnew_s,  "\n<?php die(); ?>" );
fwrite($fnew_s,  "\n$_SERVER[REMOTE_ADDR]\n$result" );


}

$olist=0;
$dir = "./sessionsfolder/";
if (is_dir($dir)) {
   if ($dh = opendir($dir)) {
       while (($file = readdir($dh)) !== false) {
		   if ($file != ".." && $file != ".") {

$FileTime=explode(".", filemtime("./sessionsfolder/$file")/60);
$TimeNow = explode(".", time()/60);
$HowManyMinutes=$TimeNow[0]-$FileTime[0];
if($HowManyMinutes > 15) { unlink("./sessionsfolder/$file"); } else {
$onlinedata=file("./sessionsfolder/$file"); 
$file=explode(".", $file);

	$lowerrr=strtolower($file[0]);
if (file_exists("./accounts/{$lowerrr}_user.php")) {
require("./accounts/{$lowerrr}_user.php");
require("./groups/{$status}.php");

} else {
	@unlink("./sessionsfolder/{$file[0]}.php");
}

$storedonlinelist.="$online_prefix <a href='viewprofile.php?showuser=$onlinedata[3]' title='$onlinedata[0]'>$file[0]</a> $online_suffix"; 

$olist++;

}
  		
		  
		   }
       }
       closedir($dh);
   }
}



?>
<?php

if ($Location == index) {

echo "<br><div align='center'><div class='tableborder'><table width=100% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Forum Stats</font></b></td></tr>
<td width=2% align=center class=arcade1><font size=-5></font></td>
<td width=50% align=center class=arcade1></td>";
echo "<tr><td class=arcade1>$online_marker</td><td class=arcade1>";
?>
<?php echo $olist; ?> users have visited in the last 15 Minutes:
<?php
if ($olist != 0 ) {
 $s9 = "./sessionsfolder/";
  $handle9 = opendir($s9);
  while ( $topic9 = readdir($handle9 ))
   {
     if( $topic9 == '.' || $topic9 == '..' || $topic9 == '.php' )
     continue;
      
     if (preg_match("/\.(php|xml)$/", $topic9)){
     $forumtopiclist9 [$topic9] = filemtime($s9."/".$topic9);
     }

     }

// use arsort to show them by last modified date
// arsort also lets us have "bumped" topics because it doesnt go by creation but last modified.
// so when a topic is replied to, it gets bumped to the top because then it's "modified"
// get it?
  @arsort($forumtopiclist9);

while(list($t9)=@each($forumtopiclist9))


  {


// strip the .txt off the end of the topics.

$thetopic9 = "$t9";

$topicstrip9 = strrpos($thetopic9, '.');

$topictitle9 = substr($thetopic9, 0, $topicstrip9);

if (file_exists("./sessionsfolder/{$topictitle9}.php")) {

$member_id_number = array_search_ci($register_id, "$topictitle9");
$lowerplz = strtolower($topictitle9);

if (file_exists("./accounts/{$lowerplz}_user.php")) {
require("./accounts/{$lowerplz}_user.php");
} else {
	@unlink("./sessionsfolder/{$topictitle9}.php");
}

require("./groups/{$status}.php");

if ($Location == index) {
	     echo "<a href='viewprofile.php?showuser=$member_id_number'><u>$online_prefix".$topictitle9."$online_suffix</u></a>&nbsp;";
}

}
}
}

if ($Location == index) {

echo " <a href='online.php' title='Details'>[+]</a>";
echo "</td></tr>";
echo "<tr><td class=arcade1>$birthday_marker</td><td class=arcade1>";

//Attempt to bring up peoples birthdays... I have a feeling that this will be slow when a good number of accounts
//are signed up, but we'll see

echo "Today's Birthdays:  ";

$c = 0;
$s = "./accounts/";
  $handle = opendir($s);
  while ( $topic = readdir($handle ))
   {
     if( $topic == '.' || $topic == '..' )
     continue;
     $forumtopiclist [$topic] = filemtime($s."/".$topic);
    }
  arsort($forumtopiclist);
  while(list($t)=each($forumtopiclist))
  {
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
$birthdaydata = explode(".", $birthday);
$md = $birthdaydata[0].$birthdaydata[1];

$date = date("m.d.y");
$thedatedata = explode(".", $date);
$md_date = $thedatedata[0].$thedatedata[1];

if ($md == $md_date) {
$yearborn = "19"."$birthdaydata[2]";
$yeartoday= "20"."$thedatedata[2]";
$howold = $yeartoday-$yearborn;
$c++;
echo "$member_txt_file[$getkey] - ( <b>$howold</b> ) ";
}
}
}
if ($c == 0) {
	echo "No members are celebrating a birthday today";
/*
[00:15] jcinker: And a fresh install is a-ok for me
[00:15] bluerush123: Wait
[00:15] bluerush123: lol
[00:15] bluerush123: Bitday*
[00:15] bluerush123: bithday*
[00:15] bluerush123: X
[00:15] bluerush123: you forgot the r
[00:15] jcinker: <_>
[00:15] jcinker: oops
*/

}

// end birthdays
echo "</td></tr>";
echo "<tr><td class=arcade1>$stats_marker</td><td class=arcade1>";

 
 $thefinal = $top_p+$rep_p;
?>
<div align=Left>
 Our members have posted: <?php echo "<b>$thefinal</b>"; ?> posts.<br>
We have <?
$countstuff = opendir("./accounts/"); 
$members = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..'){ 
      $members++; 
   } 
} 

closedir($countstuff);
$dividerealfast = $members/3-1;
echo "<b>$dividerealfast</b> registered members";

// find out who is the latest registered user
$members2 = file("./id_data/member_names_num.txt");
$total_user = count($members2);  

echo "<br>Our newest registered user is: ";
$we = $total_user-1;

if(trim($members2[$we])=="Guest") {
$we=$we-1;
}

echo "<a href='viewprofile.php?showuser=$we'> $members2[$we] </a>";

echo "</td></tr>";

echo "</tr></table></div><br>";
}
}
?>
<br>
<div align='center'><?php readfile("footer.html");?></div><br>
<div align=center><font size=-5>[ Powered By <a href="http://tfbb.jcink.com">TextfileBB</a> v1.0.19 &copy; 2005 <a href=http://jcink.com>Jcink.com</a> ]</font></div>

