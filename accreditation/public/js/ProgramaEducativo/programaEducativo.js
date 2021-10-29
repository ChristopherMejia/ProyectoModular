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

    // Crear Nivel Educativo
    const $nombrePrograma = document.getElementById('nombrePrograma');
    const $nivelPrograma = document.getElementById('nivelPrograma');
    const $alertName = document.getElementById('alert_name');
    const $alertLevel = document.getElementById('alert_level');
    const $formCreatePrograma = document.getElementById('form_create_programa');

    $formCreatePrograma.addEventListener('submit', async(event) => {
        event.preventDefault();
        const $nombre = $nombrePrograma.value;
        const $nivel = $nivelPrograma.options[$nivelPrograma.selectedIndex].value;

        const toastElList = document.getElementById('liveToastCreate');
        const toastList = new bootstrap.Toast(toastElList, 5000);

        const toastError = document.getElementById('liveToastError');
        const toastErrorShow = new bootstrap.Toast(toastError, 5000);

        ($nombrePrograma.value == '') ? $alertName.innerHTML = message('nombre') : $alertName.innerHTML = '';
        ($nivel == '') ? $alertLevel.innerHTML = message('nivel') : $alertLevel.innerHTML = '';

        const programaEducativo = {
            name : $nombre,
            level : $nivel,
        }

        postData('/programa-educativo/save', programaEducativo)
          .then( response =>{
            $('#crearProgramaEducativo').modal('hide');
            toastList.show();
            setTimeout( () =>{
              location.reload()
            }, 2000)

          })
          .catch( error => {
            toastErrorShow.show();
          });

    });

    // Editar Nivel Educativo
    const $formEditarPrograma = document.getElementById('form_editar_programa');
    const $nombreProgramaEditar = document.getElementById('nombreProgramaEditar');
    const $nivelProgramaEditar = document.getElementById('nivelProgramaEditar');
    const $idProgramaEditar = document.getElementById('idProgramaEditar');
    const $alertNameEditar = document.getElementById('alert_name_editar');
    const $alertLevelEditar = document.getElementById('alert_level_editar');
    const $btnCloseEdit = document.getElementById('btnCloseEdit');

    const arrayLevels = [
      'Tecnico Superior Universitario',
      'Ingeniería',
      'Licenciatura',
    ];


    const getProgramaEducativo = async (id) => {
      const response = await postData('/programa-educativo/get', {id : id})
      const { message , programaEducativo} = response;
      return programaEducativo;
    }
    const optionSelectNivel = async(nivel) => {
      arrayLevels.forEach(element => {
        let option = document.createElement('option');
          if(element === nivel){
              option.value = element;
              option.innerHTML = element;
              option.setAttribute("selected", "");
              $nivelProgramaEditar.appendChild(option);
          }else{
            option.value = element;
            option.innerHTML = element;
            $nivelProgramaEditar.appendChild(option);
          }
      });
    }

    editarPrograma = async(id) => {
        const programaEducativo = await getProgramaEducativo(id)
        $nombreProgramaEditar.value = programaEducativo.nombre;
        $idProgramaEditar.value = programaEducativo.id;
        optionSelectNivel(programaEducativo.nivel);
    }

    $btnCloseEdit.addEventListener('click', async() => {
      if ($nivelProgramaEditar.length >= 1) {
        for (let i = $nivelProgramaEditar.length - 1; i >= 0; i--) { //Eliminamos del DOM las opciones cargadas
          $nivelProgramaEditar.remove(i);
        }
      }
      $nombreProgramaEditar.value = '';
      $idProgramaEditar.value = '';
        
    });

    $formEditarPrograma.addEventListener('submit', async(event) => {
      event.preventDefault();
        const $level  = $nivelProgramaEditar.options[$nivelProgramaEditar.selectedIndex].value;
        const toastElList = document.getElementById('liveToastEdit')
        const toastList = new bootstrap.Toast(toastElList, 5000);
        const toastError = document.getElementById('liveToastError');
        const toastErrorShow = new bootstrap.Toast(toastError, 5000);


        ($nombreProgramaEditar.value == '') ? $alertNameEditar.innerHTML = message('nombre') : $alertNameEditar.innerHTML = '';
        ($level == '') ? $alertLevelEditar.innerHTML = message('Nivel Educativo') : $alertLevelEditar.innerHTML = '';

        const programaEducativo = {
          id : $idProgramaEditar.value,
          name : $nombreProgramaEditar.value,
          level : $level,
        }

        postData('/programa-educativo/update', programaEducativo)
          .then( response =>{
            $('#editarProgramaEducativo').modal('hide');
            toastList.show();
            setTimeout( () =>{
              location.reload()
            }, 3000)

          })
          .catch( error => {
            toastErrorShow.show();
          });
    });

    ///Eliminar Programa
    const $form_delete_programa = document.getElementById('form_delete_programa');
    const $phrase = document.getElementById('phrase');
    const $programa_delete = document.getElementById('programa_delete');

    eliminarPrograma = async(id) => {
      const programaEducativo = await getProgramaEducativo(id);
      $phrase.innerText = `¿Desea eliminar el programa educativo
      ${programaEducativo.nombre} / ${programaEducativo.nivel} ?`;
      $programa_delete.value = programaEducativo.id;
    } 

    $form_delete_programa.addEventListener('submit', async(event) => {
      event.preventDefault();
      const toastDelete = document.getElementById('toastDelete')
      const toastDeleteShow = new bootstrap.Toast(toastDelete, 5000);
      const toastError = document.getElementById('liveToastError');
      const toastErrorShow = new bootstrap.Toast(toastError, 5000);
      const programaEducativo = {
        id : $programa_delete.value,
      }
      postData('/programa-educativo/delete', programaEducativo)
      .then( response =>{
        $('#eliminarPrograma').modal('hide');
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
