<?php

function weatherFunction($coordy){


    $curl = curl_init();
    $key = env('DARK_SKY_KEY');
    $coordinates = "/37.8267,-122.4233";
    //how to pass coordinates here?

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.darksky.net/forecast/" . $key . "/" . $coordy,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "",
    ));

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {

    // $currentSummary = $response['currently']['summary'];
    //$currentSummary = $response['minutely']['summary'];
    $currentSummary = $response['minutely']['summary'];

    

    echo "\n";
    echo $currentSummary;
    echo "\n \n";
    }
    //return $currentSummary;
    //return "hello";
    return $currentSummary;
}


?>
