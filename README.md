# evas-example
Example of application with evas php framework


## System requirements

PHP 7.2+


## Installation

1. Install Composer
https://getcomposer.org/download/

2. Run command
```
composer install
```

## Routing info

### Handlers policy

1. File handler:
```PHP
$router->get('/login', 'login.php');
```

2. Callable handler:
```PHP
$router->get('/login', function () {});
```

3. Class method handler:
```PHP
$router->post('/login', [AuthController::class => 'login']);
```

4. Handlers list:
```PHP
$router->get('/login', [
    AuthController::class => 'login',
    'login.php',
]);
```

For use url parts in handler args
```PHP
$router
    ->alias(':id', '(:int') // set alias for id
    ->get('/user/:id', function ($user_id) {
        echo "user with id = $user_id<br>";
    })
```

### Map and Auto Router, grouping

1. The main router is Map router
```PHP
(new Router) // init Router
    ->post('/login', [AuthController::class => 'login']) // set handler to POST /login
    ->routingByRequst(App::request()) // routing by request
    ->handle(); // handle routing result
```

2. Set inner Map and Auto router
```PHP
(new Router) // init Router
    ->default('404.php') // set default handler
    ->middlewares([ // set global middlewares
        [Tracker::class => 'trackVisit'],
        [AuthController::class => 'setAuthUser']
    ])
    ->post('/login', [AuthController::class => 'login']) // set handler to POST /login
    ->routingByRequst(App::request()) // routing by request
    ->map('/api/v4') // set child map router to ALL /api/v4
        ->default('apiV4_404.php') // set child map router default handler
        ->middleware(function () {  // set middleware to child map router
            // check access
        })
        ->map('/user', 'GET') // set child map router to GET /api/v4/user
            ->get('/list', [UserController::class => 'list'])
            ->next() // move to parent router
        ->next() // move to parent router
    ->autoByFile('/', 'GET') // set child auto router to GET /
        ->filePostfix('.php') // set auto router file postfix
        ->next() // move to parent router
    ->handle(); // handle routing result
```

## Database

### Init

Create db.php in ./config with:
```PHP
return [
    'dbname' => 'database_name',
    'username' => 'username_database',
    'password' => 'password_database',
];
```

Evas\Orm\Integrate\AppDbTrait has methods for getting, setting and initial single database

Evas\Orm\Integrate\AppDbsTrait has methods for getting, setting and initial multiple database

Usage this trait in your App
```PHP
class App extends \Evas\Web\App
{
    use \Evas\Orm\Integrate\AppDbTrait;
}

$qr = App::db()->query('SELECT * FROM users');
var_dump($qr->assocArrayAll());
```
query() returned Evas\Orm\QueryResult object

Get the number of rows returned.
```PHP
$rowCount = $qr->rowCount();
```
Get the record as a numbered array.
```PHP
$numericArray = $qr->numericArray();
```
Get all records as an array of numbered arrays.
```PHP
$numericArrayAll = $qr->numericArrayAll();
```
Get the record as a associative array.
```PHP
$assocArray = $qr->assocArray();
```
Get all records as an array of associative arrays.
```PHP
$assocArrayAll = $qr->assocArrayAll();
```
Get the record as a class object.
```PHP
$classObject = $qr->classObject();
```
Get all records as class objects.
```PHP
$classObjectAll = $qr->classObjectAll();
```

