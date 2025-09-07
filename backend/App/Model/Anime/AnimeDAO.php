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

    public function pesquisarAnime($anime) {
        $url = "https://api.jikan.moe/v4/anime?q=" . urlencode($anime) . "&limit=5";

        $response = file_get_contents($url);

        $data = json_decode($response, true);

        return $data;
    }

    public function pegarAnime($id) {
        $url = "https://api.jikan.moe/v4/anime/".$id;

        $response = file_get_contents($url);

        $data = json_decode($response, true);

        return $data;
    }

    public function pegarAnimesRelacionado($id) {
        $url = "https://api.jikan.moe/v4/anime/".$id."/relations";

        $response = file_get_contents($url);

        $data = json_decode($response, true);

        return $data;
    }
}