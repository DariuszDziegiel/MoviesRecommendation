# MoviesRecommendation 1.0.0

Prosta aplikacja rekomendująca filmy na podstawie wybranego algorytmu

## Uruchomienie lokalne projektu

**Sklonuj projekt**

`````
  git clone https://github.com/DariuszDziegiel/ProductsAPI.git
`````

**Przejdź do katalogu projektu**

```
  cd MoviesRecommendation
```

**Uruchom kontenery docker**

```
  make start
```
Lub jeśli nie masz narzędzia make:
````
docker compose up -d
````

## Jak używać

#### Zwrócenie rekomendacji filmów na podstawie algorytmu

```http
  GET http://localhost?id=${id}
```

| Parametr | Typ       | Description                |
|:---------|:----------|:---------------------------|
| `id`     | `integer` | Id  algorytmu rekomendacji |

Dostępne **id** algorytmów rekomendacji:
* 1: Zwracane są 3 losowe tytuły.
* 2: Zwracane są wszystkie filmy na literę ‘W’ ale tylko jeśli mają parzystą liczbę znaków w tytule.
* 3: Zwracany są wszystkie tytuły, które składają się z więcej niż 1 słowa.


## Uruchomienie testów PHPUnit

Aby uruchomić testy wykonaj:

```
  make test
```
Lub jeśli nie masz narzędzia make:

````
docker compose exec -it apache vendor/bin/phpunit --colors=always --testdox 
````


## Tech Stack
- PHP 8.4
- PHPUnit 12.1,
- Docker

