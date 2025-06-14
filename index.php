<?php

function get_redirect_url($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    $final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    return $final_url;
}

if (isset($_GET['url']) && !empty($_GET['url'])) {
    $url = $_GET['url'];
    $redirect_url = get_redirect_url($url);

    header('Content-Type: application/json');
    echo json_encode([
        'url' => $url,
        'redirect_url' => $redirect_url
    ], JSON_UNESCAPED_SLASHES); 
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No URL provided.'], JSON_UNESCAPED_SLASHES);
}
?>
