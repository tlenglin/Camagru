<div>
	<div>
		<img src='' />
	</div>
	<div>
		<?php
		session_start();
		if ($_SESSION['username'] != '')
		{?>
			<form id='account_deletion' method='POST' action='./server/account_deletion.php'>
				<h2>Delete your account</h2>
				<input id='delete_pwd' type='password' name='delete_pwd' value='' placeholder='Password' required />
				<button id='delete_submit' type='submit' name='submit'></button>
			</form>
			<form id='username_modification' method='POST' action='./server/account_deletion.php'>
				<h2>Change your username</h2>
				<input id='change_login' type='text' name='new_username' value='' placeholder='New Username' required />
				<input id='change_pwd' type='password' name='username_pwd' value='' placeholder='Password' required />
				<button id='change_username_submit' type='submit' name='submit'></button>
			</form>
			<form id='pwd_modification' method='POST' action='./server/account_deletion.php'>
				<h2>Change your password</h2>
				<input id='change_old_pwd' type='password' name='old_pwd' value='' placeholder='Old Password' required />
				<input id='change_new_pwd' type='password' name='new_pwd' value='' placeholder='New Password' required />
				<button id='change_pwd_submit' type='submit' name='submit'></button>
			</form>
			<form id='mail_modification' method='POST' action='./server/account_deletion.php'>
				<h2>Change your Email</h2>
				<input id='change_new_mail' type='email' name='change_new_mail' value='' placeholder='New Email' required />
				<input id='change_mail_pwd' type='password' name='change_mail_pwd' value='' placeholder='Password' required />
				<button id='change_mail_submit' type='submit' name='submit'></button>
			</form>
		<?php
		}
		else
		{?>
			<a href='index.php'>You need to sign in</a>
		<?php
		}?>
	</div>
	<ul>
		<li></li>
	</ul>
</div>
