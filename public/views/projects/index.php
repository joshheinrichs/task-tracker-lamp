<h2>Projects</h2>
<ul id="projects_list"></ul>

<h2>Add Project</h2>
<form action="?controller=projects&action=create" method="post">
    Name: <input type="text" name="name"><br>
    Creator: <input type="text" name="creator"><br>
    <input type="submit">
</form>

<script language="javascript" type="text/javascript">
    window.onload = function () {
        var array_projects =<?php echo json_encode($projects); ?>;

        var ul = document.getElementById("projects_list");
        for (var i = 0, len = array_projects.length; i < len; i++) {

            var a = document.createElement("a");
            a.textContent = array_projects[i].name;
            a.setAttribute('href', "?controller=projects&action=show&id=" + array_projects[i].id);

            var li = document.createElement("li");
            li.appendChild(a);
            ul.appendChild(li);
        }
    }
</script>
