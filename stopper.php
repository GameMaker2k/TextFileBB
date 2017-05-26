<?php  

// Admin checkup file
// This file is 100% necessary

$cookies2 = $_COOKIE['storedcookie_textfileBB_pword'];
$cookies = $_COOKIE['storedcookie_textfileBB_id'];

if (isset($_COOKIE['storedcookie_textfileBB_id'])) {
$acfile=htmlspecialchars($_COOKIE['storedcookie_textfileBB_id'], ENT_QUOTES);
if(preg_match("@[\W]@i", $acfile)) die("<a href='?action=logout'>Logout...</a>");


if(file_exists("./accounts/{$acfile}_user.php")) { 
require("./accounts/{$acfile}_user.php"); 
} else { 
die("<a href='?action=logout'>Logout...</a>");
}

if ($yourpassword == $cookies2) {
if ($status !== "Admin" && $status !== "Moderator") {
$status = "$status";
}
} else {
echo "";
$skinchoice = "Default";
$status = "Guest";
}
} else {
echo "";
$status = "Guest";
}

?>
