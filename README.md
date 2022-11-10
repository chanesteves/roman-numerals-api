# Roman Numerals API Task
This development task is based on the Roman Numeral code kata which may have already been completed during this recruitment process. This task requires you to build a JSON API and so any HTML, CSS or JavaScript that is submitted will not be reviewed.

## Brief
Our client (Numeral McNumberFace) requires a simple RESTful API which will convert an integer to its roman numeral counterpart. After our discussions with the client, we have discovered that the solution will contain three API endpoints, and will only support integers ranging from 1 to 3999. The client wishes to keep track of conversions so they can determine which is the most frequently converted integer, and the last time this was converted.

### Endpoints Required
 1. Accepts an integer, converts it to a roman numeral, stores it in the database and returns the response.
 2. Lists all the recently converted integers.
 3. Lists the top 10 converted integers.
 
## What we are looking for
 - Use of MVC components (View in this instance can be, for example, a Laravel Resource).
 - Use of [Fractal](https://fractal.thephpleague.com/) or [Laravel Resources](https://laravel.com/docs/8.x/eloquent-resources)
 - Use of Laravel features such as Eloquent, Requests, Validation and Routes.
 - An implementation of the supplied interface.
 - The supplied PHPUnit test passing.
 - Clean code, following PSR-12 standards.
 - Use of PHP 7.4 features where appropriate.
 
## Submission Instructions
Please create a [git bundle](https://git-scm.com/docs/git-bundle/) and send the file across:
```
git bundle create <yourname>.bundle --all --branches
```

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
