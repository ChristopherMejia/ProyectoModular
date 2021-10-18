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

    const $FormCreateUser = document.getElementById('form_create_user');
    const $FirstName = document.getElementById('FirstName');
    const $LastName = document.getElementById('LastName');
    const $Email = document.getElementById('email');
    const $inputGroupRoles = document.getElementById('inputGroupRoles');
    const $password = document.getElementById('password');
    const $divAlert = document.getElementById('alert_name');
    const $divAlertEmail = document.getElementById('alert_email');
    const $alertRole = document.getElementById('alert_role');
    const $alertPassword = document.getElementById('alert_password');

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

    const defaultValue = () =>{
      $FirstName.value='';
      $LastName.value='';
      $Email.value='';
      $password.value='';
    }
    
    $FormCreateUser.addEventListener('submit', async(event) => {
        event.preventDefault();
        const $role = $inputGroupRoles.options[$inputGroupRoles.selectedIndex].value;
        const toastElList = [].slice.call(document.querySelectorAll('.toast'))
        const toastList = toastElList.map(function (toastEl) {
          return new bootstrap.Toast(toastEl, 5000)
        });

        ($FirstName.value == '') ? $divAlert.innerHTML = message('nombre') : $divAlert.innerHTML = '';
        ($Email.value == '') ? $divAlertEmail.innerHTML = message('email') : $divAlertEmail.innerHTML = '';
        ($role == '') ? $alertRole.innerHTML = message('role') : $alertRole.innerHTML = '';
        ($password.value == '') ? $alertPassword.innerHTML = message('contraseña') : $alertPassword.innerHTML = '';

        const user = {
            name : $FirstName.value,
            lastName : $LastName.value,
            email : $Email.value,
            role : $role,
            password : $password.value
        }
        console.log(user);
        postData('/users', user)
          .then( response =>{
            toastList[0].show();
            defaultValue();

          })
          .catch( error => {
            toastList[1].show();
          });
 
    });

});
