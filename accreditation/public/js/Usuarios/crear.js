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

    const defaultValue = (name, lastname, email) =>{
      name.value='';
      lastname.value='';
      email.value='';
    }
    
    $FormCreateUser.addEventListener('submit', async(event) => {
        event.preventDefault();
        const $role = $inputGroupRoles.options[$inputGroupRoles.selectedIndex].value;
        const toastElList = document.getElementById('liveToastCreate');
        const toastList = new bootstrap.Toast(toastElList, 5000);

        const toastError = document.getElementById('liveToastError');
        const toastErrorShow = new bootstrap.Toast(toastError, 5000);

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
        
        postData('/users/create/user', user)
          .then( response =>{
            $('#crearUsuario').modal('hide');
            toastList.show();
            setTimeout( () =>{
              location.reload()
            }, 3000)

          })
          .catch( error => {
            toastErrorShow.show();
          });
 
    });

    const getUser = async( idUser) => {
      const response = await postData('/users/get/user', {idUser});
      const { message , user} = response;
      return user;
    }

    const getRoles = async() => {
      const response = await postData('/roles/get', {});
      const { message , roles} = response;
      return roles;
    }
    
    ///function to edit user///
    const $FirstNameEdit = document.getElementById('FirstNameEdit');
    const $LastNameEdit = document.getElementById('LastNameEdit');
    const $email_edit = document.getElementById('email_edit');
    const $rolesEdit = document.getElementById('rolesEdit');
    const $userId = document.getElementById('user_id');
    const $form_create_user_edit = document.getElementById('form_create_user_edit');
    const $btn_close_edit = document.getElementById('btn_close_edit');
    const $alertNamEdit = document.getElementById('alert_name_edit');
    const $alertEmailEdit = document.getElementById('alert_email_edit');
    const $alertRolEdit = document.getElementById('alert_role_edit');


    const addOptionSelectedRole = async(select, IdRole) => {
        const roles = await getRoles();
        roles.forEach(element => {
          let option = document.createElement('option');
          if(element.id === IdRole){
            option.value = element.id;
            option.innerHTML = `${element.name}`;
            option.setAttribute("selected", "");
            select.appendChild(option);
          }else{
            option.value = element.id;
            option.innerHTML = `${element.name}`;
            select.appendChild(option);
          }
        });
    }
    $btn_close_edit.addEventListener('click', async() => {
      defaultValue($FirstNameEdit, $LastNameEdit, $email_edit);
    });

    editaUsuario = async(idUser) =>{
      const user = await getUser(idUser);
      console.log(user);
      $userId.value = user.id;
      $FirstNameEdit.value = user.first_name;
      $LastNameEdit.value = user.last_name;
      $email_edit.value = user.email;
      addOptionSelectedRole($rolesEdit, user.role_id);
    }

    $form_create_user_edit.addEventListener('submit', async(event) =>{
      event.preventDefault();
      const $role = $rolesEdit.options[$rolesEdit.selectedIndex].value;
      const toastElList = document.getElementById('liveToastEdit')
      const toastList = new bootstrap.Toast(toastElList, 5000);
      const toastError = document.getElementById('liveToastError');
      const toastErrorShow = new bootstrap.Toast(toastError, 5000);


      ($FirstNameEdit.value == '') ? $alertNamEdit.innerHTML = message('nombre') : $alertNamEdit.innerHTML = '';
      ($email_edit.value == '') ? $alertEmailEdit.innerHTML = message('email') : $alertEmailEdit.innerHTML = '';
      ($role == '') ? $alertRolEdit.innerHTML = message('role') : $alertRolEdit.innerHTML = '';

      const user = {
        id : $userId.value,
        name : $FirstNameEdit.value,
        lastName : $LastNameEdit.value,
        email : $email_edit.value,
        role : $role,
        password : $password.value
      }

      postData('/users/update/user', user)
          .then( response =>{
            $('#editarUsuario').modal('hide');
            toastList.show();
            setTimeout( () =>{
              location.reload()
            }, 3000)

          })
          .catch( error => {
            toastErrorShow.show();
          });

    });

    //function to delete User//
    const $user_delete = document.getElementById('user_delete');
    const $phrase = document.getElementById('phrase');
    const $btn_close_delete = document.getElementById('btn_close_delete');
    const $form_delete_user = document.getElementById('form_delete_user');

    eliminarUsuario = async(idUser) => {
      const user = await getUser(idUser);
      $user_delete.value = user.id;
      $phrase.innerText = `¿Desea eliminar el usuario ${user.first_name}?`
    }

    $btn_close_delete.addEventListener('click', () =>{
      $phrase.innerText = ``;
    });

    $form_delete_user.addEventListener('submit', async(event) => {
      event.preventDefault();

      const toastDelete = document.getElementById('toastDelete')
      const toastDeleteShow = new bootstrap.Toast(toastDelete, 5000);
      const toastError = document.getElementById('liveToastError');
      const toastErrorShow = new bootstrap.Toast(toastError, 5000);
      const user = {
        id : $user_delete.value,
      }

      postData('/users/delete/user', user)
          .then( response =>{
            $('#eliminarUsuario').modal('hide');
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


