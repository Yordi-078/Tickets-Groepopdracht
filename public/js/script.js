// const { isPlainObject } = require("jquery");
// const { default: plugin } = require("tailwindcss/plugin");

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
function showQuestionPopup($modal, card_owner_id, $helper_id, $card_id, user_id){
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
  .then(data => calcInit(data, $card_id, user_id) );

  modal = document.getElementById($modal);
  modal.style.display = 'block';
}

function calcInit(name, $card_id, user_id){
  if(name[1] == 'empty'){// if there is no helper, form needs to be empty and add helper button needs to be visible
    document.getElementById("remove-helper-button").style.display = "none";
  }
  else{// if there is a helper, fill in the form with corresponding info
    //calculate the data (if needed)
    //get element with the id
    document.getElementById('helper-' + $card_id).innerText = name[1]['name'] + ' is helping this card.';
    document.getElementById('card-' + $card_id + '-helper-name').innerText = 'name: ' + name[1]['name'];
    document.getElementById('card-' + $card_id + '-helper-email').innerText = 'email: ' + name[1]['email'];
    if(name[1]['user_role'] == 'admin') {name[1]['user_role'] = 'docent'}
    document.getElementById('card-' + $card_id + '-helper-role').innerText = 'role: ' + name[1]['user_role'];
    //fill in the data 
    //display the correct button 
    if(user_id != name[1]['id']){
      document.getElementById("remove-helper-button").style.display = "none";
    }
    document.getElementById("add-helper-button").style.display = "none";
    
  }
  
  document.getElementById('card-owner').innerText = name[0]['name']
  
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

function addHelper($helperId, $helperName, $helperMail, $helperRole, card_id){
  saveHelper(card_id, $helperId);
  document.getElementById('helper-' + card_id).innerText = $helperName + ' is helping this card.';
  document.getElementById('card-' + card_id + '-helper-name').innerText = 'name: ' + $helperName;
  document.getElementById('card-' + card_id + '-helper-email').innerText = 'email: ' + $helperMail;
  if($helperRole == 'admin') {$helperRole = 'docent'}
  document.getElementById('card-' + card_id + '-helper-role').innerText = 'role: ' + $helperRole;
  document.getElementById("add-helper-button").style.display = "none";
  document.getElementById("remove-helper-button").style.display = "inline";
}

function destroyHelper(card_id){
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
  })
  
 .then(response => response.json())
  .then(data => console.log(data));
  document.getElementById('helper-' + card_id).innerText = 'no one is helping this card';
  document.getElementById('card-' + card_id + '-helper-name').innerText = 'name: ';
  document.getElementById('card-' + card_id + '-helper-email').innerText = 'email: ';
  document.getElementById('card-' + card_id + '-helper-role').innerText = 'role: ';
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
  })
  
 .then(response => response.json())
  .then(data => console.log(data));
}