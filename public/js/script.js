/**
 * all the const are created at the top for easy access 
 */
const loaderScreen = document.getElementById('loader-screen');
const cardOwner = document.getElementById('card-owner');
const removeHelperBtn = document.getElementById('remove-helper-button');
const addHelperBtn = document.getElementById('add-helper-button');
const cardHelperAvatar =document.getElementById('card-helper-avatar');
const helper = document.getElementById('helper');
const cardHelperAvatarInit = document.getElementById('card-helper-avatar-init');
const cardAvatarContainer = document.getElementById('cardAvatarContainer');
const lessonAvatarContainer = document.getElementById('lessonAvatarContainer');
const cardTitle = document.getElementById('card-title');
const cardDescription = document.getElementById('card-description');
const cardCreatedAt = document.getElementById('card-created-at');
const cardStatus = document.getElementById('card-status');
const cardUploadImage = document.getElementById('card-upload-image');
const cardSubmitForm = document.getElementById('card-submit-form');
const cardUpvoteQuestion = document.getElementById('card-upvote-question');
const cardDownvoteQuestion = document.getElementById('card-downvote-question');
const cardUpvoteLesson = document.getElementById('card-upvote-lesson');
const cardDownvoteLesson = document.getElementById('card-downvote-lesson');
const lessonOwner = document.getElementById('lesson-owner');
const lessonTitle = document.getElementById('lesson-title');
const lessonDescription = document.getElementById('lesson-description');
const lessonStartDate = document.getElementById('lesson-start-date');
const lessonStatus = document.getElementById('lesson-card-status');
const lessonCardSubmitForm = document.getElementById('lessonCard-submit-form');
const userPopup = document.getElementById('userPopup');
const userPopupBol = document.getElementById('userPopupBol');
const userPopupInit = document.getElementById('userPopupInit');
const userPopupName = document.getElementById('userPopupName');
const userPopupAvatar = document.getElementById('userPopupAvatar');
const questionUpvoteCount = document.getElementById('question-upvote-count');
const lessonUpvoteCount = document.getElementById('lesson-upvote-count');
const cardInfoPopup = document.getElementById('card-info-popup');
const lessonInfoPopup = document.getElementById('lesson-info-popup');
const lessonModal = document.getElementById('lessonModal');
const lessonSpan = document.getElementById("close-lesson-popup");
const cardModal = document.getElementById('cardModal');
const cardSpan = document.getElementById("close-popup");
const closeUpvoterPopup = document.getElementById("close-upvoter-popup");
const userPopupEmail = document.getElementById("userPopupEmail");
const userPopupRole = document.getElementById("userPopupRole");
const review = document.getElementById('reviewLink');
const allReviews = document.getElementById('allReviewsLink');
const UploadedCardImage = document.getElementById("uploaded-card-image")
const upvoteUserPopup = document.getElementById("upvotesContainer");
const upvoterPopupBol = document.getElementById("upvoteUserAvatar");
const upvoterPopupName = document.getElementById("upvoteUserPopupName");
const upvoterPopupEmail = document.getElementById("upvoteUserPopupEmail");
const upvoterPopupRole = document.getElementById("upvoteUserPopupRole");
const upvoteUserAvatar = document.getElementById("card-upvoter-avatar");
const upvoteUserPopupBol = document.getElementById("upvoteUserPopupBol");

// uncatogorized 

const INPUTS = document.querySelectorAll('#smileys input');
const updateValue = e => document.querySelector('#result').innerHTML = e.target.value;
INPUTS.forEach(el => el.addEventListener('click', e => updateValue(e)));

cardSpan.onclick = function() {
  cardModal.style.display = "none";
}

closeUpvoterPopup.onclick = function(){
  userPopup.style.display = "none";
}

lessonSpan.onclick = function() {
  lessonModal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == lessonModal) {
    lessonModal.style.display = "none";
  }
  else if( event.target == cardModal){
    cardModal.style.display = "none";
  }
}

window.addEventListener('resize', function(event){
  var intFrameWidth = window.innerWidth;
  console.log(event);
  if (intFrameWidth < 1024){
    document.getElementById('toggle-card').style.display = 'none';
    var boards = document.getElementsByClassName("card");
    for (i = 0; i < boards.length; i++) {
        boards[i].classList.add('card-row');
    }
    document.getElementById('board-question-content-box').classList.add("flex-rows");
  }
  else if(intFrameWidth < 1340){
    document.getElementById('toggle-card').style.display = 'flex';
    var boards = document.getElementsByClassName("card");
    for (i = 0; i < boards.length; i++) {
        boards[i].classList.remove('card-row');
    }
    document.getElementById('board-question-content-box').classList.remove("flex-rows");
  }
  else if(intFrameWidth > 1340){
  }
});


/**
 * get random number between min and max
 * @param {int} min minimum number of random number
 * @param {int} max maximum number of random number
 * @returns random number
 */
function randomNumber(min, max){
  var number = Math.floor(Math.random() * max) + min
  return number
}

/**
 * show the loader for 700 to 800 seconds
 * and show 'theModal' after loader
 * @param {const} theModal the modal that should be displayed after loader
 */
function setLoader(theModal){
  loaderScreen.style.display = 'block';
  setTimeout(() => {
    loaderScreen.style.display = 'none';
    theModal.style.display = 'block';
  }, randomNumber(700, 800));
}


/**
 * toggle the cards of target to row or blocks
 * @param {int} target the id of the parent element
 * @param {int} button the id of the toggle button
 */
function toggleBoard(target, button) {
  var boards = document.getElementsByClassName("card");
  for (i = 0; i < boards.length; i++) {
      boards[i].classList.toggle('card-row');
  }
  if(document.getElementById(target).classList.contains("flex-rows")){
     document.getElementById(button).innerHTML = '<i class="fas fa-bars"></i>'; 
  }
  else{
      document.getElementById(button).innerHTML = '<i class="fas fa-th"></i>'; 
  }
  document.getElementById(target).classList.toggle("flex-rows");
}

/**
 * all functions for questionpopup
 * @param {int} card_owner_id
 * @param {int} helper_id 
 * @param {int} user_id 
 * @param {string} user_name 
 * @param {int} card_id 
 */
function showQuestionPopup(card_owner_id, helper_id, user_id, user_name, card_id, user_role_id){
  if(!helper_id) {helper_id = 'empty'}
  resetQuestionPopup();
  getQuestionCardInfo(card_id);
  checkForOwner(user_id, card_owner_id, user_role_id);
  eventListeners(card_id, user_id, user_name, user_id);
  getUsername(card_owner_id, helper_id, user_id);
  getCardAvatars(card_id, user_id, cardAvatarContainer);
  getUpvoters(card_id);
  setLoader(cardModal);
}

/**
 * all functions for lessonpopup
 * @param {int} card_id 
 * @param {int} card_owner_id 
 * @param {int} user_id 
 * @param {int} board_id 
 */
function showPopup(lessonCard_id, card_owner_id, user_id, board_id){
  resetLessonPopup();
  getLessonCardInfo(lessonCard_id);
  //checkForDocent
  getLessonOwner(card_owner_id, user_id);
  checkforLessonCardOwner(user_id, card_owner_id);
  getCardInfo(lessonCard_id);
  lessonEventListeners(lessonCard_id, board_id);
  setLoader(lessonModal);
}

function setHelperAndOwner(name, user_id, card_owner_id){
  cardOwner.innerText = name[0]['name'];

  if(name[1] == 'empty'){
    removeHelperBtn.style.display = "none";
    cardHelperAvatar.style.display = 'none'

    if(user_id != card_owner_id){
      addHelperBtn.style.display = 'inline';
    }
  }

  else{

    var initials = name[1]['name'].match(/\b(\w)/g);
    var acronym = initials.join('');
    
    helper.innerText = name[1]['name'] + ' is aan het helpen.';
    cardHelperAvatar.style.display = 'flex';
    cardHelperAvatar.style.backgroundColor= 'gray'
    cardHelperAvatar.title= name[1]['name']
    cardHelperAvatarInit.innerText= acronym
    fillAvatarPopup(name[1]);
    helper.innerText = name[1]['name'] + ' is aan het helpen.';

    if(user_id == name[1]['id'] || user_id == card_owner_id){
      removeHelperBtn.style.display = "inline";
    }

    addHelperBtn.style.display = 'none';
  }
}


function avatarEventListener(data){
  for (let i = 0; i < data.length; i++) {
    document.getElementById("card-" + data[i]['id'] + "-upvote-avatar-init").addEventListener('click', showUserData.bind(event, data[i]), false);
  }
}

function setOwner(name, user_id, card_owner_id){
  console.log(name)
  lessonOwner.innerText = name[0]['name'];

}

function fillAvatarPopup(data){
  var initials = data['name'].match(/\b(\w)/g);
    var acronym = initials.join('');

    cardHelperAvatar.style.display = 'flex';
    cardHelperAvatar.style.backgroundColor= 'gray'
    cardHelperAvatar.title= data['name']
    cardHelperAvatarInit.innerText= acronym
}
// function showLessonData(data){
// document.getElementById('lessoncard-title').value = data[0]['name'];
// document.getElementById('lessoncard-description').value = data[0]['name'];

// }

var storeLessonUpVote = function(card_id){
var url = route('storeLessonUpVote', card_id)
  let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest",
      "X-CSRF-TOKEN": token,
    },
    method: 'GET',
    credentials: "same-origin",
  });
}

function showData(data){
  for (let i = 0; i < data.length; i++) {
    var initials = data[i]['name'].match(/\b(\w)/g);
    var acronym = initials.join('');
    
    const avatar = document.createElement("div");
    avatar.id = "lesson-" + data[i]['id'] + "-upvote-avatar";
    avatar.className = "avatar";
    avatar.title = data[i]['name'];
    avatar.style.backgroundColor = 'grey';
    lessonAvatarContainer.appendChild(avatar);

    const avatarInit = document.createElement("a");
    avatarInit.id = "lesson-" + data[i]['id'] + "-upvote-avatar-init";
    avatarInit.innerText = acronym;
    avatar.appendChild(avatarInit);
  }
  lessonUpvoteCount.innerText = data.length;
}

var addHelper = function(helperId, helperName, card_id){

  saveHelper(card_id, helperId);

  var initials = helperName.match(/\b(\w)/g);
  var acronym = initials.join('');

  helper.innerText = helperName + ' is aan het helpen.';
  cardHelperAvatar.style.display = 'flex'
  cardHelperAvatar.style.backgroundColor= 'gray'
  cardHelperAvatar.title= helperName
  cardHelperAvatarInit.innerText= acronym
  removeHelperBtn.style.display = "inline";
  addHelperBtn.style.display = "none";
}

var addUpvote = function(card_id, user_id){
  saveCardUpvote(card_id);
  getCardAvatars(card_id, user_id, cardAvatarContainer);
}

var removeHelper = function(card_id){
  deleteHelper(card_id);
  helper.innerText = 'Niemand is aan het helpen.';
  cardHelperAvatar.style.display = 'none';
  cardHelperAvatar.style.backgroundColor= '';
  cardHelperAvatar.title= '';
  cardHelperAvatarInit.innerText= '';
  removeHelperBtn.style.display = "none";
  addHelperBtn.style.display = "inline";
}

var removeUpvote = function(card_id, user_id){
  deleteCardUpvote(card_id);
  getCardAvatars(card_id, user_id, cardAvatarContainer);
}

function resetQuestionPopup(){
  cardAvatarContainer.innerHTML = '';
  cardOwner.innerText = '';
  helper.innerText = 'Niemand is aan het helpen';
  cardHelperAvatar.style.display = 'none';
  cardHelperAvatar.style.backgroundColor= '';
  cardHelperAvatar.title= '';
  cardHelperAvatarInit.innerText= '';
  UploadedCardImage.src = '';
  removeHelperBtn.style.display = "none";
  addHelperBtn.style.display = "none";
}

function resetLessonPopup(){
  lessonAvatarContainer.innerHTML = '';
  lessonOwner.innerText = '';
}

function fillQuestionPopup(data){
  cardTitle.value = data[0]['name'];
  cardDescription.value = data[0]['description'];
  cardCreatedAt.innerText = data[0]['created_at'];
  var i = 0;
  if(data[0]['status'] == 'finished'){i = 1}
  cardStatus.options[i].selected = true;
  if(data[0]['image'] == '') return
  console.log(data);
  if(data[0]['image'] != null){
    UploadedCardImage.src = '/getImage/' + data[0]['image'];
  }
}

function fillLessonPopup(data){
  lessonTitle.value = data[0]['name'];
  lessonDescription.value = data[0]['description'];
  lessonStartDate.innerText = data[0]['start_time'];
  lessonStartDate.innerText = data[0]['status'];
  var i = 0;
  if(data[0]['status'] == 'finished'){i = 1}
  lessonStatus.options[i].selected = true;
  //image
}

function checkForOwner(user_id, card_owner_id, user_role_id){
  cardTitle.readOnly = false;
  cardDescription.readOnly = false;
  cardStatus.disabled = false;
  cardUploadImage.disabled = false;
  //make eventListener enabled
  cardSubmitForm.style.display = 'grid';
  //make eventListener disabled
  cardUpvoteQuestion.style.display = 'none';
  cardDownvoteQuestion.style.display = 'none';
  if(user_id == card_owner_id || user_role_id != 2){
  cardStatus.disabled = true
  cardSubmitForm.style.display = 'none';
  }
  if(user_id == card_owner_id) return
  cardTitle.readOnly = true;
  cardDescription.readOnly = true;
  cardUploadImage.disabled = true;
  //make eventListener enabled
  cardUpvoteQuestion.style.display = 'flex';
  cardDownvoteQuestion.style.display = 'none';

}

function checkforLessonCardOwner(user_id, card_owner_id){
  lessonTitle.readOnly = false;
  lessonDescription.readOnly = false;
  //make eventListener enabled
  lessonCardSubmitForm.style.display = 'grid';
  //make eventListener disabled
  if(user_id == card_owner_id) return
  lessonTitle.readOnly = true;
  lessonDescription.readOnly = true;
  //make eventListener disabled
  lessonCardSubmitForm.style.display = 'none';
  //make eventListener enabled
}

var showUserData = function (data,color){
  var initials = data['name'].match(/\b(\w)/g);
  var acronym = initials.join('');

  if(userPopup.style.display == 'block'){
    userPopup.style.display = 'none'
    return
  }
  userPopup.style.display='block';
  userPopupBol.style.backgroundColor= 'gray'
  userPopupBol.title= data['name']
  userPopupInit.innerText= data['name']
  userPopupName.title= data['name']
  userPopupEmail.innerText= data['email']
  userPopupRole.innerText= data['user_role_id']
  userPopupAvatar.innerText= acronym;
}

var showUpvoterData = function (data,color){
  var initials = data['name'].match(/\b(\w)/g);
  var acronym = initials.join('');

  if(upvoteUserPopup.style.display == 'block'){
    upvoteUserPopup.style.display = 'none'
    return
  }
  upvoteUserPopup.style.display='block';
  upvoteUserPopupBol.style.backgroundColor= 'gray'
  upvoteUserPopupBol.title= data['name']
  userPopupInit.innerText= data['name']
  upvoterPopupName.title= data['name']
  upvoterPopupEmail.innerText= data['email']
  upvoterPopupRole.innerText= data['user_role_id']
  upvoterPopupBol.innerText= acronym;

  // i need 
  //username
  //user id
  //user color
}

function showCardAvatars(data, user_id, targetBox){
  cardAvatarContainer.innerHTML = '';
  cardUpvoteQuestion.style.display = "flex";
  cardDownvoteQuestion.style.display = "none";
  for (let i = 0; i < data.length; i++) {
    var initials = data[i]['name'].match(/\b(\w)/g);
    var acronym = initials.join('');
    
    const avatar = document.createElement("div");
    avatar.id = "card-" + data[i]['id'] + "-upvote-avatar";
    avatar.className = "avatar";
    avatar.title = data[i]['name'];
    avatar.style.backgroundColor = 'grey';
    avatar.addEventListener('click', showUserData.bind(event, data[i]), false);
    targetBox.appendChild(avatar);

    const avatarInit = document.createElement("a");
    avatarInit.id = "card-" + data[i]['id'] + "-upvote-avatar-init";
    avatarInit.innerText = acronym;
    avatar.appendChild(avatarInit);
    if(user_id == data[i]['id']){
      cardUpvoteQuestion.style.display = "none";
      cardDownvoteQuestion.style.display = "flex";
    }
  }
  questionUpvoteCount.innerText = data.length;
}

function eventListeners(card_id, helper_id, helper_name, user_id){
  //remove helper
  // removeHelperBtn.addEventListener('click',destroyHelper, false);
  removeHelperBtn.addEventListener('click',removeHelper.bind(event,card_id), false);
  //add helper
  addHelperBtn.addEventListener('click',addHelper.bind(event,helper_id, helper_name, card_id), false);
  //question upvote
  cardUpvoteQuestion.addEventListener('click', addUpvote.bind(event, card_id, user_id), false);
  //question downvote
  cardDownvoteQuestion.addEventListener('click', removeUpvote.bind(event, card_id, user_id), false);
  //avatar popup
  cardHelperAvatar.addEventListener('click', getHelperInfo.bind(event, helper_id), false);
  //deleteImage
  var deleteImage = document.getElementById('deleteImage');
  deleteImage.addEventListener('click', deleteCardImage.bind(event, card_id), false);
  //submit
  cardInfoPopup.addEventListener('submit', function(event){
    event.preventDefault();
    var card_name = cardTitle.value
    var card_description = cardDescription.value
    var card_status = cardStatus.selectedOptions[0].value
    saveImage(event, card_id);
    updateCard(card_id, card_name, card_description, card_status);
    cardModal.style.display = "none";
  });
}

function lessonEventListeners(lessonCard_id, board_id){
  cardUpvoteLesson.addEventListener('click', saveLessonUpvote.bind(event, lessonCard_id), false);

  cardDownvoteLesson.addEventListener('click', deleteLessonUpvote.bind(event, lessonCard_id), false);

  review.addEventListener('click', function(){
    window.location.href = route('giveReview', [lessonCard_id, board_id]);
  });

  allReviews.addEventListener('click', function(){
    window.location.href = route('allReviews', lessonCard_id);
  });
  
  lessonInfoPopup.addEventListener('submit', function(event){
    event.preventDefault();
    var lessonCard_name = lessonTitle.value
    var lessonCard_description = lessonDescription.value
    var lessonCard_status = lessonStatus.value
    updateLessonCard(lessonCard_id, lessonCard_name, lessonCard_description, lessonCard_status);
    lessonModal.style.display = "none";
  });
}

// fetch requests

function getUsername(card_owner_id, helper_id, user_id){
  var url = route('getUsername', [card_owner_id, helper_id]);
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  }) .then(response => response.json())
  .then(data => setHelperAndOwner(data, user_id, card_owner_id) );
}

function getLessonOwner(card_owner_id, user_id){
  var url = route('getLessonOwner', card_owner_id);
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  }) .then(response => response.json())
  .then(data => setOwner(data, user_id, card_owner_id) );
}

function getCardInfo(modal_id){
  var url = route('getCardInfo', modal_id)
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  }).then(response => response.json())
  .then(data => showData(data));
}

function deleteHelper(card_id){
  var url = route('removeHelper', card_id)
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  });
}

function saveHelper(card_id, helperId){
  var url = route('saveHelper', [card_id, helperId])
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  });
}

function getQuestionCardInfo(card_id){
  var url = route('getQuestionCardInfo', card_id)
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  }).then(response => response.json())
  .then(data => fillQuestionPopup(data));
}

function getLessonCardInfo(card_id){
  var url = route('getLessonCardInfo', card_id)
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  }).then(response => response.json())
  .then(data => fillLessonPopup(data));
}

function saveCardUpvote(card_id){
  var url = route('saveCardUpvote', [card_id])
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  });
}

var saveLessonUpvote = function (card_id){
  var url = route('saveLessonUpvote', [card_id])
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  });
}

function deleteCardUpvote(card_id){
  var url = route('deleteCardUpvote', [card_id])
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  });
}

var deleteLessonUpvote = function (card_id){
  var url = route('deleteLessonUpvote', [card_id])
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  });
}

function getCardAvatars(card_id, user_id, targetBox){
  var url = route('GetCardAvatars', card_id)
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  }).then(response => response.json())
  .then(data => showCardAvatars(data, user_id, targetBox));
}

function updateCard(card_id, card_name, card_description, card_status){
  var url = route('updateCard', [card_id, card_name, card_description, card_status])
    
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  });
}

function updateLessonCard(lessonCard_id, lessonCard_name, lessonCard_description, lessonCard_status){
  var url = route('updateLessonCard');
  var meta = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var formData = new FormData();
  formData.append('lessonCard_id', lessonCard_id );
  formData.append('lessonCard_name', lessonCard_name );
  formData.append('lessonCard_description', lessonCard_description );
  formData.append('lessonCard_status', lessonCard_status ); 

  fetch(url, {
    headers: {
      'X-CSRF-TOKEN': meta,
    },
    method: 'POST',
    credentials: "same-origin",
    body: formData,
    
  });
}

function updateCardImage(card_id, image_id){
  var url = route('updateCardImage', [card_id, image_id])
    
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  });
}

var getHelperInfo = function (helper_id){
  var url = route('getUserInfo', helper_id);
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  }) .then(response => response.json())
  .then(data => showUserData(data) );
}
var deleteCardImage = function (card_id){
  var url = route('deleteImage', card_id);
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  });
  UploadedCardImage.src = '';
}
/**
 * uploaded images gets saved and map direction gets saved in the database
 * 
 * @param {} event gets form all data 
 * @param {} meta gets meta key out of head
 * @param {} formData makes a data object for image that can be send in the body for the post
 */
function saveImage(event, card_id){
  var url = route('saveImage')
  var meta = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var formData = new FormData();
  formData.append('image', event.target[5].files[0]);
    
  fetch(url, {
    headers: {
      'X-CSRF-TOKEN': meta,
    },
    method: 'POST',
    credentials: "same-origin",
    body: formData,
    
  }).then(response => response.json())
  .then(data => updateCardImage(card_id, data));
}

var getUpvoterInfo = function (upvoter_id){
  var url = route('getUpvoterInfo', upvoter_id);
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  }) .then(response => response.json())
  .then(data => showUpvoterData(data) );
}

var getUpvoters = function (card_id){
  var url = route('getUpvoters', card_id);
  
  fetch(url, {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, *//* only 1 line  ",
      "X-Requested-With": "XMLHttpRequest"
    },
    method: 'GET',
    credentials: "same-origin",
  }) .then(response => response.json())
  .then(data => avatarEventListener(data));
}

var loadFile = function(event) {
  UploadedCardImage.src = URL.createObjectURL(event.target.files[0]);
};

// to do
// function for randomizing color of avatar bal and remembering color for next use