$(document).ready(function () {
    
    //Retrieve data before load the page
    $.each(li_list, function (index, li) {
        console.log(li);
        var status = true;
        if (li['list_status'] == 0)
            status = false;
        var template_parameter = {
            id: li['list_id'],
            is_completed:  li['list_status'],
            new_content: li['list_content'],
        }
        var source = $("#list-template").html(); //Get templete
        var li_template = Handlebars.compile(source); //Use handlebars to compile the templete
        var new_li = li_template(template_parameter); //put parameter into templete
        $("#todolist").append(new_li);
    });
    /*Use ajax to retrieve data
    $.post("api/retrieve.php", [],
        function (data, textStatus, jqXHR) {
            var count = data.length;

            for (var i = 0; i < count; i++) {
                var list = data[i];
                console.log(list['list_status']);
                var status = true;
                if (list['list_status'] == 0)
                    status = false;
                var template_parameter = {
                    id: list['list_id'],
                    is_completed: status,
                    new_content: list['list_content'],
                }
                var source = $("#list-template").html(); //Get templete
                var li_template = Handlebars.compile(source); //Use handlebars to compile the templete
                var new_li = li_template(template_parameter); //put parameter into templete
                $("#todolist").append(new_li);

            }
        },
    );
    */
    //create
    $("#add").click(function () {
        var content = $("#new_content").val();
        var id = $("#todolist").find('li').length + 1;
        if (content == "") {
            alert("Content is null!")
        } else {
            $.post("api/create.php", {
                    'content': content,
                    'order': id
                },
                function (data, textStatus, jqXHR) {
                    var source = $("#list-template").html(); //Get templete
                    var li_template = Handlebars.compile(source); //Use handlebars to compile the templete

                    //set parameter  
                    var template_paremeter = {
                        id: data.id,
                        is_completed: false,
                        new_content: content,
                    };
                    var new_li = li_template(template_paremeter); //put parameter into templete
                    $("#todolist").append(new_li); //add new list into todolist
                    $("#new_content").val(""); //empty the input box
                }

            );
        }

    });

    var original_content='';
    $("#todolist")
        .on('dblclick', '.content', function () {
            
            original_content=$(this).html();
            console.log(original_content);
            $(this).prop("contenteditable", "true").focus();
        })
        .on('blur', '.content', function () {
            $(this).prop("contenteditable", "false");
            var new_content= $(this).html();
            var li_id = $(this).parent().attr("data-id");
            if(new_content==original_content)
                console.log("Not Modify");
            else{
                console.log("new_content");
                $.post("api/update.php", {'id': li_id,'content':new_content},
                    function (data, textStatus, jqXHR) {
                        console.log("Succeess");
                    },
                );
            }
        })
        //checkbox
        .on('click', '.checkbox', function () {

            var li_id = $(this).parent().attr("data-id");
            var list_status = $(this).parent().is('.complete');
            var currentli = $(this).parent();
            console.log(list_status);
            console.log(li_id);

            $.post("api/change_status", {
                    'id': li_id,
                    'status': list_status
                },
                function (data, textStatus, jqXHR) {
                    currentli.toggleClass("complete");
                    console.log(data['id']);
                },
            );


        })
        //delete li
        .on('click', '.remove', function () {
            var closest_li = $(this).closest('li');
            var li_id=closest_li.attr("data-id");
            console.log(li_id);
            var result = confirm("Do you want to delete this list?");
            if (result) {
                
                $.post("api/delete.php", {'id':li_id},
                    function (data, textStatus, jqXHR) {
                        closest_li.remove();
                    },
                    
                );
            }

        });

    $("#todolist").sortable({
        stop: function () {
            var li_new_order=[];
            $('#todolist').find('li').each(function(index,li){
                var li_id=$(li).attr("data-id");
                
                console.log(li_id+" "+ index);
                li_new_order.push({
                    'id':li_id,
                    'index':index
                });
                console.log(li_new_order);
            });
            //console.log(li_list);
            $.post("api/sort.php", {'li_new_order':li_new_order});
            
            
        },
    });

});
/*
     var content = $("#new_content").val();
     if(content==""){
         alert("Content is null!")
     }
     else{
         var new_li = $(".templete").find("li").clone();
         $("#todolist").append(new_li);
         new_li.find(".content").html(content); //Put date into tag
         $("#new_content").val("");
     }*/

/*
    $("#todolist").on('dblclick','.checkbox', function(){
        $(this).parent().removeClass("complete");
    });

    $("#todolist").on('click','.checkbox', function(){
        $(this).parent().addClass("complete");
    });

    $("#todolist").on('click','.remove', function(){
        $(this).closest('li').remove();
    });
*/


/*
//delete(the new item is not suitable)
$(".remove").click(function(){
    //alert("in");
    var currentli=$(this).closest("li");
    alert(currentli.find(".content").html());

});

//update (the new item is not suitable)
$(".content").dblclick(function(){
    console.log("Double click");
    $(this).prop("contenteditable","true");
    $(this).blur(function(){
        console.log("blur");
    });
});

$(".checkbox").click(function(){
    $(this).parent().addClass("complete");
});
$(".checkbox").dblclick(function(){
    $(this).parent().removeClass("complete");
});
*/
/*create use div contenteditable
    $("#new_content").blur(function(){
        var new_content = $("#new_content").text();
        new_content=new_content.trim();

        if(new_content!=""){
           
            var source=$("#list-template").html();//Get templete
            var li_template=Handlebars.compile(source);//Use handlebars to compile the templete

            //set parameter  
            var template_paremeter={
                is_completed:false,
                new_content:new_content,

                
            };
    
            var new_li=li_template(template_paremeter);//put parameter into templete
            $("#new_list").before(new_li);//add new list into todolist
            $("#new_content").empty();//empty the input box

        }
    });
*/