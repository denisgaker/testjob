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
                console.log(JSON.parse(data));
            }
        });
    }

    console.log('Данные по задаче: ', dataTask);
}