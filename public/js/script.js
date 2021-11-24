function toggleBoard() {
    var boards = document.getElementsByClassName("board");
    for (i = 0; i < boards.length; i++) {
        boards[i].classList.toggle('board-row');
    }
    document.getElementById("home-board-content-box").classList.toggle("flex-row");
    document.getElementById("home-board-content-box").classList.toggle("flex-column");
}