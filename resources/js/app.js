require('./bootstrap');

// window.confirmDelete = function(){
//     const resp = confirm('vuoi davvero cancellare il post selezionato?');

//     if(!resp){
//         event.preventDefault();
//     }
// }

// best practice to create a confirm for your delete button in js

const deleteForm = document.querySelectorAll('.delete-post');

deleteForm.foreach(item => {
    item.addEventListener('submit', function(e){
        const resp = confirm('vuoi davvero cancellare il post selezionato?');

        if(!resp){
            e.preventDefault();
            //e is the event pointed by the eventlistenere, with the preventDefault we stop the delete
        }
    }) 
})