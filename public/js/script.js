/**
 * all the const are created at the top for easy access 
 */
const LOADERSCREEN = document.getElementById('loader-screen');
const CARDOWNER = document.getElementById('card-owner');
const REMOVEHELPERBTN = document.getElementById('remove-helper-button');
const ADDHELPERBTN = document.getElementById('add-helper-button');
const CARDHELPERAVATAR =document.getElementById('card-helper-avatar');
const HELPER = document.getElementById('helper');
const CARDHELPERAVATARINIT = document.getElementById('card-helper-avatar-init');
const CARDAVATARCONTAINER = document.getElementById('cardAvatarContainer');
const LESSONAVATARCONTAINER = document.getElementById('lessonAvatarContainer');
const CARDTITLE = document.getElementById('card-title');
const CARDDESCRIPTION = document.getElementById('card-description');
const CARDCREATEDAT = document.getElementById('card-created-at');
const CARDSTATUS = document.getElementById('card-status');
const CARDUPLOADIMAGE = document.getElementById('card-upload-image');
const CARDSUBMITFORM = document.getElementById('card-submit-form');
const CARDUPVOTEQUESTION = document.getElementById('card-upvote-question');
const CARDDOWNVOTEQUESTION = document.getElementById('card-downvote-question');
const CARDUPVOTELESSON = document.getElementById('card-upvote-lesson');
const CARDDOWNVOTELESSON = document.getElementById('card-downvote-lesson');
const LESSONOWNER = document.getElementById('lesson-owner');
const LESSONTITLE = document.getElementById('lesson-title');
const LESSONDESCRIPTION = document.getElementById('lesson-description');
const LESSONSTARTDATE = document.getElementById('lesson-start-date');
const LESSONSTATUS = document.getElementById('lesson-card-status');
const LESSONCARDSUBMITFORM = document.getElementById('lessonCard-submit-form');
const USERPOPUP = document.getElementById('userPopup');
const USERPOPUPBOL = document.getElementById('userPopupBol');
const USERPOPUPINIT = document.getElementById('userPopupInit');
const USERPOPUPNAME = document.getElementById('userPopupName');
const USERPOPUPAVATAR = document.getElementById('userPopupAvatar');
const QUESTIONUPVOTECOUNT = document.getElementById('question-upvote-count');
const LESSONUPVOTECOUNT = document.getElementById('lesson-upvote-count');
const CARDINFOPOPUP = document.getElementById('card-info-popup');
const LESSONINFOPOPUP = document.getElementById('lesson-info-popup');
const LESSONMODAL = document.getElementById('lessonModal');
const LESSONSPAN = document.getElementById("close-lesson-popup");
const CARDMODAL = document.getElementById('cardModal');
const CARDSPAN = document.getElementById("close-popup");
const CLOSEUPVOTERPOPUP = document.getElementById("close-upvoter-popup");
const USERPOPUPEMAIL = document.getElementById("userPopupEmail");
const USERPOPUPROLE = document.getElementById("userPopupRole");
const REVIEW = document.getElementById('reviewLink');
const ALLREVIEWS = document.getElementById('allReviewsLink');
const UPLOADEDCARDIMAGE = document.getElementById("uploaded-card-image")
const UPVOTEUSERPOPUP = document.getElementById("upvotesContainer");
const UPVOTERPOPUPBOL = document.getElementById("upvoteUserAvatar");
const UPVOTERPOPUPNAME = document.getElementById("upvoteUserPopupName");
const UPVOTERPOPUPEMAIL = document.getElementById("upvoteUserPopupEmail");
const UPVOTERPOPUPROLE = document.getElementById("upvoteUserPopupRole");
const UPVOTEUSERAVATAR = document.getElementById("card-upvoter-avatar");
const UPVOTEUSERPOPUPBOL = document.getElementById("upvoteUserPopupBol");
const USERMODAL = document.getElementById('user-modal');

// uncatogorized 

const INPUTS = document.querySelectorAll('#smileys input');
const updateValue = e => document.querySelector('#result').innerHTML = e.target.value;
INPUTS.forEach(el => el.addEventListener('click', e => updateValue(e)));

CARDSPAN.onclick = function() {
  CARDMODAL.style.display = "none";
}

CLOSEUPVOTERPOPUP.onclick = function(){
  USERMODAL.style.display = "none";
  // USERPOPUP.style.display = "none";
}

LESSONSPAN.onclick = function() {
  LESSONMODAL.style.display = "none";
}

window.onclick = function(event) {
  console.log(event.target);
  if (event.target == LESSONMODAL) {
    LESSONMODAL.style.display = "none";
  }
  else if( event.target == CARDMODAL){
    CARDMODAL.style.display = "none";
  }
  else if( event.target == USERMODAL){
    USERMODAL.style.display = "none";
  }
}

window.addEventListener('resize', function(event){
  var intFrameWidth = window.innerWidth;
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
  LOADERSCREEN.style.display = 'block';
  setTimeout(() => {
    LOADERSCREEN.style.display = 'none';
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
  getCardAvatars(card_id, user_id, CARDAVATARCONTAINER);
  getUpvoters(card_id);
  setLoader(CARDMODAL);
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
  setLoader(LESSONMODAL);
}

function setHelperAndOwner(name, user_id, card_owner_id){
  CARDOWNER.innerText = name[0]['name'];

  if(name[1] == 'empty'){
    REMOVEHELPERBTN.style.display = "none";
    CARDHELPERAVATAR.style.display = 'none'

    if(user_id != card_owner_id){
      ADDHELPERBTN.style.display = 'inline';
    }
  }

  else{

    var initials = name[1]['name'].match(/\b(\w)/g);
    var acronym = initials.join('');
    
    HELPER.innerText = name[1]['name'] + ' is aan het helpen.';
    CARDHELPERAVATAR.style.display = 'flex';
    CARDHELPERAVATAR.style.backgroundColor= 'gray'
    CARDHELPERAVATAR.title= name[1]['name']
    CARDHELPERAVATARINIT.innerText= acronym
    fillAvatarPopup(name[1]);
    HELPER.innerText = name[1]['name'] + ' is aan het helpen.';

    if(user_id == name[1]['id'] || user_id == card_owner_id){
      REMOVEHELPERBTN.style.display = "inline";
    }

    ADDHELPERBTN.style.display = 'none';
  }
}


function avatarEventListener(data){
  for (let i = 0; i < data.length; i++) {
    document.getElementById("card-" + data[i]['id'] + "-upvote-avatar-init").addEventListener('click', showUserData.bind(event, data[i]), false);
  }
}

function setOwner(name, user_id, card_owner_id){
  LESSONOWNER.innerText = name[0]['name'];

}

function fillAvatarPopup(data){
  var initials = data['name'].match(/\b(\w)/g);
    var acronym = initials.join('');

    CARDHELPERAVATAR.style.display = 'flex';
    CARDHELPERAVATAR.style.backgroundColor= 'gray'
    CARDHELPERAVATAR.title= data['name']
    CARDHELPERAVATARINIT.innerText= acronym
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
    
    const AVATAR = document.createElement("div");
    AVATAR.id = "lesson-" + data[i]['id'] + "-upvote-avatar";
    AVATAR.className = "avatar";
    AVATAR.title = data[i]['name'];
    AVATAR.style.backgroundColor = 'grey';
    LESSONAVATARCONTAINER.appendChild(AVATAR);

    const AVATARINIT = document.createElement("a");
    AVATARINIT.id = "lesson-" + data[i]['id'] + "-upvote-avatar-init";
    AVATARINIT.innerText = acronym;
    AVATAR.appendChild(AVATARINIT);
  }
  LESSONUPVOTECOUNT.innerText = data.length;
}

var addHelper = function(helperId, helperName, card_id){

  saveHelper(card_id, helperId);

  var initials = helperName.match(/\b(\w)/g);
  var acronym = initials.join('');

  HELPER.innerText = helperName + ' is aan het helpen.';
  CARDHELPERAVATAR.style.display = 'flex'
  CARDHELPERAVATAR.style.backgroundColor= 'gray'
  CARDHELPERAVATAR.title= helperName
  CARDHELPERAVATARINIT.innerText= acronym
  REMOVEHELPERBTN.style.display = "inline";
  ADDHELPERBTN.style.display = "none";
}

var addUpvote = function(card_id, user_id){
  saveCardUpvote(card_id);
  getCardAvatars(card_id, user_id, CARDAVATARCONTAINER);
}

var removeHelper = function(card_id){
  deleteHelper(card_id);
  HELPER.innerText = 'Niemand is aan het helpen.';
  CARDHELPERAVATAR.style.display = 'none';
  CARDHELPERAVATAR.style.backgroundColor= '';
  CARDHELPERAVATAR.title= '';
  CARDHELPERAVATARINIT.innerText= '';
  REMOVEHELPERBTN.style.display = "none";
  ADDHELPERBTN.style.display = "inline";
}

var removeUpvote = function(card_id, user_id){
  deleteCardUpvote(card_id);
  getCardAvatars(card_id, user_id, CARDAVATARCONTAINER);
}

function resetQuestionPopup(){
  CARDAVATARCONTAINER.innerHTML = '';
  CARDOWNER.innerText = '';
  HELPER.innerText = 'Niemand is aan het helpen';
  CARDHELPERAVATAR.style.display = 'none';
  CARDHELPERAVATAR.style.backgroundColor= '';
  CARDHELPERAVATAR.title= '';
  CARDHELPERAVATARINIT.innerText= '';
  UPLOADEDCARDIMAGE.src = '';
  REMOVEHELPERBTN.style.display = "none";
  ADDHELPERBTN.style.display = "none";
}

function resetLessonPopup(){
  LESSONAVATARCONTAINER.innerHTML = '';
  LESSONOWNER.innerText = '';
}

function fillQuestionPopup(data){
  document.getElementById('card-id').value = data[0]['id'];
  CARDTITLE.value = data[0]['name'];
  CARDDESCRIPTION.value = data[0]['description'];
  CARDCREATEDAT.innerText = data[0]['created_at'];
  var i = 0;
  if(data[0]['status'] == 'finished'){i = 1}
  CARDSTATUS.options[i].selected = true;
  if(data[0]['image'] == '') return
  if(data[0]['image'] != null){
    UPLOADEDCARDIMAGE.src = '/getImage/' + data[0]['image'];
  }
}

function fillLessonPopup(data){
  document.getElementById('lesson-id').value = data[0]['id'];
  LESSONTITLE.value = data[0]['name'];
  LESSONDESCRIPTION.value = data[0]['description'];
  LESSONSTARTDATE.innerText = data[0]['start_time'];
  LESSONSTARTDATE.innerText = data[0]['status'];
  var i = 0;
  if(data[0]['status'] == 'finished'){i = 1}
  LESSONSTATUS.options[i].selected = true;
  //image
}

function checkForOwner(user_id, card_owner_id, user_role_id){
  CARDTITLE.readOnly = false;
  CARDDESCRIPTION.readOnly = false;
  CARDSTATUS.disabled = false;
  CARDUPLOADIMAGE.disabled = false;
  //make eventListener enabled
  CARDSUBMITFORM.style.display = 'grid';
  //make eventListener disabled
  CARDUPVOTEQUESTION.style.display = 'none';
  CARDDOWNVOTEQUESTION.style.display = 'none';
  // if(user_id != card_owner_id){
  //   CARDSTATUS.disabled = true
  //   CARDSUBMITFORM.style.display = 'none';
  // }
  if(user_id == card_owner_id) return
  CARDSTATUS.disabled = true
  CARDSUBMITFORM.style.display = 'none';
  CARDTITLE.readOnly = true;
  CARDDESCRIPTION.readOnly = true;
  CARDUPLOADIMAGE.disabled = true;
  //make eventListener enabled
  CARDUPVOTEQUESTION.style.display = 'flex';
  CARDDOWNVOTEQUESTION.style.display = 'none';
  if( user_role_id == 2 ){
    CARDSTATUS.disabled = false
    CARDSUBMITFORM.style.display = 'grid';
  }
}

function checkforLessonCardOwner(user_id, card_owner_id){
  LESSONTITLE.readOnly = false;
  LESSONDESCRIPTION.readOnly = false;
  //make eventListener enabled
  LESSONCARDSUBMITFORM.style.display = 'grid';
  //make eventListener disabled
  if(user_id == card_owner_id) return
  LESSONTITLE.readOnly = true;
  LESSONDESCRIPTION.readOnly = true;
  //make eventListener disabled
  LESSONCARDSUBMITFORM.style.display = 'none';
  //make eventListener enabled
}

var showUserData = function (data,color){
  var initials = data['name'].match(/\b(\w)/g);
  var acronym = initials.join('');

  if(USERMODAL.style.display == 'block'){
    USERMODAL.style.display = "none";
    // USERPOPUP.style.display = 'none';
    return
  }
  USERMODAL.style.display = "block";
  // USERPOPUP.style.display='block';
  USERPOPUPBOL.style.backgroundColor= 'gray'
  USERPOPUPBOL.title= data['name']
  USERPOPUPINIT.innerText= data['name']
  USERPOPUPNAME.title= data['name']
  USERPOPUPEMAIL.innerText= data['email']
  USERPOPUPROLE.innerText= data['user_role_id']
  USERPOPUPAVATAR.innerText= acronym;
}

var showUpvoterData = function (data,color){
  var initials = data['name'].match(/\b(\w)/g);
  var acronym = initials.join('');

  if(UPVOTEUSERPOPUP.style.display == 'block'){
    UPVOTEUSERPOPUP.style.display = 'none'
    return
  }
  UPVOTEUSERPOPUP.style.display='block';
  UPVOTEUSERPOPUPBOL.style.backgroundColor= 'gray'
  UPVOTEUSERPOPUPBOL.title= data['name']
  USERPOPUPINIT.innerText= data['name']
  UPVOTERPOPUPNAME.title= data['name']
  UPVOTERPOPUPEMAIL.innerText= data['email']
  UPVOTERPOPUPROLE.innerText= data['user_role_id']
  UPVOTERPOPUPBOL.innerText= acronym;

  // i need 
  //username
  //user id
  //user color
}

function showCardAvatars(data, user_id, targetBox){
  CARDAVATARCONTAINER.innerHTML = '';
  CARDUPVOTEQUESTION.style.display = "flex";
  CARDDOWNVOTEQUESTION.style.display = "none";
  for (let i = 0; i < data.length; i++) {
    var initials = data[i]['name'].match(/\b(\w)/g);
    var acronym = initials.join('');
    
    const AVATAR = document.createElement("div");
    AVATAR.id = "card-" + data[i]['id'] + "-upvote-avatar";
    AVATAR.className = "avatar";
    AVATAR.title = data[i]['name'];
    AVATAR.style.backgroundColor = 'grey';
    AVATAR.addEventListener('click', showUserData.bind(event, data[i]), false);
    targetBox.appendChild(AVATAR);

    const AVATARINIT = document.createElement("a");
    AVATARINIT.id = "card-" + data[i]['id'] + "-upvote-avatar-init";
    AVATARINIT.innerText = acronym;
    AVATAR.appendChild(AVATARINIT);
    if(user_id == data[i]['id']){
      CARDUPVOTEQUESTION.style.display = "none";
      CARDDOWNVOTEQUESTION.style.display = "flex";
    }
  }
  QUESTIONUPVOTECOUNT.innerText = data.length;
}

function eventListeners(card_id, helper_id, helper_name, user_id){
  //remove helper
  // removeHelperBtn.addEventListener('click',destroyHelper, false);
  REMOVEHELPERBTN.addEventListener('click',removeHelper.bind(event,card_id), false);
  //add helper
  ADDHELPERBTN.addEventListener('click',addHelper.bind(event,helper_id, helper_name, card_id), false);
  //question upvote
  CARDUPVOTEQUESTION.addEventListener('click', addUpvote.bind(event, card_id, user_id), false);
  //question downvote
  CARDDOWNVOTEQUESTION.addEventListener('click', removeUpvote.bind(event, card_id, user_id), false);
  //avatar popup
  CARDHELPERAVATAR.addEventListener('click', getHelperInfo.bind(event, helper_id), false);
  //deleteImage
  var deleteImage = document.getElementById('deleteImage');
  deleteImage.addEventListener('click', deleteCardImage.bind(event, card_id), false);
  //submit
  CARDINFOPOPUP.addEventListener('submit', function(event){
    event.preventDefault();
    var card_name = CARDTITLE.value
    var card_description = CARDDESCRIPTION.value
    var card_status = CARDSTATUS.selectedOptions[0].value
    // saveImage(event, card_id);
    updateCard(event);
    CARDMODAL.style.display = "none";
  });
}

function lessonEventListeners(lessonCard_id, board_id){
  CARDUPVOTELESSON.addEventListener('click', saveLessonUpvote.bind(event, lessonCard_id), false);

  CARDDOWNVOTELESSON.addEventListener('click', deleteLessonUpvote.bind(event, lessonCard_id), false);

  REVIEW.addEventListener('click', function(){
    window.location.href = route('giveReview', [lessonCard_id, board_id]);
  });

  ALLREVIEWS.addEventListener('click', function(){
    window.location.href = route('allReviews', lessonCard_id);
  });
  
  LESSONINFOPOPUP.addEventListener('submit', function(event){
    event.preventDefault();
    updateLessonCard(event);
    if(event['target'][7].value == 'finished'){
        sendReviewLinks(lessonCard_id);  
    }
    LESSONMODAL.style.display = "none";
  });
}

// fetch requests
function sendReviewLinks(lessonCard_id){
  var url = route('sendReviewLinks')
  var meta = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var formData = new FormData();
  formData.append('lessonCard_id', lessonCard_id);
    
  fetch(url, {
    headers: {
      'X-CSRF-TOKEN': meta,
    },
    method: 'POST',
    credentials: "same-origin",
    body: formData,
    
  });
}

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

function updateCard(event){
  var url = route('updateCard')
  var meta = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var formData = new FormData(event.target);

  fetch(url, {
    headers: {
      'X-CSRF-TOKEN': meta,
    },
    method: 'POST',
    credentials: "same-origin",
    body: formData,
    
  });
}

function updateLessonCard(event){
  var url = route('updateLessonCard');
  var meta = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var formData = new FormData(event.target);


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
  UPLOADEDCARDIMAGE.src = '';
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
  UPLOADEDCARDIMAGE.src = URL.createObjectURL(event.target.files[0]);
};

// to do
// function for randomizing color of avatar bal and remembering color for next use