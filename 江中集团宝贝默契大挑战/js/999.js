var canvas = document.getElementById('canvas');
canvas.addEventListener('mousemove', onMouseMove, false);
canvas.addEventListener('mousedown', onMouseDown, false);
canvas.addEventListener('mouseup', onMouseUp, false);

canvas.addEventListener('touchstart',onMouseDown,false);
canvas.addEventListener('touchmove',onMouseMove,false);
canvas.addEventListener('touchend',onMouseUp,false)


// canvas.height = 500;
// canvas.height = getHeight() - 125;
// canvas.width = getWidth() - 225;

// canvas.height = getHeight()*0.48;
// canvas.width = getWidth()*0.8186;
canvas.height = 600;
canvas.width = 600;

var ctx = canvas.getContext('2d');

ctx.lineWidth = 1.0; // 设置线宽
ctx.strokeStyle = "#FFFFFF"; // 设置线的颜色

var flag = false;


function onMouseMove(evt){
			evt.preventDefault();
		if (flag){
			var p = pos(evt);
			ctx.lineTo(p.x, p.y);
			ctx.lineWidth = 1.0; // 设置线宽
			ctx.shadowColor = "#FFFFFF";
			ctx.shadowBlur = 1;
			//ctx.shadowOffsetX = 6;
			ctx.stroke();
		}
}

function onMouseDown(evt){
		evt.preventDefault();
		ctx.beginPath();
		var p = pos(evt);
		ctx.moveTo(p.x, p.y);
		flag = true;
}

function onMouseUp(evt){
		evt.preventDefault();
		flag = false;
}

// var clear = document.getElementById('c');
// clear.addEventListener('click',function()
// {
// ctx.clearRect(0, 0, canvas.width, canvas.height);
// },false);


function clear(){
	ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function pos(event){
	var x,y;
	var pyx,pyy;
	if(isTouch(event)){
// x = event.touches[0].pageX;
// y = event.touches[0].pageY;

		pyx = window.innerWidth*0.082;
		pyy = window.innerHeight*0.278;

		x = event.touches[0].pageX-pyx;
		y = event.touches[0].pageY-pyy;

	}else{
		x = event.layerX;
		y = event.layerY;
	}
		return {x:x,y:y};
	}

function isTouch(event){
		var type = event.type;
	if(type.indexOf('touch')>=0){
		return true;
	}else{
		return false;
	}
}

function getWidth()
{
// var xWidth = null;
 
// if (window.innerWidth !== null) {
// xWidth = window.innerWidth;
// } else {
// xWidth = document.body.clientWidth;
// }
 
// return xWidth;


return $(window).width();

}

function getHeight()
{
// var yHeight = null;
 
// if (window.innerHeight !== null) {
// yHeight = window.innerHeight;
// } else {
// yHeight = document.body.clientHeight;
// }
 
// return yHeight;


return $(window).height();

}