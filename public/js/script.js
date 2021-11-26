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