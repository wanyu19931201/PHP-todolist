<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="./css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="./css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/main.css" />

    <script src="./js/jquery-3.5.1.min.js"></script>
    <script src="./js/jquery-ui.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/handlebars.min-v4.7.6.js"></script>
    <script src="./js/main.js"></script>
  </head>

  <body>
    <div class="mainconent">
      <h1 class="text_center">Todolist</h1>
      <ul id="todolist">
        
      </ul>

      <div id="new_list">
        <input type="text" id="new_content" />
        <button id="add">add</button>
      </div>
    </div>
    <script id="list-template" type="text/x-handlebars-template">
      <div>
        <li data-id="{{id}}" class="  {{#if is_completed}}complete{{/if}}">
          <div class="checkbox"></div>

          <div class="content">{{new_content}}</div>

          <div class="remove">
            <button>X</button>
          </div>
        </li>
      </div>
    </script>
  </body>
</html>
