
        <div class="modal fade" id="ModalMensaje" tabindex="-1" role="dialog" aria-labelledby="MensajeTitulo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header p-0">
                        <img src="{{ asset('img/cabecera_correo.png') }}" width="100%" class="modal_error_error">
                        <button type="button" class="close modal_error_close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ $mensajeModal }}
                    </div>
                    <div class="modal-footer py-1">
                        <button type="button" class="btn bg-principal text-white" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
