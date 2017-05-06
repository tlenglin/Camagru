<?php

require_once(__DIR__ . '/../config/database.php');

function check_username_exist($username)
{
	global $db;

	$stmt = $db->prepare('SELECT username FROM users');
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach($results as $result)
	{
		#var_dump($result);
		#var_dump($username);
		if ($result['username'] === $username)
			return (1);
	}
	return (0);
}

function check_valid_username($username)
{
	if (strlen($username) < 3 || strlen($username) > 15)
		return (0);
	if (ctype_alnum($username) === false)
		return (0);
	return (1);
}

function check_mail_exist($mail)
{
	global $db;

	$stmt = $db->prepare('SELECT mail FROM users');
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach($result as $result)
	{
		if ($result === $mail)
			return (1);
	}
	return (0);
}

function check_valid_mail($mail)
{
	if ($mail == '' || !preg_match("/^[\w.-]+@[\w.-]+$/", $mail))
		return (0);
	return (1);
}

function check_valid_pwd($pwd)
{
	if (strlen($pwd) < 4 || strlen($pwd) > 20)
		return (0);
	return (1);
}

function pwd_encryption($pwd)
{
	$secret = 'fd193fcf2511e9ba3a879e3a691edc375f3d1b0dcef1d59e50ef6df9fb09c873bccf4732bb63c402346d91d7447f7a56db393b9c6aae92406a9a89ee6a79fd4e';
	return (hash('whirlpool', $pwd) . $secret);
}

function checkpwd($username, $pwd)
{
	global $db;

	$encrypted_pwd = pwd_encryption($pwd);
	$stmt = $db->prepare('SELECT pwd FROM users WHERE username=?');
	$stmt->bindParam(1, $username);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	#var_dump($results);
	foreach ($results as $result)
	{
		#var_dump($result);
		#var_dump($encrypted_pwd);
		if ($result['pwd'] === $encrypted_pwd)
			return (1);
	}
	return (0);
}

function send_confirmation_mail($mail)
{

}

function send_reset_mail($mail)
{

}

?>
