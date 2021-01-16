<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}


$name2 = $_POST['name2'];
$visitor_email2 = $_POST['email2'];
$message2 = $_POST['message2'];

//Validate first
/*if(empty($pname)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}*/
if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'info@cynotive.com';//<== update the email address
$email_subject = "New Query Generated from - Footer cynotive.com";
$email_body = "Name : $name2\n".
              "Email Id : $visitor_email2\n".
              "Message : $message2\n".
              "-----\n".
    
$to = "cynotive@gmail.com";//<== update the email address

$headers = "From: $email_from \r\n";
$headers .= 'Cc: pramitshah41@gmail.com\r\n';
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.

header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 