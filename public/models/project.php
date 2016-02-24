<?php
require_once('connection.php');

class Project
{
    public $id;
    public $name;
    public $creator;

    /**
     * Constructs a new project.
     * @param $id string ID of the project.
     * @param $name string Name of the project.
     * @param $creator string Creator of the project.
     */
    public function __construct($id, $name, $creator)
    {
        $this->id = $id;
        $this->name = $name;
        $this->creator = $creator;
    }

    /**
     * Inserts a new project into the database.
     * @param $name string Name of the project.
     * @param $creator string Creator of th project.
     * @return int ID of the project that was inserted.
     */
    public static function insert($name, $creator)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare('INSERT INTO projects (p_name, p_creator) VALUES (?, ?)');
        $stmt->bind_param("ss", $name, $creator);
        $stmt->execute();
        return $stmt->insert_id;
    }

    /**
     * Updates the values of the project with the given ID in the database.
     * @param $id string ID of the project.
     * @param $name string New name of the project.
     * @param $creator string New creator of the project.
     */
    public static function update($id, $name, $creator)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare('UPDATE projects SET p_name = ?, p_creator = ? WHERE p_id = ?');
        $stmt->bind_param("sss", $name, $creator, $id);
        $stmt->execute();
    }

    /**
     * Deletes the project with the given ID from the database.
     * @param $id string ID of the project.
     */
    public static function delete($id)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare('DELETE FROM projects WHERE p_id = ?');
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }

    /**
     * Returns all existing projects.
     * @return array
     */
    public static function getAll()
    {
        $list = [];
        $conn = Db::getInstance();
        $stmt = $conn->prepare('SELECT p_id, p_name, p_creator FROM projects ORDER BY p_name');
        $stmt->execute();
        $stmt->bind_result($id, $name, $creator);
        while ($stmt->fetch()) {
            $list[] = new Project($id, $name, $creator);
        }
        return $list;
    }

    /**
     * Returns the project with the given ID.
     * @param $id ID of the project.
     * @return Project
     */
    public static function find($id)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare('SELECT p_id, p_name, p_creator FROM projects WHERE p_id = ?');
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $creator);
        $stmt->fetch();
        return new Project($id, $name, $creator);
    }
}