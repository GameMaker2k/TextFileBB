<?php

require("header.php");

// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
//                         TextfileBB
//                Website: http://tfbb.jcink.com
//               
//  Modify freely, as long as you're not turning the forum 
// into a board service of any form. Please ask for permission 
// first to redistribute any of the TextfileBB code. 
//
// Thanks.
//
// ----------------------------------------------------------------------------------------
// Module:INBOX - Last update: April 1, 2006
// Santised and Dereglobed OK
// ----------------------------------------------------------------------------------------

if(!isset($_COOKIE['storedcookie_textfileBB_id'])) {
error("Please <a href=login.php>Login</a> to PM a member with the forum.");
}

$countstuff2 = opendir("./accounts/{$acfile}_outbox");
$total_topics2 = 0;
while($file2 = readdir($countstuff2)){
 if($file2 != '.' && $file2 != '..' && $file2 != 'sticky' ){
    $total_topics2++;
 }
}
closedir($countstuff2);


$register_id = file("./id_data/member_names_num.txt");

//
//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
require("forum_conf.php");
echo "<title>$forum_name - Inbox</title>";

require("./groups/{$status}.php");
if ($can_pm == "No") {
error("Your group is disabled from using the PM system");
}


if ($_POST['pma']) {

$pma=$_POST['pma'];

for($x=0;$x<=count($pma)-1;$x++){
if(!is_numeric($pma[$x])) die();

@unlink("./accounts/{$acfile}_inbox/{$pma[$x]}.php");
@unlink("./accounts/{$acfile}_outbox/{$pma[$x]}.php");


}

}

if ($_GET['delete']) {
if(!is_numeric($_GET['delete'])) die();
@unlink("./accounts/{$acfile}_outbox/{$_GET['delete']}.php");
@unlink("./accounts/{$acfile}_inbox/{$_GET['delete']}.php");


}

$varvar = $total_topics2 + $var;
?>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; Your Inbox</td></table></div>
<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=arcade1>[ <a href="mail.php?action=mail"><u>Write Message</u></a> &middot; <?php echo "$varvar"; ?>/<?php echo "$inboxlimit"; ?> allotted messages  ] <br><br> </td>
</table>
</div>
<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><td width=2%% align=center class=headertableblock>Delete</td><td width=30%% align=center class=headertableblock>Unread Messages</td><td width=10% align=center class=headertableblock>Sender & Time</td><tr>
<form action='' method='POST'>
<?php
$countstuff = opendir("./accounts/{$acfile}_inbox");
$total_topics = 0;
while($file = readdir($countstuff)){
 if($file != '.' && $file != '..' && $file != 'sticky' ){
    $total_topics++;
 }
}
closedir($countstuff);

if ($total_topics != 0 ) {


$s = "./accounts/{$acfile}_inbox";

$handle = opendir($s);

while($topic = readdir($handle ))

 {
   if( $topic == '.' || $topic == '..' || $topic == 'error_log' )
  
   continue;
    
   $forumtopiclist [$topic] = filemtime($s."/".$topic);

   }

// use arsort to show them by last modified date
// arsort also lets us have "bumped" topics because it doesnt go by creation but last modified.
// so when a topic is replied to, it gets bumped to the top because then it's "modified"
// get it?

@arsort($forumtopiclist);

while(list($t)=@each($forumtopiclist))

{


// strip the .txt off the end of the topics.

$thetopic = "$t";

$topicstrip = strrpos($thetopic, '.');

$topictitle = substr($thetopic, 0, $topicstrip);

$thetopic_file = file("./accounts/{$acfile}_inbox/$thetopic");
$title = $thetopic_file[0];
$theauthorid = rtrim($thetopic_file[1]);
$author = $register_id[$theauthorid];
$date = date("m.d.y", filemtime("./accounts/{$acfile}_outbox/$thetopic2"));

   echo "<tr><td class=arcade1 valign=top><div align=center><input type=checkbox name='pma[]' value='$topictitle'></div></td><td class=arcade1 valign=top><a href='message.php?messageid=$topictitle&read=1'>$title</a></td></td><td class=arcade1 valign=top>Sent By: <a href='viewprofile.php?showuser=$theauthorid'>$author</a> <br>Date: $date<br></td></div>";
 }
} else {

echo "<tr><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td></div>";

}
?>
</font>
<tr><td class=headertableblock colspan=7><div align=center><input type=submit name=delete value='Delete Checked'></div></td></tr>
</form>
</table>
</div>
<br>
<form action='' method='POST'>
<div align='center'>
<div class='tableborder'><table width=100% cellpadding='5' cellspacing='1'><td width=2%% align=center class=headertableblock>Delete</td><td width=30%% align=center class=headertableblock>Read Messages</td><td width=10% align=center class=headertableblock>Sender & Time</td><tr>
<?php

// ============================
// Pull up who the author is
//============================

if ($total_topics2 != 0 ) {
$s2 = "./accounts/{$acfile}_outbox";
$handle2 = opendir($s2);
while($topic2 = readdir($handle2 ))
 {
   if( $topic2 == '.' || $topic2 == '..' || $topic2 == 'error_log' )
   continue;
   $forumtopiclist2 [$topic2] = filemtime($s2."/".$topic2);
   }
@arsort($forumtopiclist2);
while(list($t2)=@each($forumtopiclist2))
{
$thetopic2 = "$t2";
$topicstrip2 = strrpos($thetopic2, '.');
$topictitle2 = substr($thetopic2, 0, $topicstrip2);
$thetopic_file = file("./accounts/{$acfile}_outbox/$thetopic2");
$title = $thetopic_file[0];
$theauthorid = rtrim($thetopic_file[1]);
$author = $register_id[$theauthorid];
$date = date("m.d.y", filemtime("./accounts/{$acfile}_outbox/$thetopic2"));

   echo "<tr><td class=arcade1 valign=top><div align=center><input type=checkbox name='pma[]' value='$topictitle2'></div></td><td class=arcade1 valign=top><a href='message.php?messageid=$topictitle2&read=2'>$title</a></td></td><td class=arcade1 valign=top>Sent By: <a href='viewprofile.php?showuser=$theauthorid'>$author</a> <br>Date: $date<br></td></div>";
 }
} else {

echo "<tr><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td></div>";

}
?>
</font>
<tr><td class=headertableblock colspan=7><div align=center><input type=submit name=delete value='Delete Checked'></div></td></tr>
</form>
</table>
</div>
<br>
<?php 
require("footer.php");
?>