/*******************
       ACTIONS
********************/

var actions = document.querySelectorAll('.action');
var snap = document.querySelector('#snap');
var div = document.querySelector('#logo');
var photos = document.querySelectorAll('.object');
var mousePosition;
var offset = [0,0];
var div;
var isDown = false;

[].forEach.call(actions, function (single) {
	single.addEventListener('click', function (e) {
		snap.classList.remove('disabled');
		snap.disabled = false;
	})
});

[].forEach.call(photos, function (single) {
	single.addEventListener('click', function (e) {
		single.src.split('/').slice(4, 7);
		div.style.background = 'url("' + single.src + '")';
		div.style.backgroundSize = 'cover';
	})
});

/************
    MOUSE
*************/

div.addEventListener('mousedown', function(e) {
	isDown = true;
	offset = [
		div.offsetLeft - e.clientX,
		div.offsetTop - e.clientY
	];
}, true);

document.addEventListener('mouseup', function() {
	isDown = false;
}, true);

document.addEventListener('mousemove', function(event) {
	event.preventDefault();
	if (isDown) {
		mousePosition = {

			x : event.clientX,
			y : event.clientY

		};
		div.style.left = (mousePosition.x + offset[0]) + 'px';
		div.style.top  = (mousePosition.y + offset[1]) + 'px';
	}
}, true);
