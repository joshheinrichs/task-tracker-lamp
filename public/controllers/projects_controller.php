<?php
require_once('models/project.php');
require_once('models/task.php');

class ProjectsController
{

    /**
     * Displays the index page for all the projects.
     * Expects a url like: /?controller=projects&action=index
     */
    public function index()
    {
        $projects = Project::getAll();
        require_once('views/projects/index.php');
    }

    /**
     * Displays the show page for the project.
     * Expects a url like: /?controller=projects&action=show&id=0
     */
    public function show()
    {
        if (!isset($_GET['id'])) {
            call('pages', 'error');
            return;
        }

        $project = Project::find($_GET['id']);
        $tasks = Task::getAllForProject($_GET['id']);
        require_once('views/projects/show.php');
    }

    /**
     * Displays the edit page for the project.
     * Expects a url like: /?controller=projects&action=edit&id=0
     */
    public function edit()
    {
        if (!isset($_GET['id'])) {
            call('pages', 'error');
            return;
        }

        $project = Project::find($_GET['id']);
        require_once('views/projects/edit.php');
    }

    /**
     * Creates a project with the posted values.
     * Expects a url like: /?controller=projects&action=create
     */
    public function create()
    {
        if (!isset($_POST['name']) || !isset($_POST['creator'])) {
            call('pages', 'error');
            return;
        }
        $id = Project::insert($_POST['name'], $_POST['creator']);

        $project = Project::find($id);
        $tasks = Task::getAllForProject($_GET['id']);
        require_once('views/projects/show.php');
    }

    /**
     * Updates the project with the posted values.
     * Expects a url like: /?controller=projects&action=update&id=0
     */
    public function update()
    {
        if (!isset($_GET['id']) || !isset($_POST['name']) || !isset($_POST['creator'])) {
            call('pages', 'error');
            return;
        }
        Project::update($_GET['id'], $_POST['name'], $_POST['creator']);

        $project = Project::find($_GET['id']);
        $tasks = Task::getAllForProject($_GET['id']);
        require_once('views/projects/show.php');
    }

    /**
     * Deletes the project.
     * Expects a url like: /?controller=projects&action=delete&id=0
     */
    public function delete()
    {
        if (!isset($_GET['id'])) {
            call('pages', 'error');
            return;
        }
        Project::delete($_GET['id']);

        $this->index();
    }
}

?>