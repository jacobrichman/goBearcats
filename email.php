#!/usr/bin/php -q
<?php
//Listen to incoming e-mails
$sock = fopen ("php://stdin", 'r');
$email = '';

//Read e-mail into buffer
while (!feof($sock))
{
    $email .= fread($sock, 1024);
}

//Close socket
fclose($sock);

set_time_limit(600);
ini_set('max_execution_time',600);
?>

<?php

//error_log($email);

//Parse "from"
$from1 = explode ("\nFrom: ", $email);
$from2 = explode ("\n", $from1[1]);

if(strpos ($from2[0], '<') !== false)
{
    $from3 = explode ('<', $from2[0]);
    $from4 = explode ('>', $from3[1]);
    $from = $from4[0];
}
else
{
    $from = $from2[0];
}

//Parse "subject"
$subject1 = explode ("\nSubject: ", $email);
$subject2 = explode ("\n", $subject1[1]);
$subject = $subject2[0];

//Parse Images
$pieces = explode("Content-Transfer-Encoding: base64", $email);
array_shift($pieces);
foreach ($pieces as &$value) {
	$newString = strstr($value, "\n\n");
	$newString = substr($newString, 0, strpos($newString, '--'));
	$PicturesData[] = $newString;
}


foreach ($PicturesData as &$value) {
	$name = time() . ".png";
	while(file_exists("pics/" . $name)) {
		$name = time() . ".png";
	}
	file_put_contents("pics/".$name, base64_decode($value));
}

//Reply Email
if(count($PicturesData) > 0){
	$to = $from;
	$newmsg = "Thanks! I just uploaded it.";
	$headers = 'From: lets@gobearcats.com' . "\r\n" .
	'Reply-To: lets@gobearcats.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	mail($to,$subject,$newmsg,$headers);
}
else{
	$to = $from;
	$newmsg = "Sorry. There was an error uploading.";
	$headers = 'From: lets@gobearcats.com' . "\r\n" .
	'Reply-To: lets@gobearcats.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	mail($to,$subject,$newmsg,$headers);
}
?>
