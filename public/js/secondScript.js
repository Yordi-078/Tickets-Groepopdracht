
const currentUrl = window.location.href;
const board_id = currentUrl.substring(currentUrl.lastIndexOf("/") + 1, currentUrl.length);
const userSearchIcon = document.getElementById('user-search-icon');
const userSearchInput = document.getElementById('user-search-input');

userSearchIcon.addEventListener('click', function(event){
    event.preventDefault();
    if(userSearchInput.classList.contains('retract')){
        userSearchInput.classList.remove('retract');
        userSearchInput.classList.add('extend');
        
    }
    else{
        userSearchInput.classList.remove('extend');
        userSearchInput.classList.add('retract');
        setTimeout(function() {
            userSearchInput.value = "";
        }, 1000);        
    }
});

document.getElementById('user-list-form').addEventListener('submit', function(event){
    event.preventDefault();
    emptyAll();
    start();
});

function emptyAll(){
    document.getElementById('user-list').innerHTML = "";
}

function start(){
    var input = document.getElementById('user-search-input').value
    searchUser(board_id, input);
}

function showSearchResult(data, board_id){
    for (let i = 0; i < data.length; i++) {
        var div = document.createElement('div');
        var x = addUser.bind(event, board_id, data[i]['id']);
        div.addEventListener('click', x, false);
        div.classList = 'four-columns link';
        // image
        var a = document.createElement('a');
        // div.innerText = data[i][''];
        a.innerText = "image";
        div.appendChild(a);
        // name
        var b = document.createElement('a');
        b.innerText = data[i]['name'];
        div.appendChild(b);
        // email
        var c = document.createElement('a');
        c.innerText = data[i]['email'];
        div.appendChild(c);
        // role
        var d = document.createElement('a');
        d.innerText = data[i]['user_role_id'];
        div.appendChild(d);
        document.getElementById('user-list').appendChild(div);
    }
}

function showAllUsers(data){
    console.log(data)
    for (let i = 0; i < data.length; i++) {
        var div = document.createElement('div');
        div.addEventListener('click', addUser.bind(event, board_id, data[i]['id']), false);
        div.classList = 'four-columns link';
        // image
        var a = document.createElement('a');
        // div.innerText = data[i][''];
        a.innerText = "image";
        div.appendChild(a);
        // name
        var b = document.createElement('a');
        b.innerText = data[i]['name'];
        div.appendChild(b);
        // email
        var c = document.createElement('a');
        c.innerText = data[i]['email'];
        div.appendChild(c);
        // role
        var d = document.createElement('a');
        d.innerText = data[i]['user_role_id'];
        div.appendChild(d);
        document.getElementById('all-user-list').appendChild(div);
    }
}

function allUsers(location){
    console.log(location);
    var url = route(location, board_id);
  
    fetch(url, {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json, text-plain, *//* only 1 line  ",
        "X-Requested-With": "XMLHttpRequest"
      },
      method: 'GET',
      credentials: "same-origin",
    }) .then(response => response.json())
    .then(data => showAllUsers(data) );
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

var addUser = function(board_id, data){
    window.location = route('addToBoard', [board_id, data]);
}

function checkpage(){
    var url = window.location.href;
    console.log(url)
    var page = url.split('/')[5];
    console.log(page)
    var page2 = url.split('/')[4];
    console.log(page2)
    var page3 = url.split('/')[0];
    console.log(page3)
    var location = '';

    if(page == 'addStudentsToBoard'){
        location = 'fetchAllUsers';
    }
    else if(page == 'allBoardUsers'){
        location = 'viewUsersFromBoard';
    }
    else{
        alert('warning url is incorrect');
    }
    return location
}

allUsers(checkpage());

