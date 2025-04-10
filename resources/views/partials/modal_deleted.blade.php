<form action="#" id="destroy_form" method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <div class="modal modal-danger fade" data-backdrop="static" tabindex="-1" id="destroy-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> ¿Estás seguro que quieres eliminar?</h4>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <i class="voyager-trash" style="color: red; font-size: 4em;"></i>
                        <br>
                        <p><b>¿Estás seguro que quieres eliminar?</b></p>
                    </div>
                    <div class="form-group">
                        <textarea name="deletedObservation" class="form-control" rows="4" placeholder="Describa el motivo de la eliminación..." required></textarea>
                    </div>
                    {{-- <label class="checkbox-inline"><input type="checkbox" value="1" required>Confirmar eliminacion..!</label> --}}
                {{-- </div>

                <div class="modal-footer"> --}}
                    <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, eliminar">
                    
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</form>