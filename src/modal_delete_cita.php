<!-- Modal -->
<div class="modal fade" id="modal_delete_cita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar cita</h5>
      </div>
      <div class="modal-body">
        <h5 class="text-info">Control prenatal: <small>30/08/2024</small></h5>
        <p>Estas segur@ que quieres eliminar esta cita?</p>
      </div>
      <div class="modal-footer">
        <form action="eliminar_cita.php" method="post">
          <input type="text" name="id" value="<?php echo $data_citas["id_cita"]; ?>">
          <input type="hidden" name="id" value="">
          <div class="form group pt-2 text-center">
            <button type="submit" class="btn btn-success">SI</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>