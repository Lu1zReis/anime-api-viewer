````markdown
# Guia de Uso da Jikan API (Anime)

Este documento serve como referência rápida para usar a [Jikan API](https://jikan.moe/) e obter informações sobre animes, gêneros, personagens, staff, episódios e rankings.

---

## 1. Requisição Básica

```php
$response = file_get_contents($url);
````

---

## 2. Buscar Anime por Nome

Permite buscar um anime e obter informações gerais, incluindo `mal_id`.

```php
$anime = "naruto";
$url = "https://api.jikan.moe/v4/anime?q=" . urlencode($anime) . "&limit=1";
```

### Exemplo de Retorno (resumido):

```json
{
  "data": [
    {
      "mal_id": 20,
      "title": "Naruto",
      "url": "https://myanimelist.net/anime/20/Naruto",
      "images": {
        "jpg": {
          "image_url": "https://cdn.myanimelist.net/images/anime/13/17405.jpg"
        }
      },
      "episodes": 220,
      "status": "Finished Airing",
      "genres": [
        { "mal_id": 1, "name": "Action" },
        { "mal_id": 2, "name": "Adventure" },
        { "mal_id": 4, "name": "Comedy" }
      ],
      "relations": [
        { "relation": "Sequel", "entry": [{ "mal_id": 1735, "title": "Naruto: Shippuuden" }] }
      ],
      "trailer": {
        "youtube_id": "KbiM5U0B0-k",
        "url": "https://www.youtube.com/watch?v=KbiM5U0B0-k"
      }
    }
  ]
}
```

---

## 3. Listagem de Animes

* `https://api.jikan.moe/v4/anime` — lista de animes.
* `https://api.jikan.moe/v4/anime?order_by=score&sort=desc&limit=10` — Top 10 por nota.
* `https://api.jikan.moe/v4/top/anime` — Top animes mais bem avaliados.

---

## 4. Gêneros

* Lista de gêneros e IDs:

  ```
  https://api.jikan.moe/v4/genres/anime
  ```

* Buscar animes por gênero:

  ```
  https://api.jikan.moe/v4/anime?genres=1&limit=5      // Apenas gênero Action
  https://api.jikan.moe/v4/anime?genres=1,4&limit=5    // Action e Comedy
  ```

---

## 5. Filtragem

Filtros que podem ser aplicados nas consultas:

* `?type=movie` — tipo do anime
* `?filter=airing` — em exibição
* `?filter=upcoming` — próximos lançamentos

Exemplo:

```
https://api.jikan.moe/v4/top/anime?type=movie&limit=5 // top 5 filmes de anime 
```

Retorna o top 5 filmes de animes.

---

## 6. Personagens & Staff

* Requer o `mal_id` do anime:

```
https://api.jikan.moe/v4/anime/20/characters      // Naruto
https://api.jikan.moe/v4/anime/5114/staff        // Fullmetal Alchemist: Brotherhood
```

---

## 7. Episódios

* Listar todos os episódios:

```
https://api.jikan.moe/v4/anime/20/episodes
```

* Episódio específico:

```
https://api.jikan.moe/v4/anime/20/episodes/1
```

---

## 8. Dicas

* Sempre use o `mal_id` para endpoints específicos (`characters`, `staff`, `episodes`), pois os nomes podem variar.
* Você pode combinar filtros (`genres`, `type`, `filter`) para consultas personalizadas.
* Para descobrir quantas temporadas um anime tem, utilize `episodes` + `relations` (sequels e continuations).

---

> Esse README serve como referência rápida para desenvolver aplicações com a Jikan API em PHP ou qualquer outra linguagem que consuma APIs REST.

