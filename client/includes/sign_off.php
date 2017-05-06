<div>
	<?php
	session_start();
	var_dump($_SESSION);

	if ($_SESSION['username'] != '')
	{?>
		<form id='sign_off' method='POST' action='./server/sign_off.php'>
			<button id='sign_off_submit' type='submit' name='submit'>Logout</button>
		</form>
	<?php
	}
	else
	{?>
		<a href='index.php'>Login</a>
	<?php
	}?>
</div>
