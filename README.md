## Test task:

Create docker-compose file including laravel app(API only), redis and mysql.
Create simple Laravel app with one endpoint.
`GET /api/v1/health-check`.

Endpoint should check all connections to the infra services and respond 200 or 500 code in different cases with json.
If one of service is unavailable - respond should be 500.

Endpoint must have throttle 60 rq/minute

```json
{
  "db": true,
  "cache": false
}
```

Every request to endpoint MUST be signed with header `X-Owner: {uuid}`
Each request MUST be saved in DB (simple table)

##
##

## Тестове завдання:
Створення docker-comose з laravel (тільки API, redis і mysql.
Створіть просту програму Laravel з одним роутом. 
`GET /api/v1/health-check`.

Роут має перевірити всі підключення до інфраслужб і відповісти 200 або 500 кодом у різних випадках за допомогою json.
Якщо одна із служб недоступна - відповідь 500.

Кінцева точка повинна мати throttle 60 запитів/хв

```json
{
  "db": true,
  "cache": false
}
```

Кожен запит до кінцевої точки ПОВИНЕН бути підписаний заголовком X-Owner: {uuid}
Кожен запит ПОВИНЕН зберігатися в БД (проста таблиця)
