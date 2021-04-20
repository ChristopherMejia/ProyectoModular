window.addEventListener('DOMContentLoaded', (event) => {
    const modal_edit = document.getElementById('edit-item');
    
    document.addEventListener('click', (e) => {
        const target = e.target
        const nameEdit = target?.dataset && target?.dataset?.name;
        const idEdit = target?.dataset && target?.dataset?.id;
        
   

        modal_edit.addEventListener('shown.bs.modal', function () {
            const name_edit = document.getElementById('itemToEdit');
            const id_edit = document.getElementById('editId');
            const new_name = document.getElementById('nombre');
            
            name_edit.readOnly = true;
            
            name_edit.value = nameEdit
            id_edit.value = idEdit
        
            const close = document.getElementById('btn-close');
            close.addEventListener('click', () =>{
                name_edit.value = "";
                id_edit.value = "";
                new_name.value = "";
            })
        })

    })

});
