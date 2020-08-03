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

if (isset($_POST["action"]) && ($_POST["action"] === "done") )
{
    $data_task = $_POST["task_id"];

    $sql = mysqli_query($db_connect, "UPDATE `tasks` SET `done`=1 WHERE `id`=$data_task");

    if ($sql)
    {
        $result = $data_task;
        echo $result;
    }
}

if (isset($_POST["action"]) && ($_POST["action"] === "edit"))
{
    $data_task = array(
        "id" => $_POST["id"],
        "task" => $_POST["task"]
    );
    /* echo $data_task["id"] . '<br>';
    echo $data_task["task"] . '<br>';
    echo $_POST["action"] . '<hr>'; */
    $sql = mysqli_query($db_connect, "UPDATE `tasks` SET `task`='{$data_task["task"]}' WHERE `id`='{$data_task["id"]}'");

    if ($sql) echo "success";
    else echo "fail";
}

if (isset($_POST["action"]) && ($_POST["action"] === "add") )
{
    $data_task = array(
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "task" => $_POST["task"]
    );

    $sql = mysqli_query($db_connect, "INSERT INTO `tasks` (`name`, `email`, `task`) VALUES ('{$data_task["name"]}', '{$data_task["email"]}', '{$data_task["task"]}')");

    if ($sql)
    {
        $sql_get = mysqli_query($db_connect, 'SELECT `id`, `name`, `email`, `task`, `done` FROM `tasks` WHERE `id` = LAST_INSERT_ID()');

        if ($sql_get)
        {
            $result = mysqli_fetch_array($sql_get);

            $new_task = array(
                "id" => $result["id"],
                "name" => $result["name"],
                "email" => $result["email"],
                "task" => $result["task"],
                "done" => $result["done"]
            );

            echo json_encode($new_task);
        }
    }
}

/* $data_task = array(
    "name" => $_POST["name"],
    "email" => $_POST["email"],
    "task" => $_POST["task"]
);

$sql = mysqli_query($db_connect, "INSERT INTO `tasks` (`name`, `email`, `task`) VALUES ('{$_POST["name"]}', '{$_POST["email"]}', '{$_POST["task"]}')");

if ($sql)
{
    $sql_get = mysqli_query($db_connect, 'SELECT `id`, `name`, `email`, `task` FROM `tasks` WHERE `id` = LAST_INSERT_ID()');

    if ($sql_get)
    {
        $result = mysqli_fetch_array($sql_get);

        $new_task = array(
            "id" => $result["id"],
            "name" => $result["name"],
            "email" => $result["email"],
            "task" => $result["task"]
        );
        
        echo json_encode($new_task);
    }
    else echo 'Ошибка получения данных из БД';
}
else echo 'Ошибка записи данных в БД'; */

?>