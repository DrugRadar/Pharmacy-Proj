<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Delete {{$role}}</h5>
                <button type=" button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-title">Are you sure you want to Delete this record?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">CANCEL</button>

                <form method="POST" id="form_id">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="deleteBtn btn btn-danger m-0">DELETE</button>
                </form>

            </div>
        </div>
    </div>
</div>