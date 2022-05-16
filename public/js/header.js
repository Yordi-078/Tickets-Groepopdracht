const AVATARIMAGE = document.getElementById('avatarImage');

window.onload = function() {
    getUserImage();
};

function getUserImage(){
    var url = route('getUserImage')
      
    fetch(url, {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json, text-plain, *//* only 1 line  ",
        "X-Requested-With": "XMLHttpRequest"
      },
      method: 'GET',
      credentials: "same-origin",
    }).then(response => response.json())
    .then(data => showImage(data[0]['image']));
  }

  function showImage(data){
    if(data != null){
        AVATARIMAGE.src = '/getImage/' + data;
    }
  }
