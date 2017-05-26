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
// Module: add_reply.php - Last update: September 28, 2006
// ----------------------------------------------------------------------------------------
//
// Santized and Dereglobed: OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

//
// Is username posted?
//

require("header.php");
require("stopper.php");
require("clean_message.php");

	$sticky='';

	$topicid=$_GET['topicid'];
	if(!is_numeric($_GET['topicid'])) error("Invalid topic id.");


	if(file_exists("./permissions/{$forum}.php")) {
	require("./permissions/{$forum}.php");
	} else {
	error("Invalid Forum ID");
	}

	if ($allow_posting == 'No') {
	error("This forum is read only, no posts may be made.");
	}
 
	if ($can_reply["$status"] != allowed) {
	error("You do not have permission to make replies in this forum");
	}

	if ($can_read["$status"] != allowed) {
	error("You do not have permission to read this forum");
	}

	if(file_exists("./locked/{$forum}_{$topicid}.lock")) {
	error("This topic has been locked by an admin. Sorry, you will be unable to reply.");
	}

	if (file_exists("./forumposts_{$forum}/sticky/{$topicid}.php")) {
	$sticky = "sticky/";
	}

	if (file_exists("./forumposts_{$forum}/old/{$topicid}.php")) {
	$sticky = "old/";
	}

	$topic_file_s = @file("./forumposts_{$forum}/{$sticky}{$topicid}.php");
	if(!$topic_file_s) error("Invalid topic ID");

if($_GET['tr']) {  
?>

<div align='center'>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href='topicdisplay.php?forum=<?php echo "$forum"; ?>&show=<?php echo "$showtopics"; ?>'><?php if ($forum) { echo "$forum"; } ?></a> &#187; Replying</td></table></div><br>

<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Adding Reply</td><tr>
<td class=arcade1 valign="top"><div align=center><form action='add_reply.php?topicid=<?php echo $topicid ?>&forum=<?php echo "$forum"; ?>' method=post enctype="multipart/form-data" name="postbox">

<?php
	displaybbcode();
?>


<br><textarea cols=60 rows=20 class=input name=message>
<?php 

if ($_GET['quote']) {
$quote=$_GET['quote']; 
$g = is_a_quote($quote);
if ($g==true) { 
$quoted = eregi_replace("<br>", "\n", $topic_file_s[$quote]);
echo "[quote] $quoted [/quote]"; 
} 
} 

?>
</textarea><br><br>
<?php
displayemotes();
?>
<br>

<?php
if ($uploads_enabled == "yes") {
require("./permissions/{$forum}.php");
if ($can_upload["$status"] == allowed) {
echo 'Attach File: <input type="file" name="swforpic"> <br /><br>';
}
}

?>

<input type=submit value='Add Reply'></div>
 </td>
</table>
</div>
<?php
require("footer.php");
die();
}

$ipa = $_SERVER['REMOTE_ADDR'];


if($_POST['message']) {

$register_id = file("./id_data/member_names_num.txt");
$result = array_search_ci($register_id, $acfile);
$post_write = fopen("./forumposts_{$forum}/{$sticky}{$topicid}.php", "a");


require("./groups/{$status}.php");

if ($can_reply_to_others_topics == "No") {
$checkuser = @file("./forumposts_{$forum}/{$sticky}{$topicid}.php");
if ($result != rtrim($checkuser[3])) {
error("Your group does not allow you to reply to topics that are not your own");
}
}

if ($can_reply_to_own_topic == "No") {
$checkuser = file("./forumposts_{$forum}/{$sticky}{$topicid}.php");
if ($result == rtrim($checkuser[3])) {
error("Your group does not allow you to reply to your own topics");
}
}

if ($result != "") {
$get = $register_id[$result];
} else {
error("Error.");
}

$date = date("m.d.y");

if (strlen($_POST['message']) == 0) { 
error("No message was typed");
}

if (!$_FILES['swforpic']['name']) { // Very basic. Just send it.

fwrite($post_write,  "$result\n$_SERVER[REMOTE_ADDR]``$date\n$message\n");
fclose($post_write);

} else { 

if ($can_upload["$status"] != allowed) {
error("You do not have permission to attach files.");
}


$folder = "./uploads/";
$temporary = $_FILES['swforpic']['tmp_name'];
$realfilename = $_FILES['swforpic']['name'];
$extension = uploaderprotect($realfilename);

$temporary=str_replace(" ", "_", $temporary);
$realfilename=str_replace(" ", "_", $realfilename);


//
// Check the filesize, as defined in forum_conf.php
//

require("./groups/{$status}.php");

if ($_FILES['swforpic']['size'] > $group_max_upload_size) {

  unlink($_FILES['swforpic']['tmp_name']);

echo "<div align='center'><div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Attachment</td><tr><td class=arcade1 valign='top'><div align=center>File <b>failed to upload.</b> It is too large to be attached. </div></td></table></div><br>";

echo "<br>";
require("footer.php");
die();

}

//
// Check to see if a file with the exact same name exists
//


if(file_exists("./uploads/$realfilename")) {

echo "<div align='center'><div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Attachment</td><tr><td class=arcade1 valign='top'><div align=center>File <b>failed to upload.</b> This is because a file with the same name as this one has already been uploaded. Please rename the file to a different name ( ex: pic.gif rename to pic1.gif ) </div></td></table></div><br>";

echo "<br>";
require("footer.php");
die();

}


//
//  if there are no problems...
//

@move_uploaded_file($temporary, $folder.$realfilename) or die("Problem writing the Attachment. Please contact the admin. ");

echo "<div align='center'><div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Attachment</td><tr><td class=arcade1 valign='top'><div align=center>File $realfilename attached.</div></td></table></div><br><tr><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td></tr>";

$filename = "./uploads/$realfilename";
$thesize = filesize($filename);
$thedividedsize = round($thesize / 1024 ,2);

if($extension != "gif" && $extension !="jpg" && $extension != "bmp" && $extension != "jpeg" && $extension != "png") {
fwrite($post_write,  "$result\n$_SERVER[REMOTE_ADDR]``$date\n$message<br><br>[attachment]".$realfilename."[/attachment] \n");
} else {
fwrite($post_write,  "$result\n$_SERVER[REMOTE_ADDR]``$date\n$message<br><br>[b]Attachment:[/b]<br>[img]uploads/".$realfilename."[/img] \n");
}

fclose($post_write);


$ulog= fopen("upload_log.php", "a");
fwrite($ulog,  "$realfilename``$_SERVER[REMOTE_ADDR]``$result``$topicid``$date``$thedividedsize kb\n");

} 


}

if (strlen($_POST['message']) == 0) { 
error("No message was typed");
}



if ($sticky == "sticky/") {
@fopen("./forumposts_{$forum}/sticky/tmp.txt", "a");
@unlink("./forumposts_{$forum}/sticky/tmp.txt");
}



// Add to their postcount
if ($increase_postcount != No) {
$newpostcount=$postcount+1;
$postcountupdate ="<?php\n\$email = '$email';\n\$skinchoice = '$skinchoice';\n\$yourpassword = '$yourpassword';\n\$status = '$status';\n\$avatar = '$avatar';\n\$sig = '$sig';\n\$title = '$title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = '$notepad';\n\$birthday = '$birthday';\n\$postcount = '$newpostcount';\n?>";
$fp = fopen("./accounts/{$cookies}_user.php","w+");
fwrite($fp, $postcountupdate);
fclose($fp);
}

//
// Add to the forum total postcount
//


$TxtFileCount = file("./postcounts/{$forum}.txt");
eraseandreplace("./postcounts/{$forum}.txt", 1, $TxtFileCount[1]+1); 

$q=fopen("./forumposts_{$forum}/f.txt","a");
fclose($q);

unlink("./forumposts_{$forum}/f.txt");

if ($sticky == "old/") {
rename("./forumposts_{$forum}/old/{$topicid}.php", "./forumposts_{$forum}/{$topicid}.php");

}


?>


<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Successful Reply</td><tr>
<td class=arcade1 valign="top"><div align=center>Your reply was submitted successfully.
<?php
echo "<br><br>[ <a href='topicdisplay.php?forum=$forum'><u>Return to forums</u></a> | <a href='viewtopic.php?topicid=$topicid'><u>Return to Topic</u></a> ]<br>";
?>
</div>
 </td>
</table>
</div>
<br>
<?php
require("footer.php");
?>