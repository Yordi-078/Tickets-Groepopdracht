const EDITUPLOADEDIMAGE = document.getElementById("edit-uploaded-card-image");
const EDITUSERFORM = document.getElementById('edit-user-form');
const SUBMITCHANGES = document.getElementById('Submit-changes-button');

window.onload = function() {
    getUserImage();
};

EDITUSERFORM.addEventListener('submit', function(event){
    event.preventDefault();
    saveImage(event);
});

var loadImage = function(event) {
    EDITUPLOADEDIMAGE.src = URL.createObjectURL(event.target.files[0]);
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
        EDITUPLOADEDIMAGE.src = '/getImage/' + data;
    }
  }
  /**
   * uploaded images gets saved and map direction gets saved in the database
   * 
   * @param {} event gets form all data 
   * @param {} meta gets meta key out of head
   * @param {} formData makes a data object for image that can be send in the body for the post
   */
   function saveImage(event){
    var url = route('saveImage')
    var meta = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var formData = new FormData();
    formData.append('image', event.target[1].files[0]);
      
    fetch(url, {
      headers: {
        'X-CSRF-TOKEN': meta,
      },
      method: 'POST',
      credentials: "same-origin",
      body: formData,
      
    }).then(response => response.json())
    .then(data => updateImage(data));
  }

  function updateImage(image_id){
    var url = route('updateUserImage', image_id)
      
    fetch(url, {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json, text-plain, *//* only 1 line  ",
        "X-Requested-With": "XMLHttpRequest"
      },
      method: 'GET',
      credentials: "same-origin",
    });
  }

  var deleteImage = function (){
    var url = route('deleteImage' );
    
    fetch(url, {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json, text-plain, *//* only 1 line  ",
        "X-Requested-With": "XMLHttpRequest"
      },
      method: 'GET',
      credentials: "same-origin",
    });
    EDITUPLOADEDIMAGE.src = '';
  }


// following functions are yet to be made

//  var deleteImage = document.getElementById('deleteImage');
//  deleteImage.addEventListener('click', deleteCardImage.bind(event, card_id), false);

var deleteImage = function (){
    var url = route('deleteImage' );
    
    fetch(url, {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json, text-plain, *//* only 1 line  ",
        "X-Requested-With": "XMLHttpRequest"
      },
      method: 'GET',
      credentials: "same-origin",
    });
    EDITUPLOADEDIMAGE.src = '';
  }