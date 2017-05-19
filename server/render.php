<?php
	require_once(__DIR__ . '/../lib/renderTemplate.php');
	require_once(__DIR__ . '/../config/database.php');

	//render login home
	function renderHome() {
		renderTemplate(__DIR__ . '/../client/views/home.php');
	}

	function renderForgot() {
		renderTemplate(__DIR__ . '/../client/views/forgot.php');
	}

	function renderForgotPassword() {
		renderTemplate(__DIR__ . '/../client/views/forgot-password.php');
	}

	function renderSuccess() {
		renderTemplate(__DIR__ . '/../client/views/success.php');
	}

	function renderApp() {
		renderTemplate(__DIR__ . '/../client/views/app.php');
	}

	function renderGallery() {
		renderTemplate(__DIR__ . '/../client/views/gallery.php');
	}

	function renderUser() {
		renderTemplate(__DIR__ . '/../client/views/user.php');
	}

	function renderRegistred() {
		renderTemplate(__DIR__ . '/../client/includes/registred.php');
	}

	function renderSingle() {
		renderTemplate(__DIR__ . '/../client/views/single.php');
	}
 ?>
