window.addEventListener("DOMContentLoaded", (event) => {
    async function postData(url = "", data = {}) {
        const response = await fetch(url, {
            method: "POST", // *GET, POST, PUT, DELETE, etc.
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: JSON.stringify(data), // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }

    ///crear cuestionario
    const $formCreateCuestionario = document.getElementById(
        "form_create_cuestionario"
    );
    const $guiaCuestionario = document.getElementById("guiaCuestionario");
    const $alertGuia = document.getElementById("alert_guia");

    const message = (campo) => {
        return `
        <div class="alert alert-warning d-flex align-items-center" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
          <div>
            ¡El campo ${campo} es obligatorio!
          </div>
        </div>
      `;
    };

    $formCreateCuestionario.addEventListener("submit", async (event) => {
        event.preventDefault();
        const guia_id =
            $guiaCuestionario.options[$guiaCuestionario.selectedIndex].value;

        const toastElList = document.getElementById("liveToastCreate");
        const toastList = new bootstrap.Toast(toastElList, 5000);

        const toastError = document.getElementById("liveToastError");
        const toastErrorShow = new bootstrap.Toast(toastError, 5000);

        guia_id == ""
            ? ($alertGuia.innerHTML = message("guia"))
            : ($alertGuia.innerHTML = "");

        const cuestionario = {
            guia_id: guia_id,
        };

        postData("/cuestionarios/create", cuestionario)
            .then((response) => {
                $("#crearCuestionario").modal("hide");
                toastList.show();
                setTimeout(() => {
                    location.reload();
                }, 3000);
            })
            .catch((error) => {
                toastErrorShow.show();
            });
    });
});
