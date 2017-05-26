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
// Module: forgotpass.php - Last update: April 1, 2006
// ----------------------------------------------------------------------------------------
// Sanitised and Dereglobed OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

if ($_GET['user']) {


if(preg_match("@[\W]@i", $_GET['user'])) { 

die("Invalid Characters in name"); 

} else {

require("./accounts/{$_GET['user']}_user.php");

}


if ($yourpassword != $_GET['password']) {

// If it turns out that the password and ID don't match
// what's found in the file, totally die and tell the user 
// to give it another try.

echo "Passwords mismatch.";
die();
}


// But if it ISN'T! Don't die!
//

//============================
// Save logon information
//============================


// check for the checkbox - was it pressed? if so...


// Set Cookies. 1 is the userid cookie
//

setcookie("storedcookie_textfileBB_id", $_GET['user']);

//
// Next is the password cookie
//

setcookie("storedcookie_textfileBB_pword", $_GET['password']);

require("header.php");

error("Password recovery successfully, logged in. Please go to <a href='profile.php'>Your Profile</a> and update your password");

}

require("header.php");

if ($password_recovery_allowed == "No") {
error("Sorry, ability to recover passwords is disabled on this board.");
}

?>
<?php

if ($_POST['message']) {

if ($_POST['message'] == "") { 

error("You forgot to type in an email");

}

if ($_POST['messageperson'] == "") { 
error("You left the Send to line blank");
}

$messageperson = strtolower($_POST['messageperson']);

if(preg_match("@[\W]@i", $messageperson)) die("Invalid Characters in name");



if (!file_exists("./accounts/{$messageperson}_user.php")) {
error("The user, $messageperson is not registered at this forum");
}

require("./accounts/{$messageperson}_user.php"); 

if ($_POST['message'] != $email) {

error("The email on file for $messageperson, does not match the email you inputted");

} else {

// Send the email now...
$msg = $_POST['message'];
$httpflash = "http://";
$SiteDomain = $httpflash.$HTTP_HOST.$PHP_SELF."?user=$messageperson&password=$yourpassword";
$hd = "";
$members = $email;
$mailsub = "Password Recovery From $forum_name site";
$mailbody = "Dear $messageperson, \n\n A password recovery attempt has been made on your account at the $forum_name. If you did not request password recovery ( also known as forgot password form ). If you did not request password recovery, the IP address of the internet user who did was $_SERVER[REMOTE_ADDR]. Please contact a forum admin at $forum_name about this. \n\n\n Visit the link below to login to your account again: \n ----------------------------------------------- \n $SiteDomain \n--------------------------------\n When you login, visit change password in your profile to setup a new password.";
$headers = "From: $hd\n";
mail($members,$mailsub,$mailbody,$headers);


?>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Success</td><tr>

<td class=arcade1 valign="top"><div align=center>Password recovery email sent. You should recieve it in the next 5 minutes to an hour.</div>
 </td>
</table>
</div>
<br>
<?php
}
}
?>


<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; Forgot password</td></table></div><br>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Send Password</td><tr>

<td class=arcade1 valign="top"><div align=center><form action='' method=post enctype="multipart/form-data" name="postbox">
<br>Your Forums Username: <br><input type=text name=messageperson value=''><br><br>

<br>Your Email: <br><input type=text name=message><br><br>
<br><br><input type=submit value='Send E-Mail'></div>
 </td>
</table>
</div>
<br><br>
<?php
require("footer.php");
?>