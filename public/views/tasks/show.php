<a href="?controller=projects&action=show&id=<?php echo $task->project; ?>">Back to Project</a>
<h2><?php echo $task->title; ?></h2>
<p>Project: <?php echo $task->project; ?></p>
<p>Id: <?php echo $task->id; ?></p>
<p>Author: <?php echo $task->author; ?></p>
<p>Title: <?php echo $task->title; ?></p>
<p>Description: <?php echo $task->description; ?></p>
<p>Stage: <?php echo $task->stage; ?></p>
<p>Time: <?php echo $task->time; ?></p>
<a href="?controller=tasks&action=edit&id=<?php echo $task->id; ?>">Edit</a>

<h2>Comments</h2>
<ul id="comments_list"></ul>

<h2>Add Comment</h2>
<form action="?controller=comments&action=create&task=<?php echo $task->id; ?>" method="post">
    Text: <input type="text" name="text"><br>
    Author: <input type="text" name="author"><br>
    <input type="submit">
</form>

<script language="javascript" type="text/javascript">
    window.onload = function () {
        var comments =<?php echo json_encode($comments); ?>;

        var ul = document.getElementById("comments_list");
        for (var i = 0; i < comments.length; i++) {

            var span = document.createElement("span");
            span.textContent = comments[i].author + ": " + comments[i].text + " " + comments[i].time;

            var li = document.createElement("li");
            li.appendChild(span);
            ul.appendChild(li);
        }
    }
</script>
