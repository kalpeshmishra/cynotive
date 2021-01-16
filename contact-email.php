<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}


$name = $_POST['name'];
$visitor_email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

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
$email_subject = "New Query Generated from -Contact Us Form cynotive.com";
$email_body = "Name : $name\n".
              "Email Id : $visitor_email\n".
              "Contact No : $contact\n".
              "Budget : $budget\n\n".
              "Message : $message\n".
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