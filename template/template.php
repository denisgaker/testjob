<?

//!! Показывать ошибки
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// print_r($_POST);

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

$sql_get = mysqli_query($db_connect, 'SELECT `id`, `name`, `email`, `task`, `done` FROM `tasks`');

if ($sql_get)
{
    $available_tasks = array();
    while($result = mysqli_fetch_array($sql_get))
    {
        $available_tasks[] = array(
            "id" => $result["id"],
            "name" => $result["name"],
            "email" => $result["email"],
            "task" => $result["task"],
            "done" => $result["done"]
        );
    }
}

?>

<!--Кнопки управления-->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_addNewTask">Добавить новую задачу</button>
            <button 
                type="button" 
                class="btn btn-secondary float-right" 
                id="auth_btn" 
                onclick="<? echo ((isset($_COOKIE["isAdmin"]) && ($_COOKIE["isAdmin"] === "yes"))) ? "auth.logOut();" : "auth.show();" ?>">
                    <? echo ((isset($_COOKIE["isAdmin"])) && ($_COOKIE["isAdmin"] == "yes")) ? "Выйти" : "Авторизация"; ?>
            </button>
        </div>
    </div>
</div>

<div class="container sort">
    <div class="row">
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
            <span class="sort_title">Сортировать по:</span>
        </div>
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
            <button type="button" class="btn btn-info btn-sm btn_sort" onclick="sort(s='done')">Статусу</button>
        </div>
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
            <button type="button" class="btn btn-info btn-sm btn_sort" onclick="sort(s='name')">Имени пользователя</button>
        </div>
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
            <button type="button" class="btn btn-info btn-sm btn_sort" onclick="sort(s='email')">E-mail</button>
        </div>
    </div>
</div>

<div class="container" id="UTcontainer">
    <? if(empty($available_tasks)) : ?>
        <div class="row userTaskWrap">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 noTasks" id="noTasks">
                <p>Задач ещё нет. Создай первую!</p>
            </div>
        </div>
    <? else : ?>
        <? for($i=0; $i<count($available_tasks); $i++) : ?>     <?/*  for($i=count($available_tasks)-1; $i>=0; $i--) :  */?>
            <div class="row userTaskWrap <? if ($available_tasks[$i]["done"] == 1) echo "is_done" ?>" id="task_<?=$available_tasks[$i]["id"]?>">
                <div class="col-xs-hidden col-sm-2 col-md-2 col-lg-2 taskStatus">
                    <div class="clock">
                        <span>Задача в процессе...</span>
                        <div class="hour hour12"></div>
                        <div class="hour hour3"></div>
                        <div class="hour hour6"></div>
                        <div class="hour hour9"></div>
                        <div class="arrow"></div>
                    </div>
                    <div class="is_done_mes">
                        <span>Задача завершена!</span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 userInf">
                    <p class="text-secondary name_p" id="name_p_<?=$available_tasks[$i]["id"]?>">
                        <span class="userInf_title">Пользователь: </span><?=$available_tasks[$i]["name"]?>
                    </p>

                    <p class="text-secondary email_p" id="email_p_<?=$available_tasks[$i]["id"]?>">
                        <span class="userInf_title">E-mail: </span><?=$available_tasks[$i]["email"]?>
                    </p>
                </div>

                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 userTask"> 
                    <p class="task_p" id="task_p_<?=$available_tasks[$i]["id"]?>">
                        <span class="userTask_title">Задача</span><?=$available_tasks[$i]["task"]?>
                    </p>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 adm_btn_wrap <? if (isset($_COOKIE["isAdmin"]) && ($_COOKIE["isAdmin"] === "yes")) echo "available" ?>">
                    <? if ($available_tasks[$i]["done"] == 0) : ?>
                        <button type="button" class="btn btn-success adm_btn_done" onclick="task.done();">Выполнено</button>
                    <? endif; ?>
                    <button type="button" class="btn btn-primary adm_btn_edit" onclick="task.edit();">Редактировать</button>
                </div>
            </div>
        <? endfor; ?>
    <? endif; ?>
</div>