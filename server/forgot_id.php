<?php

require_once(__DIR__ . '/../lib/forgot_id.php');
require_once(__DIR__ . '/../config/database.php');

if (check_mail_exist($_POST['mail']) == 1)
	send_reset_mail($_POST['mail']);
else
	echo 'Error';
redirect('/Camagru/index.php');

?>
