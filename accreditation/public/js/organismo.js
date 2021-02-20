window.addEventListener('DOMContentLoaded', (event) => {

    const modal = document.getElementById('edit-item');
    const $btnEdit = document.getElementById('btnEdit');
    var target

    //Elemento del DOM seleccionado
    document.addEventListener('click', (e) => {
        e = window.event;
        target = e.target
    },false);

    modal.addEventListener('shown.bs.modal', function () {

        const idItem = document.getElementById('editId')
        const nameToEdit = document.getElementById('nameToEdit')

        const nameOrgano = target.dataset.name;
        const idOrgano   = target.dataset.id;
        idItem.value = idOrgano;
        nameToEdit.value = nameOrgano;

    })

});



