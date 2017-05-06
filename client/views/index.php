<div>
	<div>
		<img src='https://www.w3schools.com/css/rock600x400.jpg' />
	</div>
	<div>
		<form id='sign_up' method='POST' action='./server/sign_up.php'>
			<h2>Sign up</h2>
			<input id='sign_up_mail' type='email' name='mail' value='' placeholder='Email' required />
			<input id='sign_up_username' type='text' name='username' value='' placeholder='Username' required />
			<input id='sign_up_pwd' type='password' name='pwd' value='' placeholder='Password' required />
			<input id='sign_up_verify_pwd' type='password' name='verify_pwd' value='' placeholder='Verify_Password' required />
			<button id='sign_up_submit' type='submit' name='submit'>Suscribe</button>
		</form>
		<form id='sign_in' method='POST' action='./server/sign_in.php'>
			<h2>Sign in</h2>
			<input id='sign_in_username' type='text' name='username' value='' placeholder='Username' required />
			<input id='sign_in_pwd' type='password' name='pwd' value='' placeholder='Password' required />
			<button id='sign_in_submit' type='submit' name='submit'>Login</button>
		</form>
		<form id='forgot_id' method='POST' action='./server/forgot_id.php'>
			<h2>Forgot your Id ?</h2>
			<input id='forgot_mail' type='email' name='mail' value='' placeholder='Email' required />
			<button id='forgotsubmit' type='submit' name='submit'>Submit</button>
		</form>
	</div>
</div>
