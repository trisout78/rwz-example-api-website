<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['url'])) {
    echo json_encode(['error' => 1, 'message' => 'URL not provided']);
    exit;
}

$url = $input['url'];

$apiUrl = 'https://rwz.fr/api/url/add';
$bearerToken = 'token';

$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n" .
                     "Authorization: Bearer $bearerToken\r\n",
        'method'  => 'POST',
        'content' => json_encode(['url' => $url]),
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents($apiUrl, false, $context);

if ($result === FALSE) {
    echo json_encode(['error' => 1, 'message' => 'Failed to contact API']);
    exit;
}

echo $result;
?>
