let errorMessage = document.querySelector('.error-message'),
	positiveMessage = document.querySelector('.positive-message'),
	lat = document.getElementById('lat'),
	long = document.getElementById('long'),
	alerts = document.getElementsByClassName('alert'),
	profileIcon = document.getElementById('profile-pic'),
	profilePicInput = document.getElementById('profile-pic-upload'),
	entre = document.getElementById('entre'),
	ownsBiz = document.getElementById('owns-biz'),
	prevBtn = document.querySelector('.previous'),
	nextBtn = document.querySelector('.next'),
	submitBtn = document.querySelector('.submit-btn'),
	currTab = 0,
	tabs = document.getElementsByClassName('tab'),
	dots = document.getElementsByClassName('step');

//FORM VALIDATION
let fname = document.getElementById('fname'),
	lname = document.getElementById('lname'),
	age = document.getElementById('age'),
	gender = document.getElementById('gender'),
	photoCheck = document.getElementById('photo-check'),
	bio = document.getElementById('bio'),
	jobStatus = document.getElementById('status'),
	job = document.getElementById('job'),
	college = document.getElementById('college'),
	jobTitle = document.getElementById('job-title'),
	collegeTitle = document.getElementById('college-title');

// get the lat and long
window.onload = getLocation();
function getLocation() {
	// alert("Please don't block location access. We need it to recommend you the best matches!");
	navigator.geolocation.getCurrentPosition((position) => {
		lat.value = position.coords.latitude;
		long.value = position.coords.longitude;
	});
	changeOwnsBiz();
	changeStatus();
}

//take in user profile photo input
profileIcon.onclick = () => {
	profilePicInput.click();
};

//display owns_biz only if entre is yes
function changeOwnsBiz() {
	if (entre.value == 'no') ownsBiz.readOnly = true;
	else ownsBiz.readOnly = false;
}

function changeStatus() {
	if (jobStatus.value == 'working') {
		jobTitle.innerText = 'Job';
		job.placeholder = 'Software Developer';
		collegeTitle.innerText = 'Location';
		college.placeholder = 'Google Inc';
	} else if (jobStatus.value == 'student') {
		jobTitle.innerText = 'Studying';
		job.placeholder = 'MBA';
		collegeTitle.innerText = 'College';
		college.placeholder = 'IIM-A';
	}
}

//for multi step form to change views
showTab(currTab); //show the 1st tab
nextBtn.onclick = () => {
	currTab++;
	if (currTab == 3) {
		nextBtn.disabled = true;
	}
	showTab(currTab);
};
prevBtn.onclick = () => {
	currTab--;
	if (currTab == 0) {
		prevBtn.disabled = true;
	}
	showTab(currTab);
};
function showTab(currentTab) {
	//validate tab-1
	if (currentTab == 1) {
		let flag = false;
		if (profilePicInput.files.length == 0 && window.location.pathname.split('/')[2] != 'edit-profile.php') {
			photoCheck.classList.add('is-invalid');
			flag = true;
		} else photoCheck.classList.remove('is-invalid');
		if (fname.value == '') {
			flag = true;
			fname.classList.add('is-invalid');
		} else fname.classList.remove('is-invalid');
		if (lname.value == '') {
			flag = true;
			lname.classList.add('is-invalid');
		} else lname.classList.remove('is-invalid');
		if (parseInt(age.value) < 18) {
			flag = true;
			age.classList.add('is-invalid');
		} else age.classList.remove('is-invalid');
		if (gender.value == 'Select your gender') {
			flag = true;
			gender.classList.add('is-invalid');
		} else gender.classList.remove('is-invalid');
		if (bio.value == '') {
			flag = true;
			bio.classList.add('is-invalid');
		} else bio.classList.remove('is-invalid');

		if (flag) {
			currTab--;
			return;
		}
	}
	//validate tab-2
	if (currentTab == 2) {
		let flag = false;
		if (jobStatus.value == 'I am...') {
			flag = true;
			jobStatus.classList.add('is-invalid');
		} else jobStatus.classList.remove('is-invalid');
		if (job.value == '') {
			flag = true;
			job.classList.add('is-invalid');
		} else job.classList.remove('is-invalid');
		if (flag) {
			currTab--;
			return;
		}
	}

	currTab = currentTab;

	if (currentTab >= 1 && currentTab <= 2) {
		nextBtn.disabled = false;
		nextBtn.style.display = 'block';
		prevBtn.disabled = false;
		submitBtn.style.display = 'none';
	}
	if (currTab == 3) {
		nextBtn.disabled = true;
		nextBtn.style.display = 'none';
		submitBtn.style.display = 'block';
	}
	if (currTab == 0) {
		prevBtn.disabled = true;
		nextBtn.disabled = false;
		submitBtn.style.display = 'none';
		nextBtn.style.display = 'block';
	}

	for (let i = 0; i < 4; i++) {
		if (i == currentTab) {
			tabs[currentTab].style.display = 'block';
			dots[currentTab].classList.toggle('active');
		} else {
			tabs[i].style.display = 'none';
			dots[i].classList.remove('active');
		}
	}
}

//tab-1 validation
fname.onblur = () => {
	if (fname.value == '') fname.classList.add('is-invalid');
	else fname.classList.remove('is-invalid');
};
lname.onblur = () => {
	if (lname.value == '') lname.classList.add('is-invalid');
	else lname.classList.remove('is-invalid');
};
age.onblur = () => {
	if (parseInt(age.value) < 18) age.classList.add('is-invalid');
	else age.classList.remove('is-invalid');
};
gender.onblur = () => {
	if (gender.value == 'Select your gender*') gender.classList.add('is-invalid');
	else gender.classList.remove('is-invalid');
};
bio.onblur = () => {
	if (bio.value == '') bio.classList.add('is-invalid');
	else bio.classList.remove('is-invalid');
};
//tab-2 validation
jobStatus.onblur = () => {
	if (jobStatus.value == '') jobStatus.classList.add('is-invalid');
	else jobStatus.classList.remove('is-invalid');
};
job.onblur = () => {
	if (job.value == '') job.classList.add('is-invalid');
	else job.classList.remove('is-invalid');
};
