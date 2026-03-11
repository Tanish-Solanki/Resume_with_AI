<?php

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['text'])) {
    echo json_encode(['error' => 'No text provided.']);
    exit;
}

$apiKey = "XXXXXXXXXXXXXXXXXXXXXXXXXX"; // 🔑 Replace with your Gemini API Key from makersuite
$inputText = $data['text'];

// Prepare payload
$payload = [
    "contents" => [[
        "parts" => [[ "text" => $inputText ]]
    ]]
];

// Prepare request
$ch = curl_init("https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent?key=" . $apiKey);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);

// Execute and parse response
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    echo json_encode(['text' => $result['candidates'][0]['content']['parts'][0]['text']]);
} elseif (isset($result['error'])) {
    echo json_encode(['error' => $result['error']['message'], 'details' => $result]);
} else {
    echo json_encode(['error' => 'Unexpected response', 'raw' => $result]);
}


// old

// <?php

// require "vendor/autoload.php";

// use GeminiAPI\Client;
// use GeminiAPI\Resources\Parts\TextPart;

// header('Content-Type: application/json');

// $data = json_decode(file_get_contents("php://input"));

// if (isset($data->text)) {
//     $text = $data->text;

//     try {
//         $client = new Client("AIzaSyCJfKNpeg1oORZhKyfil2JLRQYvv7ERkp4"); # replace with your API key (GEMINI)

//         // 🔁 Changed only this line to use gemini-2.0-flash
//         $response = $client->model('gemini-2.0-flash')->generateContent(new TextPart($text));

//         echo json_encode(['text' => $response->text()]);
//     } catch (Exception $e) {
//         echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
//     }
// } else {
//     echo json_encode(['error' => 'No text provided.']);
// }
//

// old-end


?>








