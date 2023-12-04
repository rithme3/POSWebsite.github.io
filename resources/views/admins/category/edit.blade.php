
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formSubmit" class="modal-content" onsubmit="saveData(event)">
        @csrf
      <input type="hidden" name="id" id="e_id">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Category Name:</label>
            <input type="text" name="category" id="e_category" class="form-control" required>
        </div>
        <div class="form-group">
            <label>File <span class="text-danger">*</span></label>
            <input type="file" name="files" id="files" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btn_edit" class="btn btn-primary">Save Change</button>
      </div>
    </form>
  </div>
</div>
