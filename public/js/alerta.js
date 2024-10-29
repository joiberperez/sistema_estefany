function alerta(tipo,mensaje) {
    let titulo = "";
    if(tipo=="error"){  
      tipo = "danger"
    }
    if(tipo==="danger"){
        titulo = "Algo ha salido mal!";
    }else{
        titulo = "Funciono!";

    }
  // HTML de la alerta
  const toastHTML = `
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-${tipo} top-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">${titulo}</div>
        
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        ${mensaje}
      </div>
    </div>`;

  // Agregar la toast al contenedor
  $('.toast-container').append(toastHTML);

  // Activar el toast con Bootstrap JS
  $('.toast').toast('show');

  // Opcional: Eliminar la toast después de que se oculta
  $('.toast').on('hidden.bs.toast', function () {
    $(this).remove();
  });
}
