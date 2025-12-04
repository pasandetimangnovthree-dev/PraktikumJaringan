<?php
spl_autoload_register(function($class){
    $basePath = __DIR__.'/../';
    $class = str_replace('\\', '/', $class);
    $paths = [
        "$basePath/src/$class.php",
        "$basePath/$class.php"
    ];
    foreach($paths as $file){
        if(file_exists($file)) {
            require $file;
            break;
        }
    }
});

$cfg = require __DIR__.'/../config/env.php';

use Src\Helpers\Response;
use Src\Middlewares\CorsMiddleware;
//use Src\Helpers\Ratelimiter;

// CORS preflight early (OPTIONS)
CorsMiddleware::handle($cfg);
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Rate limiting untuk endpoint sensitif
// $key = $_SERVER['HTTP_AUTHORIZATION'] ?? 'ip:'.($_SERVER['REMOTE_ADDR'] ?? 'unknown');
// if(!Ratelimiter::check($key, 100, 60)) {
//     Response::jsonError(429, 'Too Many Requests');
// }

$uri = strtok($_SERVER['REQUEST_URI'], '?');
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$path = '/'.trim(str_replace($base, '', $uri), '/');
$method = $_SERVER['REQUEST_METHOD'];

// Routes map
$routes = [
    ['GET', '/api/v1/contract', 'Src\Controllers\HealthController@contract'],
    ['GET', '/api/v1/health', 'Src\Controllers\HealthController@show'],
    ['GET', '/api/v1/version', 'Src\Controllers\HealthController@version'],
    ['POST', '/api/v1/auth/login', 'Src\Controllers\AuthController@login'],
    ['GET', '/api/v1/users', 'Src\Controllers\UserController@index'],
    ['GET', '/api/v1/users/{id}', 'Src\Controllers\UserController@show'],
    ['POST', '/api/v1/users', 'Src\Controllers\UserController@store'],
    ['PUT', '/api/v1/users/{id}', 'Src\Controllers\UserController@update'],
    ['DELETE', '/api/v1/users/{id}', 'Src\Controllers\UserController@destroy'],
    ['POST', '/api/v1/upload', 'Src\Controllers\UploadController@store'],
];

function matchRoute($routes, $method, $path) {
    foreach($routes as $route) {
        [$m, $p, $h] = $route;
        if($m !== $method) continue;
        
        $regex = preg_replace('#\{[^/]+\}#', '([^/]+)', $p);
        if(preg_match('#^'.$regex.'$#', $path, $matches)) {
            array_shift($matches);
            return [$h, $matches];
        }
    }
    return [null, null];
}

[$handler, $params] = matchRoute($routes, $method, $path);

if(!$handler) {
    Response::jsonError(404, 'Route not found');
}

[$class, $action] = explode('@', $handler);
if(!class_exists($class) || !method_exists($class, $action)) {
    Response::jsonError(405, 'Method not allowed');
}

call_user_func_array([new $class($cfg), $action], $params);