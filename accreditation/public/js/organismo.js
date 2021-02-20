window.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');

    const btn_modal = document.getElementById('edit-item');
    const modal = new bootstrap.Modal(document.getElementById('editModal'), options)
    console.log(modal)

    btn_modal.addEventListener('click', function(){
        modal.show()
    })

    // modal.addEventListener('show.bs.modal', function (event){
    //     const organismoNombre = document.getElementById('organismoNombre');
    //     const organismoID = document.getElementById('organismoId');  
    // })

});



