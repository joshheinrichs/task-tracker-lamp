<?php

class Comment
{
    public $task;
    public $id;
    public $author;
    public $text;
    public $time;

    /**
     * Constructs a new Comment with the given value.
     * @param $task string ID of the comment's corresponding task.
     * @param $id string ID of the comment.
     * @param $author string Name of the author.
     * @param $text string Text of the comment.
     * @param $time string Time at which the comment was created (UTC).
     */
    public function __construct($task, $id, $author, $text, $time)
    {
        $this->task = $task;
        $this->id = $id;
        $this->author = $author;
        $this->text = $text;
        $this->time = $time;
    }

    /**
     * Inserts a new comment into the database.
     * @param $task string ID of the comment's corresponding task.
     * @param $author string Name of the author.
     * @param $text string Text of the comment.
     * @return int ID
     */
    public static function insert($task, $author, $text)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare('INSERT INTO comments (c_task, c_author, c_text) VALUES (?, ?, ?)');
        $stmt->bind_param("sss", $task, $author, $text);
        $stmt->execute();
        return $stmt->insert_id;
    }

    /**
     * Returns all comments.
     * @return array
     */
    public static function getAll()
    {
        $list = [];
        $conn = Db::getInstance();
        $stmt = $conn->prepare('SELECT c_task, c_id, c_author, c_text, c_time FROM comments ORDER BY c_time');
        $stmt->execute();
        $stmt->bind_result($task, $id, $author, $text, $time);
        while ($stmt->fetch()) {
            $list[] = new Comment($task, $id, $author, $text, $time);
        }
        return $list;
    }

    /**
     * Returns all comments for the corresponding task ordered by time.
     * @param $task string ID of the task.
     * @return array
     */
    public static function getAllForTask($task)
    {
        $list = [];
        $conn = Db::getInstance();
        $stmt = $conn->prepare('SELECT c_task, c_id, c_author, c_text, c_time FROM comments WHERE c_task = ? ORDER BY c_time');
        $stmt->bind_param("s", $task);
        $stmt->execute();
        $stmt->bind_result($task, $id, $author, $text, $time);
        while ($stmt->fetch()) {
            $list[] = new Comment($task, $id, $author, $text, $time);
        }
        return $list;
    }

    /**
     * Returns the comment with the given ID.
     * @param $id string ID of the comment.
     * @return Comment
     */
    public static function find($id)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare('SELECT c_task, c_id, c_author, c_text, c_time FROM comments WHERE c_id = ?');
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($task, $id, $author, $text, $time);
        $stmt->fetch();
        return new Comment($task, $id, $author, $text, $time);
    }
}