let badge = document.querySelector('.badge'),
	badgeClickedOnce = false,
	uid = document.querySelector('.uid').value;

// if badge clicked then make all notifs seen
badge.onclick = () => {
	if (!badgeClickedOnce) {
		let obj = new FormData();
		obj.append('seen_by_user', 'yes');
		obj.append('uid', uid);
		$.ajax({
			url: 'controllerUserData.php',
			data: obj,
			processData: false,
			contentType: false,
			type: 'POST',
			success: (data) => {
				badgeClickedOnce = true;
				console.log(data);
				badge.classList.remove('badge-danger');
				badge.classList.add('badge-light');
				document.getElementById('span-num').innerText = 0;
			}
		});
	}
};

//GO TO PARTICULAR MATCH PAGE
document.querySelector('body').addEventListener('click', (e) => {
	let value = false;
	if (e.target.tagName.toLowerCase() == 'li' && e.target.classList.contains('match-li'))
		value = e.target.lastChild.innerText;
	if (e.target.tagName.toLowerCase() == 'b' && e.target.classList.contains('match-li-b'))
		value = e.target.nextSibling.nextSibling.innerText;
	if (e.target.tagName.toLowerCase() == 'p' && e.target.classList.contains('match-li-p'))
		value = e.target.nextSibling.innerText;

	if (value) {
		document.getElementById('match-redirect-uid2').value = value;
		document.getElementById('match-redirect-form').submit();
	}
});
