<!-- Modal -->
<div class="modal fade" id="modal_check_cita" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar cita</h5>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <input type="text" name="id" value="<?php echo''; ?>">
          <h5 class="text-info"><?php echo ''?>: <small><?php echo ''; ?></small>
          </h5>
          <div class="form group pt-2">
            <label for="resultados" class="form-label mt-4">Resultados:</label>
            <textarea class="form-control" id="resultados" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="anexo" class=" text-dark font-weight-bold">Anexo: (foto o video)</label>
            <input type="file" class="form-control" name="anexo" id="anexo">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        <button type="button" class="btn btn-danger">Guardar</button>
      </div>
    </div>
  </div>
</div>