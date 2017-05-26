<?php
require("header.php");

// Defined
$cparea=$_GET['cparea'];

// Seans reglob thing
if (is_array($_GET)) { 

foreach($_GET as $k=>$v) $$k=$v;
$$k=str_replace("..", "", $$k);
$$k=str_replace("'", "", $$k);
$$k=str_replace('"', "", $$k);



}

if (is_array($_POST)) foreach($_POST as $k=>$v) {

$$k=$v;
$$k=str_replace("..", "", $$k);
$$k=str_replace("'", "", $$k);
$$k=str_replace('"', "", $$k);
}

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
// Module: admincp.php - Last update: Sept 28, 2006
// ----------------------------------------------------------------------------------------
//
//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

function addfsetting($question, $desc, $inconf_var, $name, $t) {

require("./permissions/{$t}.php");

echo "<tr><td class='arcade1'><b>$question</b><br>$desc</td><td class='arcade1'>";
echo "<select size='1' name='$name'>";
if ($inconf_var == "No") {
echo "<option value='No' selected>No</option>";
echo "<option value=Yes>Yes</option>";
} else {
echo "<option value=Yes selected>Yes</option>";
echo "<option value=No>No</option>";
}

echo "<br></td></tr>";

}


function addsetting($question, $desc, $inconf_var, $name, $t) {

require("./groups/{$t}.php");

echo "<tr><td class='arcade1'><b>$question</b><br>$desc</td><td class='arcade1'>";

echo "<select size='1' name='$name'>";

if ($inconf_var == "No") {
echo "<option value='No' selected>No</option>";
echo "<option value=Yes>Yes</option>";
} else {
echo "<option value=Yes selected>Yes</option>";
echo "<option value=No>No</option>";
}

echo "<br></td></tr>";

}

$can_use_acp == "No";

require("stopper.php");
require("./groups/$status.php");
if ($can_use_acp == Yes) {

// ...

if ($onoffSett) {

$settings = "<?php\n\$forum_offline = '$onoffSett';\n\$uploads_enabled = '$uploads_enabledSett';\n\$use_validation = '$use_validationSett';\n\$showtopics = '$showtopicsSett';\n\$inboxlimit = '$inboxlimitSett';\n\$forum_name = '$forum_nameSett';\n\$intopiclim = '$intopiclim_sett';\n\$password_recovery_allowed = '$pwordrec_sett';\n\$search_allowed ='$search_sett';\n\$email_members_allowed = '$email_mem_set';\n\$avsize='$av_Sett';\n\$thumbnailsize='$thumb_Sett';\n\$siglength='$sig_Sett';\n\$avatar_remote_allowed='$avatar_remote_sett';\n\$avatar_upload_allowed='$avatar_upload_sett';\n\$avmax_size='$avmax_Sett';\n?>";

$fp = fopen("forum_conf.php","w+");
fwrite($fp, $settings);
fclose($fp);
}

require("forum_conf.php");

echo "<title>$forum_name - Admin CP</title>";
?>

<?php if ($cparea == idx) { ?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> » Admin CP</td></table></div><br>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Forum Control</font></b></td></tr><td class=arcade1>Manage, reorder, add, delete forums and categories. <br><br>[ <a href=admincp.php?cparea=boards>Manage</a> ]</div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Banned IP addresses</font></b></td></tr><td class=arcade1>Banned IP address list <br><br>[ <a href=admincp.php?cparea=bannedIPlist>Manage</a> ]</div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Member Editor</font></b></td></tr><td class=arcade1>Edit members sig, password, avatar, and profile info, erase members... Also get IP address on date of registration, and other information. <br><br>[ <a href=admincp.php?cparea=members>Manage</a> ] [ <a href=admincp.php?cparea=membersv>Validating Users</a> ]  [ <a href=admincp.php?cparea=groups>Group Settings</a> ] </div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Filters</font></b></td></tr><td class=arcade1>Add to current word filter list.  <br><br>[ <a href=admincp.php?cparea=filter>Manage</a> ]</div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Skin Control</font></b></td></tr><td class=arcade1>Create new skin files, edit, delete. <br><br>[ <a href=admincp.php?cparea=skin>Manage</a> ]</div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Board Wrappers</font></b></td></tr><td class=arcade1>Edit your site's footer, header, and wrappers. <br><br>[ <a href=admincp.php?cparea=wrappers>Manage</a> ]</div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Settings</font></b></td></tr><td class=arcade1>Edit your site's settings. Enable validation, enable uploads, search etc <br><br>[ <a href=admincp.php?cparea=settings>Manage</a> ]</div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Emoticons</font></b></td></tr><td class=arcade1>Add smilies to your forums. To make the smiley images appear in the dropdown, upload them to the emoticons folder.<br><br>[ <a href=admincp.php?cparea=emotes>Manage</a> ]</div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Attachment Logs & Manager</font></b></td></tr><td class=arcade1>Manage attached files on your forums - find who uploaded what, where, and at what time.<br><br>[ <a href=admincp.php?cparea=attachments>Manage</a> ]</div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>IP Scan</font></b></td></tr><td class=arcade1>Gain information about a member ip.<br><br>[ <a href=admincp.php?cparea=IPscan>Manage</a> ]</div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Post Office</font></b></td></tr><td class=arcade1>Send an email to all members. Note: requires hosting to have the mail(); feature on.<br><br>[ <a href='admincp.php?cparea=Email'>Manage</a> ]</div></td></table></div>
<br />

<?php } ?>

<?php 
	

if ($newcatname) {

rename("./addedforums/{$cat}/", "./addedforums/{$newcatname}/");


//=====

$Forumlist = getarrayby_arsort("./addedforums/");

//=====

for ($x=0; $x<count($Forumlist); $x++) 
{

$trim_f = rtrim($Forumlist[$x]);


unlink("./addedforums/{$trim_f}/modify.txt");
$maketxtfile = fopen("./addedforums/{$trim_f}/modify.txt", "w+");
fwrite($maketxtfile,  "w00t" );

}



error("Your category rename is complete. <a href=admincp.php?cparea=idx>Return to ACP index</a>");


}


if ($renamecat) {
?>

<form action='' method='POST'>
<div align='center'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>New Category name?</td><tr><td class=arcade1><div align=center><input type=text name=newcatname value='<?php echo "$renamecat"; ?>'><input type=submit name=Nothing value='Rename'></div> </td></tr></table></div><br>
</form>


<?php
}


if ($cparea == IPscan) { ?>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> » <a href=admincp.php?cparea=idx>Admin CP</a> &#187; IP Scanner </td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>IP Scan</font></b></td></tr><td class=arcade1>

<?php
if ($serv) {
echo "IP Scan on ( <b>$serv</b> )<br><br>";echo "Scanning...<br><br>";
$host = @gethostbyaddr($serv);
echo "Scanned IP Host Information: <b>$host</b><br><br>";
echo "<form action=http://ws.arin.net/cgi-bin/whois.pl method=post><input type=hidden size=33 maxlength=55 name=queryinput value='$serv'><br><input type=submit value='WHOIS'></form>";
}

?>

<form action='' method='GET'><input type=hidden name=cparea value=IPscan><input type=text name=serv><input type=submit value=Scan></form>
<br></div></td></table></div>
<br>
<?php } ?>

<?php
if ($cparea == groups) {

	if ($erasegroup) {
unlink("./groups/{$erasegroup}.php");
error("Group Removed. <a href='admincp.php?cparea=groups'>Click here</a>.");
}

?>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; Groups</td></table></div><br>

<div align='center'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>ROOT system Groups</td><tr>

 <tr><td class="arcade1"><b><A href='?cparea=group_edit&g=Admin'>Admin</a></b> | <a href='admincp.php?cparea=members&showonly=Admin'>Show Members</a><br></td></tr><tr><td class="arcade1"><b><A href='?cparea=group_edit&g=Moderator'>Moderator</a></b> | <a href='admincp.php?cparea=members&showonly=Moderator'>Show Members</a> <br></td></tr><tr><td class="arcade1"><b><A href='?cparea=group_edit&g=Member'>Member</a></b> | <a href='admincp.php?cparea=members&showonly=Member'>Show Members</a> <br></td></tr><tr><td class="arcade1"><b><A href='?cparea=group_edit&g=Guest'>Guest</a></b> | <a href='admincp.php?cparea=members&showonly=Guest'>Show Members</a> <br></td></tr><tr><td class="arcade1"><b><A href='?cparea=group_edit&g=Validating'>Validating</a></b> | <a href='admincp.php?cparea=members&showonly=Validating'>Show Members</a> <br></td></tr><tr><td class="arcade1"><b><A href='?cparea=group_edit&g=Banned'>Banned</a></b>|  <a href='admincp.php?cparea=members&showonly=Banned'>Show Members</a> <br></td></tr>

</div>
 </td>
</table>
</div>
<br>
<div align='center'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Available Groups Added By You</td><td width=60% align=center class=headertableblock>Show Users</td><td width=60% align=center class=headertableblock>Delete</td><tr>



<?php

	if ($nGroup) {

if(preg_match("@[\W]@i", $_POST["nGroup"])) {
	error("Your Group Name had Invalid Characters");
}

if (file_exists("./groups/{$addedgroupname}.php")) {
	error("Sorry, a group with that name exists already. Please choose a new name");
}

// add the file...
$addedgroupname = str_replace(" ", "-", $addedgroupname);

$fp = fopen("./groups/{$addedgroupname}.php","w+");
$m = file_get_contents("./groups/{$inhertfrom}.php"); // Number of times I spelled "Inherit" wrong in this file: 5 XD
fwrite($fp, $m);


if ($handle = opendir('./permissions/')) {
   while (false !== ($file = readdir($handle))) { 
       if ($file != "." && $file != "..") {

$fp = fopen("./permissions/{$file}","a");
$p ="\n<?php\n\$can_upload['$addedgroupname'] = '';\n\$can_read['$addedgroupname'] = '';\n\$can_reply['$addedgroupname'] = '';\n\$can_start['$addedgroupname'] = '';\n?>";
fwrite($fp, $p);


       } 
   }
   closedir($handle); 
}


	}
// yes this has been stolen from the other part.

 $folder = "./groups/";

  $handle_a = opendir($folder);

  while ( $topic_y = readdir($handle_a ))

   {

     if( $topic_y == '.' || $topic_y == '..' || $topic_y == 'Admin.php' || $topic_y == 'Moderator.php' || $topic_y == 'Guest.php' || $topic_y == 'Banned.php' || $topic_y == 'icons' || $topic_y == 'icons' || $topic_y == 'Member.php' || $topic_y == 'Validating.php')
     
     continue;
      
     $forumtopiclist_h [$topic_y] = filemtime($folder."/".$topic_y);

     }

// use arsort

  @arsort($forumtopiclist_h);

  while(list($t44)=@each($forumtopiclist_h))

  {

$nameofgroup = explode(".", $t44);
echo "<tr><td class='arcade1'><b><A href='?cparea=group_edit&g=$nameofgroup[0]'>$nameofgroup[0]</a></b><br></td><td class='arcade1'><a href='admincp.php?cparea=members&showonly=$nameofgroup[0]'>Show Members</a></td><td class='arcade1'> <a href='?cparea=groups&erasegroup=$nameofgroup[0]'>Delete</a></td></tr>";

}

?>

</div>
 </td>
</table>
</div>
<br>

<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Add a New Group</font></b></td></tr><td width=50%% align=center class=arcade1><font size=-5>Group Name & Inherit Settings:</font></td><td width=10% align=center class=arcade1><font size=-5>Action</font></td></div><tr><td class=arcade1> <form method=post action="?cparea=groups"><div align=center>

Inherit Setings from which group?: <select size="1" name="inhertfrom">
<option value='Admin' selected>Admin</option>
<option value='Moderator'>Moderator</option>
<option value='Member'>Member</option>
<option value='Guest'>Guest</option>
<option value='Banned'>Banned</option>
<option value='Validating'>Validating</option>
</select>  Group Name:<input type=text name=addedgroupname></center> </div></td><td class=arcade1><div align=center><input type='submit' value='Add' name='nGroup'></div></td></table></div></form>


<?php
}
?>

<?php

if ($cparea == macros) {
?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; <a href=admincp.php?cparea=skin>Select Skin to Edit</a> &#187; Editing Skin Macros</td></table></div>
<br>
<?php
echo "<form action='' method='POST'>";

$skin_name = explode(".css", $skin);


if ($macro_update) {

$fp = fopen("./skins/{$skin_name[0]}_img/macros.php","w+");
$permissions_Settings ="<?php\n\$logo = '$o1';\n\$redirect_marker = '$o2';\n\$www_img = '$o3';\n\$email_img = '$o4';\n\$msn_img = '$o5';\n\$aim_img = '$o6';\n\$yim_img = '$o7';\n\$icq_img = '$o8';\n\$quote_img = '$o9';\n\$delete_img = '$o10';\n\$edit_img = '$o11';\n\$newtopic = '$o12';\n\$normal_topic = '$o13';\n\$hot_topic = '$o14';\n\$normal_marker = '$o15';\n\$read_only_marker = '$o16';\n\$online_marker = '$o17';\n\$stats_marker = '$o18';\n\$birthday_marker = '$o19';\n\$locked_topic = '$o20';\n\$add_reply = '$oreply';\n\$new_posts_topicindex='$o21';\n\$new_posts_forum_index='$o22';\n?>";
fwrite($fp, $permissions_Settings);
fclose($fp);

}

function addmacro($variable, $skinset, $title, $var) {
require("./skins/{$skinset}_img/macros.php");
echo "<div align='center'><div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>$title</td><tr><td class=arcade1 valign=top><div align=center><textarea rows=3 cols=40 name=$var>$variable</textarea></div></td></table></div><br>";
}

require("./skins/{$skin_name[0]}_img/macros.php");

addmacro($logo, "$skin_name[0]", "Logo", "o1");
addmacro($redirect_marker, "$skin_name[0]", "Redirect Marker", "o2");
addmacro($www_img, "$skin_name[0]", "WWW image", "o3");
addmacro($email_img, "$skin_name[0]", "Email image", "o4");
addmacro($msn_img, "$skin_name[0]", "MSN image", "o5");
addmacro($aim_img, "$skin_name[0]", "AIM image", "o6");
addmacro($yim_img, "$skin_name[0]", "YIM image", "o7");
addmacro($icq_img, "$skin_name[0]", "ICQ image", "o8");
addmacro($quote_img, "$skin_name[0]", "Quote image", "o9");
addmacro($delete_img, "$skin_name[0]", "Delete image", "o10");
addmacro($edit_img, "$skin_name[0]", "Edit image", "o11");
addmacro($newtopic, "$skin_name[0]", "New Topic image", "o12");
addmacro($add_reply, "$skin_name[0]", "Add Reply image", "oreply");
addmacro($normal_topic, "$skin_name[0]", "Topic Marker", "o13");
addmacro($hot_topic, "$skin_name[0]", "Hot Topic Marker", "o14");
addmacro($normal_marker, "$skin_name[0]", "Forum Marker", "o15");
addmacro($read_only_marker, "$skin_name[0]", "Read Only Forum Marker", "o16");
addmacro($online_marker, "$skin_name[0]", "Online List Marker", "o17");
addmacro($stats_marker, "$skin_name[0]", "Stats Marker", "o18");
addmacro($birthday_marker, "$skin_name[0]", "Birthdays Marker", "o19");
addmacro($locked_topic, "$skin_name[0]", "Locked Topic Marker", "o20");
addmacro($new_posts_topicindex, "$skin_name[0]", "New Posts Image (Topic Index)", "o21");
addmacro($new_posts_forum_index, "$skin_name[0]", "New Posts Image (Forum Index)", "o22");


echo "<div align=center><input type='submit' name='macro_update' value='Update Macro Set'></div></form>";

}


if ($cparea == group_edit) {

if ($doupdateofgroups) {
$fp = fopen("./groups/{$g}.php","w+");


$permissions_Settings ="<?php\n\$view_board = '$o1';\n\$view_offline_board = '$o2';\n\$can_email = '$o4';\n\$can_pm = '$o5';\n\$can_create_new_topics = '$o6';\n\$can_reply_to_own_topic = '$o7';\n\$can_reply_to_others_topics = '$o8';\n\$can_edit_own_posts = '$o8t';\n\$can_remove_edit_by = '$o9';\n\$can_edit_profile = '$o12';\n\$group_icon = '$icon';\n\$online_prefix = '$prefix';\n\$online_suffix = '$suffix';\n\$group_max_upload_size = '$mxsize';\n\$can_edit_desc_and_title = '$ol3';\n\$can_use_acp = '$useacp';\n\$can_use_modcp = '$usemcp';\n?>";


fwrite($fp, $permissions_Settings);
fclose($fp);

}

require("./groups/{$g}.php");

?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; <a href=admincp.php?cparea=groups>Groups</a> &#187; Editing Group <?php echo $g; ?></td></table></div>
<br>
<div align='center'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Settings</td><td width=60% align=center class=headertableblock>Current setting</td><tr>



<form action='' method='POST'>

<?php
addsetting("Can view forum?", "", "$view_board", "o1", "$g");
addsetting("Can view OFFLINE forum?", "", "$view_offline_board", "o2", "$g");
addsetting("Can email others through the forum?", "", "$can_email", "o4", "$g");
addsetting("Can use inbox?", "", "$can_pm", "o5", "$g");
addsetting("Can create new topics?", "", "$can_create_new_topics", "o6", "$g");
addsetting("Can reply to own topics?", "", "$can_reply_to_own_topic", "o7", "$g");
addsetting("Can reply to OTHER peoples' topics?", "", "$can_reply_to_others_topics", "o8", "$g");
addsetting("Can edit own posts?", "", "$can_edit_own_posts", "o8t", "$g");
addsetting("Can remove 'edit by' line?", "", "$can_remove_edit_by", "o9", "$g");
addsetting("Can edit their profile?", "", "$can_edit_profile", "o12", "$g");
addsetting("Can edit their topic title and description?", "", "$can_edit_desc_and_title", "ol3", "$g");
addsetting("Can <u>Use <i>ADMIN</i> CP</u>?", "", "$can_use_acp", "useacp", "$g");
addsetting("Can <u>Use <i>MODERATOR</i> CP</u>?", "", "$can_use_modcp", "usemcp", "$g");


// settings manual

require("./groups/{$g}.php");
echo "<tr><td class='arcade1'><b>Group Icon?</b><br></td><td class='arcade1'>";

echo '<select size="1" name="icon">';
echo "<option value='$group_icon' selected>Current: ($group_icon)</option>";
echo "<br><br><br>";
 $s = "./groups/icons/";

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

     echo "<option value='$t'>$t</option>";
  }
echo "</select><br>";

echo "<br></td></tr>";

echo "<tr><td class='arcade1'><b>Online list HTML prefix?</b><br></td><td class='arcade1'><input type=text name=prefix value='$online_prefix'>";
echo "<br></td></tr>";
echo "<tr><td class='arcade1'><b>Online list HTML suffix?</b><br></td><td class='arcade1'><input type=text name=suffix value='$online_suffix'>";
echo "<br></td></tr>";
echo "<tr><td class='arcade1'><b>Max attachment size in BYTES?</b><br></td><td class='arcade1'><input type=text name=mxsize value='$group_max_upload_size'>";
echo "<br></td></tr>";



?>
</div>
 </td>
<tr><td class=headertableblock colspan=2><div align=center><input type='Submit' name='doupdateofgroups' value='Update Groups Settings'></div></td></tr>
</form>
</table>
</div>
<br>


<?php
}
?>



<?php if ($cparea == settings) { ?>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; Settings</td></table></div>
<br>

<form action='?cparea=settings' method=POST>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Forum Name</font></b></td></tr><td class=arcade1>Forum name as it will appear on the whole forum and in the page title??<br><br><div align=center><input type='text' name='forum_nameSett' value='<?php echo "$forum_name"; ?>'></div></div></td></table></div>
<br>

<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Use Validation?</font></b></td></tr><td class=arcade1><div align=center>Validate all new users manually? If you are being attacked by someone you may want to enable this.</div><br><br><div align=center><select size="1" name="use_validationSett">';
<div align=center><option value=<?php echo "$use_validation"; ?> selected>Validation: (<?php echo "$use_validation"; ?>)</option>
<option value=On>On</option>
<option value=Off>Off</option>
</select></div></div></div></td></table></div>
<br>

<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Forum Offline?</font></b></td></tr><td class=arcade1><div align=center>Forum is offline?</div><br><br><div align=center><select size="1" name="onoffSett">';
<div align=center><option value=<?php echo "$forum_offline"; ?> selected>(<?php echo "$forum_offline"; ?>)</option>
<option value=yes>Yes</option>
<option value=no>No</option>
</select></div></div></div></td></table></div>
<br>

<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Allow use of search?</font></b></td></tr><td class=arcade1><div align=center>Forum search, allow it?</div><br><br><div align=center><select size="1" name="search_sett">';
<div align=center><option value=<?php echo "$search_allowed"; ?> selected>(<?php echo "$search_allowed"; ?>)</option>
<option value=Yes>Yes</option>
<option value=No>No</option>
</select></div></div></div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Password Recovery?</font></b></td></tr><td class=arcade1><div align=center>Allow password recovery?</div><br><br><div align=center><select size="1" name="pwordrec_sett">
<div align=center><option value=<?php echo "$password_recovery_allowed"; ?> selected>(<?php echo "$password_recovery_allowed"; ?>)</option>
<option value=Yes>Yes</option>
<option value=No>No</option>
</select></div></div></div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Forum Attachments?</font></b></td></tr><td class=arcade1><div align=center>Allow attachments?</div><br><div align=center><select size="1" name="uploads_enabledSett">';
<div align=center><option value=<?php echo "$uploads_enabled"; ?> selected>(<?php echo "$uploads_enabled"; ?>)</option>
<option value=yes>Yes</option>
<option value=no>No</option>
</select></div></div></div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Topic display?</font></b></td></tr><td class=arcade1><div align=center>
<div align=center>Number of TOPICS to show on the FORUM display?: <br><br><input type=text name=showtopicsSett value='<?php echo "$showtopics"; ?>'></div><br>

<div align=center>Number of POSTS to show in a TOPIC?: <br><br><input type=text name=intopiclim_sett value='<?php echo "$intopiclim"; ?>'></div>


</div></div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Avatar Permissions.</font></b></td></tr><td class=arcade1><div align=center>
<br />
Allow uploaded avatars?<br /><br />
<select size="1" name="avatar_upload_sett">
<option value=<?php echo "$avatar_upload_allowed"; ?> selected>(<?php echo "$avatar_upload_allowed"; ?>)</option>
<option value=Yes>Yes</option>
<option value=No>No</option>
</select>
<br /><br /><br />

Allow remote hosted avatars?<br /><br />
<select size="1" name="avatar_remote_sett">
<option value=<?php echo "$avatar_remote_allowed"; ?> selected>(<?php echo "$avatar_remote_allowed"; ?>)</option>
<option value=Yes>Yes</option>
<option value=No>No</option>
</select>
<br /><br />
Input dimensions below. Example: 150x150. Leave blank to take off dimension restriction.</div><br><div align=center>
<div align=center><input type='text' name='av_Sett' value='<?php echo "$avsize"; ?>'>
<br /><br />
Size restriction on upload avatars? (in bytes). Leave blank for no size restriction.</div><br><div align=center>
<div align=center><input type='text' name='avmax_Sett' value='<?php echo "$avmax_size"; ?>'>

</div></div></div></td></table></div>
<br>
<br />
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Resize posted images to clickable thumbnails?</font></b></td></tr><td class=arcade1><div align=center>Input dimensions below.  Example: "height=50 width=50". Leave blank to take off dimension restriction.</div><br><div align=center>
<div align=center><input type='text' name='thumb_Sett' value='<?php echo "$thumbnailsize"; ?>'></div></div></div></td></table></div>
<br>
<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Max Sig Characters?</font></b></td></tr><td class=arcade1><div align=center>Input number below.</div><br><div align=center>
<div align=center><input type='text' name='sig_Sett' value='<?php echo "$siglength"; ?>'></div></div></div></td></table></div>
<br>

<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Inbox system?</font></b></td></tr><td class=arcade1><div align=center>
<div align=center>Max Number of Messages Per Inbox?<br><input type=text name=inboxlimitSett value='<?php echo "$inboxlimit"; ?>'></div></div></div></td></table></div>
<br>

<input type=submit name=SettingsUpdate value='Update Settings'>

</form>
<br>

<?php } ?>

<?php

if ($cparea == permissions) { 


// #############################################################################
// PERMISSIONS RELATED FUNCTIONS
// #############################################################################

//---------------------------------------------------------------------------------------------------------
//                                             Permissions
// 
//-------------------------------------------------------------------------------------------------------------------
if ($updateperms) {

$fp = fopen("./permissions/{$forum}.php","w+");


$permissions_Settings ="<?php\n\$allow_posting = '$o1';\n\$url_redirect='$o2';\n\$redirect_to = '$o3';\n\$parse_bbcode = '$o4';\n\$allow_quick_reply = '$o5';\n\$increase_postcount = '$o6';\n\$password_needed = '$o7';\n\$board_password = '$boardpass';\n\$can_upload['Admin'] = '$Admin_attach';\n\$can_read['Admin'] = '$Admin_read';\n\$can_reply['Admin'] = '$Admin_reply';\n\$can_start['Admin'] = '$Admin_start';\n\$can_upload['Member'] = '$Member_attach';\n\$can_read['Member'] = '$Member_read';\n\$can_reply['Member'] = '$Member_reply';\n\$can_start['Member'] = '$Member_start';\n\$can_upload['Guest'] = '$Guest_attach';\n\$can_read['Guest'] = '$Guest_read';\n\$can_reply['Guest'] = '$Guest_reply';\n\$can_start['Guest'] = '$Guest_start';\n\$can_upload['Banned'] = '$Banned_attach';\n\$can_read['Banned'] = '$Banned_read';\n\$can_reply['Banned'] = '$Banned_reply';\n\$can_start['Banned'] = '$Banned_start';\n\$can_upload['Moderator'] = '$Moderator_attach';\n\$can_read['Moderator'] = '$Moderator_read';\n\$can_reply['Moderator'] = '$Moderator_reply';\n\$can_start['Moderator'] = '$Moderator_start';\n\$can_upload['Validating'] = '$Validating_attach';\n\$can_read['Validating'] = '$Validating_read';\n\$can_reply['Validating'] = '$Validating_reply';\n\$can_start['Validating'] = '$Validating_start';";

 $folder = "./groups/";
  $handle_a = opendir($folder);
  while ( $topic_y = readdir($handle_a ))
   {
     if( $topic_y == '.' || $topic_y == '..' || $topic_y == 'Admin.php' || $topic_y == 'Moderator.php' || $topic_y == 'Guest.php' || $topic_y == 'Banned.php' || $topic_y == 'icons' || $topic_y == 'icons' || $topic_y == 'Member.php' || $topic_y == 'Validating.php')
     continue;
     $forumtopiclist_h [$topic_y] = filemtime($folder."/".$topic_y);
     }
  @arsort($forumtopiclist_h);
  while(list($t44)=@each($forumtopiclist_h))
  {
$nameofgroup = explode(".", $t44);
$n = $nameofgroup[0];
$read = $_POST["{$n}_read"];
$reply = $_POST["{$n}_reply"];
$start = $_POST["{$n}_start"];
$attach = $_POST["{$n}_attach"];

$permissions_Yours.= "\n\$can_read['$n']='$read';\n\$can_reply['$n']='$reply';\n\$can_start['$n']='$start';\n\$can_upload['$n']='$attach';\n";
}

$permissions_End = "\n?>";

fwrite($fp, $permissions_Settings);
fwrite($fp, $permissions_Yours);
fwrite($fp, $permissions_End);

fclose($fp);

}


if ($newforum) {


	if(preg_match("@[^\w ]@", $_POST["newforum"])) {
error("Your forum name had invalid characters");
}  

//=====

$Forumlist = getarrayby_arsort("./addedforums/");

//=====

rename("./permissions/{$forum}.php", "./permissions/{$newforum}.php");
rename("./forumposts_{$forum}/", "./forumposts_{$newforum}/");
rename("./postcounts/{$forum}.txt", "./postcounts/{$newforum}.txt");

$time=filemtime("./addedforums/{$cat}/{$forum}.txt");

unlink("./addedforums/{$cat}/{$forum}.txt");

$fp = fopen("./addedforums/{$cat}/{$newforum}.txt","w+");

fwrite($fp, $newdesc);
fclose($fp);

touch("./addedforums/{$cat}/{$newforum}.txt", $time);

for ($x=0; $x<count($Forumlist); $x++) 
{

$trim_f = rtrim($Forumlist[$x]);


unlink("./addedforums/{$trim_f}/modify.txt");
$maketxtfile = fopen("./addedforums/{$trim_f}/modify.txt", "w+");
fwrite($maketxtfile,  "w00t" );

}



error("Your forum rename is complete. <a href=admincp.php?cparea=boards>Return to index</a>");

}

if ($newcat) {
rename("./addedforums/{$cat}/{$forum}.txt", "./addedforums/{$newcat}/{$forum}.txt");
error("Forum moved. <A href=admincp.php?cparea=idx>Return to ACP index</a>");
}

$desc = file("./addedforums/{$cat}/{$forum}.txt");
?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; <a href=admincp.php?cparea=boards>Manage Forums</a> &#187; Permissions & Settings : <?php echo htmlspecialchars($forum); ?></td></table></div>
<br>

<form action='' method='POST'>
<div align='center'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Forum Name</td><td width=60% align=center class=headertableblock>Forum Description</td><tr><td class=arcade1><input type=text name=newforum value='<?php echo "$forum"; ?>'></td><td class=arcade1><input type=text name=newdesc value='<?php echo $desc[0]; ?>'><tr><td class=headertableblock colspan=7><div align=center><input type=submit name=Nothing value='Update Forum'></div></td></tr>
</td></table></div><br>
</form>

<form action='' method='POST'>
<div align='center'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Settings</td><td width=60% align=center class=headertableblock>Current setting</td><tr>
<?php

require("./permissions/{$forum}.php");

addfsetting("Allow posting in this board?", "", "$allow_posting", "o1", "$forum");
addfsetting("Board is a URL redirect?", "", "$url_redirect", "o2", "$forum");



echo "<tr><td class='arcade1'><b>Redirect to where?</b><br></td><td class='arcade1'><input type=text name=o3 value='$redirect_to'>";
echo "<br></td></tr>";

addfsetting("Parse BBCode?", "", "$parse_bbcode", "o4", "$forum");
addfsetting("Enable Quick Reply?", "", "$allow_quick_reply", "o5", "$forum");
addfsetting("Postcount increases in this forum?", "", "$increase_postcount", "o6", "$forum");
addfsetting("Password access required?", "", "$password_needed", "o7", "$forum");
echo "<tr><td class='arcade1'><b>Password used to access?</b><br></td><td class='arcade1'><input type=text name=boardpass value='$board_password'>";
echo "<br></td></tr>";


echo "</table></div><br>";

// here

function createpermslot_read($group, $forum) {
require("./permissions/{$forum}.php");
echo "<td class=arcade1>";
if ($can_read["$group"] == allowed) {
echo "<div align=center><input type='checkbox' value='allowed' name='{$group}_read' checked='checked'></div>";
} else {
echo "<div align=center><input type='checkbox' value='allowed' name='{$group}_read'></div>";
}
echo "</td>";
}


function createpermslot_reply($group, $forum) {
require("./permissions/{$forum}.php");
echo "<td class=arcade1>";
if ($can_reply["$group"] == allowed) {
echo "<div align=center><input type='checkbox' value='allowed' name='{$group}_reply' checked='checked'></div>";
} else {
echo "<div align=center><input type='checkbox' value='allowed' name='{$group}_reply'></div>";
}
echo "</td>";
}


function createpermslot_start($group, $forum) {
require("./permissions/{$forum}.php");
echo "<td class=arcade1>";
if ($can_start["$group"] == allowed) {
echo "<div align=center><input type='checkbox' value='allowed' name='{$group}_start' checked='checked'></div>";
} else {
echo "<div align=center><input type='checkbox' value='allowed' name='{$group}_start'></div>";
}
echo "</td>";
}

function createpermslot_attach($group, $forum) {
require("./permissions/{$forum}.php");
echo "<td class=arcade1>";
if ($can_upload["$group"] == allowed) {
echo "<div align=center><input type='checkbox' value='allowed' name='{$group}_attach' checked='checked'></div>";
} else {
echo "<div align=center><input type='checkbox' value='allowed' name='{$group}_attach'></div>";
}
echo "</td>";
}




// #############################################################################


function headerSlot() {

 $folder = "./groups/";
  $handle_a = opendir($folder);
  while ( $topic_y = readdir($handle_a ))
   {
     if( $topic_y == '.' || $topic_y == '..' || $topic_y == 'Admin.php' || $topic_y == 'Moderator.php' || $topic_y == 'Guest.php' || $topic_y == 'Banned.php' || $topic_y == 'icons' || $topic_y == 'icons' || $topic_y == 'Member.php' || $topic_y == 'Validating.php')
     continue;
     $forumtopiclist_h [$topic_y] = filemtime($folder."/".$topic_y);
     }
  @arsort($forumtopiclist_h);
  while(list($t44)=@each($forumtopiclist_h))
  {
$nameofgroup = explode(".", $t44);
echo "<td width=10% align=center class=headertableblock>$nameofgroup[0]</td>";
}

}


function groupSlot($slotforwhat) {

 $folder = "./groups/";
  $handle_a = opendir($folder);
  while ( $topic_y = readdir($handle_a ))
   {
     if( $topic_y == '.' || $topic_y == '..' || $topic_y == 'Admin.php' || $topic_y == 'Moderator.php' || $topic_y == 'Guest.php' || $topic_y == 'Banned.php' || $topic_y == 'icons' || $topic_y == 'icons' || $topic_y == 'Member.php' || $topic_y == 'Validating.php')
     continue;
     $forumtopiclist_h [$topic_y] = filemtime($folder."/".$topic_y);
     }
  @arsort($forumtopiclist_h);
  while(list($t44)=@each($forumtopiclist_h))
  {
$nameofgroup = explode(".", $t44);
	global $forum;

if ($slotforwhat == read) {
createpermslot_read("$nameofgroup[0]", $forum);
}

if ($slotforwhat == reply) {
createpermslot_reply("$nameofgroup[0]", $forum);
}

if ($slotforwhat == start) {
createpermslot_start("$nameofgroup[0]", $forum);
}

if ($slotforwhat == attach) {
createpermslot_attach("$nameofgroup[0]", $forum);
}


}

}


?>

<div class='tableborder'><table width=5% cellpadding='4' cellspacing='1'><table width=100% cellpadding='4' cellspacing='1'><td width=10% align=center class=headertableblock>Can...</td><td width=60% align=center class=headertableblock>Admin</td><td width=60% align=center class=headertableblock>Moderator</td><td width=10% align=center class=headertableblock>Member</td><td width=10% align=center class=headertableblock>Guest</td><td width=10% align=center class=headertableblock>Validating</td><td width=10% align=center class=headertableblock>Banned</td> <?php headerSlot(); ?>

<?php
//read
echo "<tr>";
echo "<td class=arcade1>Read</td>";
createpermslot_read("Admin", $forum);
createpermslot_read("Moderator", $forum);
createpermslot_read("Member", $forum);
createpermslot_read("Guest", $forum);
createpermslot_read("Validating", $forum);
createpermslot_read("Banned", $forum);
groupSlot("read");

echo "</tr>";

//reply
echo "<tr>";
echo "<td class=arcade1>Reply</td>";
createpermslot_reply("Admin", $forum);
createpermslot_reply("Moderator", $forum);
createpermslot_reply("Member", $forum);
createpermslot_reply("Guest", $forum);
createpermslot_reply("Validating", $forum);
createpermslot_reply("Banned", $forum);
groupSlot("reply");
echo "</tr>";

//start
echo "<tr>";
echo "<td class=arcade1>Start</td>";
createpermslot_start("Admin", $forum);
createpermslot_start("Moderator", $forum);
createpermslot_start("Member", $forum);
createpermslot_start("Guest", $forum);
createpermslot_start("Validating", $forum);
createpermslot_start("Banned", $forum);
groupSlot("start");
echo "</tr>";

//Attach
echo "<tr>";
echo "<td class=arcade1>Attach</td>";
createpermslot_attach("Admin", $forum);
createpermslot_attach("Moderator", $forum);
createpermslot_attach("Member", $forum);
createpermslot_attach("Guest", $forum);
createpermslot_attach("Validating", $forum);
createpermslot_attach("Banned", $forum);
groupSlot("attach");
echo "</tr>";

echo "<tr><td class=headertableblock colspan=100><div align=center><input type=submit name=updateperms value='Update Permissions and Settings'></div></td></tr>";

echo "</form></table></div><br>";
?>
<form action='' method='POST'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Forum Name</td><td width=60% align=center class=headertableblock>Move to...</td><tr><td class=arcade1><?php echo "$forum"; ?></td><td class=arcade1>
<?php
echo '<select size="1" name="newcat">';
echo '<option value="None">Select a Category</option>';
// yes this has been stolen from the other part.

 $folder = "./addedforums";

  $handle_a = opendir($folder);

  while ( $topic_y = readdir($handle_a ))

   {

     if( $topic_y == '.' || $topic_y == '..' )
     
     continue;
      
     $forumtopiclist_h [$topic_y] = filemtime($folder."/".$topic_y);

     }

// use arsort

  arsort($forumtopiclist_h);

  while(list($t44)=each($forumtopiclist_h))

  {

echo "<option value='$t44'>$t44</option>";

}


echo "</select><br>";
?>

</td><tr><td class=headertableblock colspan=7><div align=center><input type=submit name=Nothing value='Move Forum'></div></td></tr>
</td></table></div><br>
</form>

<?php

}
?>

<?php 
if ($cparea == attachments) { 

if($_GET['remove'] === "0") die();

if ($_GET['delete_attachment']) {

$file = "upload_log.php";
$array=file($file); 
$file2=fopen($file, "w"); 
foreach($array as $k=>$v){ 
if ($k == $remove || $v == "" ){ 
continue; 
} 
fwrite($file2, $v); 
} 

fclose($file2);
@unlink("./uploads/$delete_attachment");

}
?>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; Attachments Manager</td></table></div>
<br>

<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>File name</td><td width=10% align=center class=headertableblock>Date</td><td width=10% align=center class=headertableblock>IP</td><td width=10% align=center class=headertableblock>Size</td><td width=10% align=center class=headertableblock>User</td><td width=10% align=center class=headertableblock>Topic</td><td width=60% align=center class=headertableblock>Remove</td>

<?php
$upload_log = file("upload_log.php");
for($x=1;$x<count($upload_log);$x++) {

$upload_log_line = explode("``", $upload_log[$x]);
$registered_names = file("./id_data/member_names_num.txt");
$user = $upload_log_line[2];
echo "<tr><td class=arcade1><a href='uploads/$upload_log_line[0]'>$upload_log_line[0]</a></td><td class=arcade1><div align=center>$upload_log_line[4]</div></td><td class=arcade1><div align=center>$upload_log_line[1]</div></td><td class=arcade1><div align=center>$upload_log_line[5]</div></td><td class=arcade1><div align=center>$registered_names[$user]</div></td><td class=arcade1><div align=center>#<a href='viewtopic.php?topicid=$upload_log_line[3]'>$upload_log_line[3]</a></div></td><td class=arcade1><a href='?cparea=attachments&remove=$x&delete_attachment=$upload_log_line[0]'>Remove</a></td></tr>";

}
echo "</table></div><br>";


}
?>


<?php if ($cparea == wrappers) { ?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; Board Wrappers</td></table></div>
<br>
<div class='tableborder'>
   <div class='arcade1'><center>
<table width='50%' border='0' cellspacing='0' cellpadding='4'>
<tr><td class='arcade1' width='100%' >
<div class="tableborder" style="padding: 0px;">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr>
        <td class="arcade1" style="padding: 8px 8px 8px; width: 100%">
<?php
if ($editwrappers) {

$slash = stripslashes($_POST['cssforarcade']);
$ARCADECSS = "header.html";
$ArcadeCSSOpen = fopen($ARCADECSS,"w") or die ("Error editing.");
fputs($ArcadeCSSOpen,$slash);
fclose($ArcadeCSSOpen) or die ("Error Closing File!");

$slash = stripslashes($_POST['cssforarcade2']);
$ARCADECSS = "footer.html";
$ArcadeCSSOpen = fopen($ARCADECSS,"w") or die ("Error editing.");
fputs($ArcadeCSSOpen,$slash);
fclose($ArcadeCSSOpen) or die ("Error Closing File!");
}


?>
 	<form action="?cparea=wrappers" method='POST'>
	
<textarea rows="10" cols="60" name="cssforarcade">
<?
// Implode CSS
$ARCADECSS = "header.html";
print (implode("",file($ARCADECSS)));
?>
</textarea><br />
<br>
	
<textarea rows="10" cols="60" name="cssforarcade2">
<?
// Implode CSS
$ARCADECSS = "footer.html";
print (implode("",file($ARCADECSS)));
?>
</textarea><br />

                <br />
	<input type="submit" value="Edit Wrappers" name="editwrappers">
	</form></table></table></div></div><br>

<?php } ?>

<?php if ($cparea == emotes) { ?>
<?php
if ($_GET['remove']) {
$file = "emotes_faces.txt";
$array=file($file); 
$file2=fopen($file, "w"); 
foreach($array as $k=>$v){ 
if ($k == $remove || $v == "" ){ 
continue; 
} 
fwrite($file2, $v); 
} 
fclose($file2); 

$file = "emotes_pics.txt";
$array=file($file); 
$file2=fopen($file, "w"); 
foreach($array as $k=>$v){ 
if ($k == $remove || $v == "" ){ 
continue; 
} 
fwrite($file2, $v); 
} 
fclose($file2);

}


if ($_POST['face']) {
$smilefile = fopen("emotes_faces.txt", "a");
fwrite($smilefile,  "$face\n" );

$imagefile = fopen("emotes_pics.txt", "a");
fwrite($imagefile,  "$pic\n" );
}


$smilies = file("emotes_faces.txt");
$smiliesp = file("emotes_pics.txt");
?>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; Emoticon Manager</td></table></div>
<br>

<?php

echo "<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Face</td><td width=10% align=center class=headertableblock>Preview</td><td width=60% align=center class=headertableblock>Remove</td>";

	// display
for($x=1;$x<count($smilies);$x++) {

echo "<tr><td class=arcade1>$smilies[$x]</td><td class=arcade1><div align=center><img src='emoticons/$smiliesp[$x]'></div></td><td class=arcade1><a href='?cparea=emotes&remove=$x'>Remove</a></td></tr>";

}

echo "</table></div>";
?>
<form action='admincp.php?cparea=emotes' method='POST'>

<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Add Emoticon</td><tr><td class=arcade1>
<div align=center>Face/action:<input type=text name=face>
Image: 

	    <select name="pic">
<?php
echo "<option value=':)' selected>Select an image</option>";

$dir = "./emoticons/";
   if ($dh = opendir($dir)) {
       while (($file = readdir($dh)) !== false) {
 if ($file == "." || $file == "..") continue;
echo "<option value='$file'>$file</option>";
       }
       closedir($dh);
   }
?>
</select>
<input type='Submit' name='Submit' value='Add Emoticon'></div>
</td></tr></table></div>
</form>



<?php } ?>

<?php if ($cparea == Email) {
?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; Email All Users</td></table></div>
<br>
<?php
//$settings=explode("|", $mailing[1]);

$dir = "./accounts/";
   if ($dh = opendir($dir)) {
       while (($file = readdir($dh)) !== false) {
 
 if ($file != "." || $file != "..") {

if(!is_dir("./accounts/$file")) {
include("./accounts/$file");
$list.= "$email, ";

}


}


	   }
       closedir($dh);
   }


?>
<div class='tableborder'><table width='100%' cellpadding='4' cellspacing='1'><tr><td class='arcade1'>

<form action="admincp.php?cparea=Email" method="post">
<h1>Email List</h1><br />
List of users on your mailing list: <br />

<?php
$hd = $_POST['mailheaders'];
if ($_POST['subject']) {
$members = $_POST['members'];
$mailsub = $_POST['subject'];
$mailbody = $_POST['email_body'];
$headers = "From: $hd\n";
$g=@mail($members,$mailsub,$mailbody,$headers);
if(!$g) echo "<br /> Error: The mail(); command has been disabled by your hosting provider for security reasons. The emails <font color=red>could not be sent</font>. Talk to your hosting provider, or follow the directions on sending the email right from your email client.";
}

?>

<textarea rows="5" cols="60" name="members">
<?php echo $list; ?>
</textarea><br />

The above users will be sent an email announcement. If your host does not allow people to send mail with <br /> the form below, you can <b>cut</b> and <b>paste</b> the above box into your email addresses (like AOL.com or Yahoo etc) "Send to" address box.<br /><br /><br />
Type the <b>email you want users to be able to reply to (or not) (ex use noreply@thearcade.tld) :</b> <br />
<input type=text name=mailheaders><br />
Type the <b>subject</b> of the email: <br />
<input type=text name='subject'><br />
Type your <b>message</b> here: <br /><br />
<textarea rows="20" cols="80" name="email_body">
</textarea> <BR />
<input type=submit value=Submit name=post>
</form>
</td></tr></table></div><br />

<?php }?>

<?php if ($cparea == filter) { ?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; Word Filters</td></table></div>
<br>
<div class='tableborder'>
   <div class='arcade1'><center>
<table width='50%' border='0' cellspacing='0' cellpadding='4'>
<tr><td class='arcade1' width='100%' >
<div class="tableborder" style="padding: 0px;">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr>
        <td class="arcade1" style="padding: 8px 8px 8px; width: 100%">
<?php
  if ($editban) {
$slash = stripslashes($_POST['cssforarcade']);
$ARCADECSS = "filter.txt";
$ArcadeCSSOpen = fopen($ARCADECSS,"w") or die ("Error editing.");
fputs($ArcadeCSSOpen,$slash);
fclose($ArcadeCSSOpen) or die ("Error Closing File!");
}
?>

 	<form method=post action="?cparea=filter">
	
<textarea rows="10" cols="40" name="cssforarcade">
<?
// Implode CSS
$ARCADECSS = "filter.txt";
print (implode("",file($ARCADECSS)));
?>
</textarea><br />

                <br />
	<input type="submit" value="Edit filters" name="editban">
	</form></table></table></div></div><br>

<?php } ?>


<?php if ($cparea == editor) { ?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; <a href=admincp.php?cparea=skin>Select Skin to Edit</a> &#187; Editing Skin</td></table></div>
<br>
<div class='tableborder'>
   <div class='arcade1'><center>
<table width='50%' border='0' cellspacing='0' cellpadding='4'>
<tr><td class='arcade1' width='100%' >
<div class="tableborder" style="padding: 0px;">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr>
        <td class="arcade1" style="padding: 8px 8px 8px; width: 100%">
<?php
  if ($editban) {
$slash = stripslashes($_POST['cssforarcade']);
$ARCADECSS = "./skins/$skin";
$ArcadeCSSOpen = fopen($ARCADECSS,"w") or die ("Error editing.");
fputs($ArcadeCSSOpen,$slash);
fclose($ArcadeCSSOpen) or die ("Error Closing File!");
}
?>
 	<form method=post action="?cparea=editor&skin=<?php echo "$skin"; ?>">
	
<textarea rows="40" cols="60" name="cssforarcade">
<?
// Implode CSS
$ARCADECSS = "./skins/$skin";
print (implode("",file($ARCADECSS)));
?>
</textarea><br />

                <br />
	<input type="submit" value="Edit CSS" name="editban">
	</form></table></table></div></div><br>

<?php } ?>

<?php if ($cparea == skin) { ?>


<?php

if ($skinremove) {

if ($skinremove == "Default.css") {
error("You cannot remove the default skin.");
}

unlink("./skins/$skinremove");
$skin = explode(".", $skinremove);
eraseallfiles("./skins/{$skin[0]}_img/");
rmdir("./skins/{$skin[0]}_img/");

}
?>


<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; Select Skin to Edit</td></table></div>
<br>
<div align='center'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Skin Name</td><td width=10% align=center class=headertableblock>Delete</td><td width=60% align=center class=headertableblock>Modify</td><tr>

<?php if ($addcssfile) {
$fp = fopen("./skins/{$skincssfilename}.css","w+");
mkdir("./skins/{$skincssfilename}_img", 0777);
$fp = fopen("./skins/{$skincssfilename}_img/macros.php","w+");
$m = file_get_contents("./skins/Default_img/macros.php");
fwrite($fp, $m);
fclose($fp);

}
?>

<div align=center><?php
if ($handle = opendir('./skins/')) {
   while (false !== ($file = readdir($handle))) { 
       if ($file != "." && $file != "..") {
if (!is_dir("./skins/$file")) {
           echo "<td class=arcade1>$file</td><td class=arcade1><a href='admincp.php?skinremove=$file&cparea=skin'><div align=center>[X]</div></a></td><td class=arcade1><a href='admincp.php?skin=$file&cparea=editor'><div align=center>[Edit CSS]</a> <a href='admincp.php?skin=$file&cparea=macros'>[Macros]</a></td></tr>"; 
}
       } 
   }
   closedir($handle); 
}?></table></div><br>

<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Make new CSS File</font></b></td></tr><td width=50%% align=center class=arcade1><font size=-5>CSS File name (leave out .css)</font></td><td width=10% align=center class=arcade1><font size=-5>Action</font></td></div><tr><td class=arcade1> <form method=post action="?cparea=skin"><div align=center><input type=text name=skincssfilename></center> </div></td><td class=arcade1><div align=center><input type='submit' value='Add' name='addcssfile'></div></td></table></div></form>

<?php } ?>

<?php if ($cparea == membersv) {
?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; Validating Members</td></table></div><br>
<?php
if ($eraseuser) {
	
	// Attempt to erase member and all files
	// 
                  unlink("./accounts/{$eraseuser}_user.php");
                  eraseallfiles("./accounts/{$eraseuser}_inbox");
                  eraseallfiles("./accounts/{$eraseuser}_outbox");
                  rmdir("./accounts/{$eraseuser}_outbox/");
	rmdir("./accounts/{$eraseuser}_inbox/");

$file=file("./id_data/member_names_num.txt");
if ($eraseuser) {
$file=file("./id_data/member_names_num.txt");
$file[$l]="Guest \n";  
$file3 = fopen("./id_data/member_names_num.txt", "w+"); 
foreach($file as $v){
fwrite($file3,"$v");
}
fclose($file3);
}
}

if ($allow) {

$st = strtolower($allow);
require("./accounts/{$st}_user.php");

$shoutsettings ="<?php\n\$email = '$email';\n\$skinchoice = '$skinchoice';\n\$yourpassword = '$yourpassword';\n\$status = 'Member';\n\$avatar = '$avatar';\n\$sig = '$sig';\n\$title = '$title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = 'Your notes';\n\$birthday = '$birthday';\n\$postcount='$postcount';\n?>";

$fp = fopen("./accounts/{$st}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);

}

echo "<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=30% align=center class=headertableblock>Name</td><td width=20% align=center class=headertableblock>Edit</td><td width=40% align=center class=headertableblock>Email</td><td width=60% align=center class=headertableblock>IP</td><td width=60% align=center class=headertableblock>Remove</td>";

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
if ($status == Validating) {
echo "<tr><td class=arcade1>$member_txt_file[$getkey]</td><td class=arcade1><div align=center><A href='?cparea=membersv&allow=$member_txt_file[$getkey]'>[ Validate ]</a> </div></td><td class=arcade1>$email</td><td class=arcade1>$signup_ipa</td><td class=arcade1><a href='?cparea=membersv&eraseuser=$username[0]&l=$getkey'>[ Delete ]</a></td></tr>";
}

}


  }
echo "</table></div><br>";
}

 ?>



<?php if ($cparea == members) { 
?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; Members</td></table></div><br>
<?php

if ($eraseuser) {
	
	// Attempt to erase member and all files
	// 
                  unlink("./accounts/{$eraseuser}_user.php");
                  eraseallfiles("./accounts/{$eraseuser}_inbox");
                  eraseallfiles("./accounts/{$eraseuser}_outbox");
                  rmdir("./accounts/{$eraseuser}_outbox/");
	rmdir("./accounts/{$eraseuser}_inbox/");

$file=file("./id_data/member_names_num.txt");
if ($eraseuser) {
$file=file("./id_data/member_names_num.txt");
$file[$l]="Guest \n";  
$file3 = fopen("./id_data/member_names_num.txt", "w+"); 
foreach($file as $v){
fwrite($file3,"$v");
}
fclose($file3);
}
}

if ($change) {


if(preg_match("@[\W]@i", $_POST["new_name"])) {

error("The username that you tried to change the user to,  had invalid characters such as @ or $ or ^ etc. Spaces are also considered invalid characters, please use underscores.");

}

$file=file("./id_data/member_names_num.txt");
if ($new_name) {
$file=file("./id_data/member_names_num.txt");
$file[$l]="$new_name\n";  
$file3 = fopen("./id_data/member_names_num.txt", "w+"); 
foreach($file as $v){
fwrite($file3,"$v");
}
fclose($file3);
}
$lowercaseit = strtolower($change);
$lowercasenew = strtolower($new_name);
rename("./accounts/{$lowercaseit}_user.php", "./accounts/{$lowercasenew}_user.php");
rename("./accounts/{$lowercaseit}_inbox", "./accounts/{$lowercasenew}_inbox");
rename("./accounts/{$lowercaseit}_outbox", "./accounts/{$lowercasenew}_outbox");

}

if ($changename) {
echo "<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=30% align=center class=headertableblock>New Name for $changename</td><tr><td class=arcade1><div align=center><form action='admincp.php?cparea=members&change=$changename&l=$l' method='POST'><input type=text name=new_name><input type=submit value='Change Name'></form></td></tr></table></div><br>";

}


echo "<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=30% align=center class=headertableblock>Name</td><td width=20% align=center class=headertableblock>Edit</td><td width=40% align=center class=headertableblock>Email</td><td width=60% align=center class=headertableblock>IP</td><td width=60% align=center class=headertableblock>Remove</td>";

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
if (!$showonly) {
echo "<tr><td class=arcade1>$member_txt_file[$getkey]</td><td class=arcade1><div align=center><A href='?cparea=memberedits&memberedit=$member_txt_file[$getkey]'>[ Edit ]</a> <A href='?cparea=members&changename=$member_txt_file[$getkey]&l=$getkey'>[ Change Name ]</a> </div></td><td class=arcade1>$email</td><td class=arcade1>$signup_ipa</td><td class=arcade1><a href='?cparea=members&eraseuser=$username[0]&l=$getkey'>Delete</a></td></tr>";
} else {
if ($status == $showonly) {
echo "<tr><td class=arcade1>$member_txt_file[$getkey]</td><td class=arcade1><div align=center><A href='?cparea=memberedits&memberedit=$member_txt_file[$getkey]'>[ Edit ]</a> <A href='?cparea=members&changename=$member_txt_file[$getkey]&l=$getkey'>[ Change Name ]</a> </div></td><td class=arcade1>$email</td><td class=arcade1>$signup_ipa</td><td class=arcade1><a href='?cparea=members&eraseuser=$username[0]&l=$getkey'>Delete</a></td></tr>";
}

}
}


  }
echo "</table></div><br>";
?>

<?php } ?>

<?php if ($cparea == memberedits) { ?>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <a href=admincp.php?cparea=idx>Admin CP</a> &#187; Edit Members</td></table></div>
<br>


<div class='tableborder'><center>
<table width='100%' border='0' cellspacing='0' cellpadding='4'>
<td class='arcade1' width='100%' ><DIV ALIGN='CENTER'>[ Editing Members ]<br><br>
<?php
if ($memberedit) {
echo "";
} else {
echo "<form action='' method=get>";
echo "<input type=hidden name=cparea value=memberedits><input type=text name=memberedit> <input type=submit value='Edit Member'>";
echo "</form>";
}
?>
</DIV></td></table></div></div><br><br>

<?php
if ($updateprofile) {

require("./accounts/{$memberedit}_user.php");

$posted_sig = eregi_replace("\n", "<br>", $posted_sig);


$fp = fopen("./accounts/{$memberedit}_user.php","w+");
$shoutsettings ="<?php\n\$email = '$email';\n\$skinchoice = '$updateprofile';\n\$yourpassword = '$yourpassword';\n\$status = '$status_u';\n\$avatar = '$posted_avatar';\n\$sig = '$posted_sig';\n\$title = '$posted_title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = '$notepad';\n\$postcount = '$postcount_n';\n\$birthday = '$birthday';\n?>";
fwrite($fp, $shoutsettings);
fclose($fp);

}
?>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Editing Member: <?php echo "$memberedit"; ?></td><tr>

<td class=arcade1 valign="top"><div align=center>

<?php
if ($memberedit) {

$memberedit = strtolower($memberedit);

if(file_exists("./accounts/{$memberedit}_user.php")) {

require("./accounts/{$memberedit}_user.php");
$sig = str_replace("<br>", "\n", $sig);
echo "<div align=center>";
echo "<form action='?memberedit=$memberedit&updateprofile=yes&cparea=memberedits' method=post name=updateprofile>";
echo "<br>IP Address on date of signup:<br>$signup_ipa<br><br>";
echo "Avatar:<br> <input type=text name=posted_avatar value=$avatar><br><br>";
echo "Custom Title:<br><input type=text name=posted_title value='$title'><br><br>";
echo "Posts:<br><input type=text name=postcount_n value='$postcount'><br><br>";
echo "Signature: <br><textarea rows=5 cols=30 class=input name=posted_sig>$sig</textarea><br><br>";
echo "<br><br><br>";
echo "<div align='center'>Adjust Skin Settings?</div>";
echo '<select size="1" name="updateprofile">';
echo "<option value='$skinchoice' selected>Selected Skin ($skinchoice)</option>";
echo "<br><br><br>";
 $s = "./skins/";

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

if (!is_dir("./skins/$topictitle")) {
echo "<option value='$topictitle'>$topictitle</option>";
}

  }

echo '</select><br /><br><br>';
echo "<div align='center'>User Group?<br></div>";
echo '<select size="1" name="status_u">';
echo "<option value=$status selected>Group? ($status)</option>";
echo "<option value=Admin>Admin</option>";
echo "<option value=Moderator>Moderator</option>";
echo "<option value=Validating>Validating</option>";
echo "<option value=Member>Member</option>";
echo "<option value=Banned>Banned</option>";
$folder = "./groups/";
  $handle_a = opendir($folder);
  while ( $topic_y = readdir($handle_a ))
   {
     if( $topic_y == '.' || $topic_y == '..' || $topic_y == 'Admin.php' || $topic_y == 'Moderator.php' || $topic_y == 'Guest.php' || $topic_y == 'Banned.php' || $topic_y == 'icons' || $topic_y == 'icons' || $topic_y == 'Member.php' || $topic_y == 'Validating.php')
     continue;
     $forumtopiclist_h [$topic_y] = filemtime($folder."/".$topic_y);
     }
  @arsort($forumtopiclist_h);
  while(list($t44)=@each($forumtopiclist_h))
  {
	  $nameofgroup = explode(".", $t44);
	  echo "<option value='$nameofgroup[0]'>|-- $nameofgroup[0]</option>";
  }
echo "</select><br>";
echo "<input type=hidden name=cparea value=memberedits><input type=submit value='Update Member $member Settings' name=settings></form>";
}
}
?>

</div>
 </td>
</table>
</div>
<br>
<?php } ?>

<?php if ($cparea == bannedIPlist) { ?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <A href=admincp.php?cparea=idx>Admin CP</a> &#187; Editing Banned IP List</td></table></div>
<br>
<?php
if ($editban) {
echo "<div class='tableborder'><center>
<table width='100%' border='0' cellspacing='0' cellpadding='4'>
<td class='arcade1' width='100%' ><DIV ALIGN='CENTER'>[ Ban Edits Saved ]<br></DIV></td></table></div></div><br>";
}
?>


<div class='tableborder'>
   <div class='arcade1'><center>
<table width='50%' border='0' cellspacing='0' cellpadding='4'>
<tr><td class='arcade1' width='100%' >
<div class="tableborder" style="padding: 0px;">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr>
        <td class="arcade1" style="padding: 8px 8px 8px; width: 100%">
<?php
  if ($editban) {
$slash = stripslashes($_POST['cssforarcade']);
$ARCADECSS = "./banned.txt";
$ArcadeCSSOpen = fopen($ARCADECSS,"w") or die ("Error editing.");
fputs($ArcadeCSSOpen,$slash);
fclose($ArcadeCSSOpen) or die ("Error Closing File!");
}
?>
 	<form method=post action="?cparea=bannedIPlist">
	
<textarea rows="40" cols="60" name="cssforarcade">
<?
// Implode CSS
$ARCADECSS = "./banned.txt";
print (implode("",file($ARCADECSS)));
?>
</textarea><br />

                <br />
	<input type="submit" value="Edit Ban file" name="editban">
	</form></table></table></div></div><br>

<?php } ?>

<?php if ($cparea == boards) { ?>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; <A href=admincp.php?cparea=idx>Admin CP</a> &#187; <a href=?cparea=boards>Managing Forums</a></td></table></div>
<br>

<?php
if ($removecat) {
if (!file_exists("./addedforums/$cat/")) {
error("This category doesn't exist - you may have already deleted it");
}

$countstuff = opendir("./addedforums/$cat/"); 
$total_topics = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..'){ 
      $total_topics++; 
   } 
} 
closedir($countstuff); 


if ($total_topics > 1) {

echo "<div class='tableborder'><center>
<table width='100%' border='0' cellspacing='0' cellpadding='4'>
<td class='arcade1' width='100%' ><DIV ALIGN='CENTER'>[ Deleted of forum $cat failed. Reason: This category has forums in it. Please delete them, or move these forums to another category to delete this category. ]<br><br><br></DIV></td></table></div></div><br>";

} else {
unlink("./addedforums/{$cat}/modify.txt");
rmdir("./addedforums/$cat/");
}


}


if ($deleteforum) {

if ($deleteforum == q) {
error("Are you 100% sure you want to delete this forum? There will be NO other confirmation screens, and erasing this forum will erase all posts inside. <br><br><input type=button onclick=\"document.location='?cparea=boards&eforum=$eforum&cat=$cat&deleteforum=y'\" value='Delete forum'>");
} 

//-------------------------------------------------------------------------------------------------------------------
//                                             Delete Forum Function
// 
//-------------------------------------------------------------------------------------------------------------------

if (!file_exists("./forumposts_{$eforum}/")) {
error("$eforum doesn't exist, or you already deleted it");
}

echo "<div class='tableborder'><center>
<table width='100%' border='0' cellspacing='0' cellpadding='4'>
<td class='arcade1' width='100%' ><DIV ALIGN='CENTER'>[ Deleted $eforum ]</DIV></td></table></div></div><br>";

// Attempt to erase all the files
eraseallfiles("./forumposts_{$eforum}/");

// Attempt to erase all the files in the sticky forum
eraseallfiles("./forumposts_{$eforum}/sticky/");

// Attempt to erase all the files in the archive
eraseallfiles("./forumposts_{$eforum}/old/");

rmdir("./forumposts_{$eforum}/sticky/");
rmdir("./forumposts_{$eforum}/old");
rmdir("./forumposts_{$eforum}/");

unlink("./addedforums/{$cat}/{$eforum}.txt");
unlink("./permissions/{$eforum}.php");
unlink("./postcounts/{$eforum}.txt");

}

//-------------------------------------------------------------------------------------------------------------------
//                                             Move Forum Function
// 
//-------------------------------------------------------------------------------------------------------------------

if ($_POST['orderstuff']) {
//print_r($number);
//print_r($forumname);

foreach($forumname as $k=>$v){

$FolderTime=filemtime("./addedforums/{$hiddencat}/");

$desc=file("./addedforums/{$hiddencat}/{$v}");

$TouchTest=@touch("./addedforums/{$hiddencat}/{$v}", 100000+$number[$k]);

if(!$TouchTest) {

unlink("./addedforums/{$hiddencat}/{$v}");
$maketxtfile2 = fopen("./addedforums/{$hiddencat}/{$v}", "w+");
fwrite($maketxtfile2,  "$desc[0]" );
fclose($maketxtfile2);
@touch("./addedforums/{$hiddencat}/{$v}", 100000+$number[$k]);

}


// Fix the folder.
// Doesn't work on windows. Damn you, PHP. -_-
//
// ... No wait...
///
// DAM U GORGE BUSH
//
// This is all Bush's fault.


@touch("./addedforums/{$hiddencat}/", $FolderTime);


}

}


//-------------------------------------------------------------------------------------------------------------------
//                                             Move Forum Function
//
//-------------------------------------------------------------------------------------------------------------------

if ($moveup) {

unlink("./addedforums/{$cat}/modify.txt");
$maketxtfile2 = fopen("./addedforums/{$cat}/modify.txt", "w+");
fwrite($maketxtfile2,  "w00t." );

}


?>


<html>
<head>
<style type="text/css">
@import"../Arcade.css"; 
</style>
</head>
<body>


<?php
if ($postgame) {

if ($cat == None) {
	error("You didn't chose a category");
}

	if(preg_match("@[^\w ]@", $_POST["forum"])) {   
   
error("The forum you tried to create had invalid characters, please try again");   
   
}   

// CHMOD 777 AND mkdir

$forum  = eregi_replace("'", "", $forum);

if (file_exists("./forumposts_{$forum}/")) {
error("That forum already exists. Please choose a new name.");
}

mkdir("./forumposts_{$forum}", 0777);
mkdir("./forumposts_{$forum}/sticky", 0777);
mkdir("./forumposts_{$forum}/old", 0777);

$p = fopen("./postcounts/{$forum}.txt", "w+");
fwrite($p, "0");
fwrite($p, "\n0");

}

if ($addcat) {

if (file_exists("./addedforums/{$cat}")) {
error("That category name already exists. Please choose a new name.");
}

if(preg_match("@[^\w ]@", $_POST["cat"])) { 

error("The category name you tried to enter has invalid characters.");

}

// CHMOD 777 AND mkdir

$cat  = eregi_replace("'", "", $cat);

mkdir("./addedforums/{$cat}/", 0777);


$maketxtfile2 = fopen("./addedforums/{$cat}/modify.txt", "w+");

fwrite($maketxtfile2,  "w00t." );

}

?>


<?php

if ($postgame) {


$maketxtfile2 = fopen("./addedforums/{$cat}/{$forum}.txt", "w+");
fwrite($maketxtfile2,  "$desc" );

touch("./addedforums/{$cat}/{$forum}.txt", 100000);



$fp = fopen("./permissions/{$forum}.php","w+");

$permissions_Settings ="<?php\n\$url_redirect = 'No';\n\$allow_posting = 'Yes';\n\$redirect_to = '';\n\$parse_bbcode = 'Yes';\n\$allow_quick_reply = 'No';\n\$increase_postcount = 'Yes';\n\$password_needed = 'No';\n\$board_password = '';\n\$can_upload['Admin'] = 'allowed';\n\$can_read['Admin'] = 'allowed';\n\$can_reply['Admin'] = 'allowed';\n\$can_start['Admin'] = 'allowed';\n\$can_upload['Member'] = '';\n\$can_read['Member'] = 'allowed';\n\$can_reply['Member'] = 'allowed';\n\$can_start['Member'] = 'allowed';\n\$can_upload['Guest'] = '';\n\$can_read['Guest'] = 'allowed';\n\$can_reply['Guest'] = '';\n\$can_start['Guest'] = '';\n\$can_upload['Banned'] = '';\n\$can_read['Banned'] = 'allowed';\n\$can_reply['Banned'] = '';\n\$can_start['Banned'] = '';\n\$can_upload['Moderator'] = 'allowed';\n\$can_read['Moderator'] = 'allowed';\n\$can_reply['Moderator'] = 'allowed';\n\$can_start['Moderator'] = 'allowed';\n\$can_upload['Validating'] = '';\n\$can_read['Validating'] = 'allowed';\n\$can_reply['Validating'] = '';\n\$can_start['Validating'] = '';\n?>";


fwrite($fp, $permissions_Settings);
fclose($fp);



}
?>
<title>Adding Forum</title>

<?php

$countstuff = opendir("./addedforums/"); 
$total_forums = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..' && $file != 'sticky' ){ 
      $total_forums++; 
   } 
} 
closedir($countstuff); 

if ($total_forums != 0) {
// yes this has been stolen from the other part.

 $s = "./addedforums";

  $handle = opendir($s);

  while ( $topic = readdir($handle ))

   {

     if( $topic == '.' || $topic == '..' || $topic == 'modify.txt')
     
     continue;
      
     $forumtopiclist [$topic] = filemtime($s."/".$topic);

     }

// use arsort

  arsort($forumtopiclist);


  while(list($t)=each($forumtopiclist))

  {


// strip the .txt off the end of the topics.


$thetopic = "$t";


?>
<form action='' method='POST'>
<?php
     echo "<br><div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>$thetopic - (<a href='?cparea=boards&&topic=$thetopic&cat=$thetopic&moveup=1'>Move to Top</a>) - (<a href='?cparea=boards&&cat=$thetopic&removecat=1'>Remove</a>) - (<a href='?cparea=boards&&topic=$thetopic&cat=$thetopic&renamecat=$thetopic'>Rename</a>)</font></b></td></tr><td width=2% align=center class=arcade1><font size=-5>Order <a href=\"javascript:alert('Order forums by punching in the number order you want. Enter it in reverse order, the the greater the number the higher it will appear on the list. E.g., 5,4,3,2,1. 5 being greatest number, will show that on top of the rest.');\">[?]</font></td><td width=50%% align=center class=arcade1><font size=-5>Forum</font></td><td width=20% align=center class=arcade1><font size=-5>Topics</font></td></div>";

//==========================================================
// START THE PULLER UPER
//
// 

$countstuff2 = opendir("./addedforums/$t/"); 
$total_forums2 = 0; 
while($file2 = readdir($countstuff2)){ 
   if($file2 != '.' && $file2 != '..' && $file2 != 'sticky' ){ 
      $total_forums2++; 
   } 
} 
closedir($countstuff2); 


if ($total_forums2 > 1) {
$getforums = "./addedforums/$t/";

  $handle_forums = opendir($getforums);

  while ( $forumcatfiles = readdir($handle_forums ))

   {

     if( $forumcatfiles == '.' || $forumcatfiles == '..' || $forumcatfiles == 'modify.txt')
     
     continue;
      
     $fcatlist [$forumcatfiles] = filemtime($getforums."/".$forumcatfiles);

     }

// use arsort

  arsort($fcatlist);


  while(list($t7)=each($fcatlist)) {

// strip the .txt off the end of the topics.
// this is the FORUM SHOWER

$thetopic2 = "$t7";

$topicstrip2 = strrpos($thetopic2, '.');

$topictitle2 = substr($thetopic2, 0, $topicstrip2);
require("forum_conf.php");
// count the topics
$countstuff = opendir("./forumposts_{$topictitle2}/"); 
$total_topics = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..' && $file != 'sticky'){ 
      $total_topics++; 
   } 
} 
closedir($countstuff); 

if ($showtopics > $total_topics ) {

$show = "$total_topics";

} else { 

$show = "$showtopics";

}
$yeah = str_replace("'", "", $yeah);
$forumdesc = file("./addedforums/$t/{$topictitle2}.txt");

$Forumlist = getarrayby_arsort("./addedforums/{$t}/");
$getkey = array_search_ci($Forumlist, "{$topictitle2}.txt");

$filemtime = filemtime("./addedforums/$t/{$topictitle2}.txt");

$filemtime=$filemtime-100000;
if($filemtime > 120000) $filemtime=0;
?>
<?
echo "<tr><td class=arcade1 valign=top width=1%><input type='hidden' name='hiddencat' value='$t'> <input type='text' size='1' name='number[]' value='$filemtime'><input type='hidden' size='1' name='forumname[]' value='{$topictitle2}.txt'></td><td class=arcade1 valign=top><a href='topicdisplay.php?forum=$topictitle2&show=$show'>$topictitle2</a><br>$forumdesc[0]<div align=left>$yeah<br></div></td><td class=arcade1 valign=top>[ <a href='?cparea=boards&eforum=$topictitle2&cat=$t&deleteforum=q'>Delete</a> ] <br> [ <a href='?cparea=permissions&forum=$topictitle2&cat=$t'>Permissions & Settings</a> ]</td>";

unset($latest_Replied_to);
unset($names_array);
unset($get_topic);
unset($forumtopiclistg);
}
}
?>
<tr><td class=headertableblock colspan=7><div align=center><input type=submit name='orderstuff' value='Reorder'></div></td></tr>
<?php
echo "</table></div><br></form>";
unset($fcatlist);
unset($cat);
unset($topictitle2);

//END HERE
//
//




}



}

?>
<?php
$countstuff = opendir("./addedforums/"); 
$total_forums = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..'){ 
      $total_forums++; 
   } 
} 
closedir($countstuff); 

if ($total_forums != 0) {
?>

<br><div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Add forum</font></b></td></tr><td width=50%% align=center class=arcade1><font size=-5>Forum Name</font></td><td width=20% align=center class=arcade1><font size=-5>Description</font></td><td width=30% align=center class=arcade1><font size=-5>Category</font></td><td width=10% align=center class=arcade1><font size=-5>Action</font></td></div><tr><td class=arcade1> <form method=post action="?cparea=boards"><div align=center><input type=text name=forum></center> </div></td><td class=arcade1><div align=center><b><input type=text name=desc></b></div></td><td class=arcade1>
<?
echo '<select size="1" name="cat">';
echo '<option value="None">Select a Category</option>';
// yes this has been stolen from the other part.

 $folder = "./addedforums";

  $handle_a = opendir($folder);

  while ( $topic_y = readdir($handle_a ))

   {

     if( $topic_y == '.' || $topic_y == '..' )
     
     continue;
      
     $forumtopiclist_h [$topic_y] = filemtime($folder."/".$topic_y);

     }

// use arsort

  arsort($forumtopiclist_h);

  while(list($t44)=each($forumtopiclist_h))

  {


echo "<option value='$t44'>$t44</option>";

}


echo "</select><br>";
echo "</td><td class=arcade1><input type='submit' value='Add' name='postgame'></td></table></div>";


?>
	</form></td>
</table>
<br>


<?php
}
?>

<div align='center'><div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><tr><td class=headertableblock colspan=9><b><font size=-5>Add Category</font></b></td></tr><td width=50%% align=center class=arcade1><font size=-5>Category Name</font></td><td width=10% align=center class=arcade1><font size=-5>Action</font></td></div><tr><td class=arcade1> <form method=post action="?cparea=boards"><div align=center><input type=text name=cat></center> </div></td><td class=arcade1><div align=center><input type='submit' value='Add' name='addcat'></div></td></table></div></form>


<?php
}
?>

<?php
} else {
?>

<div class='tableborder'><center>
<table width='100%' border='0' cellspacing='0' cellpadding='4'>
<td class='arcade1' width='100%' ><DIV ALIGN='CENTER'>[ Access Denied. You do not have administrator permission.  ]<br></DIV></td></table></div></div><br>

<?php
}
?>
<?php require("footer.php"); ?>
