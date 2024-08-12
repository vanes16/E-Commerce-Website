// Header Section
var header = document.querySelector ('#header .header');
document.addEventListener('scroll', () => { 
	var scroll_position = window.scrollY;
	if (scroll_position > 250) {
		header.style.backgroundColor = '#29323c';
	} else {
		header.style.backgroundColor = 'rgba(0,0,0,0.8)';
	}
});

var hamburger = document.querySelector('.hamburger');
var mobile_menu = document.querySelector('.nav-list ul');

hamburger.addEventListener('click', () => { 
	hamburger.classList.toggle('active'); 
	mobile_menu.classList.toggle('active'); 
});

var search = document.querySelector('#search');
var item1 = document.querySelector('#header ul li:nth-child(1)');
var item2 = document.querySelector('#header ul li:nth-child(2)');
var item3 = document.querySelector('#header ul li:nth-child(3)');
var item4 = document.querySelector('#header ul li:nth-child(4)');
var searchform = document.querySelector('#header .search-form');
var close1 = document.querySelector('#header .close1');

document.addEventListener('DOMContentLoaded',function(){ 
	search.addEventListener('click', () => {
		item1.classList.add('active');
		item2.classList.add('active'); 
		item3.classList.add('active');
		item4.classList.add('active');
		search.classList.add('active');
		close1.classList.add('active');
	});
});

document.addEventListener('DOMContentLoaded',function(){
	search.addEventListener('click', () => {

		searchform.classList.add('active');
	});
});
document.addEventListener('DOMContentLoaded',function(){
	close1.addEventListener('click', () => {

		searchform.classList.remove('active');
		item1.classList.remove('active');
		item2.classList.remove('active');
		item3.classList.remove('active');
		item4.classList.remove('active');
		close1.classList.remove('active');
		search.classList.remove('active');
	});
});

// End Header Section


// Home Section
var myslide = document.querySelectorAll('.myslide');
let counter = 1;
slidefun(counter);

let timer = setInterval(autoSlide, 8000);
function autoSlide() {
	counter += 1;
	slidefun(counter);
}
function plusSlides(n) {
	counter += n;
	slidefun(counter);
	resetTimer();
}
function resetTimer() {
	clearInterval(timer);
	timer = setInterval(autoSlide, 8000);
}

function slidefun(n) {
	
	let i;
	for(i = 0;i<myslide.length;i++){
		myslide[i].style.display = "none";
	}

	if(n > myslide.length){
	   counter = 1;
	   }
	if(n < 1){
	   counter = myslide.length;
	   }
	myslide[counter - 1].style.display = "block";
}
// End Home Section

