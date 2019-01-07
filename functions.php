<?php

require_once 'config.php';

session_start();



function tech_get_current_user(){
    if(empty($_SESSION['current_login_user'])){
        header('Location: /admin/login.php');
        exit();
    }
    return $_SESSION['current_login_user'];
}


function tech_fetch_all($sql) {
	$conn = mysqli_connect(TECH_DB_HOST, TECH_DB_USER, TECH_DB_PWD, TECH_DB_NAME);
	if(!$conn){
		exit('连接失败');
	}

	$query = mysqli_query($conn, $sql);
	if (!$query) {
		return false;
	}

	//一行一行读取数据库返回文件，并保存在result 数组中
	while ($row = mysqli_fetch_assoc($query)) {
		$result[] = $row;
	}
	//释放result 这个连接
	//个别php无法无法使用，需要调试
	// mysqli_free_resutl($query);	
	//关闭数据库连接
	mysqli_close($conn);

	return $result;
}

function tech_fetch_one ($sql) {
	$res = tech_fetch_all($sql);
	return isset($res[0]) ? $res[0] : '';
}






function tech_execute ($sql) {
	$conn = mysqli_connect(TECH_DB_HOST, TECH_DB_USER, TECH_DB_PWD, TECH_DB_NAME);
	if(!$conn){
		exit('连接失败');
	}

	$query = mysqli_query($conn, $sql);
	if (!$query) {
		return false;
	};

	$affect_rows = mysqli_affected_rows($conn);
	mysqli_close($conn);
	return $affect_rows;
}