<?php
// Anime que queremos buscar
$anime = "naruto";

// Endpoint da Jikan API
// $url = "https://api.jikan.moe/v4/anime?q=" . urlencode($anime) . "&limit=2";

$url = "https://api.jikan.moe/v4/seasons/now";

// Faz a requisição
$response = file_get_contents($url);

// Converte para array associativo
$data = json_decode($response, true);

// Pega o primeiro resultado
$i = 0;
while (isset($data['data'][$i])) {
    $animeData = $data['data'][$i];
    $title = $animeData['title'];
    $image = $animeData['images']['jpg']['image_url'];
    $synopsis = $animeData['synopsis'];

    echo "<h1>{$title}</h1>";
    echo "<img src='{$image}' alt='{$title}' style='width:200px'><br>";
    echo "<p>{$synopsis}</p>";
    $i++;
} 
?>
