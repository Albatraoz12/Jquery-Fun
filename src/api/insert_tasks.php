<?php
require("../includes/conn_mysql.php");
require("../includes/tasks_functions.php");

$conn = dbConnect();

insertTasks($conn);

dbDisconnect($conn);
