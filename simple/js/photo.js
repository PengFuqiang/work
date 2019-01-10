
	window.onload=function(){
		var banner=document.getElementById('ppt');
		var i=0;
		setInterval(function(){
			if(i%3==0){	
				banner.firstElementChild.src='images/photoimgs/1.jpg';
			}else if(i%2==0){
				banner.firstElementChild.src='images/photoimgs/2.jpg';
			}else if(i%2==0){
				banner.firstElementChild.src='images/photoimgs/3.png';
			}else{
				banner.firstElementChild.src='images/photoimgs/4.jpg';
			}
			i++;
			//alert(i);
			if(i==3){
				i=0;
			}
		},2000);
	}
