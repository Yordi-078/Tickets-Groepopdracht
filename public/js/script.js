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
function showQuestionPopup($var, user_id, $helper_id){
  if(!$helper_id) {$helper_id = 'empty'}
  var url = route('getUsername', [user_id, $helper_id]);

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
  .then(data => calcInit(data) );

  modal = document.getElementById($var);
  modal.style.display = 'block';
}

function calcInit(name){
  console.log('name is: ')
  console.log(name);
  if(name[1] == 'empty'){
    document.getElementById("remove-helper-button").style.display = "none";
  }
  else{
    document.getElementById("add-helper-button").style.display = "none";
    var initials = name[1]['name'].match(/\b(\w)/g);
    var acronym = initials.join('');
    document.getElementById('helper').innerText = acronym
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
  console.log(data);
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

function addHelper($helperId, $helperName, card_id){
  saveHelper(card_id, $helperId)
  var letters = $helperName.match(/\b(\w)/g).join('');
  var acronym = letters.substring(0, 3);

  let elem = document.createElement("p");

  elem.innerText = acronym;
  elem.className = 'helper';
  elem.id = 'helper';

  var helperBox = document.getElementById("helper-box");
  helperBox.insertBefore(elem, helperBox.firstChild);

  document.getElementById("add-helper-button").style.display = "none";
  document.getElementById("remove-helper-button").style.display = "block";
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
  document.getElementById('helper').remove();
  document.getElementById("remove-helper-button").style.display = "none";
  document.getElementById("add-helper-button").style.display = "block";
}

function saveHelper(card_id, $helperId){
  console.log("card id is: " + $helperId)
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
  
//  function showPopup(modal_id, board_id){
//     var url = '{{ route("getCardInfo", "1", "1") }}';
//     console.log(url)
    
//      let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//      var body = {
//        lesson_id : modal_id,
//        board_id : board_id
//      }; 
//         fetch(url, {
//           method: 'POST',
//           redirect: 'follow'
//         })
//           .then((response)=>{
//           return response.json();
//         }).then((data) => {
//           console.log('send data')
//           console.log(data)
          // let profile = data.find();      
          // document.getElementById("name-input").value = profile.name;
          // document.getElementById("email-input").value = profile.email;
        // });
    // .then(response => response.json())
    //  .then(data => console.log(data));
    // modal = document.getElementById(modal_id);
    // modal.style.display = "block";
  
 
// }
 
