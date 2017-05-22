var page = document.querySelector('.gallery');
var images = document.querySelectorAll('.gallery-single');
var rootURI = '/' + location.pathname.split('/')[1];

[].forEach.call(images, function(image) {
	var heart = image.querySelector('.likes-nb');
	var likesNB = parseInt(heart.childNodes[0].data);
	var imgID = image.id;

	heart.addEventListener('click', function (e) {
		xhr = new XMLHttpRequest();
		xhr.open('POST', rootURI + '/server/addNewLike.php', true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(imgID);
		xhr.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) { //document ready
				likesNB = xhr.responseText;
				e.target.firstChild.data = likesNB;
				//update heart
			}
		}
	});
});
