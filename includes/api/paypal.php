<?php
function tokenPayPal() {
    $ClientID = 'AZSvRWxB5C4xM6SKSwpJ5vBVH-XnsGhWrwH5877g0iyA-guJx5jRSqkamZcQA8466_XYahSWCe3hXsAu';
    $Secret = 'EPrN-0mM9mhFNEbQYCOkFfrwqvAZCitrZWZh0Cqj0hPXKGVdlfd6u1fSMXi4SkGrE4KLj_VOuq-t4inK';

    $curl = curl_init('https://api-m.sandbox.paypal.com/v1/oauth2/token');

    //curl_setopt_array configura las opciones para una transferencia cURL
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERPWD, $ClientID . ":" . $Secret);
    curl_setopt($curl, CURLOPT_HEADER, "Content-Type: application/x-www-form-urlencoded");
    curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

    // respuesta generada
    $response = curl_exec($curl);
    $response = json_decode($response);

    $accesToken = $response->access_token;

    return $accesToken;
}