<?php
header('Content-Type: application/json');

// Functie om het IP-adres van de gebruiker te verkrijgen
function getUserIP() {
    $ipHeaders = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];

    // Itereer over de headers en retourneer het eerste gedetecteerde IP-adres
    foreach ($ipHeaders as $header) {
        if (!empty($_SERVER[$header])) {
            $ips = explode(',', $_SERVER[$header]);
            $ip = trim($ips[0]);
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }

    return null;
}

// Verkrijg het IP-adres van de gebruiker
$userIP = getUserIP();

// JSON-output
$response = ['ip' => $userIP];
echo json_encode($response);
?>
