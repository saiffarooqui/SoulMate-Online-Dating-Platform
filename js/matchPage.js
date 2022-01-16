let badge = document.querySelector('.badge'),
	badgeClickedOnce = false,
	uid = document.querySelector('.uid-curr-user').value,
	header1 = document.querySelector('.header-1'),
	zeroHobbies = true,
	header2 = null,
	caret2 = null,
	popover2 = null,
	header3 = document.querySelector('.header-3'),
	caret3 = document.querySelector('.caret-3'),
	popover3 = document.querySelector('.popover-3'),
	current = 1,
	latitudeCurrUser = document.querySelector('.latitude-curr-user').value,
	longitudeCurrUser = document.querySelector('.longitude-curr-user').value,
	latitudeUid2 = document.querySelector('.latitude-uid2').value,
	longitudeUid2 = document.querySelector('.longitude-uid2').value,
	loaderContainer = document.querySelector('.loader-container');

if (document.getElementById('hobbies-count').value != '0') {
	header2 = document.querySelector('.header-2');
	caret2 = document.querySelector('.caret-2');
	popover2 = document.querySelector('.popover-2');
	zeroHobbies = false;
}

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
				badge.classList.remove('badge-danger');
				badge.classList.add('badge-light');
				document.getElementById('span-num').innerText = 0;
			}
		});
	}
};

function showBio(e) {
	let height = parseInt(e.children[0].children[1].offsetHeight);
	e.children[0].style.setProperty('top', `calc(92% - ${height + 10}px)`);
}
function hideBio(e) {
	let height = e.children[0].children[1].offsetHeight;
	e.children[0].style.setProperty('top', `92%`);
}

//change headers animation
header1.style.display = 'block';
current++;
setInterval(() => {
	if (current == 2) {
		if (zeroHobbies) {
			header1.style.display = 'none';
			header3.style.display = 'block';
		} else {
			header1.style.display = 'none';
			header2.style.display = 'block';
			header3.style.display = 'none';
		}
	} else if (current == 3) {
		header1.style.display = 'none';
		if (!zeroHobbies) header2.style.display = 'none';
		header3.style.display = 'block';
	} else if (current == 1) {
		header1.style.display = 'block';
		if (!zeroHobbies) header2.style.display = 'none';
		header3.style.display = 'none';
	}
	current++;
	if (current == 4) current = 1;
}, 9000);

function showCommonHobbies(e) {
	e.nextElementSibling.style.display = 'block';
	e.nextElementSibling.nextElementSibling.style.display = 'block';
}
function hideCommonHobbies(e) {
	e.nextElementSibling.style.display = 'none';
	e.nextElementSibling.nextElementSibling.style.display = 'none';
}

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

async function calcDistance(latitudeCurrUser, longitudeCurrUser, latitudeUid2, longitudeUid2) {
	const res = await fetch(
		`https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?origins=${latitudeCurrUser},${longitudeCurrUser}&destinations=${latitudeUid2},${longitudeUid2}&travelMode=driving&key=AlqYwMSv8W6JrEnyQg_58Mkj6ZcBFipQI9ToM0_BX4FBTVbuXenxTnpKrNQDQ2G3`
	);
	const json = await res.json();
	return json;
}

window.onload = () => {
	document.getElementById('lottie-player-match').style.display = 'none';
	loaderContainer.style.display = 'block';
	calcDistance(latitudeCurrUser, longitudeCurrUser, latitudeUid2, longitudeUid2)
		.then((res) => {
			document.getElementById(
				'distance-between'
			).innerText = res.resourceSets[0].resources[0].results[0].travelDistance.toFixed(2);
		})
		.catch((e) => console.error(new Error(e)));
	setTimeout(() => {
		loaderContainer.style.display = 'none';
		document.getElementById('lottie-player-heart').style.display = 'none';
		document.getElementById('lottie-player-match').style.display = 'block';
	}, 2000);
};
