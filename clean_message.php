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
// Module: clean_message.php - Last update: May 02, 2006
// ----------------------------------------------------------------------------------------
//
//
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
?>
<?php

require("forum_conf.php");

// Define stuff.
$message=$_POST['message'];
$topicname=$_POST['topicname'];
$topicdesc=$_POST['topicdesc'];

// Filter swearing
$file = file("filter.txt");
$i=-1;
while ($i <= count($file)) {
$i++;
$message= str_replace(rtrim($file[$i]), "@!&^*%", $message);
$topicname = str_replace(rtrim($file[$i]), "@!&^*%", $topicname);
$topicdesc = str_replace(rtrim($file[$i]), "@!&^*%", $topicdesc);
}

// For xss
$message=str_replace("&&#35;62;", "&#62;", $message); 
$message=str_replace("&&#35;60;", "&#60;", $message); 

// No html peroid
$topicname  = htmlspecialchars($topicname, ENT_QUOTES);
$message  = htmlspecialchars($message, ENT_QUOTES);
$topicdesc = htmlspecialchars($topicdesc, ENT_QUOTES);


// for brs
$message = eregi_replace("\n", "<br>", $message);
$topicname = eregi_replace("\n", "<br>", $topicname);
$topicdesc = eregi_replace("\n", "<br>", $topicdesc);

// Strip Slashes
//$message = stripslashes($message);
//$topicname = stripslashes($topicname);
//$topicdesc = stripslashes($topicdesc);

?>