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
// Module: viewtopic.php - Last update: Mar 30th, 2006
// ----------------------------------------------------------------------------------------
//
// Sanitised and Dereglobed: OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

	// "wear" are the files?!
	require("header.php"); 
	require("moderate.php");
	require("stopper.php");
	require("forum_conf.php");

if($_GET['topicid']) if(!is_numeric($_GET['topicid'])) { 

error("Redirecting... <a href='index.php'>Click here</a>");
?>

<?php
}

$topicid=$_GET['topicid'];

$sticky='';
$limit = $_GET['limit'];
$show = $_GET['show'];

$num_pages_of =  $intopiclim;

// *************************
// Get for Pages
// *************************

$sw = $_GET['show'];

$page = $_GET['page'];
$pgn = $page + 1; 
$pgnm = $page - 1;

//**************************

// *************************
// Get for the LIMIT
// *************************
$lim = $_GET['limit'];
$limn = $limit + $num_pages_of; 
$limnm = $limit - $num_pages_of; 
//**************************

// *************************
// Get for the LIMIT
// *************************
$sw = $_GET['show'];
$swn = $show + $num_pages_of; 
$swnm = $show - $num_pages_of; 
//**************************


//=====================================================
// What board does this topic come from?
//=====================================================



$countstuff = opendir("./addedforums/"); 
$total_forums = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..' && $file != 'sticky' ){ 
      $total_forums++; 
   } 
} 
closedir($countstuff); 

	// Sean: WTH this can be made shorter! what is he doing?!
	// I know t_t LoL Sean XD

if ($total_forums != 0) {
// yes this has been stolen from the other part.

 $s = "./addedforums";

  $handle = opendir($s);

  while ( $topic = readdir($handle ))

   {

     if( $topic == '.' || $topic == '..' || $topic == 'sticky')
     
     continue;
      
     $forumtopiclist [$topic] = filemtime($s."/".$topic);

     }

// use arsort

  arsort($forumtopiclist);


  while(list($t)=each($forumtopiclist))

  {


// strip the .txt off the end of the topics.


$thetopic = "$t";



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



                  // Are you sticky today?
	if (file_exists("./forumposts_{$topictitle2}/sticky/{$topicid}.php")) {
	$forum = $topictitle2;
	$sticky = "sticky/";
	}

                  // "Well maybe your not" (get it? well if you don't you haven't seen JcinkHealth yet)
	if (file_exists("./forumposts_{$topictitle2}/{$topicid}.php")) {
	$forum = $topictitle2;
	$sticky='';
	}

	// well maybe you're old! f-jh.no-ip.org:82/oldppl/fart.txt
	if (file_exists("./forumposts_{$topictitle2}/old/{$topicid}.php")) {
	$forum = $topictitle2;
	$sticky = "old/";
	}


}
}
unset($fcatlist);

//END HERE
//
//




}



}


				  	if ($topicid == sticky) {
?>

<meta http-equiv="refresh" content="2;url=index.php">


<?php
error("Redirecting...");
}


				  require("stopper.php");

if(file_exists("./permissions/{$forum}.php")) { 
require("./permissions/{$forum}.php");
} else { 
error("The topic you specified no longer exists and could not be found. It may have been deleted or you have been given the wrong url."); 
}


	if ($can_read["$status"] != allowed) {
    error("You do not have permission to view this topic, $status.");
	}


	if ($password_needed == Yes) { // start if password needed

	$PasswordCookie = $_COOKIE["textfilebb_board_password"];

	if (!isset($PasswordCookie)) {

	if ($LoL_Sean) { 
	require("./permissions/{$forum}.php");
	if ($board_password != $LoL_Sean) {
	error("Access denied. Password incorrect.");
	} else {
	setcookie("textfilebb_board_password", "$LoL_Sean");
	error ("Access approved. Password correct. <a href='topicdisplay.php?forum=$forum'>Click here</a>");
	}
	}


echo "<div align='center'><div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Password Required</td><tr><td class=arcade1 valign=top><div align=center>This forum is password protected. If you are authorized, please enter the password below. <br><br><form action='' method='POST'><input type=text name=LoL_Sean><input type=submit name=go value=Go></div></td></table></div></form><br>";
require("footer.php");
die();

} //end isset

	if ($board_password != $PasswordCookie) {
	error("Access denied. Password cookie was wrong.");
} // end check

} // end if password needed


//=====================================

require("forum_conf.php");



$countstuff = opendir("./forumposts_{$forum}/{$sticky}"); 
$total_forums = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..' && $file != 'sticky' ){ 
      $total_forums++; 
   } 
} 
closedir($countstuff); 

require("forum_conf.php");


if(file_exists("./locked/{$forum}_forumhide_lockfile.lock")) {
require("footer.php");
die();
}

?>

<?php 

$topic_file_s = @file("./forumposts_{$forum}/{$sticky}{$topicid}.php");
if(!$topic_file_s) error("The topic you specified no longer exists and could not be found. It may have been deleted or you have been given the wrong url."); 
$hits = count($topic_file_s);  
?>

<title><?php echo "$forum_name => Viewing Topic: $topic_file_s[0]"; ?></title>


<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php><?php echo "$forum_name"; ?></a> &#187; <a href='topicdisplay.php?forum=<?php echo "$forum"; ?>'><?php if ($forum) { echo "$forum"; } ?></a> &#187; <a href='viewtopic.php?topicid=<?php echo "$topicid"; ?>'><B>Viewing Topic:</b></a> <?php echo $topic_file_s[0]; ?></td></table></div>
<br>

<?php



if (!$stickytopic) {

$file=file("./id_data/topic_view_count.txt");

                  $message = $file[$topicid];
	if ($message) 
	{
	$file=file("./id_data/topic_view_count.txt");
	
	$gg = $message+1;// dont know why it just wont work
                   $o = "\n";
	$file[$topicid]=$gg.$o; 
	$file3 = fopen("./id_data/topic_view_count.txt", "w"); 
	foreach($file as $v){
	fwrite($file3,"$v");
	}
	fclose($file3);
	}

if (file_exists("./forumposts_{$forum}/{$sticky}{$topicid}.php")) {

if ($replies-1 < $show) {
$dosubtract = $show - $replies - 1;
$resultoftest = $show - $dosubtract-1;
} else {
$resultoftest = $show+1;
}

	// No limit. <_>
	//
if (!$limit) {
$limit=3;
} else {
$limit = $limit*3+3;
}

$counter = "./forumposts_{$forum}/{$sticky}{$topicid}.php";  
$hits = count($topic_file_s)/3; // divide hits
$actual = count($topic_file_s);
require('forum_conf.php');

if (!$show) {
	//
	//  No show?
	//

if ($intopiclim > $hits-1 || $intopiclim == $hits-1) {
$show = $hits*3;
} else {
$show = $intopiclim*3+2;
}

} else {

if ($show > $hits-1) {
$show = $hits*3;
} else {
$show = $show*3+2;
}
}

$posts=$limit-1;
$ipa=$limit-2;

//*_*_**_*_*_*_*

if ($_GET['limit']) {
$y=$_GET['limit'];
}
?>
<div align='center'><div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><div style="float: left;">
<?php
// Page 1 starts here
echo "Pages: ";
	//
	// DM: "it makes no sense"
	//
$x2=0;
for($x7=$intopiclim;$x7<$actual;$x7+=$intopiclim){
$x2++;
pages("$x7","$x2","$forum","$topicid","$sticky","$p");
}
echo "</div><div align='right'><a href='add_reply.php?tr=1&topicid=$topicid&forum=$forum'>$add_reply</a> <a href='new_topic.php?forum=$forum'>$newtopic</a></div></div></td></table></div></div><br />";





for ($x=$limit; $x<$show; $x+=3)  {
$y++;
$posts+=3; 
$ipa+=3;



// file(); in the ID and name file

$registered_names = file("./id_data/member_names_num.txt");
$trimawaythenumber= rtrim($topic_file_s[$x]);
$trimawaythename = $registered_names[$trimawaythenumber];
$trimawaythename = rtrim($trimawaythename);
$requiredin = strtolower($trimawaythename);



require("./accounts/{$requiredin}_user.php");

require("./groups/{$status}.php");	

$postsofsomething = $topic_file_s[$posts];

$smilies = file("emotes_faces.txt");
$smiliesp = file("emotes_pics.txt");
$i=-1;
while ($i <= count($smilies)) {
$i++;
$postsofsomething = str_replace(rtrim($smilies[$i]), "<img src='emoticons/$smiliesp[$i]'>", $postsofsomething);

if ($parse_bbcode != No) {
       $postsofsomething = bbcodeize($postsofsomething);
} else {
$postsofsomething = $postsofsomething;
}
$sig = bbcodeize($sig);

//echo "$smilies[$i] replace with <img src='emoticons/$smiliesp[$i]'><br>";

}

// ====================================================================
// Mini How-To!
// You can add your own information to textfileBB that will go along with each post. The below
// area explodes the IP address line. Anything you want to add you should use this section.

$IPandmore_separate_data =  explode("``", $topic_file_s[$ipa]);

?>
<div class='tableborder'><table width='100%' cellpadding='4' cellspacing='1'><td width=15%% align=center class=headertableblock>User</td><td width=60%% align=center class=headertableblock>Post</td>

<tr><td class=arcade1 valign=top><?php echo "<a name='post$y'></a>"; ?>

<?php echo "<div style='font-size:1.0em'><A href=viewprofile.php?showuser=$trimawaythenumber>$trimawaythename</a></div>"; ?>

<?php echo $title; ?></b><br><img src='<?php echo $avatar; ?>'><br><img src='groups/icons/<?php echo "$group_icon" ?>'><br><br>Posts: <?php echo $postcount; ?><br>Group: <?php echo $status; ?><br>Skin: <?php echo $skinchoice; 
unset($can_use_modcp); 
?>

<br><br><br><br><br><br><br><br>
</td><td class=arcade1 valign=top><?php echo "$postsofsomething"; ?><br><br>-----------------<br><?php echo $sig; ?></td></tr><tr><td class=headertableblock><font size=-5>


<?php echo "<div align='left'><a href='#post$y'>Post #$y</a>"; ?> - <?php echo $IPandmore_separate_data[1]; ?> 
<?php 
require("stopper.php");
require("./groups/$status.php");

	
if ($can_use_modcp == Yes){ echo " - <a href='admincp.php?cparea=IPscan&serv=$IPandmore_separate_data[0]'>[IP]</i></a>"; } else { echo ''; } ?>

<?php require("./accounts/{$requiredin}_user.php"); ?>
</div></font></td><td class=headertableblock><div align=right><?php echo "<div style='float: left;'>";

if ($msn != "") {
?>
 <a href="javascript:window.open('messanger.php?p=MSN&user=<?php echo $msn ?>', 'Messanger', 'width=400,height=400,directories=no,location=no,menubar=no,resizable=no,scrollbars=yes,status=no,toolbar=no');void(0);"><?php echo "$msn_img"; ?></a>
<?php
}
?>
<?php 
if ($aim != "") {
?>
 <a href="javascript:window.open('messanger.php?p=AIM&user=<?php echo $aim ?>', 'Messanger', 'width=400,height=400,directories=no,location=no,menubar=no,resizable=no,scrollbars=yes,status=no,toolbar=no');void(0);"><?php echo "$aim_img"; ?></a>
<?php
}
?>
<?php 
if ($yim != "") {
?>
 <a href="javascript:window.open('messanger.php?p=YIM&user=<?php echo $yim ?>', 'Messanger', 'width=400,height=400,directories=no,location=no,menubar=no,resizable=no,scrollbars=yes,status=no,toolbar=no');void(0);"><?php echo "$yim_img"; ?></a>
<?php
}
?>
<?php 
if ($icq != "") {
?>
 <a href="javascript:window.open('messanger.php?p=ICQ&user=<?php echo $icq; ?>', 'Messanger', 'width=400,height=400,directories=no,location=no,menubar=no,resizable=no,scrollbars=yes,status=no,toolbar=no');void(0);"><?php echo "$icq_img"; ?></a>
<?php
}
?>

<?php 
if ($www != "") {
?>
 <a href="<?php echo $www; ?>"><?php echo "$www_img"; ?></a>
<?php
}

echo "<font size=-5>"; ?></div><?php unset($postcount); ?><?php unset($sig); ?> <?php unset($avatar); ?> <?php unset($title); ?><?php 
unset($status); 
require('stopper.php');
?><?php 
?><font size=-5><?php echo "<a href=\"add_reply.php?tr=1&topicid=$topicid&quote=$posts&forum=$forum\">$quote_img</a>"; ?><?php echo "<a href=\"edit_post.php?topic=$topicid&forum=$forum&line=$posts\">$edit_img</a>"; ?><?php if ($can_use_modcp == Yes && $posts != 5){ echo "<a href=\"?action=del&topic=$topicid&forum=$forum&line=$posts\">$delete_img</a>"; } ?></div></td></tr></table></div><br>
<?php

}


} else { }

} else { }


?>

</table>
</div>
<div align='center'><div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><div style="float: left;"><?php
// Page 1 starts here
echo "Pages: ";
	//
	// DM: "it makes no sense"
	//
$x2=0;
for($x7=$intopiclim;$x7<$actual;$x7+=$intopiclim){
$x2++;
pages("$x7","$x2","$forum","$topicid","$sticky","$p");

}
echo "</div><div align='right'><a href='add_reply.php?tr=1&topicid=$topicid&forum=$forum'>$add_reply</a> <a href='new_topic.php?forum=$forum'>$newtopic</a></div></div></td></table></div></div>";
?>
<br>
<br>

<?php
if ($can_use_modcp == Yes) {
?>
<form action='' method='GET'>
<input type='hidden' name='topica[]' value='<?php echo $topicid; ?>'>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock><select size="1" name="action"><option value='Default' selected>Action...</option><option value='stickythis'>Sticky</option><option value='unstickythis'>Unsticky</option><option value='delete'>Delete</option><option value='move'>Move</option><option value='lock'>Lock</option><option value='unlock'>Unlock</option><option value='bump'>Bump</option></select><input type=hidden name=forum value='<?php echo "$forum"; ?>'><input type=submit value=Go> </td>
</table>
</div>
</form>

<?php
	echo "<br>";
}
?>

<?php

require("./permissions/{$forum}.php"); 


	if ($can_reply["$status"] == allowed) {
		if ($allow_quick_reply == No) {
require("footer.php");
die();
		}

?>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Adding Reply in: <?php echo "$topic_file_s[0]"; ?></td><tr>
<td class=arcade1 valign="top"><div align=center><form action='add_reply.php?topicid=<?php echo $topicid ?>&forum=<?php echo "$forum"; ?><?php if ($stickytopic) { echo "&stickytopic=1"; }?>' method=post enctype="multipart/form-data" name="postbox">
<input type=hidden name=username value='<?php 
if ($status != Guest) {
$cookieusername = $_COOKIE['storedcookie_textfileBB_id']; 
echo "$cookieusername";
} else {
echo "Guest";
} ?>'>
<?php
	displaybbcode();
?>


<br><textarea cols=60 rows=5 class=input name=message>
<?php 

if ($quote) { 
$g = is_a_quote($quote);

if ($g==true) { 
$quoted = eregi_replace("<br>", "\n", $topic_file_s[$quote]);
echo "[quote] $reverse [/quote]"; 
} 

} 
?>
</textarea><br><br>
<?php
displayemotes();
?>
<br>

<?php
require("forum_conf.php");
if ($uploads_enabled == "yes") {

require("./permissions/{$forum}.php");


	if ($can_upload["$status"] == allowed) {

echo 'Attach File: <input type="file" name="swforpic"> <br /><br>';

}

}

?>

<input type=submit value='Add Reply'></div>
<?php

} else {
echo "";
}

?>
 </td>
</table>
</div>

<br>
<br>
<?php require("footer.php"); ?>