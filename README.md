# Roman Numerals API

## Brief
A simple RESTful API which will convert an integer to its roman numeral counterpart. This solution contains three API endpoints, and only supports integers ranging from 1 to 3999. It keeps track of conversions to determine which is the most frequently converted integer, and the last time this was converted.

### Endpoints Required
 1. Accepts an integer, converts it to a roman numeral, stores it in the database and returns the response.
 2. Lists all the recently converted integers.
 3. Lists the top 10 converted integers.

## Configurations
Please setup a database and configure the connection by setting the following `env` variables.
```
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
Run the migration files.
```
php artisan migrate
```

## Usage
1. Convert an integer to a roman numeral equivalent by making a GET request to `/api/convert` with `source`, `target`, and `input` (the integer to be converted) parameters. For example, to convert the integer 1382 to roman numerals,
```
curl "http://localhost:8000/api/convert?source=integer&target=roman&input=1382"
```
2. List the recently converted integers by making a GET request to `/api/list` with `type` and `elapsed` (the no. of seconds that has elapsed since the oldest conversion you want to get has been performed) parameters. For example, to get the recently converted integers within the last hour (60 seconds x 60 minutes),
```
curl "http://localhost:8000/api/list?type=recent&elapsed=3600"
```
3. List the top 10 converted integers by making a GET request to `/api/list` with `type` and `limit` (the no. of integer conversions you want to get) parameters. For example,
```
curl "http://localhost:8000/api/list?type=popular&limit=10"
```
