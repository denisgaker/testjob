<!--Кнопки управления-->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_addNewTask">Добавить новую задачу</button>
            <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#modal_auth">Авторизация</button>
        </div>
    </div>
</div>

<?

$db_host = "localhost";
$db_name = "cg35923_testjob";
$db_user = "cg35923_testjob";
$db_pssw = "ya4kfzA8";
$db_connect = mysqli_connect($db_host, $db_user, $db_pssw, $db_name);

if (!$db_connect)
{
    echo 'Не удалось связаться с базой данных';
    exit;
}

$sql_get = mysqli_query($db_connect, 'SELECT `id`, `name`, `email`, `task` FROM `tasks`');

if ($sql_get)
{
    $available_tasks = array();
    while($result = mysqli_fetch_array($sql_get))
    {
        $available_tasks[] = array(
            "id" => $result["id"],
            "name" => $result["name"],
            "email" => $result["email"],
            "task" => $result["task"]
        );
    }
}
?>

<div class="container" id="UTcontainer">
    <? if(empty($available_tasks)) : ?>
        <div class="row userTaskWrap">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 noTasks" id="noTasks">
                <p>Задач ещё нет. Создай первую!</p>
            </div>
        </div>
    <? else : ?>
        <? for($i=0; $i<count($available_tasks); $i++) : ?>
            <div class="row userTaskWrap">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 userInf">
                    <p class="text-secondary name_p" id="name_p_<?=$available_tasks[$i]["id"]?>">
                        <span class="userInf_title">Пользователь: </span><?=$available_tasks[$i]["name"]?>
                    </p>

                    <p class="text-secondary email_p" id="email_p_<?=$available_tasks[$i]["id"]?>">
                        <span class="userInf_title">E-mail: </span><?=$available_tasks[$i]["email"]?>
                    </p>
                </div>

                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 userTask"> 
                    <p class="task_p" id="task_p_<?=$available_tasks[$i]["id"]?>">
                        <span class="userTask_title">Задача</span><?=$available_tasks[$i]["task"]?>
                    </p>
                </div>
            </div>
        <? endfor; ?>
    <? endif; ?>
</div>