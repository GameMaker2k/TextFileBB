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
// Module: messanger.php - Last update: April 1st, 2006
// ----------------------------------------------------------------------------------------
// Sanitised and Dereglobed OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

require("stopper.php");

$user=htmlspecialchars($_GET['user'], ENT_QUOTES); 
$mess=htmlspecialchars($_GET['mess'], ENT_QUOTES);

require("forum_conf.php");
echo "<title>$forum_name</title>";
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-15"> 

<?php

if (isset($cookies)) {
require("./accounts/{$acfile}_user.php");

?>

<style type="text/css">@import"./skins/<?php echo "$skinchoice"; ?>.css";</style>

<?php
} else {

$skinchoice = "Default";

?>

<style type="text/css">@import"./skins/Default.css";</style>

<?php
} 
?>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Messanger information: <?php echo "$mess"; ?></td><tr>
<td class=arcade1 valign="top"><div align=center>
<?php

	// AIM

if ($_GET['p']==AIM) {
?>
<!-- Begin AIM Remote -->
<table width='140' align='center'>
<tr align='right'><td><a href="http://www.aol.co.uk/aim/index.html"><img src="http://www.aol.co.uk/aim/remote/gr/aimver_man.gif" width=44 height=55 border=0 alt="Download AIM"></a><img src="http://www.aol.co.uk/aim/remote/gr/aimver_topsm.gif" width=73 height=55 border=0 alt="AIM Remote"><br /><a href="aim:goim?screenname=<?php echo $user; ?>&amp;message=Hi.+Are+you+there?"><img src="http://www.aol.co.uk/aim/remote/gr/aimver_im.gif" width=117 height=39 border=0 alt="Send me an Instant Message"></a><br /><a href="aim:addbuddy?screenname=<?php echo $user; ?>"><img src="http://www.aol.co.uk/aim/remote/gr/aimver_bud.gif" width=117 height=39 border=0 alt="Add me to Your Buddy List"></a><br /><a href="http://www.aol.co.uk/aim/remote.html"><img src="http://www.aol.co.uk/aim/remote/gr/aimver_botadd.gif" width=117 height=23 border=0 alt="Add Remote to Your Page"></a><br /><a href="http://www.aol.co.uk/aim/index.html"><img src="http://www.aol.co.uk/aim/remote/gr/aimver_botdow.gif" width=117 height=29 border=0 alt="Download AOL Instant Messenger"></a><br /><br /></td></tr></table>
<!-- End AIM Remote -->
Username: $user
<?php
}	
// Jcink: Get on YIM <_<
elseif ($_GET['p']==YIM) {
?>
<b>Yahoo! Online Status: <?php echo $user; ?></b><br>
<img border=0 src="http://opi.yahoo.com/online?u=<?php echo "$user"; ?>&amp;m=g&amp;t=2"><br><br>
 <a href="http://edit.yahoo.com/config/send_webmesg?.target=<?php echo "$user"; ?>&amp;.src=pg">Send this member a Yahoo! Message</a><br>
<a href="http://members.yahoo.com/interests?.oc=t&amp;.kw=<?php echo "$user"; ?>&amp;.sb=1">View Yahoo! Profile</a>
<?php
} elseif ($_GET['p']==MSN){
?>
MSN: <?php echo $user; ?><BR><BR>
<?php
} elseif($_GET['p']==ICQ) {
?>
<img src="http://web.icq.com/whitepages/online?icq=<?php echo $user; ?>&img=5"> ICQ number: <?php echo $user; ?><br><br><a href="http://www.icq.com/whitepages/wwp.php?Uin=<?php echo $user; ?>">ICQ Profile Page</a>
<?
}
?>
<b></b>
</b></div>
</b></div>
 </td>
</table>
</div>
</div><br>