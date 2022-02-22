// const { isPlainObject } = require("jquery");
// const { default: plugin } = require("tailwindcss/plugin");

// all document.getElementById in const's
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
const userPopup = document.getElementById('userPopup');
const userPopupBol = document.getElementById('userPopupBol');
const userPopupInit = document.getElementById('userPopupInit');
const userPopupName = document.getElementById('userPopupName');
const userPopupAvatar = document.getElementById('userPopupAvatar');
const questionUpvoteCount = document.getElementById('question-upvote-count');
const lessonUpvoteCount = document.getElementById('lesson-upvote-count');
const cardInfoPopup = document.getElementById('card-info-popup');
const lessonModal = document.getElementById('lessonModal');
const lessonSpan = document.getElementById("close-lesson-popup");
const cardModal = document.getElementById('cardModal');
const cardSpan = document.getElementById("close-popup");


// uncatogorized 

cardSpan.onclick = function() {
  cardModal.style.display = "none";
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


// multiple use functions
function randomNumber(min, max){
  var number = Math.floor(Math.random() * max) + min
  return number
}

function setLoader(theModal){
  loaderScreen.style.display = 'block';
  setTimeout(() => {
    loaderScreen.style.display = 'none';
    theModal.style.display = 'block';
  }, randomNumber(700, 800));
}

// single use functions
function toggleBoard() {
  var boards = document.getElementsByClassName("board");
  for (i = 0; i < boards.length; i++) {
      boards[i].classList.toggle('board-row');
      
  }
  if(document.getElementById("home-board-content-box").classList.contains("flex-row")){
     document.getElementById("toggle-board").innerHTML = '<i class="fas fa-th"></i>'; 
  }
  else{
      document.getElementById("toggle-board").innerHTML = '<i class="fas fa-bars"></i>'; 
  }
  document.getElementById("home-board-content-box").classList.toggle("flex-row");
  document.getElementById("home-board-content-box").classList.toggle("flex-column");
}

function showQuestionPopup(card_owner_id, helper_id, user_id, user_name, card_id){
  if(!helper_id) {helper_id = 'empty'}
  resetQuestionPopup();
  getQuestionCardInfo(card_id);
  checkForOwner(user_id, card_owner_id);
  eventListeners(card_id, user_id, user_name);
  getUsername(card_owner_id, helper_id, user_id);
  getCardAvatars(card_id);
  setLoader(cardModal);
}

function showPopup(card_id, card_owner_id, user_id){
  resetLessonPopup();
  getLessonCardInfo(card_id);
  //checkForDocent
  lessonEventListeners(card_id);
  getLessonOwner(card_owner_id, user_id);
  getCardInfo(card_id);
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
    
    helper.innerText = name[1]['name'] + ' is helping this card.';
    cardHelperAvatar.style.display = 'flex';
    cardHelperAvatar.style.backgroundColor= 'gray'
    cardHelperAvatar.title= name[1]['name']
    cardHelperAvatarInit.innerText= acronym

    if(user_id == name[1]['id'] || user_id == card_owner_id){
      removeHelperBtn.style.display = "inline";
    }

    addHelperBtn.style.display = 'none';
  }
}

function setOwner(name, user_id, card_owner_id){
  console.log(name)
  lessonOwner.innerText = name[0]['name'];

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

  helper.innerText = helperName + ' is helping this card.';
  cardHelperAvatar.style.display = 'flex'
  cardHelperAvatar.style.backgroundColor= 'gray'
  cardHelperAvatar.title= helperName
  cardHelperAvatarInit.innerText= acronym
  // document.getElementById('card-' + card_id + '-helper-avatar').onclick= showUserData('jan pieter son', 'jps', 'green');
  removeHelperBtn.style.display = "inline";
  addHelperBtn.style.display = "none";
}

var removeHelper = function(card_id){
  deleteHelper(card_id);
  helper.innerText = 'no one is helping this card';
  cardHelperAvatar.style.display = 'none';
  cardHelperAvatar.style.backgroundColor= '';
  cardHelperAvatar.title= '';
  cardHelperAvatarInit.innerText= '';
  removeHelperBtn.style.display = "none";
  addHelperBtn.style.display = "inline";
}

function resetQuestionPopup(){
  cardAvatarContainer.innerHTML = '';
  cardOwner.innerText = '';
  helper.innerText = 'no one is helping this card';
  cardHelperAvatar.style.display = 'none';
  cardHelperAvatar.style.backgroundColor= '';
  cardHelperAvatar.title= '';
  cardHelperAvatarInit.innerText= '';
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
  //image
}

function fillLessonPopup(data){
  lessonTitle.value = data[0]['name'];
  lessonDescription.value = data[0]['description'];
  lessonStartDate.innerText = data[0]['start_time'];
  //Extra wat we willen is dat als de kaart ongoing is dat de kaart een andere kleur wordt zodat mensen zien dat die bezig is
  lessonStartDate.innerText = data[0]['status'];
  // var i = 0;
  // if(data[0]['status'] == 'finished'){i = 1}
  // cardStatus.options[i].selected = true;
  //image
}

function checkForOwner(user_id, card_owner_id){
  cardTitle.readOnly = false;
  cardDescription.readOnly = false;
  cardStatus.disabled = false;
  cardUploadImage.disabled = false;
  //make eventListener enabled
  cardSubmitForm.style.display = 'grid';
  //make eventListener disabled
  cardUpvoteQuestion.style.display = 'none';
  cardDownvoteQuestion.style.display = 'none';
  if(user_id == card_owner_id) return
  cardTitle.readOnly = true;
  cardDescription.readOnly = true;
  cardStatus.disabled = true;
  cardUploadImage.disabled = true;
  //make eventListener disabled
  cardSubmitForm.style.display = 'none';
  //make eventListener enabled
  cardUpvoteQuestion.style.display = 'flex';
  cardDownvoteQuestion.style.display = 'flex';
}

function showUserData(username, initials,color){
  if(userPopup.style.display == 'block'){
    userPopup.style.display = 'none'
    return
  }
  userPopup.style.display='block';
  userPopupBol.style.backgroundColor= 'gray'
  userPopupBol.title= username
  userPopupInit.innerText= username
  userPopupName.title= username
  userPopupAvatar.innerText= initials;

  // i need 
  //username
  //user id
  //user color
}

function showCardAvatars(data){
  for (let i = 0; i < data.length; i++) {
    var initials = data[i]['name'].match(/\b(\w)/g);
    var acronym = initials.join('');
    
    const avatar = document.createElement("div");
    avatar.id = "card-" + data[i]['id'] + "-upvote-avatar";
    avatar.className = "avatar";
    avatar.title = data[i]['name'];
    avatar.style.backgroundColor = 'grey';
    cardAvatarContainer.appendChild(avatar);

    const avatarInit = document.createElement("a");
    avatarInit.id = "card-" + data[i]['id'] + "-upvote-avatar-init";
    avatarInit.innerText = acronym;
    avatar.appendChild(avatarInit);
  }
  questionUpvoteCount.innerText = data.length;
}

function eventListeners(card_id, helper_id, helper_name){
  //remove helper
  // removeHelperBtn.addEventListener('click',destroyHelper, false);
  removeHelperBtn.addEventListener('click',removeHelper.bind(event,card_id), false);
  //add helper
  addHelperBtn.addEventListener('click',addHelper.bind(event,helper_id, helper_name, card_id), false);
  //question upvote
  cardUpvoteQuestion.addEventListener('click', saveCardUpvote.bind(event, card_id), false);
  //question downvote
  cardDownvoteQuestion.addEventListener('click', deleteCardUpvote.bind(event, card_id), false);
  //submit
  cardInfoPopup.addEventListener('submit', function(event){
    event.preventDefault();
    var card_name = cardTitle.value
    var card_description = cardDescription.value
    var card_status = cardStatus.selectedOptions[0].value
    updateCard(card_id, card_name, card_description, card_status);
  });
}

function lessonEventListeners(card_id){
  cardUpvoteLesson.addEventListener('click', saveLessonUpvote.bind(event, card_id), false);

  cardDownvoteLesson.addEventListener('click', deleteLessonUpvote.bind(event, card_id), false);
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

var saveCardUpvote = function (card_id){
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

var deleteCardUpvote = function (card_id){
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

function getCardAvatars(card_id){
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
  .then(data => showCardAvatars(data));
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


// to do
// function for randomizing color of avatar bal and remembering color for next use