<?php

$my_email = "bissenj@gmail.com,horiconmarshww@yahoo.com";

/*

Enter the continue link to offer the user after the form is sent.  If you do not change this, your visitor will be given a continue link to your homepage.

If you do change it, remove the "/" symbol below and replace with the name of the page to link to, eg: "mypage.htm" or "http://www.elsewhere.com/page.htm"

*/

$continue = "http://horiconmarshww.com";

/*

Step 3:

Save this file (FormToEmail.php) and upload it together with your webpage containing the form to your webspace.  IMPORTANT - The file name is case sensitive!  You must save it exactly as it is named above!  Do not put this script in your cgi-bin directory (folder) it may not work from there.

THAT'S IT, FINISHED!

You do not need to make any changes below this line.

*/

$errors = array();

// Remove $_COOKIE elements from $_REQUEST.

if(count($_COOKIE)){foreach(array_keys($_COOKIE) as $value){unset($_REQUEST[$value]);}}

// Check all fields for an email header.

function recursive_array_check_header($element_value)
{

global $set;

if(!is_array($element_value)){if(preg_match("/(%0A|%0D|\n+|\r+)(content-type:|to:|cc:|bcc:)/i",$element_value)){$set = 1;}}
else
{

foreach($element_value as $value){if($set){break;} recursive_array_check_header($value);}

}

}

recursive_array_check_header($_REQUEST);

if($set){$errors[] = "You cannot send an email header";}

unset($set);

// Validate email field.

if(isset($_REQUEST['email']) && !empty($_REQUEST['email']))
{

if(preg_match("/(%0A|%0D|\n+|\r+|:)/i",$_REQUEST['email'])){$errors[] = "Email address may not contain a new line or a colon";}

$_REQUEST['email'] = trim($_REQUEST['email']);

if(substr_count($_REQUEST['email'],"@") != 1 || stristr($_REQUEST['email']," ")){$errors[] = "Email address is invalid";}else{$exploded_email = explode("@",$_REQUEST['email']);if(empty($exploded_email[0]) || strlen($exploded_email[0]) > 64 || empty($exploded_email[1])){$errors[] = "Email address is invalid";}else{if(substr_count($exploded_email[1],".") == 0){$errors[] = "Email address is invalid";}else{$exploded_domain = explode(".",$exploded_email[1]);if(in_array("",$exploded_domain)){$errors[] = "Email address is invalid";}else{foreach($exploded_domain as $value){if(strlen($value) > 63 || !preg_match('/^[a-z0-9-]+$/i',$value)){$errors[] = "Email address is invalid"; break;}}}}}}

}

// Check referrer is from same site.

if(!(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && stristr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))){$errors[] = "You must enable referrer logging to use the form";}

// Check for a blank form.

function recursive_array_check_blank($element_value)
{

global $set;

if(!is_array($element_value)){if(!empty($element_value)){$set = 1;}}
else
{

foreach($element_value as $value){if($set){break;} recursive_array_check_blank($value);}

}

}

recursive_array_check_blank($_REQUEST);

if(!$set){$errors[] = "You cannot send a blank form";}

unset($set);

// Display any errors and exit if errors exist.

if(count($errors)){foreach($errors as $value){print "$value<br>";} exit;}

if(!defined("PHP_EOL")){define("PHP_EOL", strtoupper(substr(PHP_OS,0,3) == "WIN") ? "\r\n" : "\n");}

// Build message.

function build_message($request_input){if(!isset($message_output)){$message_output ="";}if(!is_array($request_input)){$message_output = $request_input;}else{foreach($request_input as $key => $value){if(!empty($value)){if(!is_numeric($key)){$message_output .= str_replace("_"," ",ucfirst($key)).": ".build_message($value).PHP_EOL.PHP_EOL;}else{$message_output .= build_message($value).", ";}}}}return rtrim($message_output,", ");}

$message = build_message($_REQUEST);

$message = $message . PHP_EOL.PHP_EOL."-- ".PHP_EOL."";

$message = stripslashes($message);

$subject = "HMWW - Volunteer Sign Up";

$headers = "From: " . $_REQUEST['email'];

mail($my_email,$subject,$message,$headers);

?>

<!doctype html>
<html><!-- InstanceBegin template="/Templates/Horicon.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Horicon Marsh Wounded Warriors - DucksforVets.com - Horicon, WI</title>
<!-- InstanceEndEditable -->
<style type="text/css">
body,td,th {
	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;
	font-style: normal;
	font-weight: normal;
	font-size: 12px;
	color: #533832;
}
<br>
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(/images/Horicon-WW-bkgd2.png);
	background-color: #FFF;
	background-repeat: repeat-y;
}
a:link {
	color: #898B5B;
	text-decoration: none;
}
a:visited {
	color: #898B5B;
	text-decoration: none;
}
a:hover {
	color: #9F826E;
	text-decoration: none;
}
a:active {
	color: #9F826E;
	text-decoration: none;
}
h1 {
	font-size: 16px;
}
h2 {
	font-size: 14px;
	color: #898b5b;
}
h3 {
	font-size: 14px;
	color: #656f65;
}
h4 {
	font-size: 14px;
	color: #9e816d;
}
a {<meta name="keywords" content="horicon, horicon marsh, horicon march, horicon marsh wounded warriors, horicon marsh ww, horicon duck hunting, duck hunting wi, wisconsin, horicon, beaver dam, mayville, duck hunt beaver dam, duck hunt veterans, duck hunt mayville, duck hunt horicon, wounded warriors in wisconsin, ducks for vets, ducksforvets.com, horiconmarshww.com, veterans, helping veterans, duck hunting for veterans, programs for veterans, horicon wi, horicon wi duck, horicon wi duck hunting">

	font-style: normal;
	font-weight: bold;
}
body {
	background-image: url(/images/Horicon-WW-bkgd2.png);
	background-repeat: repeat-y;
}
</style>
<meta name="description" content="Horicon Marsh Wounded Warriors - a small group of volunteers that has found a way to give back to our heroes by hosting an annual duck hunting event">
</head>

<body bgcolor="#FFFFFF" text="#533832" link="#898D5B" vlink="#898D5B" alink="#898D5B" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">  
  <tr>
    <td align="center" valign="top"><!-- InstanceBeginEditable name="Header Text" -->
      <h3>Thank You for signing up to Volunteer! Someone will contact you as soon as possible!</h3>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td align="center" valign="top"><!-- InstanceBeginEditable name="Body" -->
      <table width="875" border="0" cellspacing="3" cellpadding="0">
        <tr>
          <td width="857" height="41" align="center" valign="top"><a href="/waystohelp.html">Click here to return to the How You Can Help page          </a></td>
        </tr>
      </table>
    <!-- InstanceEndEditable -->
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td align="center" valign="top">&copy; Horicon Marsh Wounded Warriors, Inc. - A Non Profit Organization ID#45-3354139<br>
      <a href="http://horiconmarshww.com">Home of HoriconMarshWW.com</a> and <a href="http://ducksforvets.com">DucksForVets.com </a><br>
    (We are not affiliated with national Wounded Warriors organization)</td>
  </tr>
</table>

<map name="FB">
  <area shape="circle" coords="847,62,32" href="https://www.facebook.com/HoriconMarshWounedWarriors" target="_blank" alt="Visit Our Facebook Page">
</map>
</body>
<!-- InstanceEnd --></html>
