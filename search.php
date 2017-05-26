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
// Module: search.php - Last update: April 1, 2006
// ----------------------------------------------------------------------------------------
// Sanitised and Dereglobed: OK
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

	// "wear" are the files?!

	require("header.php");
	require("moderate.php");
	require("forum_conf.php");

$topictitle='';

$search=htmlspecialchars($_GET['search'], ENT_QUOTES);
$action=$_GET['action'];
$howsearch=$_GET['howsearch'];

if ($search_allowed != Yes) {
error("Search has been disabled by the admin");
} 
?>

<div class='tableborder'><table width=100%% cellpadding='4' cellspacing='1'><td width=100%% align=left class=arcade1><a href=index.php><?php echo "$forum_name" ?></a> &#187; Search Engine</a></td></table></div>
<br>

<?php
if ($_GET['p'] == "idx") {
?>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=arcade1>Search forums<br><br>
<form action='search.php' method='GET'>
<input type=text value='' name=search>

<?php
echo "<input type=submit value='Search' name=action><br><br>";

echo '<select size="1" name="forum">';
echo "<option selected>Select Forum...</option>";

$countstuff = opendir("./addedforums/"); 
$total_forums = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..' && $file != 'sticky' && $file != 'old' ){ 
      $total_forums++; 
   } 
} 
closedir($countstuff); 

if ($total_forums != 0) {
// yes this has been stolen from the other part.

 $s = "./addedforums";

  $handle = opendir($s);

  while ( $topic = readdir($handle ))

   {

     if( $topic == '.' || $topic == '..' || $topic == 'sticky' || $topic == 'old')
     
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
   if($file2 != '.' && $file2 != '..' && $file2 != 'modify.txt' ){ 

$file_title = explode(".", $file2);

require("./permissions/{$file_title[0]}.php");
	if ($can_read["$status"] == "allowed") { 
      $total_forums2++; 
}
   } 
} 
closedir($countstuff2); 

if ($total_forums2 > 0) {

   echo "<option value='None'> ---| $t</option>";

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
   if($file != '.' && $file != '..' && $file != 'sticky' && $file != 'old'){ 
      $total_topics++; 
   } 
} 
closedir($countstuff); 

if ($showtopics > $total_topics ) {
$show = "$total_topics";
} else { 
$show = "$showtopics";
}

     echo "<option value='$topictitle2'>$topictitle2</option>";
}
}

unset($fcatlist);

//END HERE
//
//
}
}

echo '</select><br /><br><br>';
?>
<input type="radio" name="howsearch" value="posts"> Search in posts <input type="radio" name="howsearch" value="topicbased" checked> Search in topic title <br>
</form>
<?php
echo "</td></table></div>"
?>
</table>
</div>
<br>

<?php
require("footer.php");
die();
}// end $p

if ($forum == 'Select Forum...') {
error("You forgot to select a forum");
}

if ($forum == 'None') {
error("You cannot search a category, please choose a forum");
}


	// Get the permissions file...

$forum=htmlspecialchars($forum, ENT_QUOTES);
if(file_exists("./permissions/{$forum}.php")) {

                  require("./permissions/{$forum}.php");
} else {

error("Invalid forum ID");

}

	if ($can_read["$status"] != allowed) {
	error("You do not have permission to view this forum.");
	}

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

$countstuff = @opendir("./forumposts_{$forum}/"); 
$total_forums = 0; 
while($file = @readdir($countstuff)){ 
   if($file != '.' && $file != '..' && $file != 'sticky' && $file != 'old'){ 
      $total_forums++; 
   } 
} 
@closedir($countstuff); 

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
?>


<div align=right><a href='new_topic.php?forum=<?php echo "$forum"; ?>'><b></b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>


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
 if($file != '.' && $file != '..' && $file != 'sticky' ){
    $total_topics++;
 }
}
closedir($countstuff);

if ($total_topics != 0 ) {


$s = "./forumposts_{$forum}/sticky/";

$handle = opendir($s);

while($topic = readdir($handle ))

 {
   if( $topic == '.' || $topic == '..' || $topic == 'sticky' )
  
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
$hits = count(@file($counter))/3;  

// ============================
// Pull up who the author is
//============================

$register_id = @file("./id_data/member_names_num.txt");
$names_array = @file("./forumposts_{$forum}/sticky/{$topictitle}.php");

$theauthorid = rtrim($names_array[3]);
$author = $register_id[$theauthorid];

// ============================
// And now the last replier
//============================
$key = count(@file($counter))-3;
$last_replier = rtrim($names_array[$key]);
$thelastreplierid = rtrim($names_array[$key]);
$replier = $register_id[$thelastreplierid];

$date = date("m.d.y", @filemtime("./forumposts_{$forum}/sticky/{$topictitle}.php"));
	// Get the topic name
                  // We grab out of only the first line of the file
$TopicFile ="./forumposts_{$forum}/sticky/{$topictitle}.php";     
$TopicName = file($TopicFile);

	// get the views

$views = @file("./id_data/topic_view_count.txt");



if ($can_use_modcp == Yes) {

   echo "<tr><td class=arcade1 valign=top>$img</td><td class=arcade1 valign=top><b>Sticky:</b> <a href='viewtopic.php?topicid=$topictitle&p=1'>$TopicName[0]</a><br>$TopicName[1]";

topiclist($forum, $topictitle, "sticky/");

$realht = $hits-1;
echo "</td><td class=arcade1 valign=top><div align=center>$realht</div></td><td class=arcade1 valign=top><div align=center><a href='viewprofile.php?showuser=$theauthorid'>$author</a></div></td><td class=arcade1 valign=top><div align=center>$views[$topictitle]</div></td><td class=arcade1 valign=top><div align=center>Date: $date<br> Reply by: <A href='viewprofile.php?showuser=$thelastreplierid'>$replier</a></div></td><td class=arcade1 valign=top><div align=center><input type='checkbox' name='topica[]' value='$topictitle'></div></td></div>";

} else {

   echo "<tr><td class=arcade1 valign=top>$img</td><td class=arcade1 valign=top><b>Sticky:</b><a href='viewtopic.php?topicid=$topictitle&p=1'> $TopicName[0]</a><br>$TopicName[1]";

topiclist($forum,$topictitle,"sticky/");


$realht = $hits-1;
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


$countstuff = opendir("./forumposts_{$forum}/");
$total_topics = 0;
while($file = readdir($countstuff)){
 if($file != '.' && $file != '..' && $file != 'sticky' && $file != 'old'){
    $total_topics++;
 }
}
closedir($countstuff);

if ($total_topics != 0 ) {


$s = "./forumposts_{$forum}/";

$handle = opendir($s);

while($topic = readdir($handle ))

 {
   if( $topic == '.' || $topic == '..' || $topic == 'sticky' )
  
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
$counter = "./forumposts_{$forum}/{$topictitle}.php";  
$hits = count(@file($counter))/3;  

// ============================
// Pull up who the author is
//============================

$register_id = @file("./id_data/member_names_num.txt");
$names_array = @file("./forumposts_{$forum}/{$topictitle}.php");

$theauthorid = rtrim($names_array[3]);
$author = $register_id[$theauthorid];

// ============================
// And now the last replier
//============================
$key = count(@file($counter))-3;
$last_replier = rtrim($names_array[$key]);
$thelastreplierid = rtrim($names_array[$key]);
$replier = $register_id[$thelastreplierid];

$date = date("m.d.y", @filemtime("./forumposts_{$forum}/{$topictitle}.php"));
	// Get the topic name
                  // We grab out of only the first line of the file
$TopicFile ="./forumposts_{$forum}/{$topictitle}.php";     
$TopicName = @file($TopicFile);

	// get the views

$views = @file("./id_data/topic_view_count.txt");

//==
if ($howsearch == "topicbased") { 

// start if

if (preg_match("/$search/i", "$TopicName[0]")) {

if ($can_use_modcp == Yes) {
   echo "<tr><td class=arcade1 valign=top>$img</td><td class=arcade1 valign=top><a href='viewtopic.php?topicid=$topictitle&p=1'>$TopicName[0]</a><br>$TopicName[1]";
topiclist($forum, $topictitle, $stickynothing);
$realht = $hits-1;
echo "</td><td class=arcade1 valign=top><div align=center>$realht</div></td><td class=arcade1 valign=top><div align=center><a href='viewprofile.php?showuser=$theauthorid'>$author</a></div></td><td class=arcade1 valign=top><div align=center>$views[$topictitle]</div></td><td class=arcade1 valign=top><div align=center>Date: $date<br> Reply by: <A href='viewprofile.php?showuser=$thelastreplierid'>$replier</a></div></td><td class=arcade1 valign=top><div align=center><input type='checkbox' name='topica[]' value='$topictitle'></div></td></div>";
} else {
   echo "<tr><td class=arcade1 valign=top>$img</td><td class=arcade1 valign=top><a href='viewtopic.php?topicid=$topictitle&p=1'>$TopicName[0]</a><br>$TopicName[1]";
topiclist($forum,$topictitle, $stickynothing);
$realht = $hits-1;
echo "</td><td class=arcade1 valign=top><div align=center>$realht</div></td><td class=arcade1 valign=top><div align=center><a href='viewprofile.php?showuser=$theauthorid'>$author</a></div></td><td class=arcade1 valign=top><div align=center>$views[$topictitle]</div></td><td class=arcade1 valign=top><div align=center>Date: $date<br> Reply by: <A href='viewprofile.php?showuser=$thelastreplierid'>$replier</a></div></td><td class=arcade1 valign=top><div align=center></div></td></div>";
}
}
}
//==

if ($howsearch == posts) {

$content = @file_get_contents("./forumposts_{$forum}/{$topictitle}.php");
$array = array("$content");

if (preg_match("/$search/i", "$array[0]")) {
if ($can_use_modcp == Yes) {
   echo "<tr><td class=arcade1 valign=top>$img</td><td class=arcade1 valign=top><a href='viewtopic.php?topicid=$topictitle&p=1'>$TopicName[0]</a><br>$TopicName[1]";
topiclist($forum, $topictitle, $stickynothing);
$realht = $hits-1;
echo "</td><td class=arcade1 valign=top><div align=center>$realht</div></td><td class=arcade1 valign=top><div align=center><a href='viewprofile.php?showuser=$theauthorid'>$author</a></div></td><td class=arcade1 valign=top><div align=center>$views[$topictitle]</div></td><td class=arcade1 valign=top><div align=center>Date: $date<br> Reply by: <A href='viewprofile.php?showuser=$thelastreplierid'>$replier</a></div></td><td class=arcade1 valign=top><div align=center><input type='radio' name='topic' value='$topictitle'></div></td></div>";
} else {
   echo "<tr><td class=arcade1 valign=top>$img</td><td class=arcade1 valign=top><a href='viewtopic.php?topicid=$topictitle&p=1'>$TopicName[0]</a><br>$TopicName[1]";
topiclist($forum,$topictitle, $stickynothing);
$realht = $hits-1;
echo "</td><td class=arcade1 valign=top><div align=center>$realht</div></td><td class=arcade1 valign=top><div align=center><a href='viewprofile.php?showuser=$theauthorid'>$author</a></div></td><td class=arcade1 valign=top><div align=center>$views[$topictitle]</div></td><td class=arcade1 valign=top><div align=center>Date: $date<br> Reply by: <A href='viewprofile.php?showuser=$thelastreplierid'>$replier</a></div></td><td class=arcade1 valign=top><div align=center></div></td></div>";
}
}
}
//==

}
}

echo "<tr>
   <td class=headertableblock colspan=9>";

echo "Search results for '$search' displayed above."; 


echo "</td></tr>";
?>
</font>
</table>
</div>
<br>
<?php
if ($can_use_modcp == Yes) {
?>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock><select size="1" name="action"><option value='Default' selected>Action...</option><option value='stickythis'>Sticky</option><option value='unstickythis'>Unsticky</option><option value='delete'>Delete</option><option value='move'>Move</option><option value='lock'>Lock</option><option value='unlock'>Unlock</option></select><input type=hidden name=forum value='<?php echo "$forum"; ?>'><input type=hidden name=show value='<?php echo "$show"; ?>'><input type=submit value=Go></form> </td>
</table>
</div>
<?php
}
?>

<br>
<br>
<br>
<?php
require("footer.php");
?>