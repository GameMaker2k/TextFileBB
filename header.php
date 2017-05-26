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
// Module: header.php - Last update: August 29, 2006
// ----------------------------------------------------------------------------------------
// Sanitised and Dereglobed OK
//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =


//error_reporting(0); 

if ($_GET['action'] == "logout") {
setcookie ("storedcookie_textfileBB_id", "", time( ) - 1);
setcookie ("storedcookie_textfileBB_pword", "", time( ) - 1);
echo "You are logged out. <a href=index.php>Forum Index</a>.";
die();
}

// Global Check on Account Login.
// There are still 10 million
// checks everywhere but I hope to remove them.



	// Here's how it works
	// I check if the cookie storedcookie_textfilebb_id is set
	// if it is, i htmlspecialchars this cookie.
	// Then, to block file inclusion, i preg_match it allowing
	// Only the very same characters on signup. If bad cookie data
	// is found it kills the page.
	//
	// Then it checks the passes. Do they match? if not it kills the page.
	// And so, if you want to make stuff that depends on the person being logged in
	//
	// Just do if(isset($_COOKIE['storedcookie_textfileBB_id'])) { echo "stuff"; } 
	//
	// Because this check on every page already validates login status for you and
	// requires in account variables.


$skinchoice='Default';

if(isset($_COOKIE['storedcookie_textfileBB_id'])) {

$acfile=htmlspecialchars($_COOKIE['storedcookie_textfileBB_id'], ENT_QUOTES);

if(preg_match("@[\W]@i", $acfile)) die("<a href='?action=logout'>Logout...</a>");


if(file_exists("./accounts/{$acfile}_user.php")) {

@include("./accounts/{$acfile}_user.php");

} else { 

die("<a href='?action=logout'>Logout...</a>");

}

if($_COOKIE['storedcookie_textfileBB_pword'] != $yourpassword) die("Username and password mismatch. <a href='?action=logout'>Logout...</a>");
$username=$_COOKIE['storedcookie_textfileBB_id'];

} else {
$acfile="Guest";
$username="Guest";
require("./accounts/guest_user.php");
}

// End Check

if ($_GET['reset']) {
$shoutsettings ="<?php\n\$email = '$email';\n\$skinchoice = 'Default';\n\$yourpassword = '$yourpassword';\n\$status = '$status';\n\$avatar = '$avatar';\n\$sig = '$sig';\n\$title = '$title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = 'notepad';\n\$birthday = '$birthday';\n\$postcount = '$postcount';\n?>";
$fp = fopen("./accounts/{$acfile}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);
}

$action=$_GET['action'];
if($_GET['forum']) { 
$forum = htmlspecialchars($_GET['forum'], ENT_QUOTES); 
$forum = str_replace(".", "", $_GET['forum']);
$forum = str_replace("/", "", $_GET['forum']);
if(preg_match("@[^\w ]@", $_GET['forum'])) die("");
}

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// Functions - Core textfileBB functions
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function displaybbcode () {
?>
<input type=button value=QUOTE onclick="document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+'[quote][/quote]'">

<input type=button value="http://" onclick="document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+&#39;[url][/url]&#39;">

<input type=button value="IMG" onclick="document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+&#39;[img][/img]&#39;">

<input type=button value=Bold onclick="document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+&#39;[B] [/B]&#39;">

<input type=button value=Italics onclick="document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+&#39;[I] [/I]&#39;">

<input type=button value=Underline onclick="document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+&#39;[U] [/U]&#39;">


<input type=button value=strike onclick="document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+&#39;[s] [/s]&#39;">

<input type=button value=Size onclick="document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+&#39;[size=] [/size]&#39;">

<input type=button value=Color onclick="document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+&#39;[color=] [/color]&#39;">

<input type=button value=Code onclick="document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+&#39;[code] [/code]&#39;">

<?php
}


function is_email($text){ 

$g=explode("@", $text);
if(count($g)==2) return true;
}


function eraseandreplace($dafile, $line, $replacewith) {
$file=file("$dafile");

                  $message = $file[$topicid];
	$file=file("$dafile");
	
	$gg = $replacewith; // dont know why it just wont work
                   $o = "\n";
	$file[$line]=$gg.$o; 
	$file3 = fopen("$dafile", "w"); 
	foreach($file as $v){
	fwrite($file3,"$v");
	}
	fclose($file3);

} 


	// BBcode function
	function bbcodeize($it) {
		global $thumbnailsize;
	$patterns = array(
	       
           "/\[url\](.*?)\[\/url\]/",
      	   "/\[img\](.*?)\[\/img\]/",
		   "/\[B\](.*?)\[\/B\]/",
           "/\[b\](.*?)\[\/b\]/",
           "/\[U\](.*?)\[\/U\]/",
           "/\[u\](.*?)\[\/u\]/",
           "/\[I\](.*?)\[\/I\]/",
           "/\[i\](.*?)\[\/i\]/",
           "/\[quote\](.*?)\[\/quote\]/",
           "/\[QUOTE\](.*?)\[\/QUOTE\]/",

		  "/\[code\](.*?)\[\/code\]/",
           "/\[CODE\](.*?)\[\/CODE\]/",

           "/\[s\](.*?)\[\/s\]/",
           "/\[S\](.*?)\[\/S\]/",
           "/\[attachment\](.*?)\[\/attachment\]/",
            "/\[url=(.*?)\](.*?)\[\/url\]/",
			"/\[color=(.*?)\](.*?)\[\/color\]/",
			"/\[size=(.*?)\](.*?)\[\/size\]/"
       );

       $replacements = array(
           "<a href=\"\\1\">\\1</a>",
	     "<a href='\\1'><img $thumbnailsize border=0 src='\\1'></a>",
		   "<b>\\1</b>",
           "<b>\\1</b>",
           "<u>\\1</u>",
           "<u>\\1</u>",
           "<i>\\1</i>",    
           "<i>\\1</i>",  
           "<div align=left><b>QUOTE:</b></div><div class=tableborder><table width=100%><td class=arcade1>\\1</td></table></div>",
           "<div align=left><b>QUOTE:</b></div><div class=tableborder><table width=100%><td class=arcade1>\\1</td></table></div>",
			              "<div align=left><b>CODE:</b></div><div class=tableborder><table width=100%><td class=arcade1><pre>\\1</pre></td></table></div>",
           "<div align=left><b>CODE:</b></div><div class=tableborder><table width=100%><td class=arcade1><pre>\\1</pre></td></table></div>",
           "<s>\\1</s>",
           "<s>\\1</s>",
           "<table><br><td class=arcade1 valign=top><b>Attached File</b>: <a href='uploads/\\1' target='_blank'><i>\\1</i></a></td></table>",
			"<a href=\"\\1\">\\2</a>",
			"<font color=\"\\1\">\\2</font>",
			"<font size=\"\\1\">\\2</font>"
       );

// Seems to work alright.
// learned about this from IPS forums xD
$it = preg_replace( "#javascript\:#is", "java script:", $it);
$it = preg_replace( "#moz\-binding:#is", "moz binding:", $it );
$it = preg_replace( "#vbscript\:#is", "vb script:", $it );
$it = str_replace( "`" , "`" , $it );

$it = preg_replace($patterns,$replacements, $it);
return $it;

}

	// wear is the function?!
	
	function is_a_quote($int) {
	$result = $int/3;
	$result= explode('.', $result);
                  $decimal = $result[1];
	if ($decimal[0] != "6") { 
	return false;
	} else {
	return true;
	}
	}

// function by Seanj

function striparray($a){ 
if (get_magic_quotes_gpc()) { 
foreach($a as $k=>$v) $b[$k]=is_array($v)?striparray($v):stripslashes($v); 
return $b; 
} else return $a; 
}

if ($_GET) { $_GET=striparray($_GET); }
if ($_POST) { $_POST=striparray($_POST); }

	function pages($vars,$number,$forum,$topicid, $stickyisit, $p) 
	{
	require("forum_conf.php");
	$hits = count(file("./forumposts_{$forum}/{$stickyisit}{$topicid}.php"))/3;

	$thingpage3 = $vars;
	$thing = $vars - $intopiclim;
	$varcheck3 = $thingpage3 - $hits-1;
          	if ($hits-1 > $thingpage3 || $varcheck3+2 < $intopiclim) {
if ($p != $number) {	
echo "<a href='viewtopic.php?topicid=$topicid&forum=$forum&limit=$thing&show=$thingpage3&p=$number'><u>$number</u></a> ";
} else {
echo "[ $number ] ";
}

	}
}


function error($info) {
echo "<div align='center'><div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Message</td><tr><td class=arcade1 valign=top><div align=center>$info</div></td></table></div><br>";
require("footer.php");
die();
}

function getarrayby_arsort($dir) {
 $s = "$dir";
 $handle = opendir($s);
  while ( $topic = readdir($handle ))
   {
     if( $topic == '.' || $topic == '..' || $topic == 'modify.txt' || $topic == 'old' || $topic == 'sticky')
     continue;
    $forumtopiclist [$topic] = filemtime($s."/".$topic);
     }
arsort($forumtopiclist);
//while(list($t)=each($forumtopiclist))
$x=0;
foreach($forumtopiclist as $key=>$value){
$t[$x]=$key; 
$x++;
}
return $t;
}


if ($_GET['action'] == "login") {

echo "";

} else {

function array_search_ci ($arr, $posted) {

foreach($arr as $key => $value) {
$string =strtoupper(trim($arr[$key]));
$uppercase_it = strtoupper($posted);
if ($uppercase_it == $string) {
return $key;
}
}

}

}

function displayemotes() { 

$smilies = file("emotes_faces.txt");
$smiliesp = file("emotes_pics.txt");
for($x=1;$x<count($smilies);$x++) {
$trim = rtrim($smilies[$x]);
echo "<img src=\"emoticons/$smiliesp[$x]\" onclick=\"document.forms['postbox'].elements['message'].value=document.forms['postbox'].elements['message'].value+&#39;$trim&#39;\"> ";
}

}

function uploaderprotect ($blah2) {
$pos=strpos($blah2,".",0);
$ext=trim(substr($blah2,$pos+1,strlen($blah2))," ");
$string="$blah2"; 
$acount=substr_count($string,"."); 
$counts=count_chars($string,0); 
$acount=$counts[ord(".")];
if ($acount != 1) {
echo "A file with two extentions is not allowed.";
DIE();
}
$ext = strtolower($ext);
$allowed_types= file("allowed_ext.txt");

$i=-1;
while ($i <= count($allowed_types)) {
$i++; 
$allowed = rtrim($allowed_types[$i]);

if ($ext == $allowed) {
$uploadfail='ok';
}

}

if ($uploadfail != ok) {

echo "<div align='center'>";
echo "<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Error: Extention Problem</td><tr>";

echo "<td class=arcade1 valign=top><div align=center>Your file has a .$ext extention. Sorry, this file type is not allowed.</div>";
echo "</td></table></div><br><br>";

require("footer.php");
die();


}

return $ext;
}


function eraseallfiles($dir) {
$countstuff = opendir("$dir"); 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..'){ 
      @unlink("{$dir}$file");
   } 
} 
closedir($countstuff); 
}
		// end functions

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-15"> 

<style type="text/css">@import"./skins/<?php echo $skinchoice; ?>.css";</style>


<?php


if ($cparea != macros) {


if (!file_exists("./skins/{$skinchoice}_img/macros.php")) { // O NOES IS IT BROKE?

// QUITE RLY :(

echo "<b>Internal Skin Error:</b> Some parts of the skin you are using are missing and we cannot continue. Please click <a href=index.php?reset=1>here</a> to reset your accounts skin back to deafult.<br><br>If you have tried that and have no luck, you will need to contact a forum admin, or, if you are the admin you must restore the default skin.</b>";

die();

}

require("./skins/{$skinchoice}_img/macros.php");

}

?>


<script type="text/javascript">
// Stupid JS
// "Official member of the JS haters club <_<"
function logout()
{
var name=confirm("Log off?")
if (name==true)
{
window.location="index.php?action=logout"
}
}
</script>

</head>
<body>


<?php

// Skin

echo $logo;

// Skin

$bannedfile = explode("\n", fread(fopen("banned.txt", "r"), filesize("banned.txt"))); 

foreach($bannedfile as $a_banned_ip){
 
$ipa = $_SERVER['REMOTE_ADDR'];

if ($ipa == $a_banned_ip){ 
$o ="h";
} 

} 
if ( $o == "h" ){ 

echo "<div align='center'>";
echo "<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Banned: $ipa</td><tr>";

echo "<td class=arcade1 valign=top><div align=center>Your IP ( $ipa ) has been banned from this board.</div>";
echo "</td></table></div><br><br>";

require("footer.php");
die();
} 

if(file_exists("chmodcheck.php")) require("chmodcheck.php");

readfile("header.html");
?>

<div align='center'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>User Menu</td><tr>

<td class=arcade1 valign="top"><div align=center>
<?php 
require("stopper.php");

if (isset($_COOKIE['storedcookie_textfileBB_id'])) {

$inbox = opendir("./accounts/{$acfile}_inbox/"); 
$var = 0; 
while($pminbox = readdir($inbox)){ 
   if($pminbox != '.' && $pminbox != '..' && $pminbox != 'sticky' ){ 
      $var++; }} 

closedir($inbox); 

if (!file_exists("./groups/{$status}.php")) {

if ($_GET['resetgroup']) {
require("./accounts/{$acfile}_user.php");
$shoutsettings ="<?php\n\$email = '$email';\n\$skinchoice = '$skinchoice';\n\$yourpassword = '$yourpassword';\n\$status = 'Member';\n\$avatar = '$avatar';\n\$sig = '$sig';\n\$title = '$title';\n\$signup_ipa = '$signup_ipa';\n\$msn = '$msn';\n\$yim = '$yim';\n\$aim='$aim';\n\$icq = '$icq';\n\$www='$www';\n\$notepad = 'notepad';\n\$birthday = '$birthday';\n\$postcount = '$postcount';\n?>";
$fp = fopen("./accounts/{$acfile}_user.php","w+");
fwrite($fp, $shoutsettings);
fclose($fp);
}


	error("Your group, $status no longer exists, it has been deleted. <a href='index.php?resetgroup=1'>Reset My Group</a>");

}

require("./groups/{$status}.php");



echo "[ Logged in: <B>$acfile</B> &middot; <a href=profile.php>Profile</a> &middot;";

if ($var > 0 ) {
echo " <blink><a href=inbox.php?action=read>Inbox ($var)</a></blink> &middot;";
} else {
echo " <a href=inbox.php?action=read>Inbox ($var)</a> &middot;";
}

if ($can_use_acp == Yes) { echo " <a href=admincp.php?cparea=idx>Admin CP</a> &middot; "; }


echo "<a href=javascript:logout()>Log Out</a> &middot; <a href=search.php?p=idx>Search</a> &middot; <a href=memberlist.php>Members</a>";

} else {

echo "Logged off : [ <a href=login.php>Login</a> | <a href=register.php>Register</a> | <a href=search.php?p=idx>Search</a> | <a href=memberlist.php>Members</a> </font>";


}

?> ]</div>
 </td>
</table>
</div>
<br>
<br>
<?php

if ($view_board == No) {
error("You do not have permission to view this forum.");
}


require("forum_conf.php");
if ($forum_offline == yes) {

require("./groups/{$status}.php");

if ($view_offline_board == No) {

$why = file_get_contents("offline_msg.txt");
echo "<div align='center'>";
echo "<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Offline Login</td><tr>";
echo "<td class=arcade1 valign=top>";
?>
<br>
<form action='login.php?action=login' method='POST'>
<?php
	if ($action==login) {
echo "<div align='center'>If you have permission to view the forum, <A href=index.php>Click here</a> to see it</div><br>";
}
?>
<div align='center'>User Name:</div></div><div align='center'><input type='text' name="userID" value=''></div><div align=center>Password:</div><div align='center'><input type='password' name='pword'  value=></div><br>
<div align='center'><input type=submit value='Login'></div><br><div align=center>Cant login? Please enable cookies on the site you're visiting.</div><br><div align=center>Always be logged in? <input type=checkbox name=cookiescheck>
</form>

<?php
	echo "</div>";
echo "</td></table></div><br><br>";

error("Forum offline.<br><br>$why");

}

}
?>