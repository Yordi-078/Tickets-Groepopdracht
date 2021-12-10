const { isPlainObject } = require("jquery");
const { default: plugin } = require("tailwindcss/plugin");

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
       var url = '{{ route("getCardInfo") }}';
       console.log(url)
       let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
       var body = {
         lesson_id : modal_id,
         board_id : board_id
       };
       fetch(url, {
         headers: {
           "Content-Type": "application/json",
           "Accept": "application/json, text-plain, */*",
           "X-Requested-With": "XMLHttpRequest",
           "X-CSRF-TOKEN": token,
         },
         method: 'post',
         credentials: "same-origin",
         body: JSON.stringify(body)
       })
      .then(response => response.json())
       .then(data => console.log(data));
      modal = document.getElementById(modal_id);
      modal.style.display = "block";

   
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
