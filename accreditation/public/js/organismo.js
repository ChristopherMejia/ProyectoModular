window.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById('edit-item');
    const modal_delete = document.getElementById('delete-item');

    //Elemento del DOM seleccionado
    document.addEventListener('click', (e) => {
        e = window.event;
        let target = e.target
    

    //logica modal edit
    

    modal.addEventListener('shown.bs.modal', function () {

        const idItem = document.getElementById('editId')
        const nameToEdit = document.getElementById('nameToEdit')
        const nameNewInput = document.getElementById('newName')

        const nameOrgano = target.dataset.name;
        const idOrgano   = target.dataset.id;
        idItem.value = idOrgano;
        nameToEdit.value = nameOrgano;

        //Resetamos los valores a null
        const close = document.getElementById('btn-close');
        close.addEventListener('click', () =>{
            idItem.value = "";
            nameToEdit.value = "";
            nameNewInput.value = "";
        })

    })

    
    modal_delete.addEventListener('shown.bs.modal', function(){
        const idDelete = document.getElementById('deleteId')
        const nameDelete = document.getElementById('deleteName')
        nameDelete.readOnly = true;

        const nameOrgano = target.dataset.name;
        const idOrgano   = target.dataset.id;
        idDelete.value = idOrgano;
        nameDelete.value = nameOrgano;


        const closeDelete = document.getElementById('btn-close-dlt');
        closeDelete.addEventListener('click', () =>{
            idDelete.value = "";
            nameDelete.value = "";
        })

    })


    });

});



