<div class='main app'>
	<div class='top-app'>
		<div id='top-left-app' class='webcam'>
			<!-- if camera available -->
			<video id='camera' width="100%" autoplay></video>
			<!-- else -->
			<img class='hidden' id='top-left-img' src='' alt='top-left-img' />
		</div>
		<button type='button' class='btn disabled' id='snap'>Take snapshot</button>
		<div id='top-right-app' class='preview'>
			<!-- hidden -->
			<canvas class='hidden' id='canvas' width='' height=''></canvas>
			<!-- else if uploaded image -->
			<img class='hidden' id='return-img' src='' alt='return-img' />
		</div>
	</div>
	<li id='tab-upload' class='hidden'>Image Upload</li>
	<div id='no-camera' class='hidden'>
		<input type='file' name='fileToUpload' id='fileToUpload' />
		</div>
</div>

<script type='text/javascript' src='./public/js/montage.js'></script>
