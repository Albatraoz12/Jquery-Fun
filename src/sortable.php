<!DOCTYPE html>
<html>

<head>
   <title>jQuery UI Sortable - Example</title>
   <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
   <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   <link rel="stylesheet" href="styles.css">

</head>
<?php
require("includes/conn_mysql.php");
require("includes/tasks_functions.php");
$connection = dbConnect();
$allTodos = getAllTodos($connection);
$allDoing = getAllDoing($connection);
$allDone = getAllDone($connection);
dbDisconnect($connection);
?>

<body>

   <section class="input">
      <form action="/api/insert_tasks.php" method="POST">
         <label for="name">Name</label>
         <input type="text" name="name" id="name">
         <label for="desc">Description</label>
         <input type="text" name="description" id="desc">
         <input type="submit" name="submit">
      </form>
   </section>

   <section class="list">
      <ul id="todo">
         <h3>Todo-list</h3>
         <?php
         foreach ($allTodos as $item) {
            print('<li class="default" ');
            print('id="');
            print($item['id'] . '">');
            print($item['name']);
            print('</li>');
         }
         ?>
      </ul>

      <ul id="doing">
         <h3>Doing-list</h3>
         <?php
         foreach ($allDoing as $item) {
            print('<li class="default" ');
            print('id="');
            print($item['id'] . '">');
            print($item['name']);
            print('</li>');
         }
         ?>
      </ul>

      <ul id="done">
         <h3>Done-list</h3>
         <?php
         foreach ($allDone as $item) {
            print('<li class="default" ');
            print('id="');
            print($item['id'] . '">');
            print($item['name']);
            print('</li>');
         }
         ?>
      </ul>
   </section>

   <script>
      $(function() {
         $("#todo, #doing, #done").sortable({
            placeholder: "highlight",
            connectWith: "#todo, #doing, #done",
            axis: 'y',
            receive: function(event, ui) {
               var id = $(ui.item).attr('id');
               var state = this.id;
               $.ajax({
                  data: {
                     'id': id,
                     'state': state
                  },
                  type: 'POST',
                  url: '/api/update_tasks.php',
               });
            }
         });
      });
   </script>
</body>

</html>