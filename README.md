### MAHIKER CRM Events


1. Установка зависимостей
```bash
$ composer install
```


2. Настройка окруженности (.env)
```bash 
...

APP_ENV=prod

....

DATABASE_URL="postgresql://USERNAME:PASSWORD@127.0.0.1:5432/DATABASE?serverVersion=15&charset=utf8"

... 
```


3. Выполнение миграции
```bash 
$ bin/console make:migration
$ bin/console doctrine:migrations:migrate
```


4. Добавление пользователей
```bash 
$ bin/console app:users:store
```

5. Запуск локалного сервера
```bash 
$ symfony serve (если установлен симфони глобально)

ИЛИ 

$ php -S 127.0.0.1:8000 -t public -d display_errors=1
```

6. Войти в систему как админ 
```bash
логин  : andrey@gmail.com
пароль : andrey123
```


