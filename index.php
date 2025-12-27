<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RayZen - Official Site</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap');
    * {
        font-family: "Google Sans";
    }
    body {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to bottom, #AB29CF, black);
    }
    .container {
        background-color: black;
        border-radius: 15px;
        text-align: center;
        width: 33%;
        color: white;
        box-shadow: 0px 0px 10px white;
        height: 150px;
    }
    a {
        color: blue;
        padding: 5px;
    }
</style>
<body>
    <div class="container">
        <h1>RZ-SEC</h1>
        <p>Join our Discord comunity</p>
        <a href="https://discord.gg/GhEaJ7phk">Click to join our Discord comunity</a><br>
    </div>
</body>
<?php
date_default_timezone_set("Europe/Berlin");

$time = date("Y-m-d H:i:s");

// IP (Cloudflare uyumlu)
$ip = $_SERVER['HTTP_CF_CONNECTING_IP']
    ?? $_SERVER['REMOTE_ADDR']
    ?? 'unknown';

// Language (tarayıcıdan)
$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'unknown';

// Country (IP tabanlı – hafif ve yaygın)
$country = 'Unknown';
if ($ip !== 'unknown') {
    $geo = @file_get_contents("http://ip-api.com/json/$ip?fields=status,country");
    if ($geo !== false) {
        $data = json_decode($geo, true);
        if (is_array($data) && ($data['status'] ?? '') === 'success') {
            $country = $data['country'] ?? 'Unknown';
        }
    }
}

// Log satırı
$line = "$time | IP:$ip | Country:$country | Lang:$lang\n";

// Yaz
file_put_contents(__DIR__ . "/access.log", $line, FILE_APPEND | LOCK_EX);

// Sessiz cevap
http_response_code(204);
?>
</html>

