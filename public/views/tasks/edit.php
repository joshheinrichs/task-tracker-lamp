<h2>Edit <?php echo $task->title ?></h2>
<ul id="projects_list"></ul>
<form action="?controller=tasks&action=update&id=<?php echo $task->id; ?>" method="post">
    Title: <input type="text" name="title" value="<?php echo $task->title ?>"><br>
    Description: <input type="text" name="description" value="<?php echo $task->description ?>"><br>
    Author: <input type="text" name="author" value="<?php echo $task->author ?>"><br>
    Stage: <select name="stage">
        <option value="to do" <?php if ($task->stage == "to do") echo "selected"; ?>>To Do</option>
        <option value="in progress" <?php if ($task->stage == "in progress") echo "selected"; ?>>In Progress</option>
        <option value="in review" <?php if ($task->stage == "in review") echo "selected"; ?>>In Review</option>
        <option value="done" <?php if ($task->stage == "done") echo "selected"; ?>>Done</option>
    </select>
    <input type="submit">
</form>
<a href="?controller=tasks&action=show&id=<?php echo $task->id ?>">Cancel</a>
<a href="?controller=tasks&action=delete&id=<?php echo $task->id ?>">Delete</a>