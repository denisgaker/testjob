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


/* if ( (isset($_POST["logOut"]) && ($_POST["logOut"] === "yes")) )
{
    setcookie("isAdmin", "");
} */


if (!$db_connect)
{
    echo 'Не удалось связаться с базой данных';
    exit;
}

$sql_get_auth = mysqli_query($db_connect, 'SELECT `login`, `pass` FROM `admin`');

if($sql_get_auth)
{
    $result = mysqli_fetch_array($sql_get_auth);

    if (($result["login"] === $_POST["login"]) && ($result["pass"] === $_POST["pssw"]))
    {
        $authRequest = "yes";
    }
    else
    {
        $authRequest = "no";
    }
    
    echo $authRequest;
}
?>