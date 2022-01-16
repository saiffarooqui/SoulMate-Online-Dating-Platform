function changeNav() {
	if (window.scrollTop > 50 || document.documentElement.scrollTop > 50) {
		document.querySelector('nav').style.borderBottom = '.5px solid rgba(0, 0, 0, .1)';
		document.getElementById('soulmate-logo').style.height = '55px';
		document.querySelectorAll('.menu ul li a').forEach((ul) => (ul.style.fontSize = '18px'));
		document.querySelector('nav').style.paddingBottom = '0';
		document.querySelector('nav').style.height = '90px';
	} else {
		document.querySelector('nav').style.borderBottom = '0';
		document.getElementById('soulmate-logo').style.height = '62px';
		document.querySelectorAll('.menu ul li a').forEach((ul) => (ul.style.fontSize = '20px'));
		document.querySelector('nav').style.padding = '10px 0';
		document.querySelector('nav').style.height = '94px';
	}
}

function changeAddr(href) {
	window.location.href = href;
}
