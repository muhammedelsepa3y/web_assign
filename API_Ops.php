<?php
// Function to get actors by birthdate from IMDb API
function getActorsByBirthdate($birthdate) {
    $api_key = "YOUR_API_KEY";  // Replace with your actual API key
    $url = "https://imdb-api.com/API/BornToday/k_" . $api_key . "/" . $birthdate;
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response, true);
}
?>
