<?php
require_once('connection.php');

class Task
{
    public $project;
    public $id;
    public $author;
    public $title;
    public $description;
    public $stage;
    public $time;

    /**
     * Constructs a new Task.
     * @param $project string ID of the task's project.
     * @param $id string ID of the task.
     * @param $author string Author of the task.
     * @param $title string Title of hte task.
     * @param $description string Description of the task.
     * @param $stage string Stage of the task.
     * @param $time string Time at which the task was created.
     */
    public function __construct($project, $id, $author, $title, $description, $stage, $time)
    {
        $this->project = $project;
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->description = $description;
        $this->stage = $stage;
        $this->time = $time;
    }

    /**
     * Inserts a task into the database.
     * @param $project string ID of the task's corresponding project.
     * @param $author string Author of the task.
     * @param $title string Title of the task.
     * @param $description string Description of the task.
     * @return int ID of the task that was inserted.
     */
    public static function insert($project, $author, $title, $description)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare('INSERT INTO tasks (t_project, t_author, t_title, t_description) VALUES (?, ?, ?, ?)');
        $stmt->bind_param("ssss", $project, $author, $title, $description);
        $stmt->execute();
        return $stmt->insert_id;
    }

    /**
     * Updates a task in the database.
     * @param $id string ID of the task.
     * @param $author string New author of the task.
     * @param $title string New title of the task.
     * @param $description string New description of the task.
     * @param $stage string New stage of the task.
     */
    public static function update($id, $author, $title, $description, $stage)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare('UPDATE tasks SET t_author = ?, t_title = ?, t_description = ?, t_stage = ? WHERE t_id = ?');
        $stmt->bind_param("sssss", $author, $title, $description, $stage, $id);
        $stmt->execute();
    }

    /**
     * Deletes a task in the database.
     * @param $id string ID of the task.
     */
    public static function delete($id)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare('DELETE FROM tasks WHERE t_id = ?');
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }

    /**
     * Returns all tasks.
     * @return array
     */
    public static function getAll()
    {
        $list = [];
        $conn = Db::getInstance();
        $result = $conn->query('SELECT * FROM tasks ORDER BY t_time');
        foreach ($result->fetch_all() as $task) {
            $list[] = new Task($task['t_project'], $task['t_id'], $task['t_author'], $task['t_title'], $task['t_description'], $task['t_stage'], $task['t_time']);
        }
        return $list;
    }

    /**
     * Returns all tasks which correspond to the given project.
     * @param $project ID of the project.
     * @return array
     */
    public static function getAllForProject($project)
    {
        $list = [];
        $conn = Db::getInstance();
        $stmt = $conn->prepare('SELECT t_project, t_id, t_author, t_title, t_description, t_stage, t_time FROM tasks WHERE t_project = ? ORDER BY t_time');
        $stmt->bind_param("s", $project);
        $stmt->execute();
        $stmt->bind_result($project, $id, $author, $title, $description, $stage, $time);
        while ($stmt->fetch()) {
            $list[] = new Task($project, $id, $author, $title, $description, $stage, $time);
        }
        return $list;
    }

    /**
     * Returns the task with the given ID.
     * @param $id string ID of the task to be returned.
     * @return Task
     */
    public static function find($id)
    {
        $db = Db::getInstance();
        $stmt = $db->prepare('SELECT t_project, t_id, t_author, t_title, t_description, t_stage, t_time FROM tasks WHERE t_id = ?');
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($project, $id, $author, $title, $description, $stage, $time);
        $stmt->fetch();
        return new Task($project, $id, $author, $title, $description, $stage, $time);
    }

    /**
     * Sets this task's stage value, updating it both in the object and database.
     * @param $stage
     */
    public function setStage($stage)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare('UPDATE tasks SET t_stage = ? WHERE t_id = ?');
        $stmt->bind_param("ss", $stage, $this->id);
        $stmt->execute();
        $this->stage = $stage;
    }
}