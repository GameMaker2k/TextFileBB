<?php
require("header.php");

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
// Module: mail.php - Last update: April 1, 2006
// ----------------------------------------------------------------------------------------
//
// Sanitised and Dereglobed OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

require("forum_conf.php");

if(!isset($_COOKIE['storedcookie_textfileBB_id'])) {
error("Please <a href=login.php>Login</a> to PM a member with the forum.");
}

require("./groups/{$status}.php");
if ($can_pm == "No") {
error("Your group is disabled from using the PM system");
}


require("clean_message.php");


if ($_POST) {

if ($_POST['message'] == "") error("No title given to message.");
if ($_POST['topicname'] == "") error("No title given message subject.");

$today = date("m.d.y");

$messageperson = strtolower($_POST['messageperson']);

if (!file_exists("./accounts/{$messageperson}_user.php")) {
error("The user you are trying to send a PM to doesn't exist.");
} else {
require("forum_conf.php");
$countstuff2 = opendir("./accounts/{$messageperson}_outbox");
$total_topics2 = 0;
while($file2 = readdir($countstuff2)){
 if($file2 != '.' && $file2 != '..'){
    $total_topics2++;
 }
}
closedir($countstuff2);

$countstuff3 = opendir("./accounts/{$messageperson}_inbox");
$total_topics3 = 0;
while($file3 = readdir($countstuff3)){
 if($file3 != '.' && $file3 != '..'){
    $total_topics3++;
 }
}
closedir($countstuff3);

$inboxof_person_total = $total_topics3 + $total_topics2;

if ($inboxlimit == $inboxof_person_total) {
error("This user's inbox is full, and cannot accept new messages at this time.");
} else {

$g = "./id_data/pm_id_num.txt";  
$id_file = file($g);
$latest_id_num = $id_file[0];
$add1 = $latest_id_num+1;
$quickwrite=fopen("$g", "w");
fwrite($quickwrite,  "$add1" );
$register_id = file("./id_data/member_names_num.txt");
$result = array_search_ci($register_id, $acfile);
if ($result != "") {
$get = $register_id[$result];
} else {
echo "No account with the name $acfile was found";
die();
}

$date = date("m.d.y");

$post_write = fopen("./accounts/{$messageperson}_inbox/{$latest_id_num}.php", "a");
fwrite($post_write,  "<?php die(); ?>$topicname\n$result\n$date\n$message\n");



?>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Sent Successfully</td><tr>

<td class=arcade1 valign="top"><div align=center>Message Sent.</div>
 </td>
</table>
</div>
<br>
<?
}
}
}

?>


<br>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php><?php echo "$forum_name"; ?></a> &#187; <a href=inbox.php>Inbox</a> &#187; Composing a message...</td></table></div>
<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Send Inbox Message</td><tr>

<td class=arcade1 valign="top"><div align=center><form action='' method=post enctype="multipart/form-data" name="postbox">
<br>Title:&nbsp;&nbsp;&nbsp;&nbsp; <input type=text name=topicname value='<?php if ($_GET['replysubject']) { echo stripslashes(htmlspecialchars($_GET['replysubject'], ENT_QUOTES)); } ?>' maxlength="80"><br><br>Send to: <input type=text name=messageperson value='<?php echo htmlspecialchars($_GET['replyname'], ENT_QUOTES); ?>' maxlength="80"><br><br>

<?php
	displaybbcode();
?>


<br><textarea cols=60 rows=20 class=input name=message></textarea><br><br>
<?php
displayemotes();
?>
<br>

<br><br><input type=submit value='Send Message'></div>
 </td>
</table>
</div>
<br><br>
<?php
require("footer.php");
?>