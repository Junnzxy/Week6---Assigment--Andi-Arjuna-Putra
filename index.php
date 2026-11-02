<?php
/**
 * Assignment Week 6 - PHP MVC Layouting & Partials
 * Front Controller & Router
 */

// PSR-4 style autoloader for App namespace
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Routing
$page = $_GET['page'] ?? 'employee';
$action = $_GET['action'] ?? 'index';

switch ($page) {
    case 'office':
        $controller = new \App\Controllers\OfficeController();
        if ($action === 'store') {
            $controller->store();
        } elseif ($action === 'delete') {
            $controller->delete();
        } else {
            $controller->index();
        }
        break;

    case 'office-employees':
        $controller = new \App\Controllers\OfficeEmployeeController();
        if ($action === 'store') {
            $controller->store();
        } elseif ($action === 'delete') {
            $controller->delete();
        } else {
            $controller->index();
        }
        break;

    default: // 'employee'
        $controller = new \App\Controllers\EmployeeController();
        if ($action === 'store') {
            $controller->store();
        } elseif ($action === 'delete') {
            $controller->delete();
        } else {
            $controller->index();
        }
        break;
}

