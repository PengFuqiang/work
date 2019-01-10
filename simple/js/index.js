
window.onload=function(){
	var banner=document.getElementById('ppt');
	var i=0;
	setInterval(function(){
		if(i%3==0){	
			banner.firstElementChild.src='images/allimgs/1451571480.png';
		}else if(i%2==0){
			banner.firstElementChild.src='images/allimgs/1452510331.jpg';
		}else{
			banner.firstElementChild.src='images/allimgs/1452329274.jpg';
		}
		i++;
		//alert(i);
		if(i==3){
			i=0;
		}
	},2000);
}


