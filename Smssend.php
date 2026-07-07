<?php

$apiKey = "tNAUWgQw4Lz7UHQNvLG6WMhIcqkzYY1bsjr0yvhETNCZtfdv";

// دریافت اطلاعات از برنامه
$mobile = $_POST["Phone_number"] ?? "";
$message = $_POST["message"] ?? "";

if (empty($mobile) || empty($message)) {
    echo json_encode([
        "success" => false,
        "message" => "شماره یا متن پیام ارسال نشده است."
    ]);
    exit;
}

$data = [
    "mobile" => $mobile,
    "message" => $message
];

$ch = curl_init("https://api.sms.ir/v1/send/bulk");

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Accept: application/json",
        "x-api-key: $apiKey"
    ],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode([
        "success" => false,
        "error" => curl_error($ch)
    ]);
} else {
    echo $response;
}

curl_close($ch);
?>
