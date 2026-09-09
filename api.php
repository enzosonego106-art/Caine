<?php

header("Content-Type: application/json");

$apiKey = "sk-47e75be62b8e4f089bc98812cc7330eb";

// pega mensagem
$input = json_decode(file_get_contents("php://input"), true);

if (!$input || !isset($input["mensagem"])) {
    echo json_encode(["resposta" => "Erro: mensagem não enviada"]);
    exit;
}

$mensagem = $input["mensagem"];

// dados da requisição
$data = [
    "model" => "deepseek-chat",
    "messages" => [
        ["role" => "user", "content" => $mensagem]
    ]
];

// cURL
$ch = curl_init("https://api.deepseek.com/chat/completions");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $apiKey
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(["resposta" => "Erro: " . curl_error($ch)]);
    exit;
}

curl_close($ch);

$response = json_decode($result, true);

// erro da API
if (isset($response["error"])) {
    echo json_encode([
        "resposta" => "Erro API: " . $response["error"]["message"]
    ]);
    exit;
}

// resposta final
echo json_encode([
    "resposta" => $response["choices"][0]["message"]["content"] ?? "Sem resposta"
]);