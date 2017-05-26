<?php
ob_start();

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
// Module: topicdisplay.php - Last update: Sept 28, 2006
// ----------------------------------------------------------------------------------------
//
//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

	// "wear" are the files?!

	require("header.php");
	require("moderate.php");
	require("forum_conf.php");

$cookie_filter_forum=str_replace(" ", "_", $forum);

$cookievarname="newposts_{$cookie_filter_forum}";
$NewPostsCheck=explode(",", $_COOKIE[$cookievarname]);

$TopicNewCheckArray=Array();

foreach($NewPostsCheck as $key=>$value){ 

$gogobunchierangeeeerrrrsss=explode("|", $value);
$TopicNewCheckArray[$gogobunchierangeeeerrrrsss[0]]=$gogobunchierangeeeerrrrsss[1];

}







	$arch='';
	// Are we opening an archive?
      if ($_GET['archive'] == 1) {
	$arch = 'old/';
	}

	// Get the permissions file...
$forum=htmlspecialchars($forum, ENT_QUOTES);
if(file_exists("./permissions/{$forum}.php")) {

                 require("./permissions/{$forum}.php");
	if ($can_read["$status"] != allowed) {
	error("You do not have permission to view this forum.");
	}

} else {
error("Invalid forum ID");
}

	if ($password_needed == Yes) { // start if password needed

	$PasswordCookie = $_COOKIE["textfilebb_board_password"];

	if (!isset($PasswordCookie)) {

	if ($_POST['LoL_Sean']) {
	require("./permissions/{$forum}.php");
	if ($board_password != $_POST['LoL_Sean']) {
	error("Access denied. Password incorrect.");
	} else {
	setcookie("textfilebb_board_password", $_POST['LoL_Sean']);
	error ("Access approved. Password correct. <a href='topicdisplay.php?forum=$forum'>Click here</a>");
	}
	}


echo "<div align='center'><div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Password Required</td><tr><td class=arcade1 valign=top><div align=center>This forum is password protected. If you are authorized, please enter the password below. <br><br><form action='' method='POST'><input type=text name=LoL_Sean><input type=submit name=go value=Go></form></div></td></table></div><br>";

require("footer.php");
die();

} //end isset

	if ($board_password != $PasswordCookie) {
	error("Access denied. Password cookie was wrong.");
} // end check

} // end if password needed



	//gues this is wear i put the function
//======================================


function topiclist($forum,$topictitle,$sticky) {
$counter = "./forumposts_{$forum}/{$sticky}{$topictitle}.php";  
$hits = count(@file($counter))/3;  

require('forum_conf.php');

if ($hits-1 > $intopiclim) {

// Page 1 starts here
echo "  (Pages: <a href='viewtopic.php?topicid=$topictitle&forum=$forum&limit=0&show=$intopiclim&p=1'><u>1</u></a>";

// Page 2 check
if ($hits-1 > $intopiclim) {
$thing = $intopiclim+$intopiclim;
echo " <a href='viewtopic.php?topicid=$topictitle&forum=$forum&limit=$intopiclim&show=$thing&p=2'><u>2</u></a>";
}

// Page 3 check
if ($hits-1 > $intopiclim+$intopiclim) {
$thingpage3 = $intopiclim+$intopiclim+$intopiclim;
echo " <a href='viewtopic.php?topicid=$topictitle&forum=$forum&limit=$thing&show=$thingpage3&p=3'><u>3</u></a>";
}

$finalpage = $intopiclim + $intopiclim + $intopiclim;

// Final Page
if ($hits-1 > $finalpage) {
$howmany = $hits/$intopiclim;

	// Hmm I think it's that what, even though you have .5 you still round down?
	// So I add .2
	// I can see it now... if DM ever sees this it will be "wHY are you rounding?!?!"

$r = round($howmany+.2);
$s=$intopiclim*$r;
$l=$s-$intopiclim;

//if ($l == $hits-1) {
//$s=$intopiclim*$r2;
//$l=$s-$intopiclim;
//}

echo " ... <a href='viewtopic.php?topicid=$topictitle&forum=$forum&limit=$l&show=$s'><u>&#187;</u></a>";
}

echo ")";

}

}

//=====================================


// Define limit and show...
// And check for the limit var

$limit = $_GET['limit'];
$show = $_GET['show'];


	if (!$limit) {
	$limit=0;
}
	if (!$page) {
	$page=1;
}
if (!$show) {
require('forum_conf.php');

$countstuff = opendir("./forumposts_{$forum}/{$arch}"); 
$total_forums = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..' && $file != 'sticky' ){ 
      $total_forums++; 
   } 
} 
closedir($countstuff); 

if ($showtopics > $total_forums ) {
$show = "$total_forums";
} else { 
$show = "$showtopics";
}

}

// lazyness or "smth" >_>
$num_pages_of = $showtopics;

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



require("forum_conf.php");
echo "<title>$forum_name - $forum</title>";

if(file_exists("./locked/{$forum}_forumhide_lockfile.lock")) {
?>

<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Locked Forum</td><tr>

<td class=arcade1 valign="top"><div align=center>This forum has been locked from view.</div>
 </td>
</table>
</div>
<br>

<?php
require("footer.php");
die();
}

if ($forum == "") { 
?>
<br>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=60%% align=center class=headertableblock>Error</td><tr>

<td class=arcade1 valign="top"><div align=center>There is no forum here. Are you looking for the <a href="index.php">forum index?</a></div>
 </td>
</table>
</div>
<br>
<?php
require("footer.php");
die();
}
?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><div style="float: left;"><a href=index.php><?php echo "$forum_name" ?></a> &#187; <a href='topicdisplay.php?forum=<?php echo "$forum"; ?>'><?php if ($forum) { echo "<b>$forum</b>"; } ?></a> <?php if ($archive==1) { echo "&#187; <i>Archive.</i>"; } ?></div><div align=right><a href='new_topic.php?forum=<?php echo "$forum"; ?>'><?php echo $newtopic; ?></a></div></td></table></div>
<br>


<div class='tableborder'><table width=100%% cellpadding='5' cellspacing='1'><td width=2%% align=center class=headertableblock></td><td width=30%% align=center class=headertableblock>Topic</td><td width=2%% align=center class=headertableblock>Replies</td><td width=10%% align=center class=headertableblock>Author</td><td width=2%% align=center class=headertableblock>Views</td><td width=20%% align=center class=headertableblock>Last Reply</td><td width=1%% align=center class=headertableblock></td><tr>
<form action="" method="GET">

<?php

	//````````````````````````````````````````````````````````````````````````````````````````````
	//
                  //   This area can be really shortened, but I did this quickly. A same copy and paste
	//
	// ```````````````````````````````````````````````````````````````````````````````````````````


# START THE STICKY

$countstuff = opendir("./forumposts_{$forum}/sticky/");
$total_topics = 0;
while($file = readdir($countstuff)){
 if($file != '.' && $file != '..' && $file != 'sticky' && $file != 'old' ){
    $total_topics++;
 }
}
closedir($countstuff);

if ($total_topics != 0 ) {


$s = "./forumposts_{$forum}/sticky/";

$handle = opendir($s);

while($topic = readdir($handle ))

 {
   if( $topic == '.' || $topic == '..' || $topic == 'sticky' || $topic == 'old' )
  
   continue;
    
   $forumtopiclist [$topic] = filemtime($s."/".$topic);

   }

// use arsort to show them by last modified date
// arsort also lets us have "bumped" topics because it doesnt go by creation but last modified.
// so when a topic is replied to, it gets bumped to the top because then it's "modified"
// get it?

arsort($forumtopiclist);
// bah

$x=0;

foreach($forumtopiclist as $key=>$value){ 
$t[$x]=$key; 
$x++;
}

if ($total_topics < $show) {
$dosubtract = $show - $total_topics;
$resultoftest = $show - $dosubtract;
} else {
$resultoftest = $show;
}

for ($x=0; $x<$total_topics; $x++) 
{

//strip the .txt off the end of the topics.
$thetopic = "$t[$x]";
$topicstrip = strrpos($thetopic, '.');
$topictitle = substr($thetopic, 0, $topicstrip);
if(file_exists("./locked/{$forum}_{$topictitle}.lock")) {
$img = "$locked_topic";
} else {
if ($hits < 15) {
$img = "$normal_topic";
} else {
$img = "$hot_topic";
}
}
$counter = "./forumposts_{$forum}/sticky/{$topictitle}.php";  
$hits = count(file($counter))/3;  

// ============================
// Pull up who the author is
//============================

$register_id = file("./id_data/member_names_num.txt");
$names_array = file("./forumposts_{$forum}/sticky/{$topictitle}.php");

$theauthorid = rtrim($names_array[3]);
$author = $register_id[$theauthorid];

// ============================
// And now the last replier
//============================
$key = count(file($counter))-3;
$last_replier = rtrim($names_array[$key]);
$thelastreplierid = rtrim($names_array[$key]);
$replier = $register_id[$thelastreplierid];

$date = date("m.d.y", filemtime("./forumposts_{$forum}/sticky/{$topictitle}.php"));
	// Get the topic name


                  // We grab out of only the first line of the file
$TopicFile ="./forumposts_{$forum}/sticky/{$topictitle}.php";     
$TopicName = file($TopicFile);

	// get the views

$views = file("./id_data/topic_view_count.txt");

$realht = $hits-2;



// can use mod cp?
if ($can_use_modcp == Yes) {

   echo "<tr><td class=arcade1 valign=top>$img</td><td class=arcade1 valign=top><b>Sticky:</b> <a href='viewtopic.php?topicid=$topictitle&p=1'>$TopicName[0]</a><br>$TopicName[1]";

topiclist($forum, $topictitle, "sticky/");


echo "</td><td class=arcade1 valign=top><div align=center>$realht</div></td><td class=arcade1 valign=top><div align=center><a href='viewprofile.php?showuser=$theauthorid'>$author</a></div></td><td class=arcade1 valign=top><div align=center>$views[$topictitle]</div></td><td class=arcade1 valign=top><div align=center>Date: $date<br> Reply by: <A href='viewprofile.php?showuser=$thelastreplierid'>$replier</a></div></td><td class=arcade1 valign=top><div align=center><input type='checkbox' name='topica[]' value='$topictitle'></div></td></div>";

} else {

   echo "<tr><td class=arcade1 valign=top>$img</td><td class=arcade1 valign=top><b>Sticky:</b><a href='viewtopic.php?topicid=$topictitle&p=1'> $TopicName[0]</a><br>$TopicName[1]";

topiclist($forum,$topictitle,"sticky/");

echo "</td><td class=arcade1 valign=top><div align=center>$realht</div></td><td class=arcade1 valign=top><div align=center><a href='viewprofile.php?showuser=$theauthorid'>$author</a></div></td><td class=arcade1 valign=top><div align=center>$views[$topictitle]</div></td><td class=arcade1 valign=top><div align=center>Date: $date<br> Reply by: <A href='viewprofile.php?showuser=$thelastreplierid'>$replier</a></div></td><td class=arcade1 valign=top><div align=center></div></td></div>";

}

 }
echo "<tr><td class=headertableblock colspan=8><b>^</b></td></tr>";
} else {

echo "<tr><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td></div>";

}

unset($countstuff);
unset($total_topics);
unset($file);
unset($topic);
unset($forumtopiclist);

# END THE STICKY

#
#      Start the NON sticky topic display
#


$countstuff = opendir("./forumposts_{$forum}/{$arch}");
$total_topics = 0;
while($file = readdir($countstuff)){
 if($file != '.' && $file != '..' && $file != 'sticky' && $file != 'old' ){
    $total_topics++;
 }
}
closedir($countstuff);

if ($total_topics != 0 ) {


$s = "./forumposts_{$forum}/{$arch}";

$handle = opendir($s);

while($topic = readdir($handle ))

 {
   if( $topic == '.' || $topic == '..' || $topic == 'sticky' || $topic == 'old')
  
   continue;
    
   $forumtopiclist [$topic] = filemtime($s."/".$topic);

   }

// use arsort to show them by last modified date
// arsort also lets us have "bumped" topics because it doesnt go by creation but last modified.
// so when a topic is replied to, it gets bumped to the top because then it's "modified"
// get it?

arsort($forumtopiclist);
// bah

$x=0;

foreach($forumtopiclist as $key=>$value){ 
$t[$x]=$key; 
$x++;
}

if ($total_topics < $show) {
$dosubtract = $show - $total_topics;
$resultoftest = $show - $dosubtract;
} else {
$resultoftest = $show;
}

for ($x=$limit; $x<$resultoftest; $x++) 
{

//strip the .txt off the end of the topics.
$thetopic = "$t[$x]";
$topicstrip = strrpos($thetopic, '.');
$topictitle = substr($thetopic, 0, $topicstrip);

// ============================
// Pull up who the author is
//============================

$register_id = file("./id_data/member_names_num.txt");
$names_array = @file("./forumposts_{$forum}/{$arch}{$topictitle}.php");
$hits = count($names_array)/3;  

if(file_exists("./locked/{$forum}_{$topictitle}.lock")) {
$img = "$locked_topic";
} else {
if ($hits < 15) {
$img = "$normal_topic";
} else {
$img = "$hot_topic";
}
}


$theauthorid = rtrim($names_array[3]);
$author = $register_id[$theauthorid];

// ============================
// And now the last replier
//============================
$key = count($names_array)-3;
$last_replier = rtrim($names_array[$key]);
$thelastreplierid = rtrim($names_array[$key]);
$replier = $register_id[$thelastreplierid];
$lastdate=filemtime("./forumposts_{$forum}/{$arch}{$topictitle}.php");

if(!$_GET['archive'] && !$_GET['page']) {
if(isset($_COOKIE[$cookievarname])) {

if($TopicNewCheckArray[$topictitle]<$lastdate) {
$img = "$new_posts_topicindex";
}

}

}

$date = date("m.d.y", $lastdate);
	// Get the topic name
                  // We grab out of only the first line of the file
$lastpost_cookie_data .="$topictitle|$lastdate,";


$TopicFile ="./forumposts_{$forum}/{$arch}{$topictitle}.php";     
$TopicName = $names_array;

	// get the views

$views = file("./id_data/topic_view_count.txt");

$realht = $hits-2;

if ($can_use_modcp == Yes) {
if ($topictitle != "") {
   echo "<tr><td class=arcade1 valign=top>$img</td><td class=arcade1 valign=top><a href='viewtopic.php?topicid=$topictitle&p=1'>$TopicName[0]</a><br>$TopicName[1]";
}

topiclist($forum, $topictitle, $arch);


if ($topictitle != "") {

echo "</td><td class=arcade1 valign=top><div align=center>$realht</div></td><td class=arcade1 valign=top><div align=center><a href='viewprofile.php?showuser=$theauthorid'>$author</a></div></td><td class=arcade1 valign=top><div align=center>$views[$topictitle]</div></td><td class=arcade1 valign=top><div align=center>Date: $date<br> Reply by: <A href='viewprofile.php?showuser=$thelastreplierid'>$replier</a></div></td><td class=arcade1 valign=top><div align=center><input type='checkbox' name='topica[]' value='$topictitle'></div></td></div>";

}

} else {
if ($topictitle != "") {

   echo "<tr><td class=arcade1 valign=top>$img</td><td class=arcade1 valign=top><a href='viewtopic.php?topicid=$topictitle&p=1'>$TopicName[0]</a><br>$TopicName[1]";

}

topiclist($forum,$topictitle, $arch);


$realht = $hits-1;
if ($topictitle != "") {
echo "</td><td class=arcade1 valign=top><div align=center>$realht</div></td><td class=arcade1 valign=top><div align=center><a href='viewprofile.php?showuser=$theauthorid'>$author</a></div></td><td class=arcade1 valign=top><div align=center>$views[$topictitle]</div></td><td class=arcade1 valign=top><div align=center>Date: $date<br> Reply by: <A href='viewprofile.php?showuser=$thelastreplierid'>$replier</a></div></td><td class=arcade1 valign=top><div align=center></div></td></div>";
}

}


 }
} else {

echo "<tr><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td><td class=arcade1 valign=top></td></div>";

}
echo "<tr>
   <td class=headertableblock colspan=9>";
   ?>
   <div style="float: right;">
   <?php

if ($limit > 0) {
echo "<a href='topicdisplay.php?&forum=$forum&limit=$limnm&show=$swnm&page=$pgnm'>Previous Page ($pgnm)</a> &middot; ";
}

if ($total_topics < $show || $total_topics < $showtopics || $total_topics == $showtopics ) {
echo "";
} else {
echo "<a href='topicdisplay.php?&forum=$forum&limit=$limn&show=$swn&page=$pgn'> Next Page ($pgn)</a>"; 
}

?>
</div>
<div align="left">
<input type=hidden name=forum value='<?php echo $forum; ?>'>
<select size="1" name="archive">
<?php if ($archive == "1") {
echo "<option value=1 selected>Old Posts Archive</option>";
echo "<option value=2>Latest Threads</option>";
} else {
echo "<option value=2 selected>Latest Threads</option>";
	echo "<option value=1>Old Posts Archive</option>";
}
?>
</select> <input type=submit value='Go'>

<?php
echo "</td></tr>";
?>
</font>
</table>
</div>
<br>
<?php
// Set the cookie crap
if(!$_GET['archive'] && !$_GET['page']) {
	$forum_Cookie=str_replace(" ", "_", $forum);
setcookie("newposts_{$forum_Cookie}", $lastpost_cookie_data,time()+9999999);
}
//

if ($can_use_modcp == Yes) {
?>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock><select size="1" name="action"><option value='Default' selected>Action...</option><option value='stickythis'>Sticky</option><option value='unstickythis'>Unsticky</option><option value='delete'>Delete</option><option value='move'>Move</option><option value='lock'>Lock</option><option value='unlock'>Unlock</option><option value='bump'>Bump</option></select><input type=hidden name=forum value='<?php echo "$forum"; ?>'><input type=submit value=Go> </td>
</table>
</div>
</form>
<?php
}
?>

<br>
<br>
<br>
<?php
require("footer.php");
ob_end_flush();
?>