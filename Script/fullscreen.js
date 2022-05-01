function  fullscreen() {
	screen = document.querySelector('#fullscreen');
	if(screen.classList.contains('fullscreen')){
		screen.classList.remove('fullscreen')
		h = window.innerHeight;
		document.querySelector('.slider__items').style.height = h - (h/100)*30+'px';
		document.querySelector('#fullscreen_but').innerHTML = "<i class='bx bx-fullscreen'></i>"
	}else{
		screen.classList.add('fullscreen');
		document.querySelector('.slider__wrapper').style.height = '100%';
		document.querySelector('.slider__items').style.height = '100%';
		document.querySelector('.slider__wrapper').style.backgroundColor = 'black';
		document.querySelector('#fullscreen_but').innerHTML = "<i class='bx bx-exit-fullscreen' ></i>"
	}

}

