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
// Module: new_topic.php - Last update: March 31, 2006
// ----------------------------------------------------------------------------------------
// Santized and Dereglobed: OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

require("header.php");
require("stopper.php");

if(file_exists("./permissions/{$forum}.php")) {
require("./permissions/{$forum}.php");
} else {
error("Invalid Forum ID");
}

if ($can_start["$status"] != allowed) {
error("You do not have permission to start new topics");
}

require("./groups/{$status}.php");


require("clean_message.php");

if ($_POST) {


	$register_id = file("./id_data/member_names_num.txt");
	$result = array_search_ci($register_id, $acfile);
	$get = $register_id[$result];
	$date = date("m.d.y");

	if ($result != "") { } else {
	error("Error.");
	}

if ($_POST['message'] == "") { 
error("No Message was typed!");
}

if ($_POST['topicname'] == "") { 
error("No title given to topic!");
}

	if ($status == "Guest") {
	require("./accounts/guest_user.php"); 
	}

	// Get the permissions file...
      require("./permissions/{$forum}.php");

	if ($can_read["$status"] != allowed) {
	error("You do not have permission to read");
	}

	if ($can_start["$status"] != allowed) {
	error("You do not have permission to start new topics");
	}


	if ($allow_posting == 'No') {
	error("This forum is read only, no posts may be made.");
	}
 

	// Different things need to be fwritten and even checked for

$g = "./id_data/topic_id_num.txt";  
$id_file = file($g);
$latest_id_num = $id_file[0];



	if (!$_FILES['swforpic']['name']) { // No attachment

	$post_write = fopen("./forumposts_{$forum}/{$latest_id_num}.php", "a");

	fwrite($post_write,  "$topicname\n$topicdesc\n<?php die(); ?>\n$result\n$_SERVER[REMOTE_ADDR]``$date\n$message\n");


	} else { 


	$swforpic=htmlspecialchars($_POST['swforpic'],ENT_QUOTES);

	if ($can_upload["$status"] != allowed) {
	error("You do not have permission to attach files");
}

$folder = "./uploads/";
$temporary = $_FILES['swforpic']['tmp_name'];
$realfilename = $_FILES['swforpic']['name'];

$temporary=str_replace(" ", "_", $temporary);
$realfilename=str_replace(" ", "_", $realfilename);

$extension=uploaderprotect($realfilename);

//
// Check the filesize, as defined in forum_conf.php
//

require("forum_conf.php");

require("./groups/{$status}.php");

if ($_FILES['swforpic']['size'] > $group_max_upload_size) {
@unlink($_FILES['swforpic']['tmp_name']);
error("File <b>failed to upload.</b> It is too large to be attached. ");
}

//
// Check to see if a file with the exact same name exists
//


if(file_exists("./uploads/$realfilename")) {

echo "<div align='center'><div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Attachment</td><tr><td class=arcade1 valign='top'><div align=center>File $realfilename <b>failed to upload.</b> This is because a file with the same name as this one has already been uploaded. Please rename the file to a different name ( ex: pic.gif rename to pic1.gif ) </div></td></table></div><br>";

echo "<br>";
require("footer.php");
die();

}


//
// Copy if there are no problems...
//

move_uploaded_file($temporary, $folder.$realfilename) or die("Problem writing the Attachment. Please contact the admin. ");

echo "<div align='center'><div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Attachment</td><tr><td class=arcade1 valign='top'><div align=center>File attached.</div></td></table></div><br><tr><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td></tr>";


$filename = "./uploads/$realfilename";
$thesize = filesize($filename);
$thedividedsize = round($thesize / 1024 ,2);

	$post_write = fopen("./forumposts_{$forum}/{$latest_id_num}.php", "a");


if($extension != "gif" && $extension !="jpg" && $extension != "bmp" && $extension != "jpeg" && $extension != "png") {

fwrite($post_write,  "$topicname\n$topicdesc\n<?php die(); ?>\n$result\n$_SERVER[REMOTE_ADDR]``$date\n$message<br><br>[attachment]".$realfilename."[/attachment] \n");


} else {

fwrite($post_write,  "$topicname\n$topicdesc\n<?php die(); ?>\n$result\n$_SERVER[REMOTE_ADDR]``$date\n$message<br><br>[b]Attachment:[/b]<br>[img]uploads/".$realfilename."[/img] \n");

}


$ulog= fopen("upload_log.php", "a");
fwrite($ulog,  "$realfilename``$_SERVER[REMOTE_ADDR]``$result``$latest_id_num``$date``$thedividedsize kb\n");



	}




if ($increase_postcount != No) {

$newpostcount=$postcount+1;
$postcountupdate ="<?php\n\$email = '$email';\n\$skinchoice = '$skinchoice';\n\$yourpassword = '$yourpassword';\n\$status = '$status';\n\$avatar = '$avatar';\n\$sig = '$sig';\n\$title = '$title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = '$notepad';\n\$birthday = '$birthday';\n\$postcount = '$newpostcount';\n?>";
$fp = fopen("./accounts/{$acfile}_user.php","w+");
fwrite($fp, $postcountupdate);
fclose($fp);

}


$add1 = $latest_id_num+1;
$quickwrite=fopen("$g", "w");
fwrite($quickwrite,  "$add1" );
$quickwrite2=fopen("./id_data/topic_view_count.txt", "a");
fwrite($quickwrite2,  "\n0" );

$countstuff = opendir("./forumposts_{$forum}/"); 
$total_forums = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..' && $file != 'sticky' ){ 
      $total_forums++; 
   } 
} 
closedir($countstuff); 


if ($showtopics > $total_forums ) {

$show = "$total_forums";

} else { 

$show = "$showtopics";

}

$TxtFileCount = file("./postcounts/{$forum}.txt");
eraseandreplace("./postcounts/{$forum}.txt", 0, $TxtFileCount[0]+1); 

// Put the whole board into an array
$wholeforumarray = getarrayby_arsort("./forumposts_{$forum}/");

// Count...
$number_of_threads_in_forum = count($wholeforumarray);

if ($number_of_threads_in_forum > 50) { // if it's greater than 50... maybe this can be upped in the future or something. but whatever, i dont want slowness.
$last_topic = $wholeforumarray[$number_of_threads_in_forum-1];

rename("./forumposts_{$forum}/$last_topic", "./forumposts_{$forum}/old/$last_topic"); //bump it

}

?>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Topic Created</td><tr>

<td class=arcade1 valign="top"><div align=center>Your topic was submitted successfully. <a href='topicdisplay.php?forum=<?php echo "$forum"; ?>&show=<?php echo "$show"; ?>'>Click Here</a></div>
 </td>
</table>
</div>



<?php
}
?>
<br>


<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href='topicdisplay.php?forum=<?php echo "$forum"; ?>&show=<?php echo "$showtopics"; ?>'><?php if ($forum) { echo "$forum"; } ?></a> &#187; Creating New Topic</td></table></div>
<br>

<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>New Topic</td><tr>

<td class=arcade1 valign="top"><div align=center><form action='' method=post enctype="multipart/form-data" name="postbox">
<br>Topic Title: <input type=text name=topicname value='' maxlength="80"><br><br>Topic Description: <input type=text name=topicdesc value='' maxlength="120"><br><br>

<?php
displaybbcode();
?>

<br><textarea cols=60 rows=20 class=input name=message></textarea><br><br>
<?php
displayemotes();
?>
<br>
<br>
<br><?php
require("forum_conf.php");
if ($uploads_enabled == "yes") {
	if ($can_upload["$status"] == allowed) {
echo 'Attach File: <input type="file" name="swforpic"> <br /><br>';
}
}
?><br><br><input type='submit' value='New Topic'></div>
 </td>
</table>
</div>
<br><br>
</form>
<?php
require("footer.php");
?>