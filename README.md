Парсер РБК
## Установка

--------  Для развертывания приложения используется Docker ------
1) Забираем код из репозитория
2) В терминали переходим в корневую дирректорию проекта
3) Выполняем команды:

- **docker-compose build**
- **docker-compose up -d**
- **composer install**

Проект развернут, зависимости установлены!
4) Выполняем миграции
- Переходим в контейнер: **docker exec -it project_app bash**
- Выполняем команду: **php artisan migrate** 
5) Запускаем парсер командой: **php artisan roach:run RbkSpider**


## Запуск
Переходим в браузере http://test.local .
- Если возникнут проблемы с открытием этого адреса - добавьте hosts файл вашей ОС следующую запись: **127.0.0.1 test.local**

- Инструкция для Windows: https://help.reg.ru/hc/ru/articles/4408047768849-%D0%A4%D0%B0%D0%B9%D0%BB-hosts-%D0%B4%D0%BB%D1%8F-Windows-10
- Инструкция для Mac: https://help.reg.ru/hc/ru/articles/4408047764625-%D0%A4%D0%B0%D0%B9%D0%BB-hosts-%D0%BD%D0%B0-macOS
