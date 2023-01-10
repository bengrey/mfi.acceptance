<?php
$id = 953;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://investments.mentorsflow.com/wp-json/dcp3450/test_endpoint/");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        "delete" => $id,
        'action' => 'deleter_post',
    )
);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

var_dump($server_output);

curl_close($ch);