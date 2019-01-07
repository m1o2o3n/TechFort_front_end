<?php



require_once '../../config.php';


if (empty($_GET['email'])) {
	exit('缺少参数');
}

$email = $_GET['email'];

$conn = mysqli_connect(TECH_DB_HOST, TECH_DB_USER, TECH_DB_PWD, TECH_DB_NAME);
if (!$conn) {
	exit('连接失败');
}

// $query = 'SELECT avatar FROM users where email= "{$email}" limit 1;';

// $res = mysqli_query($conn, $query);

$res = mysqli_query($conn, "select avatar from users where email = '{$email}' limit 1;");

if (!$res) {
	exit('查询失败');
}

$row = mysqli_fetch_assoc($res);

echo $row['avatar'];