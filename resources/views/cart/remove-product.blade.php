<!--removeProductFromCart Modal-->
<div class="modal fade" id="removeProductFromCartModal" tabindex="-1" role="dialog" aria-labelledby="removeProductFromCartModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeProductFromCartModalLabel">Remove Product from cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="removeProductFromCartProductForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <h5 class="text-danger" >Are you sure, you want to remove product?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-danger">Remove Product </button>
                </div>
            </form>
        </div>
    </div>
</div>
