// Grab elements, create settings, etc.
var video = document.querySelector('#camera');
// Elements for taking the snapshot
var canvas = document.querySelector('#canvas');
var context = canvas.getContext('2d');
//dimension canvas
var canvasWidth = video.offsetWidth;
var canvasHeight = Math.floor(canvasWidth / 1.33);
//hidden img
var topLeftIMG = document.querySelector('#top-left-img');
var returnIMG = document.querySelector('#return-img');
// Webcam active ou pas
var webcam = true;

// Get access to the camera!
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	if (!navigator.getUserMedia) { //Browser compatibility
		navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
	}
	// Not adding `{ audio: true }` since we only want video now
	if (navigator.getUserMedia) {
		navigator.getUserMedia({video: true}, function(stream) {
			//set canvas size
			canvas.setAttribute('width', canvasWidth);
			canvas.setAttribute('height', canvasHeight);
			//canvas.classList.remove('hidden');
			video.src = window.URL.createObjectURL(stream);
			video.play();
		}, isNoWebcam);
	}
}

var data = {
	'img' : null,
	'size' : {
		'width' : canvasWidth,
		'height' : canvasHeight
	}
};

function isNoWebcam(error) {
	webcam = false;
	console.log('An error occured:' + error);
	document.querySelector('#tab-upload').classList.remove('hidden');
	document.querySelector('#no-camera').classList.remove('hidden');
	document.querySelector('#top-left-img').classList.remove('hidden');
	video.classList.add('hidden');
	document.querySelector('#no-camera').addEventListener('change', function (e) {
		var imgType = (e.target.files[0].name.split('.')).pop().toLowerCase();
		var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'];
		if (allowedTypes.indexOf(imgType) != -1) {
			var file = e.target.files[0];
			var reader = new FileReader();
			reader.addEventListener('load', function (e) {
				data.img = reader.result;
				topLeftIMG.classList.remove('hidden');
				topLeftIMG.src = data.img;
			});
			reader.readAsDataURL(file);
		}
	});
}

// Trigger photo take
document.querySelector("#snap").addEventListener("click", function() {
	if (webcam) {
		context.drawImage(video, 0, 0, canvasWidth, canvasHeight);
		data.img = canvas.toDataURL('image/jpeg', 1.0);
	} else {
		data.size.width = topLeftIMG.width;
		data.size.height = topLeftIMG.height;
	}
	var rootURI = '/' + location.pathname.split('/')[1]; // /camagru
	//XMLHttpRequest
	var xhr = new XMLHttpRequest();
	xhr.open('POST', rootURI + '/server/saveImage.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); //because POST method
	xhr.send(JSON.stringify(data));
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { //response ready
			//console.log(xhr.responseText);
			returnIMG.src = xhr.responseText;
			returnIMG.style.display = 'block';
		}
	};
});
