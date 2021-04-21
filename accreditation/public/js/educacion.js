window.addEventListener('DOMContentLoaded', (event) => {
    const modal_edit = document.getElementById('edit-item');
    const modal_delete = document.getElementById('delete-item');
    const table = document.getElementById('table');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = tbody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {

        rows[i].addEventListener('click', (e) => {
            const target = e.target
            const name_edit = target?.dataset && target?.dataset?.name;
            const id_edit = target?.dataset && target?.dataset?.id;
            console.log(name_edit, id_edit)

            modal_edit.addEventListener('shown.bs.modal', function () {
                const name_edit_dom = document.getElementById('itemToEdit');
                const id_edit_dom = document.getElementById('editId');
                const new_name_dom = document.getElementById('nombre');
                
                name_edit_dom.readOnly = true;
                name_edit_dom.value = name_edit;
                id_edit_dom.value = id_edit;
            
                const close = document.getElementById('btn-close');

                close.addEventListener('click', () =>{
                    name_edit_dom.value = "";
                    id_edit_dom.value = "";
                    new_name_dom.value = "";
                })
            })

            modal_delete.addEventListener('shown.bs.modal', function() {
                const name_delete_dom = document.getElementById('deleteName');
                const id_delete_dom = document.getElementById('deleteId');
                const close_delete = document.getElementById('btn-close-dlt');

                name_delete_dom.readOnly = true;
                name_delete_dom.value = name_edit;
                id_delete_dom.value = id_edit;

                close_delete.addEventListener('click', () =>{
                    name_delete_dom.value='';
                    id_delete_dom.value='';
                })

            })

        })
    }

});
