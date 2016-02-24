<h2>Edit <?php echo $project->name ?></h2>
<ul id="projects_list"></ul>
<form action="?controller=projects&action=update&id=<?php echo $project->id ?>" method="post">
    Name: <input type="text" name="name" value="<?php echo $project->name ?>"><br>
    Creator: <input type="text" name="creator" value="<?php echo $project->creator ?>"><br>
    <input type="submit">
</form>
<a href="?controller=projects&action=show&id=<?php echo $project->id ?>">Cancel</a>
<a href="?controller=projects&action=delete&id=<?php echo $project->id ?>">Delete</a>