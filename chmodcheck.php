<?php

echo "<div align='center'><div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>TextfileBB installer</td><tr><td class=arcade1 valign=top><div align=left>";

if(!$_GET['action']) {

die("<hr><b><i>Step 1: Welcome!</i></b> --> Step 2: CHMOD Check --> Step 3: Finished <hr>Welcome to textfileBB install wizard!<br /><br />In just a few easy steps you'll have your new textfileBB forum online in no time. Please get your FTP details ready to be inputted if needed. <br /><br /><form action='index.php?action=next' method='post'><input type='submit' value='Proceed -->'></form></table></div> <div align='center'>TextfileBB , &copy; 2006 Jcink.com</div>");


} elseif($_GET['action']!="nextf") {

	echo "<hr>Step 1: Welcome! --> <b><i>Step 2: CHMOD Check</i></b> --> Step 3: Finished <hr>Your CHMOD permissions must be checked before you can use your forum. CHMOD means givin write permission to files. Without textfileBB having proper permissions setupid, errors in your forum will be displayed about being unable to write data. <hr> "; 

} else {

	echo "<hr>Step 1: Welcome! --> Step 2: CHMOD Check --> <b><i>Step 3: Finished</i></b> <hr>You are finished installing textfileBB. Congratulations and thanks for installing! <br /><br />When you refresh this page, your forum will appear. If it does not, please try deleting the file \"chmodcheck.php\" however, this installer should erase itself.<hr> "; 

unlink("chmodcheck.php");
}


function ftp_chdir_mass ($dir) {
global $conn_id;
$dirs=explode("/", $dir);
foreach ($dirs as $k=>$v){
$f=@ftp_chdir($conn_id, $v);
if($f) { $result=true; }
}
return $result;
}

function ftp_chmod2 ($file,$chmod,$conn_id) {
        $g=ftp_site($conn_id, "CHMOD $chmod ".$file);
	return $g;
}

$files=Array('chmodcheck.php','forum_conf.php','groups/','groups/Admin.php','groups/Banned.php','groups/Member.php','groups/Guest.php','groups/Moderator.php','groups/Validating.php','permissions/','permissions/A test forum.php','postcounts/A test forum.txt','postcounts/','header.html','footer.html','banned.txt','emotes_pics.txt','emotes_faces.txt','locked/','sessionsfolder/','id_data/','id_data/member_names_num.txt','id_data/pm_id_num.txt','id_data/topic_id_num.txt','id_data/topic_view_count.txt','accounts/','accounts/admin_inbox/','accounts/admin_outbox/','accounts/guest_inbox','accounts/guest_outbox','accounts/admin_user.php','accounts/guest_user.php','addedforums/A test cat','addedforums/','addedforums/A test cat/A test forum.txt','addedforums/A test cat/modify.txt','uploads/','forumposts_A test forum/','forumposts_A test forum/old/','forumposts_A test forum/sticky/','upload_log.php','skins/','skins/BlackDefault_img','skins/BlackDefault_img/macros.php','skins/Default_img','skins/Default_img/macros.php','skins/BlackDefault.css','skins/Default.css');

if($_POST['test_ftp']) {

// set up basic connection
$conn_id = @ftp_connect($_POST['ftp_host']);


if(!$conn_id) { 
echo "FTP Connection... <font color='red'>FAILED</font> to $_POST[ftp_host]. Please try again.";
die();
} else {
echo "FTP Connection... <font color='green'>OK</font> to $_POST[ftp_host].";
}

// login with username and password
$login_result = ftp_login($conn_id, $_POST['ftp_username'], $_POST['ftp_pass']);

if(!$login_result) { 
echo "FTP Login... <font color='red'>FAILED</font>. Please check name and pass and try again.";
die();
} else {
echo "<br>FTP Login... <font color='green'>OK</font> .";
}

$test=ftp_chdir_mass ($_POST['ftp_chdir']);
echo "<br>";
if(!$test) { 

echo "FTP Connection... <font color='red'>FAILED</font> Switching through directories to the textfileBB one at $_POST[ftp_chdir] please make sure you typed it correctly."; 

} else {
echo "FTP Connection... <font color='green'>OK</font>.<br />";
echo "The current directory is: "; 
echo ftp_pwd($conn_id);
echo "<br>Proceeding to try to CHMOD.<br><br>";




}

foreach ($files as $k=>$v){
if(ftp_chmod2($v,777,$conn_id)) {
echo "CHMODDING $v ..... <font color='green'>OK</font><br>";
} else {
echo "CHMODDING $v ..... <font color='red'>FAILED</font><br>";

die("<br><br>FTP disconnected. Stopped on failure of $v. Please check that this file exists, or that you typed the path correctly.");

}

}

$hmm="./";
ftp_chmod2($hmm,777,$conn_id);

echo "<hr>The CHMODDing was successful! <hr> <a href='index.php?action=next'> << Click here to Continue >> </a></table></div><br>TextfileBB Chmod Checker &copy; 2006 Jcink.com";

die();

}


echo "<title>TextfileBB installer</title>";

if (!$_SERVER['WINDIR']) {

if($_GET['action']=="next") {
foreach ($files as $k=>$v){
$g=substr(sprintf("%o",@fileperms("./$v")),-3);
if($g == 777) { 
echo "CHMOD Checking... <font color=green>OK</font> on .............................. <font color=blue>$v</font>.<br /><br />"; 
} else {
echo "CHMOD Checking...  <font color=red>FAILED</font> on .............................. <font color=blue>$v</font>. Permissions are $g.<br /><br />";
$failure=1; 
}
}

}
} else {
}



if($failure) { 
echo "<hr>";
echo "Results: The CHMOD check was a failure. Please check above for the files which need to be CHMODDED. If you would like textfileBB to do all of this for you, look below.";
}



?>
<?php
if($failure) { 

if(function_exists('ftp_connect')) {
echo "<hr>";

echo "</table></div> <br /> <div align='center'><div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock> Auto CHMOD tool Available </td><tr><td class=arcade1 valign=top><div align=left>";

echo "<hr>";
echo "Would you like textfileBB to try to CHMOD the files for you? If yes, please insert your FTP info below and press the Connect Now button. If it can, then your files will be chmodded automatically. Pay attention to what you put down as the FULL ftp path, or it might not work. If it doesn't it'll tell you.";
echo "<hr>";
echo "<form action='index.php?action=next' method='POST'>FTP Path to TextfileBB (do NOT include trailing slash!):<input type='text' name='ftp_chdir'><br>FTP username: <input type='text' name='ftp_username'><br>FTP password:<input type='text' name='ftp_pass'><br>FTP Host:<input type='text' name='ftp_host'><br><input type='submit' name='test_ftp' value='Connect Now'></form>";

}

echo "</table></div> <br /> <div align='center'><div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock> Skipping </td><tr><td class=arcade1 valign=top><div align=left> If you <b>know</b> for a fact that the permissions are correct but this installer is not picking up the permissions correctly, you can skip this step and move on to the final. However, this is NOT advised. <br/><form action='index.php?action=nextf' method='post'><input type='submit' value='Proceed To Final Step -->'></form>";


} else { 



if($_GET['action']!="nextf") {


if ($_SERVER['WINDIR']) {
echo "<hr>Microsoft Windows(tm) Operating System has been detected on this server. This filesystem does not require permissions setup. <br/><br/><br/>Therefore, CHMOD check has been skipped.<br /><br /><form action='index.php?action=nextf' method='post'><input type='submit' value='Proceed To Final Step -->'></form>";
} else {
echo "<hr>Your permissions are correctly setup! You may now proceed to the final step. <br/><br/><br/>CHMOD check has finished.<br /><br /><form action='index.php?action=nextf' method='post'><input type='submit' value='Proceed To Final Step -->'></form>";
}

}






}

die("</table></div> <div align='center'>TextfileBB, &copy; 2006 Jcink.com</div>");
?>
