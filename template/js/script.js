function addNewTask()
{
    console.log('Добавление новой задачи');

    let dataTaskCtrl = true,
        dataTask = {
        "name": $('#name_userInp').val(),
        "email": $('#email_userInp').val(),
        "task": $('#task_userInp').val()
    };

    if (dataTask.name == "")
    {
        $('#name_userInp').css('border-color', '#ff0000');
        dataTaskCtrl = false;
        $('#name_userInp').on('input', function()
        {
            $('#name_userInp').removeAttr('style');
        });
    }

    if (dataTask.email == "")
    {
        $('#email_userInp').css('border-color', '#ff0000');
        dataTaskCtrl = false;
        $('#email_userInp').on('input', function()
        {
            $('#email_userInp').removeAttr('style');
        });
    }

    if (dataTask.task == "")
    {
        $('#task_userInp').css('border-color', '#ff0000');
        dataTaskCtrl = false;
        $('#task_userInp').on('input', function()
        {
            $('#task_userInp').removeAttr('style');
        });
    }

    if (dataTaskCtrl == false) return false;
    else {
        $.ajax({
            url: '/testjob/helper/data_add.php',
            method: 'POST',
            dataType: 'html',
            data: dataTask,
            success: function(data)
            {
                let newTaskData = JSON.parse(data);

                if($('#noTasks')) $('#noTasks').remove();

                $('#UTcontainer').append(
                    '<div class="row userTaskWrap">' +
                        '<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 userInf">' +
                            '<p class="text-secondary name_p" id="name_p_' + newTaskData.id + '">' +
                                '<span class="userInf_title">Пользователь: </span>' + newTaskData.name +
                            '</p>' +
                            '<p class="text-secondary email_p" id="email_p_' + newTaskData.id + '">' +
                                '<span class="userInf_title">E-mail: ' + newTaskData.email + '</span>' +
                        '</div>' +
                        '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 userTask">' +
                            '<p class="task_p" id="task_p_' + newTaskData.id + '">' +
                                '<span class="userTask_title">Задача: ' + newTaskData.task + '</span>' +
                            '</p>' +
                        '</div>' +
                    '</div>'
                );

                $('#name_userInp, #email_userInp, #task_userInp').val("");
                $('#modal_addNewTask').modal('hide');
            }
        });
    }
}