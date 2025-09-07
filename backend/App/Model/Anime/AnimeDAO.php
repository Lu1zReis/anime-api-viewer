<?php

namespace connect;

Class AnimeDAO {

    public function pegarTodos() {
        $url = "https://api.jikan.moe/v4/anime";

        // Faz a requisição
        $response = file_get_contents($url);

        $data = json_decode($response, true);

        return $data;
    }

    public function pegarAnime($anime) {
        $url = "https://api.jikan.moe/v4/anime?q=" . urlencode($anime) . "&limit=5";

        $response = file_get_contents($url);

        $data = json_decode($response, true);

        return $data;
    }

    public function pegarAnimePorGenero($id_genero) {
        $url = "https://api.jikan.moe/v4/genres/anime";

        $response = file_get_contents($url);

        $data = json_decode($response, true);

        return $data;
    }
}