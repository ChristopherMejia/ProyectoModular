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

    const $guiaContinue = document.getElementById('guia_complete');
    const $guiaCreate = document.getElementById('guia_create');
    
    ///crear plantilla
    const $formCreatePlantilla = document.getElementById('form_create_plantilla');
    const $organismoPlantilla = document.getElementById('organismoPlantilla');
    const $version = document.getElementById('version');
    const $alertOrganismo = document.getElementById('alert_organismo');
    const $alertVersion = document.getElementById('alert_version');

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

    $formCreatePlantilla.addEventListener('submit', async(event) => {
        event.preventDefault();
        const organismoValue = $organismoPlantilla.options[$organismoPlantilla.selectedIndex].value;
        const $versionValue = $version.value;

        const toastElList = document.getElementById('liveToastCreate');
        const toastList = new bootstrap.Toast(toastElList, 5000);

        const toastError = document.getElementById('liveToastError');
        const toastErrorShow = new bootstrap.Toast(toastError, 5000);

        (organismoValue == '') ? $alertOrganismo.innerHTML = message('organismo') : $alertOrganismo.innerHTML = '';
        ($versionValue == '') ? $alertVersion.innerHTML = message('versión') : $alertVersion.innerHTML = '';

        const plantilla = {
            idOrganismo : organismoValue,
            version : $versionValue,
        }
        postData('/plantillas/create', plantilla)
          .then( response =>{
            $('#crearPlantilla').modal('hide');
            toastList.show();
            setTimeout( () =>{
              location.reload()
            }, 3000)

          })
          .catch( error => {
            toastErrorShow.show();
          });

    });

    const $formCreateGuia = document.getElementById('form_create_guia');
    const $programaEducativo = document.getElementById('programaEducativo');
    const $coordinador = document.getElementById('coordinador');
    const $fecha = document.getElementById('fecha');
    const $idPlantilla = document.getElementById('id_plantilla');
    const $alertCoordinador = document.getElementById('alert_coordinador');
    const $alertProgramaEducativo = document.getElementById('alert_programaEducativo');
    const $alertFecha = document.getElementById('alert_fecha');
    const $closeModal = document.getElementById('close_guia_modal');

    crearGuia = async (id) => {
      $idPlantilla.value = id;
    }


    $formCreateGuia.addEventListener('submit', async(event) => {
      event.preventDefault();

      const valueProgramaEducativo = $programaEducativo.options[$programaEducativo.selectedIndex].value;
      const valueCoordinador = $coordinador.value;
      const valueDate = $fecha.value;
      const valueIdPlantilla = $idPlantilla.value;

      const toastElList = document.getElementById('liveToastCreate');
      const toastList = new bootstrap.Toast(toastElList, 5000);

      const toastError = document.getElementById('liveToastError');
      const toastErrorShow = new bootstrap.Toast(toastError, 5000);

      console.log(valueCoordinador, valueProgramaEducativo, valueDate, valueIdPlantilla);
      (valueCoordinador == '') ? $alertCoordinador.innerHTML = message('coordinador') : $alertCoordinador.innerHTML = '';
      (valueProgramaEducativo == '') ? $alertProgramaEducativo.innerHTML = message('programa educativo') : $alertProgramaEducativo.innerHTML = '';
      (valueDate == '') ? $alertFecha.innerHTML = message('fecha') : $alertFecha.innerHTML = '';

      const guia = {
        plantilla_id : valueIdPlantilla,
        programa_educativo_id : valueProgramaEducativo,
        nombre_coordinador : valueCoordinador,
        fecha_inicio : valueDate,
        status : 'Activo',
      }

      postData('/plantilla/create/guia', guia)
          .then( response =>{
            console.log(response)
            // $('#crearGuia').modal('hide');
            $closeModal.click();
            toastList.show();
            setTimeout( () =>{
              location.reload()
            }, 2000)

          })
          .catch( error => {
            console.log(error)
            toastErrorShow.show();
          });

    });      



});