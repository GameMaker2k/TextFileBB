<?php
require("header.php");
require("./permissions/{$forum}.php");

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
// Module: edit_post.php - Last update: April 1, 2006
// ----------------------------------------------------------------------------------------
//
// Santized and Dereglobed: OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

require("forum_conf.php");
require("stopper.php");
require("clean_message.php");

if(!is_numeric($_GET['topic'])) error("Invalid topic ID");
$topic=$_GET['topic'];
$line=$_GET['line'];

if($status != "Admin") {

	if(file_exists("./locked/{$forum}_{$topic}.lock")) {
	error("This topic has been locked. Sorry, you cannot edit this post.");
	}

}

require("./groups/{$status}.php");

if ($can_edit_own_posts == No) {
error("Your group does not allow you to edit your posts.");
}


// Does it exist?

if(file_exists("./forumposts_{$forum}/{$topic}.php")) {

$sticky = "";

} elseif (file_exists("./forumposts_{$forum}/sticky/{$topic}.php")) {

$sticky = "sticky/";

} else {

$sticky = "old/";

}

// Check with a line thing

	$line = $line-1;


$names_array = file("forumposts_{$forum}/{$sticky}{$topic}.php");
$trimawaythename = rtrim($names_array[$line-1]);
$register_id = file("./id_data/member_names_num.txt");

$result = array_search_ci($register_id, "$acfile");
if ($result != "") {
$get = $register_id[$result];
} else {
?>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Editing a post</td><tr>

<td class=arcade1 valign="top"><div align=center>You are logged in as a guest. Guests may not edit posts. If you are the creator of this post please login to edit it.</div>
 </td>
</table>
</div>
<br>
<?php
require("footer.php");
die();
}
$idnumber = strtolower(rtrim($get));
$lowercase = strtolower($idnumber);

if ($can_use_modcp == Yes) {

} else {

if ($result != $trimawaythename) {

?>
<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Error</td><tr>

<td class=arcade1 valign="top"><div align=center>
<?php
echo "$idnumber, you did not write this post, so you may not edit it.";
?>
</div>
 </td>
</table>
</div>
<br>


<?php
require("footer.php");
die();
}
}

$cookies2 = $_COOKIE['storedcookie_textfileBB_pword'];
require("./accounts/{$lowercase}_user.php"); 
if ($yourpassword == $cookies2) {

// Editing?

	if ($_POST['doh']) {

if($_GET['line'] == "5") {
if($_POST['topicname']=="") error("No topic name entered");
}

$message=stripslashes($message);
require("clean_message.php");

$file=file("./forumposts_{$forum}/{$sticky}{$topic}.php");
if ($message) {
$file=file("./forumposts_{$forum}/{$sticky}{$topic}.php");
if ($message != $file[$line+1]) { 
$dateedit =date("jS F Y - h:i A");

// Look for an attachment
//
//
//

$uload_write='';

if($_FILES['swforpic']['name']) {

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
$uload_write="<br><br>[attachment]".$realfilename."[/attachment]";
} else {
$uload_write="<br><br>[b]Attachment:[/b]<br>[img]uploads/".$realfilename."[/img]";
}


$ulog= fopen("upload_log.php", "a");
fwrite($ulog,  "$realfilename``$_SERVER[REMOTE_ADDR]``$result``$topicid``$date``$thedividedsize kb\n");

}

// End looking
// >_><_<

if ($_POST['removeeditby']) {

require("./groups/{$status}.php");
if ($can_remove_edit_by == Yes) {
$file[$line+1]="$message $uload_write \n"; 
}

} else {
$file[$line+1]="$message $uload_write <br><br>[i] This post was edited by $acfile on $dateedit [/i] \n"; 
}

} 
$file3 = fopen("./forumposts_{$forum}/{$sticky}{$topic}.php", "w+"); 
foreach($file as $v){
fwrite($file3,"$v");
}
fclose($file3);
}


// Edit topic title, and desc


require("./groups/{$status}.php");

if ($can_edit_desc_and_title == Yes) {

if ($_GET['line'] == 5) { // start if
require("clean_message.php");

// edit topic title
$file=file("./forumposts_{$forum}/{$sticky}{$topic}.php");
if ($message) {
$file=file("./forumposts_{$forum}/{$sticky}{$topic}.php");
if ($topicname != $file[0]) { 
$file[0]="$topicname \n"; 
} 
$file3 = fopen("./forumposts_{$forum}/{$sticky}{$topic}.php", "w+"); 
foreach($file as $v){
fwrite($file3,"$v");
}
fclose($file3);
}


$file=file("./forumposts_{$forum}/{$sticky}{$topic}.php");
if ($message) {
$file=file("./forumposts_{$forum}/{$sticky}{$topic}.php");
if ($topictitle != $file[1]) { 
$file[1]="$topicdesc \n"; 
} 
$file3 = fopen("./forumposts_{$forum}/{$sticky}{$topic}.php", "w+"); 
foreach($file as $v){
fwrite($file3,"$v");
}
fclose($file3);
}


} // end if
}


?>

<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Edit Complete</td><tr>

<td class=arcade1 valign="top"><div align=center>Edit successful: <?php echo "<a href='topicdisplay.php?forum=$forum&show=$showtopics'>Back to the forum</a>"; ?></div>
 </td>
</table>
</div>
<br>

<?php
}

}
?>

<br>


<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href='topicdisplay.php?forum=<?php echo "$forum"; ?>'><?php if ($forum) { echo "$forum"; } ?></a> &#187; Editing a post.</td></table></div>

<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Editing a post</td><tr>
<td class=arcade1 valign="top"><div align=center><form action='' method=post enctype="multipart/form-data" name="postbox">

<?php
$file=file("./forumposts_{$forum}/{$sticky}{$topic}.php");
$get_info = $_GET['line'];
require("./groups/{$status}.php");

if ($can_edit_desc_and_title == Yes) {
if ($get_info  == 5) {
$title=$file[$get_info-5];
$desc = $file[$get_info-4];
echo "Topic Title: <input type=text name=topicname value='$title'><br>";
echo "Topic Description: <input type=text name=topicdesc value='$desc'>";
}

}
?>

<?php
echo "<br>";
displaybbcode();
?>

<?php 
$edit = $file[$line+1];
$edit = eregi_replace("<br>", "\n", $edit);
?>

<br><textarea cols=60 rows=20 class=input name=message><?php echo "$edit"; ?></textarea><br><br>
<?php
displayemotes();

require("./groups/{$status}.php");
if ($can_remove_edit_by == Yes) {
echo "<br><br>Don't include 'Edited By' line? <input type=checkbox name=removeeditby value='cya' checked='checked'>";
 }

if ($uploads_enabled == "yes") {
require("./permissions/{$forum}.php");
if ($can_upload["$status"] == allowed) {
echo '<br /><br />Attach File: <input type="file" name="swforpic"> <br /><br>';
}
}

?>

<br><br><br><input type=submit value='Edit Your Post' name='doh'></div>
 </td>
</table>
</div>
<br><br>
<?php
require("footer.php");
?>