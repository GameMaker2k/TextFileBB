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
// Module: login.php - Last update: April 07, 2006
// ----------------------------------------------------------------------------------------
// Santized and Dereglobed: OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

if ($_GET['action'] == "login") {

function array_search_ci ($arr, $posted) {
foreach ($arr as $key => $value) {
$string =strtoupper(trim($arr[$key]));
$uppercase_it = strtoupper($posted);
if ($uppercase_it == $string) {
return $key;
}
}
}

}

if ($_POST['pword']) {

// Ask for that userid file
$userID=str_replace(" ","_", $_POST['userID']);

$register_id = file("./id_data/member_names_num.txt");
$result = array_search_ci($register_id, "$userID");
if ($result != "") {
$get = $register_id[$result];
} else {
die("Login failed.");
}

$idnumber = strtolower(rtrim($get));
$lowercase = strtolower($idnumber);
$lowercase=str_replace(" ","_", $lowercase);

require("./accounts/{$lowercase}_user.php");

$md5ed = md5(sha1($_POST['pword']));

if ($yourpassword != $md5ed) {

// If it turns out that the password and ID don't match
// what's found in the file, totally die and tell the user 
// to give it another try.

echo "The User ID, and password you entered, was wrong. <A href='forgotpass.php'>Forgot Password?</a>";
die();
}


// But if it ISN'T! Don't die!
//

//============================
// Save logon information
//============================


// check for the checkbox - was it pressed? if so...
if ($cookiescheck) {

// Set Cookies. 1 is the userid cookie
//

setcookie("storedcookie_textfileBB_id", "$lowercase", time()+9999999);

//
// Next is the password cookie
//

setcookie("storedcookie_textfileBB_pword", "$md5ed", time()+9999999);

} else {


// Set Cookies. 1 is the userid cookie
//

setcookie("storedcookie_textfileBB_id", "$lowercase");

//
// Next is the password cookie
//

setcookie("storedcookie_textfileBB_pword", "$md5ed");

}

}

require("header.php");
require("forum_conf.php");
?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php><?php echo "$forum_name"; ?></a> &#187; Log In!</td></table></div>
<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Login</td><tr>

<td class=arcade1 valign="top"><div align=center>

<?php
echo "<form method='post' action='?action=login'>";
?>
<?php
if ($_POST['pword']) {

echo "<div align='center'>You are now logged in as [ $userID ] <br><br>[ <a href=index.php><b>Go to the forum</b></a> ] </div><br>";

}
?>

<div align=center>User Name:</div><div align='center'><input type='text' name="userID"></div><div align=center>Password:</div><div align='center'><input type='password' name='pword'  value=></div><br>
<div align='center'><input type=submit value='Login'></div><br><div align=center>Cant login? Please enable cookies on the site you're visiting.</div><br><div align=center>Always be logged in? <input type=checkbox name=cookiescheck>
</form>

</div>
 </td>
</table>
</div>
<br>
<?php require("footer.php"); ?>