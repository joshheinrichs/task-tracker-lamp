<?php

function call($controller, $action)
{
    require_once('controllers/' . $controller . '_controller.php');

    switch ($controller) {
        case 'pages':
            $controller = new PagesController();
            break;
        case 'projects':
            require_once('models/project.php');
            $controller = new ProjectsController();
            break;
        case 'tasks':
            require_once('models/task.php');
            $controller = new TasksController();
            break;
        case 'comments':
            require_once('models/comment.php');
            $controller = new CommentsController();
            break;
    }
    $controller->{$action}();
}

$controllers = array('pages' => ['home', 'error'],
    'projects' => ['index', 'show', 'edit', 'create', 'update', 'delete'],
    'tasks' => ['show', 'edit', 'create', 'update', 'delete'],
    'comments' => ['create']);


if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}