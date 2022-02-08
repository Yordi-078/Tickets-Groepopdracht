// const { isPlainObject } = require("jquery");
// const { default: plugin } = require("tailwindcss/plugin");

const removeHelperBtn = document.getElementById('remove-helper-button');
const addHelperBtn = document.getElementById('add-helper-button');

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

// Get the modal
var modal = 0;

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
function showQuestionPopup(card_owner_id, $helper_id, user_id, user_name, card_id){

  resetQuestionPopup();
  getQuestionCardInfo(card_id);
  checkForOwner(user_id, card_owner_id);
  eventListeners(card_id, user_id, user_name);
  if(!$helper_id) {$helper_id = 'empty'}
  var url = route('getUsername', [card_owner_id, $helper_id]);

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
  })
  
 .then(response => response.json())
  .then(data => calcInit(data, user_id, card_owner_id) );
  getCardAvatars(card_id);

  modal = document.getElementById('cardModal');
  modal.style.display = 'block';
}

function calcInit(name, user_id, card_owner_id){
  document.getElementById('card-owner').innerText = name[0]['name'];

  if(name[1] == 'empty'){
    document.getElementById("remove-helper-button").style.display = "none";
    document.getElementById('card-helper-avatar').style.display = 'none'

    if(user_id != card_owner_id){
      document.getElementById('add-helper-button').style.display = 'inline';
    }
  }

  else{
    var initials = name[1]['name'].match(/\b(\w)/g);
    var acronym = initials.join('');
    
    document.getElementById('helper').innerText = name[1]['name'] + ' is helping this card.';
    document.getElementById('card-helper-avatar').style.display = 'flex';
    document.getElementById('card-helper-avatar').style.backgroundColor= 'gray'
    document.getElementById('card-helper-avatar').title= name[1]['name']
    document.getElementById('card-helper-avatar-init').innerText= acronym

    if(user_id == name[1]['id'] || user_id == card_owner_id){
      document.getElementById("remove-helper-button").style.display = "inline";
    }

    document.getElementById('add-helper-button').style.display = 'none';
  }
  
}

function showPopup(modal_id, board_id){
  // modal_id substringen
  var url = route('getCardInfo', [modal_id, board_id])
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
  })
  
 .then(response => response.json())
  .then(data => showData(data));
   modal = document.getElementById(modal_id);
   modal.style.display = "block"; 
}

function showData(data){

  document.getElementById('lesson-card-info-test').innerText = 'de hele array: ' + data[0] + ', ' + data[1];
}

span.onclick = function() {
  modal.style.display = "none";
}
    
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

var addHelper = function($helperId, $helperName, card_id){

  saveHelper(card_id, $helperId);

  var initials = $helperName.match(/\b(\w)/g);
  var acronym = initials.join('');

  document.getElementById('helper').innerText = $helperName + ' is helping this card.';
  document.getElementById('card-helper-avatar').style.display = 'flex'
  document.getElementById('card-helper-avatar').style.backgroundColor= 'gray'
  document.getElementById('card-helper-avatar').title= $helperName
  document.getElementById('card-helper-avatar-init').innerText= acronym
  // document.getElementById('card-' + card_id + '-helper-avatar').onclick= showUserData('jan pieter son', 'jps', 'green');
  document.getElementById("remove-helper-button").style.display = "inline";
  document.getElementById("add-helper-button").style.display = "none";
}

var destroyHelper = function(card_id){

  var url = route('removeHelper', card_id)
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

  document.getElementById('helper').innerText = 'no one is helping this card';
  document.getElementById('card-helper-avatar').style.display = 'none';
  document.getElementById('card-helper-avatar').style.backgroundColor= '';
  document.getElementById('card-helper-avatar').title= '';
  document.getElementById('card-helper-avatar-init').innerText= '';
  document.getElementById("remove-helper-button").style.display = "none";
  document.getElementById("add-helper-button").style.display = "inline";
}

function saveHelper(card_id, $helperId){
  var url = route('saveHelper', [card_id, $helperId])
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

function getQuestionCardInfo(card_id){
  var url = route('getQuestionCardInfo', card_id)
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
  })
  
 .then(response => response.json())
  .then(data => fillQuestionPopup(data));
}

function resetQuestionPopup(){
  document.getElementById('cardAvatarContainer').innerHTML = '';
  document.getElementById('card-owner').innerText = '';
  document.getElementById('helper').innerText = 'no one is helping this card';
  document.getElementById('card-helper-avatar').style.display = 'none';
  document.getElementById('card-helper-avatar').style.backgroundColor= '';
  document.getElementById('card-helper-avatar').title= '';
  document.getElementById('card-helper-avatar-init').innerText= '';
  document.getElementById("remove-helper-button").style.display = "none";
  document.getElementById("add-helper-button").style.display = "none";
}

function fillQuestionPopup(data){
  document.getElementById('card-info-popup')
  document.getElementById('card-title').value = data[0]['name'];
  document.getElementById('card-description').value = data[0]['description'];
  document.getElementById('card-created-at').innerText = data[0]['created_at'];
  var i = 0;
  if(data[0]['status'] == 'finished'){i = 1}

  document.getElementById('card-status').options[i].selected = true;
  //image
}

function checkForOwner(user_id, card_owner_id){
  document.getElementById('card-title').readOnly = false;
  document.getElementById('card-description').readOnly = false;
  document.getElementById('card-status').disabled = false;
  document.getElementById('upload-image').disabled = false;
  //make eventListener enabled
  document.getElementById('submit-form').style.display = 'grid';
  //make eventListener disabled
  document.getElementById('card-upvote-question').style.display = 'none';
  document.getElementById('card-downvote-question').style.display = 'none';
  if(user_id == card_owner_id) return
  document.getElementById('card-title').readOnly = true;
  document.getElementById('card-description').readOnly = true;
  document.getElementById('card-status').disabled = true;
  document.getElementById('upload-image').disabled = true;
  //make eventListener disabled
  document.getElementById('submit-form').style.display = 'none';
  //make eventListener enabled
  document.getElementById('card-upvote-question').style.display = 'flex';
  document.getElementById('card-downvote-question').style.display = 'flex';
  
}

function showUserData(username, initials,color){
  if(document.getElementById('userPopup').style.display == 'block'){
    document.getElementById('userPopup').style.display = 'none'
    return
  }
  document.getElementById('userPopup').style.display='block';
  document.getElementById('userPopupBol').style.backgroundColor= 'gray'
  document.getElementById('userPopupBol').title= username
  document.getElementById('userPopupInit').innerText= username
  document.getElementById('userPopupName').title= username
  document.getElementById('userPopupAvatar').innerText= initials;

  // i need 
  //username
  //user id
  //user color
}

var saveCardUpvote = function ($card_id){
  var url = route('saveCardUpvote', [$card_id])
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

var deleteCardUpvote = function ($card_id){
  var url = route('deleteCardUpvote', [$card_id])
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

function getCardAvatars(card_id){
  var url = route('GetCardAvatars', card_id)
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
  })
  
 .then(response => response.json())
  .then(data => showCardAvatars(data));
}

function showCardAvatars(data){
  for (let i = 0; i < data.length; i++) {
    var initials = data[i]['name'].match(/\b(\w)/g);
    var acronym = initials.join('');
    
    const container = document.getElementById('cardAvatarContainer');
    const avatar = document.createElement("div");
    avatar.id = "card-" + data[i]['id'] + "-helper-avatar";
    avatar.className = "avatar";
    avatar.title = data[i]['name'];
    avatar.style.backgroundColor = 'grey';
    container.appendChild(avatar);

    const avatarInit = document.createElement("a");
    avatarInit.id = "card-" + data[i]['id'] + "-helper-avatar-init";
    avatarInit.innerText = acronym;
    avatar.appendChild(avatarInit);
  }
  document.getElementById('question-upvote-count').innerText = data.length;
}

function eventListeners(card_id, helper_id, helper_name){
  //remove helper
  // removeHelperBtn.addEventListener('click',destroyHelper, false);
  removeHelperBtn.addEventListener('click',destroyHelper.bind(event,card_id), false);
  //add helper
  addHelperBtn.addEventListener('click',addHelper.bind(event,helper_id, helper_name, card_id), false);
  //question upvote
  document.getElementById('card-upvote-question').addEventListener('click', saveCardUpvote.bind(event, card_id), false);
  //question downvote
  document.getElementById('card-downvote-question').addEventListener('click', deleteCardUpvote.bind(event, card_id), false);
  //submit
  document.getElementById('card-info-popup').addEventListener('submit', function(event){
    event.preventDefault();
  
    var card_name = document.getElementById('card-title').value
    var card_description = document.getElementById('card-description').value
    var card_status = document.getElementById('card-status').selectedOptions[0].value

    var url = route('updateCard', [card_id, card_name, card_description, card_status])
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
  });
}

// to do
// all variables that have a '$' should remove '$' from there name
// function for randomizing color of avatar bal and remembering color for next use
// move all fetch related request to the bottom of the javascript file
// make a loader for all popups
//remove all document.getElementById and place them in const at the top of script.js file