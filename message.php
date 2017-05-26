<?php 
require("header.php"); 
require("moderate.php");
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
// Module: message.php - Last update: Nov 19, 2005
// ----------------------------------------------------------------------------------------
//
// Sanitised and Dereglobed OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

if(!isset($_COOKIE['storedcookie_textfileBB_id'])) error("You must login to access your inbox.");

if(!is_numeric($_GET[messageid])) die();
$linecount = '1';
require("forum_conf.php");
$messageid=$_GET[messageid];
?>

<title><?php echo "$forum_name - Your Inbox" ?></title>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php><?php echo "$forum_name"; ?></a> &#187; <a href=inbox.php>Inbox</a> &#187; Viewing Message</td></table></div>
<br>

<br>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=15%% align=center class=headertableblock>User Info</td><td width=60%% align=center class=headertableblock>Inbox Message</td><tr>

<?php
if (file_exists("./accounts/{$acfile}_outbox/{$messageid}.php")) {
$info = @file("./accounts/{$acfile}_outbox/{$messageid}.php");
} else {
$info = @file("./accounts/{$acfile}_inbox/{$messageid}.php");
}

if(!$info) die();

$replace = str_replace("<?php die(); ?>", "", $info[0]);
$memberfile = file("./id_data/member_names_num.txt");
$thiseh = rtrim($info[1]);
$postsofsomething = $info[3];
$postsofsomething = bbcodeize($postsofsomething);
$sig = bbcodeize($sig);

?>
<tr><td class=arcade1 valign=top><b><?php echo $memberfile[$thiseh]; ?></b><br><br><br><br><br><br><br></td><td class=arcade1 valign=top><?php echo $postsofsomething; ?><br><br>-----------------<br></td></tr><tr><td class=headertableblock><font size=-5>Date: <?php echo $info[2]; ?></font></td><td class=headertableblock><div align=right><a href="mail.php?replysubject=Re: <?php echo $replace; ?>&replyname=<?php echo $memberfile[$thiseh]; ?>&action=do">[Reply]</a> &middot; <a href="inbox.php?delete=<?php echo $messageid; ?>&action=do">[Delete]</a></div></td></tr>

<?php
if ($_GET['read'] == "1") {
@rename("./accounts/{$acfile}_inbox/{$messageid}.php", "./accounts/{$acfile}_outbox/{$messageid}.php");
}

?>

</table>
</div>
<br>
<?php require("footer.php"); ?>