<?php include('header.php')?>
<?php include('./api/retrieve.php')?>



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
