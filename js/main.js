// https://codepen.io/RobVermeer/pen/japZpY?editors=1010

var tinderContainer = document.querySelector('.tinder');
var allCards = document.querySelectorAll('.tinder--card');
var nope = document.getElementById('nope');
var love = document.getElementById('love');

function initCards(card, index) {
	var newCards = document.querySelectorAll('.tinder--card:not(.removed)');

	newCards.forEach(function(card, index) {
		card.style.zIndex = allCards.length - index;
		card.style.transform = 'scale(' + (20 - index) / 20 + ') translateY(-' + 30 * index + 'px)';
		card.style.opacity = (10 - index) / 10;
	});

	tinderContainer.classList.add('loaded');
}

initCards();

allCards.forEach(function(el) {
	var hammertime = new Hammer(el);

	hammertime.on('pan', function(event) {
		el.classList.add('moving');
	});

	hammertime.on('pan', function(event) {
		if (event.deltaX === 0) return;
		if (event.center.x === 0 && event.center.y === 0) return;

		tinderContainer.classList.toggle('tinder_love', event.deltaX > 0);
		tinderContainer.classList.toggle('tinder_nope', event.deltaX < 0);

		var xMulti = event.deltaX * 0.03;
		var yMulti = event.deltaY / 80;
		var rotate = xMulti * yMulti;

		event.target.style.transform =
			'translate(' + event.deltaX + 'px, ' + event.deltaY + 'px) rotate(' + rotate + 'deg)';
	});

	hammertime.on('panend', function(event) {
		el.classList.remove('moving');
		tinderContainer.classList.remove('tinder_love');
		tinderContainer.classList.remove('tinder_nope');

		var moveOutWidth = document.body.clientWidth;
		var keep = Math.abs(event.deltaX) < 80 || Math.abs(event.velocityX) < 0.5;

		event.target.classList.toggle('removed', !keep);

		if (keep) {
			event.target.style.transform = '';
		} else {
			var endX = Math.max(Math.abs(event.velocityX) * moveOutWidth, moveOutWidth);
			var toX = event.deltaX > 0 ? endX : -endX;
			var endY = Math.abs(event.velocityY) * moveOutWidth;
			var toY = event.deltaY > 0 ? endY : -endY;
			var xMulti = event.deltaX * 0.03;
			var yMulti = event.deltaY / 80;
			var rotate = xMulti * yMulti;

			event.target.style.transform =
				'translate(' + toX + 'px, ' + (toY + event.deltaY) + 'px) rotate(' + rotate + 'deg)';
			initCards();
		}
	});
});

function createButtonListener(love) {
	return function(event) {
		var cards = document.querySelectorAll('.tinder--card:not(.removed)');
		var moveOutWidth = document.body.clientWidth * 1.5;

		if (!cards.length) return false;

		var card = cards[0];

		card.classList.add('removed');

		//check if match in backend
		let checkMatch = new FormData(),
			uid1 = card.children[0].getAttribute('data-uid1'),
			uid2 = card.children[0].getAttribute('data-uid'),
			uid1Fname = document.querySelector('.uid1-name').value,
			uid2Fname = card.children[0].children[0].innerText.split(', ')[0];
		checkMatch.append('uid1', uid1);
		checkMatch.append('data-uid', uid2);
		checkMatch.append('uid1-name', uid1Fname);
		checkMatch.append('uid2-name', uid2Fname);
		if (love) {
			checkMatch.append('choice', 'pending');
			card.style.transform = 'translate(' + moveOutWidth + 'px, -100px) rotate(-30deg)';
		} else {
			checkMatch.append('choice', 'blocked');
			card.style.transform = 'translate(-' + moveOutWidth + 'px, -100px) rotate(30deg)';
		}

		if (cards.length == 1) displayCardsOver();

		$.ajax({
			// url: 'http://localhost:8081/dating-website/controllerUserData.php',
			url: 'controllerUserData.php',
			data: checkMatch,
			processData: false,
			contentType: false,
			type: 'POST',
			success: (res) => {
				let instantMatch = JSON.parse(res).instantMatch;
				console.log(instantMatch);
				if (instantMatch) {
					document.querySelector('.loader-container').style.display = 'block';
					setTimeout(() => {
						document.getElementById('lottie-player-match').style.display = 'block';
					}, 400);
					setTimeout(() => {
						document.getElementById('match-redirect-uid1').value = document.querySelector('.uid').value;
						document.getElementById('match-redirect-uid2').value = uid2;
						document.getElementById('match-redirect-form').submit();
					}, 2000);
				}
			}
		});

		initCards();

		event.preventDefault();
	};
}

var nopeListener = createButtonListener(false);
var loveListener = createButtonListener(true);

nope.addEventListener('click', nopeListener);
love.addEventListener('click', loveListener);

function displayCardsOver() {
	//hide like-dislike buttons
	document.querySelector('.tinder').style.display = 'none';
	//display msg
	document.querySelector('.cards-over').style.display = 'block !important';
}

function showBio(e) {
	let height = parseInt(e.children[0].children[2].offsetHeight);
	e.children[0].style.setProperty('top', `calc(85% - ${height + 10}px)`);
}
function hideBio(e) {
	let height = e.children[0].children[2].offsetHeight;
	e.children[0].style.setProperty('top', `85%`);
}
