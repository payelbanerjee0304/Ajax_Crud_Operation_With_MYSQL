<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
  <form action="" method="" id="updateproductform">
    @csrf

    <input type="hidden" name="uid" id="uid">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="errMsgContainer">

        </div>
        <div class="form-group">
          <label for="">Product Name</label>
          <input type="text" name="uname" id="uname" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Product Price</label>
          <input type="text" name="uprice" id="uprice" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_product">Update Details</button>
      </div>
    </div>
  </div>
  </form>
</div>
