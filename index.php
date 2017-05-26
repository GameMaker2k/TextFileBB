<?php
ob_start();
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
// Module: index.php - Last update: September 28, 2006
// ----------------------------------------------------------------------------------------
//  Sanitised and Dereglobed OK
//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
require("forum_conf.php");
echo "<title>$forum_name</title>";

$npgt=0;

$newpostscheck=explode(",", $_COOKIE['textfbb_index']);


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

echo "<div align='center'>";

if ($total_forums2 > 0) {

     $underscore = str_replace(" ", "_", $thetopic);
     echo "<br><div class='tableborder'><div id='blech'><table width=100% cellpadding='5' cellspacing='1' id='$underscore' style='display: normal;'>";
	 
	 echo "<tr><td class=headertableblock colspan=9><b><font size=-5>$thetopic</font></b></td></tr><tr><td width=2% align=center class=arcade1><font size=-5></font><td width=50% align=center class=arcade1><font size=-5>Forum</font></td><td width=5% align=center class=arcade1><font size=-5>Topics</font></td><td width=5% align=center class=arcade1><font size=-5>Replies</font></td><td width=20% align=center class=arcade1><font size=-5>Last Reply</font></td>";
	
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
$countstuff =  opendir("./forumposts_{$topictitle2}/"); 
$total_topics = 0; 
while($file = readdir($countstuff)){ 

   if($file != '.' && $file != '..' && $file != 'sticky' && $file != 'old'){ 
	  $total_topics++; 
   }

} 
closedir($countstuff); 


$countstuffs = @opendir("./forumposts_{$topictitle2}/sticky/"); 
$total_topicss = 0; 
while($files = @readdir($countstuffs)){ 
   if($files != '.' && $files != '..' && $files != 'sticky'){ 
      $total_topicss++; 
   }
} 
closedir($countstuffs); 



if ($showtopics > $total_topics ) {
$show = "$total_topics";
} else { 
$show = "$showtopics";
}


//-----------------------------------------------------------

$forumdesc = file("./addedforums/$t/{$topictitle2}.txt");

require("stopper.php");
// Get permissions...
require("./permissions/{$topictitle2}.php");

	// If they're allowed to read...
	if ($can_read["$status"] == "allowed") { 

$fileanddate=explode("|", $newpostscheck[$npgt]);
$npgt++;


if ($url_redirect != 'Yes') {
if ($allow_posting == 'Yes') {
$marker_f = $normal_marker;
} else {
$marker_f = $read_only_marker;
}


if(isset($_COOKIE['textfbb_index'])) {
// What is the filemtime?
$LoL_Sean=filemtime("./forumposts_{$topictitle2}/");


if($LoL_Sean>$fileanddate[0]) {

$marker_f = $new_posts_forum_index;

}

}


$threadstotal = file("./postcounts/{$topictitle2}.txt");

$rep_p+=$threadstotal[1];
$top_p+=$threadstotal[0];
$colcookie = $_COOKIE["$underscore"];

echo "<tr><td class=arcade1 valign=top>$marker_f</td><td class=arcade1 valign=top><a href='topicdisplay.php?forum=$topictitle2'>$topictitle2</a><br><div align=left>$forumdesc[0]</div></td><td class=arcade1><div align=center><b>$threadstotal[0]</b></div></td><td class=arcade1><div align=center><b>$threadstotal[1]</b></div></td><td class=arcade1 valign=top><div align='center'>";

} else {
echo "<tr><td class=arcade1 valign=top>$redirect_marker</td><td class=arcade1 valign=top><a href='$redirect_to'>$topictitle2</a><br><div align=left>$forumdesc[0]</div></td><td class=arcade1><div align=center><b>--</b></div></td><td class=arcade1><div align='center'>--</div></td></div><td class=arcade1 valign=top><div align='center'>";
}


unset($marker_f);
// xx
$countstuff = opendir("./forumposts_{$topictitle2}");
$total_topics = 0;
while($file = readdir($countstuff)){
 if($file != '.' && $file != '..'){
    $total_topics++;
 }
}
closedir($countstuff);

if ($total_topics != 0 ) {
$sg = "./forumposts_{$topictitle2}/";
$handleg = opendir($sg);
while($topicg = readdir($handleg ))
 {
   if( $topicg == '.' || $topicg == '..' || $topicg == 'old')
     continue;
     $forumtopiclistg [$topicg] = filemtime($sg."/".$topicg);
   }
arsort($forumtopiclistg);
$x=0;
foreach($forumtopiclistg as $key=>$value){ 
$get_topic[$x]=$key; 
$x++;
}

if ($total_topics < $show) {
$dosubtract = $show - $total_topics;
$resultoftest = $show - $dosubtract;
} else {
$resultoftest = $show;
}

for ($x=0; $x<1; $x++) 
{

//strip the .txt off the end of the topics.
$latest_Replied_to = "$get_topic[$x]";
if ($latest_Replied_to == sticky) {
	if ($total_topicss != 0) {
$lateststicky = getarrayby_arsort("./forumposts_{$topictitle2}/sticky/");
//print_r($lateststicky);
$latest_Replied_to = $lateststicky[0];
$sticky = "/sticky/";
}
// echo "this is the latest sticky: $lateststicky[0]";
} 


$strip = explode('.', $latest_Replied_to);

$names_array = @file("./forumposts_{$topictitle2}/{$sticky}$latest_Replied_to");
$hits = count($names_array)/3;  
$register_id = file("./id_data/member_names_num.txt");
$theauthorid = rtrim($names_array[3]);
$author = $register_id[$theauthorid];
$key = @count(@file("./forumposts_{$topictitle2}/{$sticky}$latest_Replied_to"))-3;
$last_replier = rtrim($names_array[$key]);
$thelastreplierid = rtrim($names_array[$key]);
$replier = rtrim($register_id[$thelastreplierid]);

$lastdate=filemtime("./forumposts_{$topictitle2}/");

$lastpost_cookie_data .="$lastdate|-,";


$date = date("m.d.y", $lastdate);
$TopicFile ="./forumposts_{$topictitle2}/{$sticky}$latest_Replied_to";
if ($url_redirect !=Yes) {
if ($password_needed == Yes) {
echo "<b>In:</b> Private";
echo "&#187;<br><b>On:</b> $date <br><b>By:</b> <a href='viewprofile.php?showuser=$last_replier'>$replier</a>";
} else {
echo "<b>In:</b> <a href='viewtopic.php?topicid=$strip[0]&p=1'>";
printf("%.22s",$names_array[0]);
echo "...</a> &#187;<br><b>On:</b> $date <br><b>By:</b> <a href='viewprofile.php?showuser=$last_replier'>$replier</a>";
}
} else {
echo "<b>Redirect forum &#187;</b>";
}
}
} else {
if ($url_redirect !=Yes) {
echo "<b>In:</b> ----- &#187;<br><b>On:</b> ----- <br><b>By:</b>-----";
} else {
echo "<b>Redirect forum &#187;</b>";
}
}

unset($latest_Replied_to);
unset($names_array);
unset($get_topic);
unset($forumtopiclistg);
unset($url_redirect);
unset($password_needed);
unset ($sticky);
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx


echo "<br></div></td>";

} // end permissions check



}



echo "</table></div></div><br>";

}


unset($fcatlist);
unset($x2);
unset($fcatlist2);
//END HERE
//
//




}



}


setcookie("textfbb_index", $lastpost_cookie_data,time()+9999999);

?>

<?php require("footer.php"); 
ob_end_flush();
?>
