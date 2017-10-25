window.onload = startfn;

var running = false;

function toggleRunning() {
	var button = document.getElementById('toggleRunning');
	running = !running;
	if (running) {
		button.innerHTML = 'Pause';
	} else {
		button.innerHTML = 'Start';
	}
}

// https://stackoverflow.com/a/39187274
function gaussianRand() {
  var rand = 0;

  for (var i = 0; i < 6; i += 1) {
    rand += Math.random();
  }

  return rand / 3;
}
function gaussianRandom(start, end) {
  return Math.floor(start + gaussianRand() * (end - start + 1));
}

function randomAngle(min, max) {
	return Math.random() * (max - min) + min;
}

function toVectorCoords(distance, angle, ox, oy) {
	var x = ox + Math.sin(angle) * distance;
	var y = oy + Math.cos(angle) * distance;
	return {"x": x, "y": y};
}

function startfn() {	
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');

	window.setInterval(onInterval, 500);
}

function onInterval() {
	if (!running) {
		return;
	}

	var canvas = document.getElementById('canvas');
	var width = canvas.width;
	var height = canvas.height;
	var ctx = canvas.getContext('2d');

	for (var i = 0; i < growers.length; i++) {
	var grower = growers[i];

	ctx.strokeStyle = grower.color;
	ctx.beginPath();

	ctx.moveTo(grower.x, grower.y);

	var cp1d = gaussianRandom(20, 100);

	var cp1 = toVectorCoords(cp1d, grower.angle, grower.x, grower.y);

	var nd = gaussianRandom(20, 150);
	var nAngle = randomAngle(0, 2 * Math.PI);
	var nCoords = toVectorCoords(nd, nAngle, grower.x, grower.y);
	while (nCoords.x <= 0 || nCoords.y <= 0 || nCoords.x >= width || nCoords.y >= height) {
	var nAngle = randomAngle(0, Math.PI);
	var nCoords = toVectorCoords(nd, nAngle, grower.x, grower.y);
		}

	ctx.quadraticCurveTo(cp1.x, cp1.y, nCoords.x, nCoords.y);
	ctx.lineCap = 'round'
	ctx.lineWidth = 8;
	ctx.lineCap = 'round'
	ctx.stroke();

	grower.x = nCoords.x;
	grower.y = nCoords.y;
	grower.angle = 0.5 * Math.PI + -Math.atan2(nCoords.y - cp1.y, nCoords.x - cp1.x);

	}
}


	var growers = [{
	"color": 'red',
	"x": 50.0,
	"y": 50.0,
	"angle": randomAngle(0, 2 * Math.PI)
},
{
	"color": 'blue',
	"x": 400.0,
	"y": 50.0,
	"angle": randomAngle(0, 2 * Math.PI)
},
{
	"color": 'green',
	"x": 50.0,
	"y": 300.0,
	"angle": randomAngle(0, 2 * Math.PI)
}
];