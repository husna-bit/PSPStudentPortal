<?php

session_start();

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ProfileController.php';
require_once __DIR__ . '/controllers/PasswordController.php';
require_once __DIR__ . '/controllers/StudentController.php';

$page = $_GET['page'] ?? 'login';

switch ($page) {

    case 'login':
        (new AuthController())->login();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    case 'profile':
        (new ProfileController())->index();
        break;

    case 'password':
        (new PasswordController())->change();
        break;

    case 'students':
        (new StudentController())->index();
        break;

    case 'student_create':
        (new StudentController())->create();
        break;

    case 'student_edit':
        (new StudentController())->edit();
        break;

    case 'student_delete':
        (new StudentController())->delete();
        break;

    default:

        http_response_code(404);

        echo "Page not found";

        break;
}
?>