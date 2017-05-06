<?php

function sign_off()
{
	session_start();
	var_dump($_SESSION);
	foreach($_SESSION as $field => &$value)
		$value = '';
}

function delete_account($username)
{
	global $db;

	$stmt = $db->prepare("DELETE FROM users WHERE username=?");
	$stmt->bindParam(1, $username);
	$stmt->execute();
}

function change_username($old_username, $new_username)
{
	global $db;

	$stmt = $db->prepare("UPDATE users SET username=? WHERE username=?");
	$stmt->bindParam(1, $new_username);
	$stmt->bindParam(2, $old_username);
	$stmt->execute();
}

function change_pwd($username, $new_pwd)
{
	global $db;

	$encrypted_pwd = pwd_encryption($new_pwd);
	$stmt = $db->prepare("UPDATE users SET pwd=? WHERE username=?");
	$stmt->bindParam(1, $encrypted_pwd);
	$stmt->bindParam(2, $username);
	$stmt->execute();
}

function change_mail($username, $new_mail)
{
	global $db;

	$stmt = $db->prepare("UPDATE users SET mail=? WHERE username=?");
	$stmt->bindParam(1, $new_mail);
	$stmt->bindParam(2, $username);
	$stmt->execute();
}

?>
