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
function showPopup(modal_id, board_id){
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
  .then(data => showData(data['users']));
   modal = document.getElementById(modal_id);
   modal.style.display = "block"; 
}

function showData(data){
  document.getElementById('lesson-card-info-test').innerText = 'de hele array: ' + data;
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

function addHelper($helperId, $helperName){

  var letters = $helperName.match(/\b(\w)/g).join('');
  var acronym = letters.substring(0, 3);

  let elem = document.createElement("p");

  elem.innerText = acronym;
  elem.className = 'helper';
  elem.id = 'helper' + $helperId;

  var helperBox = document.getElementById("helper-box");
  helperBox.insertBefore(elem, helperBox.firstChild);

  document.getElementById("add-helper-button").value = " - ";
  document.getElementById("add-helper-button").onclick = function(){destroyHelper($helperId, $helperName)};
}

function destroyHelper($helperId, $helperName){
  document.getElementById('helper' + $helperId).remove();
  document.getElementById("add-helper-button").value = " + ";
  document.getElementById("add-helper-button").onclick = function(){addHelper($helperId, $helperName)};
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
 
