<?php
	require_once __DIR__ . '/../config/database.php';
	require_once __DIR__ . '/routes.php';

	function sendSubscriptionMail($login, $email) {
		global $db;

		$requestURI = array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1);
		$query = 'SELECT password FROM users WHERE login = ?';
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $login);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$validateURL = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $requestURI[1] . '/validate/' . $login . '/' . $result['password'];

		$subject = 'Camagru - Validez votre inscription';
		$message = 'Camagru - Validez votre inscription.
			Bonjour,' . $login . ' Bienvenue sur Camagru ! Pour valider votre inscription, cliquez ' .$validateURL;
		$header = 'MIME-Version: 1.0' . '\r\n';
		$header .= 'Content-type: text/html; charset=iso-8859-1' . '\r\n';
		$header .= 'To: ' . $login . ' <' . $email . '>' . '\r\n';
		$header .= 'From: Camagru app <noreply@camagru.app>' . '\r\n';

		mail($email, $subject, $message, $header);
	}

	function sendRecoverMail($login, $email) {
		global $db;

		$requestURI = array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1);
		$rootURI = getRootURI();
		$query = 'SELECT password FROM users WHERE login = ?';
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $login);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$validateURL = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $requestURI[1] . '/changePassword/' . $login . '/' . $result['password'];

		$subject = 'Camagru - Modifier votre mot de passe';
		$message = 'Camagru - Modifier votre mot de passe
		Bonjour, votre login est: ' . $login . '\nPour changer votre mot de passe, cliquez ' . $validateURL;
		$header = 'MIME-Version: 1.0' . '\r\n';
		$header .= 'Content-type: text/html; charset=iso-8859-1' . '\r\n';
		$header .= 'To: ' . $login . ' <' . $email . '>' . '\r\n';
		$header .= 'From: Camagru app <noreply@camagru.app>' . '\r\n';

		mail($email, $subject, $message, $header);
	}

	function sendInformativeMail($login, $email) {
		global $db;

	$requestURI = array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1);
		$rootURI = getRootURI();
		$query = 'SELECT password FROM users WHERE login = ?';
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $login);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$validateURL = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $requestURI[1] . '/';

		$subject = 'Camagru - Une de vos photo a reçu un commentaire.';
		$message = 'Camagru - Une de vos photo a reçu un commentaire.
		Bonjour, ' . $login . "\nUne de vos photo a reçu un commentaire. Connectez vous vite ici " . $validateURL;
		$header = 'MIME-Version: 1.0' . '\r\n';
		$header .= 'Content-type: text/html; charset=iso-8859-1' . '\r\n';
		$header .= 'To: ' . $login . ' <' . $email . '>' . '\r\n';
		$header .= 'From: Camagru app <noreply@camagru.app>' . '\r\n';

		mail($email, $subject, $message, $header);
	}
 ?>
