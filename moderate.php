<?php
require("stopper.php");
require("./groups/$status.php");

if($_GET['forum']) { 
$forum = htmlspecialchars($_GET['forum'], ENT_QUOTES); 
$forum = str_replace(".", "", $_GET['forum']);
$forum = str_replace("/", "", $_GET['forum']);
if(preg_match("@[^\w ]@", $_GET['forum'])) die("");
}

$topica=$_GET['topica'];
$line=$_GET['line'];
$topic=$_GET['topic'];

if($_GET['topic']) if(!is_numeric($topic)) die();



if ($can_use_modcp == Yes) {

$wear='';

?>

<?php

$thesubtract = $show - 1;
$theadd = $show;

if ($action == "del") {

if (file_exists("./forumposts_{$forum}/{$topic}.php")) {
$wear = "";
} elseif (file_exists("./forumposts_{$forum}/old/{$topic}.php"))  {
$wear = "old/";
} else {
	$wear = "sticky/";
}

$file = "./forumposts_{$forum}/{$wear}{$topic}.php";

// delete topic code
// by Sean (http://seanj.cjb.net)

$array=file($file); 
$file2=fopen($file, "w"); 
foreach($array as $k=>$v){ 
if ($k==$line||$v==""){ 
continue; 
} 
fwrite($file2, $v); 
} 
fclose($file2);

$array=file($file); 
$file2=fopen($file, "w"); 
foreach($array as $k=>$v){ 
if ($k==$line-1||$v==""){ 
continue; 
} 
fwrite($file2, $v); 
} 
fclose($file2); 

$array=file($file); 
$file2=fopen($file, "w"); 
foreach($array as $k=>$v){ 
if ($k==$line-2||$v==""){ 
continue; 
} 
fwrite($file2, $v); 
} 
fclose($file2); 


// end
//==================================== 

require("forum_conf.php");

$TxtFileCount = file("./postcounts/{$forum}.txt");
eraseandreplace("./postcounts/{$forum}.txt", 1, $TxtFileCount[1]-1); 

?>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock>Thanks, post deleted... please wait while we transfer you</td>
</table>
</div>
<br>
<meta http-equiv="refresh" content="2;url=topicdisplay.php?forum=<?php echo $forum ?>"> 

<?php


require("footer.php");
die();
}
?>

<?php

if ($action == stickythis) {
for($x=0;$x<=count($topica)-1;$x++){
if(!is_numeric($topica[$x])) die();
@rename("./forumposts_{$forum}/$topica[$x].php", "./forumposts_{$forum}/sticky/$topica[$x].php");
@rename("./forumposts_{$forum}/old/$topica[$x].php", "./forumposts_{$forum}/sticky/$topica[$x].php");
}

?>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock>Thanks, sticky topic action executed. Please wait while we transfer you...</td>
</table>
</div>
<br>
<meta http-equiv="refresh" content="2;url=topicdisplay.php?forum=<?php echo $forum ?>"> 


<?
require("footer.php");
die();
}
?>

<?php
if ($action == unstickythis) {

for($x=0;$x<=count($topica)-1;$x++){
if(!is_numeric($topica[$x])) error("...");
@rename("./forumposts_{$forum}/sticky/$topica[$x].php", "./forumposts_{$forum}/$topica[$x].php");
}

?>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock>Thanks, unsticky topic action executed. Please wait while we transfer you...</td>
</table>
</div>
<br>
<meta http-equiv="refresh" content="2;url=topicdisplay.php?forum=<?php echo $forum ?>"> 

<?
require("footer.php");
die();
}

if ($action == bump) {

for($x=0;$x<=count($topica)-1;$x++){
if(!is_numeric($topica[$x])) error("...");

$c = @file_get_contents("./forumposts_{$forum}/$topica[$x].php");
if(!$c) {
$c = @file_get_contents("./forumposts_{$forum}/old/$topica[$x].php");
}
if(!$c) error("You cannot bump a sticky topic.");

@unlink("./forumposts_{$forum}/$topica[$x].php");
@unlink("./forumposts_{$forum}/old/$topica[$x].php");

$g = fopen("./forumposts_{$forum}/$topica[$x].php", "w");
fwrite($g, $c);
fclose($g);
}

?>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock>Thanks, topics bumped...</td>
</table>
</div>
<br>
<meta http-equiv="refresh" content="2;url=topicdisplay.php?forum=<?php echo $forum ?>"> 


<?
require("footer.php");
die();
}
?>

<?php

if ($action == lock) {
for($x=0;$x<=count($topica)-1;$x++){
if(!is_numeric($topica[$x])) error("...");
$lastreply = fopen("./locked/{$forum}_{$topica[$x]}.lock", "w+");
}
?>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock>Thanks, thread(s) closed...</td>
</table>
</div>
<br>
<meta http-equiv="refresh" content="2;url=topicdisplay.php?forum=<?php echo $forum ?>"> 
<?
		die();
}

if ($action == unlock) {
for($x=0;$x<=count($topica)-1;$x++){
if(!is_numeric($topica[$x])) error("...");
@unlink("./locked/{$forum}_{$topica[$x]}.lock");

}
?>
<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock>Thanks, thread(s) unlocked...</td>
</table>
</div>
<br>
<meta http-equiv="refresh" content="2;url=topicdisplay.php?forum=<?php echo $forum ?>"> 
<?php
	die();
}

?>

<?php
if ($action == delete) {
for($x=0;$x<=count($topica)-1;$x++){


if(!is_numeric($topica[$x])) error("...");

$existest = @file_exists("./forumposts_{$forum}/$topica[$x].php");
$existest2 = @file_exists("./forumposts_{$forum}/old/$topica[$x].php");
$existest3 = @file_exists("./forumposts_{$forum}/sticky/$topica[$x].php");

if($existest)$wear="";
if($existest2)$wear="old/";
if($existest3)$wear="sticky/";

if(!$existest && !$existest2 && !$existest3) error("Couldn't erase the topic(s)!");

$TxtFileCount = file("./postcounts/{$forum}.txt");

$replies = count(file("./forumposts_{$forum}/{$wear}$topica[$x].php"))/3-1-1;
@unlink("./forumposts_{$forum}/$topica[$x].php");
@unlink("./forumposts_{$forum}/old/$topica[$x].php");
@unlink("./forumposts_{$forum}/sticky/$topica[$x].php");

eraseandreplace("./postcounts/{$forum}.txt", 0, $TxtFileCount[0]-1); 
eraseandreplace("./postcounts/{$forum}.txt", 1, $TxtFileCount[1]-$replies); 


}

?>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock>Thanks, deletion of topic(s) action executed. Please wait while we transfer you...</td>
</table>
</div>
<br>
<meta http-equiv="refresh" content="2;url=topicdisplay.php?forum=<?php echo $forum ?>"> 

<?php
require("footer.php");
die();
}
?>


<?php
if ($action == move) {

if (count($topica) > 1){
error("You can only move 1 topic at time.");
}

?>

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=arcade1>Move Topic?<br><br>
<form action='' method='GET'>
<input type='hidden' name='topic' value='<?php echo "$topica[0]"; ?>'><input type=hidden value='<?php echo "$forum"; ?>' name=moveoutof>
<input type=hidden value='<?php echo "$show"; ?>' name=show>
<?php

echo "<input type=submit value='Move Topic' name=action><br><br>";

echo '<select size="1" name="moveinto">';
echo "<option value='' selected>Select Forum...</option>";

$countstuff = opendir("./addedforums/"); 
$total_forums = 0; 
while($file = readdir($countstuff)){ 
   if($file != '.' && $file != '..' && $file != 'sticky' ){ 
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



     echo "<option value='None'> ---| $t</option>";


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
}
?>


<?php
$moveinto=$_GET['moveinto'];
$moveoutof=$_GET['moveoutof'];


if ($action == "Move Topic") {

if(preg_match("@[^\w ]@", $_GET['moveoutof'])) error("...");
if(preg_match("@[^\w ]@", $_GET['moveoutinto'])) error("...");

if ($moveinto == "None") {

error("What do you think you're doing? o_0 moving a topic into a category.");

}


if (file_exists("./forumposts_{$moveoutof}/{$topic}.php")) {
$wear = "";
} elseif (file_exists("./forumposts_{$moveoutof}/old/{$topic}.php"))  {
$wear = "old/";
} else {
	$wear = "sticky/";
}



$move_a_topic = @rename("./forumposts_{$moveoutof}/{$wear}$topic.php", "./forumposts_{$moveinto}/$topic.php");

if (!$move_a_topic) {
error("Error in moving. You tried to move a sticky topic, or the topic you are trying to move has already been moved. Please unstick the topic then move.");
}

// Subtratct topic-wise
$TxtFileCount = file("./postcounts/{$moveoutof}.txt");
eraseandreplace("./postcounts/{$moveoutof}.txt", 0, $TxtFileCount[0]-1); 
$TxtFileCount2 = file("./postcounts/{$moveinto}.txt");
eraseandreplace("./postcounts/{$moveinto}.txt", 0, $TxtFileCount2[0]+1); 

// Do the subtraction out of the forum for the replies
$replies = count(file("./forumposts_{$moveinto}/$topic.php"))/3-1-1;
$TxtFileCount3 = file("./postcounts/{$moveoutof}.txt");
eraseandreplace("./postcounts/{$moveoutof}.txt", 1, $TxtFileCount3[1]-$replies); 

// Now do the ADDITION

$TxtFileCount4 = file("./postcounts/{$moveinto}.txt");
eraseandreplace("./postcounts/{$moveinto}.txt", 1, $TxtFileCount4[1]+$replies); 



?>
<meta http-equiv="refresh" content="2;url=topicdisplay.php?forum=<?php echo $moveoutof ?>"> 

<div align='center'>
<div class='tableborder'><table width=100%% cellpadding='0' cellspacing='1'><td width=60%% align=center class=headertableblock>Thanks, Move topic action executed. Please wait while we transfer you...</td>
</table>
</div>
<br>

<?php
require("footer.php");
die();
}

?>


<?php
}
?>