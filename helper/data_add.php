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

$data_task = array(
    "name" => $_POST["name"],
    "email" => $_POST["email"],
    "task" => $_POST["task"]
);

$sql = mysqli_query($db_connect, "INSERT INTO `tasks` (`name`, `email`, `task`) VALUES ('{$data_task['name']}', '{$data_task['email']}', '{$data_task['task']}')");
// $sql = mysqli_query($db_connect, "INSERT INTO `tasks` (`name`, `email`, `task`) VALUES ({$data_task['name']}, {$data_task['email']}, {$data_task['task']})");

if ($sql)
{
    $sql_get = mysqli_query($db_connect, 'SELECT `id`, `name`, `email`, `task` FROM `tasks` WHERE `id` = LAST_INSERT_ID()');

    if ($sql_get)
    {
        $result = mysqli_fetch_array($sql_get);
        echo json_encode($result);
    }
    else echo 'Ошибка получения данных из БД';
}
else echo 'Ошибка записи данных в БД';

?>