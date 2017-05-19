//need to add the delete picture of the user
var images = document.querySelectorAll('.gallery-single');
var rootURI = '/' + location.pathname.split('/')[1];

[].forEach.call(images, function (single) {
	var imgID = single.id;
	var trash = single.querySelector('i');

	trash.addEventListener('click', function (e) {
		xhr = new XMLHttpRequest();
		xhr.open('POST', rootURI + '/server/deleteImage.php');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(imgID);
		xhr.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				location.reload();
			}
		}
	})
});
