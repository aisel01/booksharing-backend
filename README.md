# backend проекта booksharing

## Установка параметров соединения с базой данных
    php install.php

- [Действия с пользователями]()
  - [users.get.php]()
  - [user.get.php]()
  - [user.put.php]()
  - [user.delete.php]()

- [Действия с книгами]()
  - [books.get.php]()
  - [book.get.php]()
  - [book.delete.php]()
  - [book.google.search.php]()

- [Действия с обменами](#exchanges.get.php)
  - [exchanges.get.php](#exchanges.get.php)
  - [exchange.get.php](#exchange.get.php)
  - [exchange.put.php](#exchange.put.php)
  - [exchange.update.php](#exchange.update.php)

 ## <a name="exchanges.get.php"></a> exchanges.get.php

**Для получения списка обменов пользователя**

 Принимает GET-параметры:

 `user_id` - id пользователя,

 `page`  - номер страницы.

 Отдает JSON вида

     {
        "total_pages": 2,
        "exchanges": [
            {
                "id": "1",
                "state": "завершен",
                "target_user": {
                    "id": "2",
                    "name": "scarlet",
                    "image": "img/samples/scarlett-300.jpg"
                },
                "origin_user": {
                    "id": "1",
                    "name": "ryan",
                    "image": "img/samples/ryan-300.jpg"
                },
                "target_book": {
                    "id": "1",
                    "user_id": "1",
                    "isbn": "11-250-1155",
                    "title": "Анна Каренина",
                    "image": "img/samples/galaxy.jpg"
                },
                "origin_book": {
                    "id": "2",
                    "user_id": "2",
                    "isbn": "158-250-1155",
                    "title": "Алиса в Стране чудес",
                    "image": "img/samples/galaxy.jpg"
                }
            }
        ]
    }

## <a name="exchange.get.php"></a> exchange.get.php

**Для получения информации об обмене по его id**

Принимает GET-параметр `id` - id обмена.

Пример JSON ответа:

    {
        "state": "завершен",
        "origin_user": {
            "id": "1",
            "name": "ryan",
            "image": "img/samples/ryan-300.jpg"
        },
        "target_user": {
            "id": "2",
            "name": "scarlet",
            "image": "img/samples/scarlett-300.jpg"
        },
        "origin_book": {
            "id": "2",
            "user_id": "2",
            "isbn": "158-250-1155",
            "title": "Алиса в Стране чудес",
            "image": "img/samples/galaxy.jpg"
        },
        "target_book": {
            "id": "1",
            "user_id": "1",
            "isbn": "11-250-1155",
            "title": "Анна Каренина",
            "image": "img/samples/galaxy.jpg"
        }
    }

## <a name="exchange.put.php"></a> exchange.put.php

**Для создания нового обмена**

GET-параметры:

`origin_user_id` - номер пользователя пользователя, предложившего обмен,

`origin_book_id` - номер книги, которую предлагает пользователь, предложивший обмен,

`target_user_id` - номер пользователя, которому предлагают обмен,

`target_book_id` - номер книги, которую просят почитать.

Пример ответа:

    {
        "message": "Обмен предложен"
    }

## <a name="exchange.update.php"></a> exchange.update.php

**Для обновления состояния обмена**

GET-параметры:

`id` - номер обмена, у котрого обновляется состояние,

`state` - новое состояние обмена (предложение/в процессе/завершен/отмена).

Пример ответа:

    {
        "message": "Статус изменен"
    }
