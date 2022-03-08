
console.log('second')
document.getElementById('user-list-form').addEventListener('submit', function(event){
    event.preventDefault();
    emptyAll();
    start();
});

function emptyAll(){
    document.getElementById('user-list').innerHTML = "";
}

function start(){
    var board_id = document.getElementById('user-search-btn').value
    var input = document.getElementById('user-search-input').value
    searchUser(board_id, input);
}

function showSearchResult(data, board_id){
    for (let i = 0; i < data.length; i++) {
        var user = document.createElement('a');
        user.innerText = data[i]['name'];
        user.href = route('addToBoard', [board_id, data[i]['id']]);
        document.getElementById('user-list').appendChild(user);
    }
}

var searchUser = function(board_id, input){
    var url = route('search', [input, board_id]);
  
    fetch(url, {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json, text-plain, *//* only 1 line  ",
        "X-Requested-With": "XMLHttpRequest"
      },
      method: 'GET',
      credentials: "same-origin",
    }) .then(response => response.json())
    .then(data => showSearchResult(data, board_id) );
}