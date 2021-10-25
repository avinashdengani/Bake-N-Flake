<div class="modal fade" id="quantityModalForm" tabindex="-1" role="dialog" aria-labelledby="quantityModalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quantityModalFormLabel">Edit Quantity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="quantityForm">
            @csrf
            @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <input type="number"
                                class="form-control"
                                name="quantity"
                                placeholder="Enter Quantity"
                                id="quantity"
                                value="{{ old('quantity') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
