window.addEventListener('DOMContentLoaded', (event) => {

    const modal_delete = document.getElementById('delete-plantilla');

    document.addEventListener('click', (e) =>{
    e = window.event
    let target = e.target
    
        //logica modal edit
        modal_delete.addEventListener('shown.bs.modal', function () {

            const plantilla_id = document.getElementById('delete_id')
            const plantilla_name_delete = document.getElementById('name_delete')
            plantilla_name_delete.readOnly = true;

            const name_plantilla = target.dataset.name;
            const id_plantilla   = target.dataset.id;

            plantilla_id.value = id_plantilla;
            plantilla_name_delete.value = name_plantilla;

            //Resetamos los valores a null
            const close = document.getElementById('btn-close');
            close.addEventListener('click', () =>{
                plantilla_id.value = "";
                plantilla_name_delete.value = "";
            })
        })
    
    });

});