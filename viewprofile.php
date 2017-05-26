<?php
require("header.php");
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
// Module: viewprofile.php - Last update: March 28, 2006
// Sanitised and Dereglobed: OK
// ----------------------------------------------------------------------------------------
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

if(!is_numeric($_GET['showuser'])) die();

$showuser=$_GET['showuser'];

require("forum_conf.php");

	// file(); in the ID and name file
	$registered_names = file("./id_data/member_names_num.txt");

$their_name_idnumber = $registered_names[$showuser];
$trimawaythename = rtrim($their_name_idnumber);

$requiredin = strtolower($their_name_idnumber);
$m = rtrim($requiredin);

echo "<title>Viewing Member's Profile: $their_name_idnumber</title>";
if(file_exists("./accounts/{$m}_user.php")) {
require("./accounts/{$m}_user.php");
?>

<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; Viewing Member's Profile</td></table></div>
<br>

<div align='center'>
<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=60% align=center class=headertableblock>Profile Data</td><td width=60% align=center class=headertableblock>Setting</td><tr>
<?php
	echo "<tr><td class='arcade1'><b>Name</b><br></td><td class='arcade1'>$their_name_idnumber</td>";
	echo "<tr><td class='arcade1'><b>Group</b><br></td><td class='arcade1'>$status</td>";
	echo "<tr><td class='arcade1'><b>Skin</b><br></td><td class='arcade1'>$skinchoice</td>";
	echo "<tr><td class='arcade1'><b>Posts</b><br></td><td class='arcade1'>$postcount</td>";
	echo "<tr><td class='arcade1'><b>Contact</b><br></td><td class='arcade1'>[ <a href='mail.php?replyname=$their_name_idnumber'>Inbox Message</a> ]</td>";
	echo "<tr><td class='arcade1'><b>Birthday</b><br></td><td class='arcade1'>$birthday</td>";
	echo "<tr><td class='arcade1'><b>Custom Title</b><br></td><td class='arcade1'>$title</td>";
?>
</table>
</div>
<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Member: <b><?php echo "$their_name_idnumber"; ?></td><tr>
<tr>
<td class=arcade1 valign="top"><div align=center><b>Avatar:</b><br> <img src='<?php echo "$avatar"; ?>'></div>
 </td>
</tr>
<tr>
<td class=arcade1 valign="top"><div align=center><b>Signature:</b><br> <?php echo bbcodeize($sig); ?></div>
 </td>
</tr>
</table>
</div>
<br>
<br>

<?php
require("footer.php");
die();
} else {
?>
<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Error</td><tr>
<tr>
<td class=arcade1 valign="top"><div align=center>Member does not exist.</div>
 </td>
</tr>
</table>
</div>
<br>
<br>
<br>
<br>
<?php
require("footer.php");
}
?>
