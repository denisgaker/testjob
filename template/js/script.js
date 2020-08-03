
auth = {
    show: () => $("#modal_auth").modal("show"),
    hide: function()
    {
        $("#modal_auth input").val("");
        $("#modal_auth").modal("hide");
    },
    logIn: function()
    {
        auth.data.login = $("#authInp_login").val();
        auth.data.pssw = $("#authInp_password").val();
        
        $.ajax({
            url: "/testjob/helper/auth.php",
            method: "POST",
            dataType: "HTML",
            data: auth.data,
            success: function(data)
            {
                console.log("data", data);
                if (data === "yes")
                {
                    document.cookie = "isAdmin=yes";
                    $("#auth_btn").attr("onclick", "auth.logOut();").text("Выйти");
                    $(".adm_btn_wrap").addClass("available");
                    auth.hide();
                }
                else
                {
                    $("#modal_auth input").addClass("border-danger");
                    $("#modal_auth input").on("input", () => $(event.target).removeClass("border-danger"));
                }
            }
        });
    },
    logOut: function()
    {
        document.cookie = "isAdmin=no";
        $("#auth_btn").attr("onclick", "auth.show();").text("Авторизация");
        $(".adm_btn_wrap").removeClass("available");
    },
    data: {}
};

task = {
    add: function()
    {
        task.data.action = "add";
        task.data.name = $("#name_userInp").val();
        task.data.email = $("#email_userInp").val();
        task.data.task = $("#task_userInp").val();

        let inp_validation = true;
        $.each(task.data, function(index, value){
            if (value === "")
            {
                $("#" + index + "_userInp").addClass("border-danger");
                $("#" + index + "_userInp").on("input", () => $("#" + index + "_userInp").removeClass("border-danger"));
                inp_validation = false;
            }
        });

        if (inp_validation === false) return false;

        task.send();
    },
    done: function()
    {
        if (document.cookie.replace("isAdmin=no", "") != document.cookie)
        {
            auth.show();
            return false;
        }
        task.data.action = "done";
        task.data.task_id = event.target.parentElement.parentElement.id.replace(/[^0-9]/g, "");
        task.send();
    },
    edit: function()
    {
        console.log("Редактировать текст задачи");
        if (document.cookie.replace("isAdmin=no", "") != document.cookie)
        {
            auth.show();
            return false;
        }

        task.data.action = "edit";
        task.data.id = event.target.parentElement.parentElement.id.replace(/[^0-9]/g, "");
        
        $("#modal_editTask").modal("show");
        $("#task_userInp_ET").val($("#task_p_" + task.data.id)[0].lastChild.textContent);
        $("#modal_editTask button.btn-success").on("click", function()
        {
            task.data.task = $("#task_userInp_ET").val();

            if (task.data.task === "")
            {
                $("#task_userInp_ET").addClass("border-danger");
                $("#task_userInp_ET").on("input", () => $("#task_userInp_ET").removeClass("border-danger"));
            }
            else
                task.send();
        });
    },
    send: function()
    {
        $.ajax({
            url: '/testjob/helper/task.php',
            method: 'POST',
            dataType: 'html',
            data: task.data,
            success: function(data)
            {
                if (task.data.action === "add")
                {
                    task.data = JSON.parse(data);
                    let new_task_wrap = document.createElement("div"),
                        new_task_inner = '<div class="col-xs-hidden col-sm-2 col-md-2 col-lg-2 taskStatus">' + 
                                            '<div class="clock">' + 
                                                '<span>Задача в процессе...</span>' + 
                                                '<div class="hour hour12"></div>' + 
                                                '<div class="hour hour3"></div>' + 
                                                '<div class="hour hour6"></div>' + 
                                                '<div class="hour hour9"></div>' + 
                                                '<div class="arrow"></div>' + 
                                            '</div>' + 
                                            '<div class="is_done_mes"><span>Задача завершена!</span></div>' + 
                                         '</div>' + 
                                         '<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 userInf">' + 
                                            '<p class="text-secondary name_p" id="name_p_' + task.data.id + '">' + 
                                                '<span class="userInf_title">Пользователь: </span>' + task.data.name + 
                                            '</p>' + 
                                            '<p class="text-secondary email_p" id="email_p_' + task.data.id + '">' + 
                                                '<span class="userInf_title">E-mail: </span>' + task.data.email + 
                                            '</p>' + 
                                         '</div>' + 
                                         '<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 userTask">' + 
                                            '<p class="task_p" id="task_p_' + task.data.id + '">' + 
                                                '<span class="userTask_title">Задача: </span>' + task.data.task + 
                                            '</p>' + 
                                         '</div>' + 
                                         '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 adm_btn_wrap ">' + 
                                            '<button type="button" class="btn btn-success adm_btn_done" onclick="task.done();">Выполнено</button>' + 
                                            '<button type="button" class="btn btn-primary adm_btn_edit" onclick="task.edit();">Редактировать</button>' + 
                                         '</div>';
                    
                    new_task_wrap.className = (task.data.done == 1) ? "row userTaskWrap is_done" : "row userTaskWrap";
                    new_task_wrap.id = "task_" + task.data.id;
                    new_task_wrap.innerHTML = new_task_inner;

                    $("#UTcontainer").prepend(new_task_wrap);

                    $("#modal_addNewTask input, #modal_addNewTask textarea").val("");

                    data.task = {};

                    $("#modal_addNewTask").modal("hide");
                }

                if (task.data.action === "done")
                {
                    $($("#task_" + data)[0]).addClass("is_done");
                    $("#task_" + data + " button.adm_btn_done")[0].remove();
                    task.data = {};
                }
                if (task.data.action === "edit")
                {
                    if (data === "success")
                    {
                        $("#task_p_" + task.data.id).html('<span class="userTask_title">Задача</span>' + task.data.task);
                        task.data = {};
                        $("#task_userInp_ET").val();
                        $("#modal_editTask").modal("hide");
                    }
                }
            }
        });
    },
    data: {}
};

function sort(s)
{
    console.log("Ф-ция для сортировки задач\ns = ", s);

    $.ajax({
        url: "/testjob/helper/sort.php",
        method: "POST",
        dataType: "HTML",
        data: {s},
        success: function(data)
        {
            let new_sort = JSON.parse(data);
            console.log("new_sort: ", new_sort);
            $.ajax({
                url: "/testjob/template/template.php",
                method: "POST",
                dataType: "HTML",
                data: new_sort,
                success: function(data)
                {
                    console.log("data: ", data);
                }
            });
        }
    });
}