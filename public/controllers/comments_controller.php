<?php
require_once('models/comment.php');
require_once('models/task.php');

class CommentsController
{

    /**
     * Creates a comment with the posted values.
     * Expects a url like: /?controller=comments&action=create&task=0
     */
    public function create()
    {
        if (!isset($_GET['task']) || !isset($_POST['author']) || !isset($_POST['text'])) {
            call('pages', 'error');
            return;
        }
        Comment::insert($_GET['task'], $_POST['author'], $_POST['text']);

        $task = Task::find($_GET['task']);
        $comments = Comment::getAllForTask($task->id);
        require_once('views/tasks/show.php');
    }
}

?>