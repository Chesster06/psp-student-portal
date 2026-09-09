<?php

session_start();

require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/ProfileController.php';
require_once __DIR__ . '/../app/controllers/GradeController.php';

$page = $_GET['page'] ?? 'landing';

switch ($page) {
    case 'landing':
        (new HomeController())->index();
        break;

    case 'login':
        (new AuthController())->login();
        break;

    case 'authenticate':
        (new AuthController())->authenticate();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    case 'profile':
        (new ProfileController())->index();
        break;

    case 'settings':
        (new ProfileController())->settings();
        break;

    case 'change-password':
        (new ProfileController())->changePassword();
        break;

    case 'grades':
        (new GradeController())->index();
        break;

    case 'grades-create':
        (new GradeController())->create();
        break;

    case 'grades-store':
        (new GradeController())->store();
        break;

    case 'grades-edit':
        (new GradeController())->edit();
        break;

    case 'grades-update':
        (new GradeController())->update();
        break;

    case 'grades-delete':
        (new GradeController())->delete();
        break;

    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
