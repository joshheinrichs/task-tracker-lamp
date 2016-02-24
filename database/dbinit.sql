CREATE TABLE projects (
	p_id SERIAL PRIMARY KEY,
	p_name VARCHAR(20),
	p_creator VARCHAR(20)
);

CREATE TABLE tasks (
	t_project BIGINT UNSIGNED,
	t_id SERIAL PRIMARY KEY,
	t_author VARCHAR(20),
	t_title VARCHAR(60),
	t_description TEXT,
	t_stage ENUM('to do', 'in progress', 'in review', 'done') DEFAULT 'to do',
	t_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (t_project) REFERENCES projects(p_id) ON DELETE CASCADE
);

CREATE TABLE comments (
	c_task BIGINT UNSIGNED,
	c_id SERIAL PRIMARY KEY,
	c_author VARCHAR(20),
	c_text TEXT,
	c_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (c_task) REFERENCES tasks(t_id) ON DELETE CASCADE
);
