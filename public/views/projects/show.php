<a href="?controller=projects&action=index">Back to Projects</a>
<h2><?php echo $project->name; ?></h2>
<p>ID: <?php echo $project->id; ?></p>
<p>Name: <?php echo $project->name; ?></p>
<p>Creator: <?php echo $project->creator; ?></p>
<a href="?controller=projects&action=edit&id=<?php echo $project->id; ?>">Edit</a>

<h2>Tasks</h2>
<h4>To Do</h4>
<ul id="todo_list"></ul>
<h4>In Progress</h4>
<ul id="inprogress_list"></ul>
<h4>In Review</h4>
<ul id="inreview_list"></ul>
<h4>Done</h4>
<ul id="done_list"></ul>


<h2>Add Task</h2>
<form action="?controller=tasks&action=create&project=<?php echo $project->id; ?>" method="post">
    Title: <input type="text" name="title"><br>
    Description: <input type="text" name="description"><br>
    Author: <input type="text" name="author"><br>
    <input type="submit">
</form>

<script language="javascript" type="text/javascript">
    window.onload = function () {
        var tasks =<?php echo json_encode($tasks); ?>;

        var todo = document.getElementById("todo_list");
        var inprogress = document.getElementById("inprogress_list");
        var inreview = document.getElementById("inreview_list");
        var done = document.getElementById("done_list");

        for (var i=0; i<tasks.length; i++) {

            var a = document.createElement("a");
            a.textContent = tasks[i].title;
            a.setAttribute('href', "?controller=tasks&action=show&id=" + tasks[i].id);
            var li = document.createElement("li");
            li.appendChild(a);

            switch (tasks[i].stage) {
                case "to do":
                    todo.appendChild(li);
                    break;
                case "in progress":
                    inprogress.appendChild(li);
                    break;
                case "in review":
                    inreview.appendChild(li);
                    break;
                case "done":
                    done.appendChild(li);
                    break;
            }
        }
    }
</script>
