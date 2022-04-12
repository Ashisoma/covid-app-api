<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.onfonmedia.co.ke/v1/sms/SendBulkSMS',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "SenderId": "CHS-NMECFRM",
    "MessageParameters": [
        {
            "Number": "254708995130",
            "Text": "Test Message 1230hrs_API"
        },
        {
            "Number": "254721218922",
            "Text": "Test Message 1230hrs_API"
        },
         {
            "Number": "254769007416",
            "Text": "Test Message 1230hrs_API"
        }
    ],
    "ApiKey": "z/ZWK3U4w4O+xnajLW20HoZiUvTwKzMFB6gct8tASOA=",
    "ClientId": "3d9fd917-62ae-4584-a420-ceb5dcffc3dd"
}
',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'AccessKey: oY8yT8U8Lw5UqF4ME5CZDfUE570tfmm2',
    'Cookie: AWSALBTG=RYF4yJy4IjopmAKq280k3ni1vkH0ZeGyPJF4rJ2RA/DBTunvpxZCZLoEKW6rPXlQ5guIbpFNvsKFaF1do0ArwJ4MTQsNOCl6zRUQjySm/KKa7X3keGkmWj/loVxcLeWpWakj0tR85+FybC6P9fdxSAIPlHTZ/R8SrVQuwfimdj+LAK0QgfU=; AWSALBTGCORS=RYF4yJy4IjopmAKq280k3ni1vkH0ZeGyPJF4rJ2RA/DBTunvpxZCZLoEKW6rPXlQ5guIbpFNvsKFaF1do0ArwJ4MTQsNOCl6zRUQjySm/KKa7X3keGkmWj/loVxcLeWpWakj0tR85+FybC6P9fdxSAIPlHTZ/R8SrVQuwfimdj+LAK0QgfU='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;