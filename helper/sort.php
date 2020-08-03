<?
//!! Показывать ошибки
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$db_host = "localhost";
$db_name = "cg35923_testjob";
$db_user = "cg35923_testjob";
$db_pssw = "ya4kfzA8";
$db_connect = mysqli_connect($db_host, $db_user, $db_pssw, $db_name);

$sort = $_POST["s"];

// echo "Это sort.php, Полученный параметр - это вот: " . $_POST["s"];

$sql_get = mysqli_query($db_connect, "SELECT * FROM `tasks` ORDER BY '{$sort}'");

if ($sql_get)
{
    $sorted_tasks = array();
    while($sorted_result = mysqli_fetch_array($sql_get))
    {
        $sorted_tasks[] = array(
            "id" => $sorted_result["id"],
            "name" => $sorted_result["name"],
            "email" => $sorted_result["email"],
            "task" => $sorted_result["task"],
            "done" => $sorted_result["done"]
        );
    }

    echo json_encode($sorted_tasks);
}

?>