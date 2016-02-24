<?php
require_once('models/task.php');
require_once('models/project.php');
require_once('models/comment.php');

class TasksController
{

    /**
     * Displays the show page for the specified task.
     * Expects a url like: /?controller=tasks&action=show&id=0
     */
    public function show()
    {
        if (!isset($_GET['id'])) {
            call('pages', 'error');
            return;
        }

        $task = Task::find($_GET['id']);
        $comments = Comment::getAllForTask($task->id);
        require_once('views/tasks/show.php');
    }

    /**
     * Displays the edit page for the specified task.
     * Expects a url like: /?controller=tasks&action=edit&id=0
     */
    public function edit()
    {
        if (!isset($_GET['id'])) {
            call('pages', 'error');
            return;
        }

        $task = Task::find($_GET['id']);
        require_once('views/tasks/edit.php');
    }

    /**
     * Creates a task with the posted values.
     * Expects a url like: /?controller=tasks&action=create&project=0
     */
    public function create()
    {
        if (!isset($_GET['project']) || !isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['author'])) {
            call('pages', 'error');
            return;
        }
        $id = Task::insert($_GET['project'], $_POST['author'], $_POST['title'], $_POST['description']);

        $task = Task::find($id);
        $comments = Comment::getAllForTask($task->id);
        require_once('views/tasks/show.php');
    }

    /**
     * Updates a task with the posted values.
     * Expects a url like /?controller=tasks&action=update&id=0
     */
    public function update()
    {
        if (!isset($_GET['id']) || !isset($_POST['author']) || !isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['stage'])) {
            call('pages', 'error');
            return;
        }
        Task::update($_GET['id'], $_POST['author'], $_POST['title'], $_POST['description'], $_POST['stage']);

        $task = Task::find($_GET['id']);
        $comments = Comment::getAllForTask($task->id);
        require_once('views/tasks/show.php');
    }

    /**
     * Deletes the task.
     * Expects a url like /?controller=tasks&action=delete&id=0
     */
    public function delete()
    {
        if (!isset($_GET['id'])) {
            call('pages', 'error');
            return;
        }
        $task = Task::find($_GET['id']);
        Task::delete($task->id);

        $project = Project::find($task->project);
        $tasks = Task::getAllForProject($task->project);
        require_once('views/projects/show.php');
    }
}

?>