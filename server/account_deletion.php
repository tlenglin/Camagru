<?php
require_once(__DIR__ . '/../lib/account_modification.php');
require_once(__DIR__ . '/../lib/sign_up.php');
require_once(__DIR__ . '/../lib/redirect.php');

session_start();

if (check_valid_username($_SESSION['username'] == 0 || check_username_exist($_SESSION['username'] == 0)))
{
	sign_off();
	redirect('../index.php',0);
	exit;
}
if (isset($_POST['delete_pwd']))
{
	if (checkpwd($_SESSION['username'], $_POST['delete_pwd']) == 1)
	{
		delete_account($_SESSION['username']);
		sign_off();
		redirect('../index.php',0);
		exit;
	}
	else
	{
		redirect('../user.php',0);
		exit;
	}
}

if (isset($_POST['new_username']))
{
	if (checkpwd($_SESSION['username'], $_POST['username_pwd']) == 1 && check_valid_username($_POST['new_username']) == 1)
	{
		change_username($_SESSION['username'], $_POST['new_username']);
		$_SESSION['username'] = $_POST['new_username'];
		redirect('../user.php',0);
		exit;
	}
	else
	{
		redirect('../user.php',0);
		exit;
	}
}

if (isset($_POST['old_pwd']))
{
	if (checkpwd($_SESSION['username'], $_POST['old_pwd']) == 1 && check_valid_pwd($_POST['new_pwd']) == 1)
	{
		change_pwd($_SESSION['username'], $_POST['new_pwd']);
		redirect('../user.php',0);
		exit;
	}
	else
	{
		redirect('../user.php',0);
		exit;
	}
}

if (isset($_POST['change_new_mail']))
{
	if (checkpwd($_SESSION['username'], $_POST['change_mail_pwd']) == 1 && check_valid_mail($_POST['change_new_mail']) == 1)
	{
		change_mail($_SESSION['username'], $_POST['change_new_mail']);
		#var_dump($_POST['change_new_mail']);
		redirect('../user.php',0);
		exit;
	}
	else
	{
		redirect('../user.php',0);
		exit;
	}
}

?>
