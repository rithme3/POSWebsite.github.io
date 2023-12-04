
<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formSubmit" class="modal-content">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Create new Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Category Name:</label>
            <input type="text" name="category" id="category" class="form-control" required>
        </div>
        <div class="form-group">
            <label>File <span class="text-danger">*</span></label>
            <input type="file" name="files" id="files" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btn_save" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
