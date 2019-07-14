<?php

$guid = $_GET['guid'];

echo $guid;


$aacfile = system("find . -type f -name \"*.aac\" -printf '%T@ %p\n' | sort -n | tail -1 | cut -f2- -d\" \" ");
$aacfile = substr($aacfile, 1);

echo('/var/www/html/SummarizeIT'.$aacfile);

$file = file_get_contents( '/var/www/html/SummarizeIT'.$aacfile);

// Encode the image string data into base64
$data = base64_encode($file);

$url = 'https://ofayilo7ug.execute-api.us-west-2.amazonaws.com/dev/uploadAudio';
$ch = curl_init($url);

//The data you want to send via POST
$jsonData = array(
    'file'      => $data,
    'meetingId' => $guid,
    'meetingOwnerEmail' => "omkar.9194@gmail.com",
);
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

//Execute the request
$result = curl_exec($ch);
echo $result;
return $result;


?>
