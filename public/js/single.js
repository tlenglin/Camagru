var page = document.querySelector('.gallery');
var rootURI = '/' + location.pathname.split('/')[1];

var heart = document.querySelector('.likes-nb i');
var likesNB = parseInt(heart.nextSibling.data);
var imgID = document.querySelector('.image').id;


heart.addEventListener('click', function (e) {
	xhr = new XMLHttpRequest();
	xhr.open('POST', rootURI + '/server/addNewLike.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send(imgID);
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) { //document ready
			//console.log(xhr.responseText);
			likesNB = xhr.responseText;
			//console.log(typeof(e.target.nextSibling.data));
			e.target.nextSibling.data = likesNB;
		}
	}
});
