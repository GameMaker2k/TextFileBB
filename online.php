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
// Module: online.php - Last update: Nov 18, 2005
// ----------------------------------------------------------------------------------------
//
//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
require("header.php");
require("forum_conf.php");
require("stopper.php");
require("./groups/$status.php");
?>
<div class=tableborder><table width=100% cellpadding='4' cellspacing='1'><td class=arcade1><a href=index.php?do=idx><?php echo "$forum_name" ?></a> &#187; Online List</td></table></div>
<br>
<?php

echo "<div class='tableborder'><table width=100% cellpadding='4' cellspacing='1'><td width=40% align=center class=headertableblock>User</td><td width=40% align=center class=headertableblock>Last Refresh</td><td width=50% align=center class=headertableblock>Location</td><td width=10% align=center class=headertableblock>Contact</td>";

$countstuf = opendir("./sessionsfolder/"); 
$total_ = 0; 
while($file6= readdir($countstuf)){ 
   if($file6 != '.' && $file6 != '..'){ 
      $total_++; 
   } 
} 
closedir($countstuf); 

if ($total_ != 0 ) {


 $s9 = "./sessionsfolder/";

  $handle9 = opendir($s9);

  while ( $topic9 = readdir($handle9 ))

   {

     if( $topic9 == '.' || $topic9 == '..' || $topic9 == '.php' )
     
     continue;
      
     if (preg_match("/\.(php|xml)$/", $topic9)){
     $forumtopiclist9 [$topic9] = filemtime($s9."/".$topic9);
     }

     }

// use arsort to show them by last modified date
// arsort also lets us have "bumped" topics because it doesnt go by creation but last modified.
// so when a topic is replied to, it gets bumped to the top because then it's "modified"
// get it?
  @arsort($forumtopiclist9);

while(list($t9)=@each($forumtopiclist9))


  {


// strip the .txt off the end of the topics.

$thetopic9 = "$t9";

$topicstrip9 = strrpos($thetopic9, '.');

$topictitle9 = substr($thetopic9, 0, $topicstrip9);


if (file_exists("./sessionsfolder/$topictitle9.php")) {

$onlineinfos = file("./sessionsfolder/$topictitle9.php");

if ($onlineinfos[0] == "") {
$onlineinfo= "Viewing board index";
} else {
$onlineinfo = $onlineinfos[0];
}

}

if (file_exists("./sessionsfolder/{$topictitle9}.php")) {

$grabLines = file("./sessionsfolder/{$topictitle9}.php");
//$register_id = 1;
//$member_id_number = array_search_ci($register_id, "$topictitle9");
$Lastrefresh = date("jS F Y - h:i A", filemtime("./sessionsfolder/{$topictitle9}.php"));

$member_txt_file = file("./id_data/member_names_num.txt");
$getkey = array_search_ci($member_txt_file, "$topictitle9");


if ($can_use_modcp == Yes) {
     echo "<tr><td class=arcade1><a href='viewprofile.php?showuser=$getkey' title=''>$topictitle9</a> ( <A href=admincp.php?cparea=IPscan&serv=$grabLines[2]>$grabLines[2]</a> ) <br></td><td class=arcade1><div align=center>$Lastrefresh</div></td><td class=arcade1>$onlineinfo</td><td class=arcade1><a href=mail.php?replyname=$topictitle9>PM</a></td></tr>";
} else {
echo "<tr><td class=arcade1><a href='viewprofile.php?showuser=$getkey' title='$yeah444'>$topictitle9</a><br></td><td class=arcade1><div align=center>$Lastrefresh</div></td><td class=arcade1>$onlineinfo</td><td class=arcade1><a href=mail.php?replyname=$topictitle9>PM</a></td></tr>";
}

}
}
}
?>

</td></tr></table></div>
<br>

<?php require("footer.php"); ?>