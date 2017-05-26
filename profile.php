<?php
require("header.php");
?>
<?
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
// Module: profile.php - Last update: April 1, 2006
// ----------------------------------------------------------------------------------------
//
// Sanitised and Dereglobed OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

?>
<br>
<?php

// theres probably way more code in here than has to be... 
// but i just want to get this part done for now.

require("forum_conf.php");
require("stopper.php");

require("./groups/{$status}.php");

if ($can_edit_profile == "No") {
error("Your group is disabled from editing your profile");
}

if ($_POST['updateskin']) {
require("./accounts/{$acfile}_user.php");
$updateskin = htmlspecialchars($_POST['updateskin'], ENT_QUOTES);
$shoutsettings ="<?php\n\$email = '$email';\n\$skinchoice = '$updateskin';\n\$yourpassword = '$yourpassword';\n\$status = '$status';\n\$avatar = '$avatar';\n\$sig = '$sig';\n\$title = '$title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = '$notepad';\n\$birthday = '$birthday';\n\$postcount = '$postcount';\n?>";
$fp = fopen("./accounts/{$acfile}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);
error("Skin updated. <a href='index.php'>Refresh</a> to see changes");
}


if ($_POST['updateprofile']) {

$posted_title = stripslashes(htmlspecialchars($_POST['posted_title'], ENT_QUOTES));
$email_update = htmlspecialchars($_POST['email_update'], ENT_QUOTES);

if(!is_email($_POST['email_update'])) error("Invalid Email");

$yim_update = htmlspecialchars($_POST['yim_update'], ENT_QUOTES);
$aim_update = htmlspecialchars($_POST['aim_update'], ENT_QUOTES);
$msn_update = htmlspecialchars($_POST['msn_update'], ENT_QUOTES);
$icq_update = htmlspecialchars($_POST['icq_update'], ENT_QUOTES);
$www_update = htmlspecialchars($_POST['www_update'], ENT_QUOTES);
$month = htmlspecialchars($_POST['month'], ENT_QUOTES);
$day = htmlspecialchars($_POST['day'], ENT_QUOTES);
$year= htmlspecialchars($_POST['year'], ENT_QUOTES);


$shoutsettings ="<?php\n\$email = '$email_update';\n\$skinchoice = '$skinchoice';\n\$yourpassword = '$yourpassword';\n\$status = '$status';\n\$avatar = '$avatar';\n\$sig = '$sig';\n\$title = '$posted_title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn_update';\n\$yim = '$yim_update';\n\$aim='$aim_update';\n\$icq = '$icq_update';\n\$www='$www_update';\n\$notepad = '$notepad';\n\$birthday = '$month.$day.$year';\n\$postcount = '$postcount';\n?>";
$fp = fopen("./accounts/{$acfile}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);

}

$uploadin=0;

if ($_POST['remoteavatar'] || $_FILES['uploadavatar']['tmp_name']) {


$message=$_POST['remoteavatar'];

if($avatar_upload_allowed=="Yes") {

if($_FILES['uploadavatar']['tmp_name']) {

$uploadin=1;

$folder = "./uploads/";
$temporary = $_FILES['uploadavatar']['tmp_name'];

if($_FILES['uploadavatar']['size'] > $avmax_size) {
error("The avatar is too big to be uploaded");
}


$realfilename = $_FILES['uploadavatar']['name'];
$extension = uploaderprotect($realfilename);

$temporary=str_replace(" ", "_", $temporary);
$realfilename=str_replace(" ", "_", $realfilename);

$randomnum=rand(0,999999);
$md5num=md5($randomnum);
$realfilename=$md5num.$realfilename;


move_uploaded_file($temporary, $folder.$realfilename) or error("Problem writing your uploaded avatar. Please contact the admin.");



$message=$folder.$realfilename;

}

if($_POST['remoteavatar']==$message) {
if($avatar_remote_allowed != 'Yes') {
if($_POST['remoteavatar']!="blank.gif") {
error("Remote avatars disabled, sorry");
}
}
}


}

$message=str_replace("#", "&#35;", $message);
$message=str_replace("&&#35;62;", "&#62;", $message); 
$message=str_replace("&&#35;60;", "&#60;", $message); 
$message  = htmlspecialchars($message, ENT_QUOTES);
$message=str_replace("javascript", "java&nbsp;script", $message);

if($avsize) {

$img_dims=@getimagesize($message);
$image_dims_set=explode("x", $avsize);

if(!$img_dims) {
if($uploadin) unlink($message);
error("Unable to reach server to check size, or invalid image file.");

}

if($img_dims[0] > $image_dims_set[0]) { 
	if($uploadin) unlink($message);
	error("Sorry, one of the dimensions in the avatar you wish to use is too big. The maximum is $avsize.");
}

if($img_dims[1] > $image_dims_set[1]) { 
	if($uploadin) unlink($message);
	error("Sorry, one of the dimensions in the avatar you wish to use is too big. The maximum is $avsize.");
}

}

$shoutsettings ="<?php\n\$email = '$email';\n\$skinchoice = '$skinchoice';\n\$yourpassword = '$yourpassword';\n\$status = '$status';\n\$avatar = '$message';\n\$sig = '$sig';\n\$title = '$title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = '$notepad';\n\$birthday = '$birthday';\n\$postcount = '$postcount';\n?>";

$fp = fopen("./accounts/{$acfile}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);

}

if ($_POST['updatesig']) {

require("clean_message.php");

if(strlen($_POST['message'])>$siglength) {
error("Your signature, is greater than $siglength characters. Please reduce the size.");
}

$shoutsettings ="<?php\n\$email = '$email';\n\$skinchoice = '$skinchoice';\n\$yourpassword = '$yourpassword';\n\$status = '$status';\n\$avatar = '$avatar';\n\$sig = '$message';\n\$title = '$title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = '$notepad';\n\$birthday = '$birthday';\n\$postcount = '$postcount';\n?>";

$fp = fopen("./accounts/{$acfile}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);
}


if ($_POST['updatenotepad']) {
$updatenotepad = stripslashes(htmlspecialchars($_POST['updatenotepad'], ENT_QUOTES));
$shoutsettings ="<?php\n\$email = '$email';\n\$skinchoice = '$skinchoice';\n\$yourpassword = '$yourpassword';\n\$status = '$status';\n\$avatar = '$avatar';\n\$sig = '$sig';\n\$title = '$title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = '$updatenotepad';\n\$birthday = '$birthday';\n\$postcount = '$postcount';\n?>";
$fp = fopen("./accounts/{$acfile}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);
}


require("./accounts/{$acfile}_user.php");

?>


<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; Editing Your Profile</td></table></div>
<br>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=20%% align=center class=headertableblock>Main Menu</td><td width=80%% align=center class=headertableblock>Edit your forum profile</td><tr>

<td class=arcade1 valign="top">

<div class=headertableblock>Inbox</div>
<br>
-- <a href="inbox.php?action=read">Read Messages</a><br>
-- <a href="mail.php?action=mail">Compose Message</a><br>
<br>
<div class=headertableblock>Your Profile</div>
<br>
 -- <a href="profile.php?action=editprofile">Edit Profile</a><br>
-- <a href="profile.php?action=avatar">Edit Avatar </a><br>
-- <a href="profile.php?action=sig">Edit Signature </a><br>
<br>
<div class=headertableblock>Board Settings</div>
<br>
-- <a href='profile.php?action=password'>Change Password</a><br>
-- <a href='profile.php?action=skin'>Skin Chooser</a><br>


 </td>


<td class=arcade1 valign="top">

<?php

if ($action == password) {

if ($_POST['newpass']) {
if ($_POST['newpass'] != $_POST['newpass2']) error("Your new passwords did not match, please try again"); 
$md5new = md5(sha1($_POST['newpass']));
$shoutsettings ="<?php\n\$email = '$email';\n\$skinchoice = '$skinchoice';\n\$yourpassword = '$md5new';\n\$status = '$status';\n\$avatar = '$avatar';\n\$sig = '$sig';\n\$title = '$title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = '$notepad';\n\$birthday = '$birthday';\n\$postcount = '$postcount';\n?>";
$fp = fopen("./accounts/{$acfile}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);
echo("Password changed. <a href='login.php'>Click here to login again with your new password.</a><br /><br />");

}


echo "<form action='' method=post>";
echo "New Password: <input type=text name=newpass><br><br>";
echo "RE-Enter New Password: <input type=text name=newpass2><br><br><input type=submit value='Change Password'></form>";
}


if ($action == editprofile) {

echo "<div align=center>";
echo "<form action=profile.php?action=editprofile method=post name=update_profile>";
echo "Custom Title:<br><input type=text name=posted_title value='$title'><br><br>";
echo "MSN:<br><input type=text name=msn_update value='$msn'><br><br>";
echo "AIM:<br> <input type=text name=aim_update value='$aim'><br><br>";
echo "ICQ:<br><input type=text name=icq_update value='$icq'><br><br>";
echo "YIM:<br><input type=text name=yim_update value='$yim'><br><br>";
echo "Homepage:<br><input type=text name=www_update value='$www'><br><br>";
echo "Your Email:<br><input type=text name=email_update value='$email'><br><br>";
echo "Your Birthday:<br><br>";
$bday = explode(".", $birthday);
?>
<select name="day">&nbsp;
				<option value='<?php echo $bday[1]; ?>'><?php echo $bday[1]; ?></option><option value='01'>1</option><option value='02'>2</option><option value='03'>3</option><option value='04'>4</option><option value='05'>5</option><option value='06'>6</option><option value='07'>7</option><option value='08'>8</option><option value='09'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option><option value='25'>25</option><option value='26'>26</option><option value='27'>27</option><option value='28'>28</option><option value='29'>29</option><option value='30'>30</option><option value='31'>31</option>
			</select> 
			<select name="month">&nbsp;
				<option value='<?php echo $bday[0]; ?>'><?php echo $bday[0]; ?></option><option value='1'>January</option><option value='2'>February</option><option value='3'>March</option><option value='4'>April</option><option value='5'>May</option><option value='6'>June</option><option value='7'>July</option><option value='8'>August</option><option value='9'>September</option><option value='10'>October</option><option value='11'>November</option><option value='12'>December</option>
			</select>
			<select name="year">&nbsp;
				<option value='<?php echo $bday[2]; ?>'>19<?php echo $bday[2]; ?></option><option value='99'>1999</option><option value='98'>1998</option><option value='97'>1997</option><option value='96'>1996</option><option value='95'>1995</option><option value='94'>1994</option><option value='93'>1993</option><option value='92'>1992</option><option value='91'>1991</option><option value='90'>1990</option><option value='89'>1989</option><option value='88'>1988</option><option value='87'>1987</option><option value='86'>1986</option><option value='85'>1985</option><option value='84'>1984</option><option value='83'>1983</option><option value='82'>1982</option><option value='81'>1981</option><option value='80'>1980</option><option value='79'>1979</option><option value='78'>1978</option><option value='77'>1977</option><option value='76'>1976</option><option value='75'>1975</option><option value='74'>1974</option><option value='73'>1973</option><option value='72'>1972</option><option value='71'>1971</option><option value='70'>1970</option><option value='69'>1969</option><option value='68'>1968</option><option value='67'>1967</option><option value='66'>1966</option><option value='65'>1965</option><option value='64'>1964</option><option value='63'>1963</option><option value='62'>1962</option><option value='61'>1961</option><option value='60'>1960</option><option value='59'>1959</option><option value='58'>1958</option><option value='57'>1957</option><option value='56'>1956</option><option value='55'>1955</option><option value='54'>1954</option><option value='53'>1953</option><option value='52'>1952</option><option value='51'>1951</option><option value='50'>1950</option><option value='49'>1949</option><option value='48'>1948</option><option value='47'>1947</option><option value='46'>1946</option><option value='45'>1945</option><option value='44'>1944</option><option value='43'>1943</option><option value='42'>1942</option><option value='41'>1941</option><option value='40'>1940</option><option value='39'>1939</option><option value='38'>1938</option><option value='37'>1937</option><option value='36'>1936</option><option value='35'>1935</option><option value='34'>1934</option><option value='33'>1933</option><option value='32'>1932</option><option value='31'>1931</option><option value='30'>1930</option><option value='29'>1929</option><option value='28'>1928</option><option value='27'>1927</option><option value='26'>1926</option><option value='25'>1925</option><option value='24'>1924</option><option value='23'>1923</option><option value='22'>1922</option><option value='21'>1921</option><option value='20'>1920</option><option value='19'>1919</option><option value='18'>1918</option><option value='17'>1917</option><option value='16'>1916</option><option value='15'>1915</option><option value='14'>1914</option><option value='13'>1913</option><option value='12'>1912</option><option value='11'>1911</option><option value='10'>1910</option><option value='09'>1909</option><option value='08'>1908</option><option value='07'>1907</option><option value='06'>1906</option>
			</select>
<?php
echo "<br><br>";
echo "<input type=submit value='Update Profile' name='updateprofile'></form>";
echo "</form>";
}



if ($action == sig) {
$sig = str_replace("<br>", "\n", $sig);
?>

<?php
displaybbcode();

echo "<form action='profile.php?action=sig' method=post enctype='multipart/form-data' name='postbox'><textarea rows=10 cols=60 class=input name=message>$sig</textarea><br><input type='submit' onclick=\"if (document.forms[0][0].value.length>$siglength) alert('Your sig is too long!'); else this.form.submit()\" name='updatesig' value='Update Signature'><br>";

displayemotes();
  
}

if (!$action) {
echo "<form action='profile.php' method=post enctype='multipart/form-data' name='postbox'>";
?>
<div class=headertableblock><div align=center>Welcome to your profile controls</div></div>
<br>Welcome to your profile, here you can change settings, read Inbox messages, pick different skins, and more.<br><br><br>
<div class=headertableblock><div align=center>Your Note Board</div></div>
<br>
<?php
echo "<div align=center><textarea rows=5 cols=60 class=input name=updatenotepad>$notepad</textarea><br><input type='submit' name='update_notes' value='Update Notes'></div><br>";
}

if ($action == skin) {

echo '<form action="profile.php?action=skin" method="POST"><select size="1" name="updateskin">';
echo "<option value='$skinchoice' selected>Select Skin... ($skinchoice)</option>";

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
if ($topictitle !="") {
     echo "<br><option value='$topictitle'>$topictitle</option>";
}

} 
echo '</select><br /><br><br>';
echo "<input type=submit value='Update Skin' name=;'skinsettings'></form>"; 
}


if ($action == avatar) {

echo "<div align=center>Current Avatar:<br>";
echo "<img src=\"$avatar\">";


echo "<form action='?action=avatar' method='POST' enctype='multipart/form-data'>";
if($avatar_remote_allowed=="Yes") {
echo "<br />Enter URL To Remote Avatar:<br>";
echo "<input type='text' name='remoteavatar' value='$avatar'><br /><br />";
}
if($avatar_upload_allowed=="Yes") {
echo "<br /><br />Upload an avatar from your PC:<br /><input type='file' name='uploadavatar'><br /><br />";
}
echo "<input type='submit' name='submit' value='Submit'></form><br><form action='?action=avatar' method='POST'><input type=hidden name='remoteavatar' value='blank.gif'><input type=submit value='Remove Avatar'></form>";

echo "<hr>";
echo "<form action='' method='GET'>Gallery Choices:<br><br>";
echo "<input type='hidden' name='action' value='$action'>";
echo '<select size="1" name="gallery">';
$dir = "./avatars/";
   if ($dh = opendir($dir)) {
       while (($file = readdir($dh)) !== false) {
		   if ($file != ".." && $file != ".") {
           echo "<option value='$file'>$file</option>";
		   }
       }
       closedir($dh);
}

echo "</select><input type='submit' name='submit' value='Go'></form>";

if ($_GET['gallery']) {
$gallery=$_GET['gallery'];
if(preg_match("@[^\w ]@", $_GET['gallery'])) error("Gallery error.");

$dir = "./avatars/$gallery";

if (is_dir($dir)) {
	echo "<form action='?action=avatar' method='POST'>";
   echo "";
   if ($dh = opendir($dir)) {
       while (($file = readdir($dh)) !== false) {
		   if ($file != ".." && $file != ".") {
           echo "[<input type='radio' name='remoteavatar' value='avatars/$gallery/$file'>] <img src='avatars/$gallery/$file'>";
		   }
		   echo "";
       }
       closedir($dh);
	   echo "<br><br><input type=submit name='submit' value='Select'></form>";
   }

}

}
}




?>

</td></div>
</table>
</div>
<br>
<?php
require("footer.php");
?>