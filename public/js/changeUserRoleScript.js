
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
    searchUser(input);
}

function showAllUsers(data){
    for (let i = 0; i < data.length; i++) {
        var div = document.createElement('div');
        div.classList = 'four-columns';
        // email
        var a = document.createElement('a');
        a.innerText = data[i]['email'];
        div.appendChild(a);
        // role
        var b = document.createElement('a');
        b.innerText = data[i]['user_role_id'];
        div.appendChild(b);
        // edit
        var c = document.createElement('a');
        c.innerText = "Bewerk";
        var x = changeUser.bind(event, data[i]['id']);
        c.addEventListener('click', x, false);
        c.classList = 'link';
        div.appendChild(c);
        // delete
        var d = document.createElement('a');
        d.innerText = "Verwijder";
        var x = deleteUser.bind(event, data[i]['id']);
        d.addEventListener('click', x, false);
        d.classList = 'link';
        div.appendChild(d);
        document.getElementById('all-user-list').appendChild(div);
    }
}

function showSearchResult(data){
    for (let i = 0; i < data.length; i++) {
        var div = document.createElement('div');
        div.classList = 'four-columns';
        // email
        var a = document.createElement('a');
        a.innerText = data[i]['email'];
        div.appendChild(a);
        // role
        var b = document.createElement('a');
        b.innerText = data[i]['user_role_id'];
        div.appendChild(b);
        // edit
        var c = document.createElement('a');
        c.innerText = "Bewerk";
        var x = changeUser.bind(event, data[i]['id']);
        c.addEventListener('click', x, false);
        c.classList = 'link';
        div.appendChild(c);
        // delete
        var d = document.createElement('a');
        d.innerText = "Verwijder";
        var x = deleteUser.bind(event, data[i]['id']);
        d.addEventListener('click', x, false);
        d.classList = 'link';
        div.appendChild(d);
        document.getElementById('user-list').appendChild(div);
    }
}

function allUsers(){
    var url = route('fetchAllUsers');
  
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

var searchUser = function(input){
    var url = route('searchUser', input );
  
    fetch(url, {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json, text-plain, *//* only 1 line  ",
        "X-Requested-With": "XMLHttpRequest"
      },
      method: 'GET',
      credentials: "same-origin",
    }) .then(response => response.json())
    .then(data => showSearchResult(data) );
}

var changeUser = function(user_id){
    window.location = route('changeUserForm', [user_id]);
}

var deleteUser = function(user_id){
    window.location = route('destroyUserPage', [user_id]);
}

allUsers()