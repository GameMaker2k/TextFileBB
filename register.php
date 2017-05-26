<?php
require("header.php");
require("forum_conf.php");
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
// Module: register.php - Last update: August 29, 2006
// ----------------------------------------------------------------------------------------
//
//  Sanitised and Dereglobed: OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
$postpassword=$_POST['postpassword'];
?>
<br>




<?php
	// they say they agree, start.
	if  ($_POST["agreed"]) {

$lowercase = strtolower($_POST["idnumber"]);
$lowercase=str_replace(" ", "_", $lowercase);

$normal=str_replace(" ", "_", $_POST["idnumber"]);

                 if  ($_POST["idnumber"] != "") {

	if(file_exists("./accounts/{$lowercase}_user.php")) {

                   error("An account with this name already exists, sorry");

	}

	if  ($_POST["idnumber"] == "") {
	 error("You forgot to type a username.");
	}

if (preg_match("/_user/i", $lowercase)) {
error("You cannot have _user in your username, sorry");
}

if(preg_match("@[\W]@i", $lowercase)) {   
   
error("The username that you tried to change the user to, has invalid characters. Spaces are also considered invalid characters, please use underscores indtead.");   
   
}   



}

$_POST['postpassword'] = htmlspecialchars($_POST['postpassword'], ENT_QUOTES);

if ($_POST['postpassword'] != $_POST['postpassword2']) {

	error(" Error! the passwords you entered don't match, please try again.");

}

if ($_POST['postpassword'] == "") {

	error(" Error! You didnt enter a password.");

}

if ($_POST['postpassword2'] == "") {

	error(" Error! You forgot to type a password in the re-enter your password box.");

}

if ($_POST['age'] < 13) {

error("Sorry, due to COPPA laws no one under 13 may join this forum without written parental consent.");

} 

$emailsign = htmlspecialchars($_POST['emailsign'], ENT_QUOTES);

if ($_POST['emailsign'] == "") {

error("You forgot to enter an email.");

} 

$f=is_email($emailsign);
if (!$f) error("Invalid email address");

// create the _user file
$fnew = fopen("./accounts/{$lowercase}_user.php", "w+"); 

$open = "./id_data/member_names_num.txt";
$quickwrite=fopen("$open", "a");
fwrite($quickwrite,  "$normal\n");

// - Write the account info...
require("forum_conf.php");
$ipa = $_SERVER['REMOTE_ADDR'];

$postpassword = md5(sha1($postpassword));

if ($use_validation != "On") {


$shoutsettings ="<?php\n\$email = '$emailsign';\n\$skinchoice = 'Default';\n\$yourpassword = '$postpassword';\n\$status = 'Member';\n\$avatar = 'blank.gif';\n\$sig = '';\n\$title = '';\n\$signup_ipa = '$ipa';\n\$msn = '';\n\$yim = '';\n\$aim='';\n\$icq = '';\n\$www='';\n\$notepad = 'notepad';\n\$birthday = '';\n\$postcount = '0';\n?>";
$fp = fopen("./accounts/{$lowercase}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);

mkdir("./accounts/{$lowercase}_inbox/");
mkdir("./accounts/{$lowercase}_outbox/");


} else {

$shoutsettings ="<?php\n\$email = '$emailsign';\n\$skinchoice = 'Default';\n\$yourpassword = '$postpassword';\n\$status = 'Validating';\n\$avatar = 'blank.gif';\n\$sig = '';\n\$title = '';\n\$signup_ipa = '$ipa';\n\$msn = '';\n\$yim = '';\n\$aim='';\n\$icq = '';\n\$www='';\n\$notepad = 'notepad';\n\$birthday = '';\n\$postcount = '0';\n?>";
$fp = fopen("./accounts/{$lowercase}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);

mkdir("./accounts/{$lowercase}_inbox/");
mkdir("./accounts/{$lowercase}_outbox/");

}

?>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Register Successful</td><tr>

<td class=arcade1 valign="top"><div align=center>Account registered successfully! <a href=login.php>Login...</a></div></div>
 </td>

</table>
</div><br>
<?php
}
?>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php><?php echo "$forum_name"; ?></a> &#187; Register!</td></table></div>
<br>

<form action='' method=post>
<div align='center'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Register</td><td width=60% align=center class=headertableblock></td><tr>

 <tr><td class="arcade1"><b>Enter a user name</b><br>Note: username cannot contain most special characters.</td><td class="arcade1"><input type='text' name='idnumber'></td></tr><tr><td class="arcade1"><b>Enter a password</b><br>Choose a secure password and dont make it your username or something easy to guess.</td><td class="arcade1"><input type="password" name="postpassword" value=""></td></tr><tr><td class="arcade1"><b>Re-enter your password</b><br>Please re-enter your password exactly as it was above.</td><td class="arcade1"><input type="password" name="postpassword2" value=""></td></tr><tr><td class="arcade1"><b>Email</b><br>Please enter your email.</td><td class="arcade1"><input type="text" name="emailsign" value=""></td></tr>


<tr><td class="arcade1"><b>Age</b><br>Please enter your age.</td><td class="arcade1"><input type="text" name="age" value=""></td></tr>

</div>
 </td>
</table>
</div>
<br>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Terms of use</td><tr>

<td class=arcade1 valign="top"><div align=center>
Please read fully and check the 'I agree' box ONLY if you agree to the terms 
<br><br>I agree to the Terms of use:<input type=checkbox value='iagreed' name='agreed'><br><br>
Please remember that we are not responsible for any messages posted. We do not vouch for or warrant the accuracy, completeness or usefulness of any message, and are not responsible for the contents of any message. The messages express the views of the author of the message, not necessarily the views of this BB. Any user who feels that a posted message is objectionable is encouraged to contact us immediately by email. We have the ability to remove objectionable messages and we will make every effort to do so, within a reasonable time frame, if we determine that removal is necessary. You agree, through your use of this service, that you will not use this BB to post any material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person's privacy, or otherwise violative of any law. You agree not to post any copyrighted material unless the copyright is owned by you or by this BB.<br><br></div></div>
<tr><td class=headertableblock colspan=0><div align=center><input type=submit name=post value='Register Me!'></div></td></tr>
</form>
 </td>
</table>
</div><br>

<?php
require("footer.php");
?>