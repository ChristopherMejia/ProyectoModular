window.addEventListener('DOMContentLoaded', (event) => {

    async function postData(url = '', data = {}) {
        const response = await fetch(url, {
          method: 'POST', // *GET, POST, PUT, DELETE, etc.
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            // 'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }

    const message = ( campo ) =>{
        return (`
          <div class="alert alert-warning d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
              ¡El campo ${campo} es obligatorio!
            </div>
          </div>
        `)
    };

    ///crear Organismo ///
    const $form_create_organismo = document.getElementById('form_create_organismo');
    const $organismo_name = document.getElementById('organismoName');
    const $alert_name = document.getElementById('alert_name');

    $form_create_organismo.addEventListener('submit', async(event) => {
        event.preventDefault();
        const $name = $organismo_name.value;
        const toastElList = document.getElementById('liveToastCreate');
        const toastList = new bootstrap.Toast(toastElList, 5000);
        const toastError = document.getElementById('liveToastError');
        const toastErrorShow = new bootstrap.Toast(toastError, 5000);

        ($name == '') ? $alert_name.innerHTML = message('nombre') : $alert_name.innerHTML = '';

        const organismo = { name : $name }
        postData('/organismos/create', organismo)
          .then( response =>{
            $('#crearOrganismo').modal('hide');
            toastList.show();
            setTimeout( () =>{
              location.reload()
            }, 3000)

          })
          .catch( error => {
            toastErrorShow.show();
          });
    });

    ///Editar Organismo ///
    const $form_editar_organismo = document.getElementById('form_editar_organismo');
    const $organismo_name_editar = document.getElementById('organismoNameEditar');
    const $organismo_editar = document.getElementById('organismo_editar');
    const $alert_name_edit = document.getElementById('alert_name_edit');

    const getOrganismo = async(idOrganismo) => {
        const response = await postData('/organismos/get', {id : idOrganismo});
        const {message, organismo } = response;
        return organismo;
    }

    editOrganismo = async(idOrganismo) =>{
        const organismo = await getOrganismo(idOrganismo);
        $organismo_name_editar.value = organismo.nombre;
        $organismo_editar.value = organismo.id;
    }

    $form_editar_organismo.addEventListener('submit', async(event) => {
        event.preventDefault();
        const $name = $organismo_name_editar.value;
        const $id = $organismo_editar.value;
        const toastElList = document.getElementById('liveToastEdit')
        const toastList = new bootstrap.Toast(toastElList, 5000);

        const toastError = document.getElementById('liveToastError');
        const toastErrorShow = new bootstrap.Toast(toastError, 5000);

        ($name == '') ? $alert_name_edit.innerHTML = message('nombre') : $alert_name_edit.innerHTML = '';
        
        const organismo = { 
            name : $name,
            id : $id 
        }

        postData('/organismos/update', organismo)
          .then( response =>{
            $('#editarOrganismo').modal('hide');
            toastList.show();
            setTimeout( () =>{
              location.reload()
            }, 3000)

          })
          .catch( error => {
            toastErrorShow.show();
          });

    });


    ///Eliminar Organismo///
    const $form_delete_organismo = document.getElementById('form_delete_organismo');
    const $phrase = document.getElementById('phrase');
    const $organismo_delete = document.getElementById('organismo_delete');

    deleteOrganismo = async( idOrganismo ) => {
        const organismo = await getOrganismo(idOrganismo);
        $phrase.innerText = `¿Desea eliminar el organismo ${organismo.nombre} ?`;
        $organismo_delete.value = organismo.id;
    }

    $form_delete_organismo.addEventListener('submit', async(event) => {
        event.preventDefault();
        const toastDelete = document.getElementById('toastDelete')
        const toastDeleteShow = new bootstrap.Toast(toastDelete, 5000);
        const toastError = document.getElementById('liveToastError');
        const toastErrorShow = new bootstrap.Toast(toastError, 5000);
        const idOrganismo = $organismo_delete.value;
        const organismo = { id : idOrganismo}

        postData('/organismos/delete', organismo)
          .then( response =>{
            $('#eliminarOrganismo').modal('hide');
            toastDeleteShow.show();
            setTimeout( () =>{
              location.reload()
            }, 3000)

          })
          .catch( error => {
            toastErrorShow.show();
          });
    });

});
