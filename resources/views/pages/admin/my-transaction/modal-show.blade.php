<!-- Basic Modal -->
<div class="modal fade" id="showModalMyTransaction{{ $row->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="">Account</label>
                <input type="text" value="{{ Auth::user()->name }}" class="form-control" disabled>

                <label for="">Rechiver</label>
                <input type="text" value="{{ $row->name }}" class="form-control" disabled>

                <label for="">Email</label>
                <input type="tag" value="{{ $row->email }}" class="form-control" disabled>

                <label for="">Address</label>
                <input type="tag" value="{{ $row->address }}" class="form-control" disabled>

                <label for="">Phone</label>
                <input type="tag" value="{{ $row->phone }}" class="form-control" disabled>

                <label for="">Courier</label>
                <input type="tag" value="{{ $row->courier }}" class="form-control" disabled>

                <label for="">Payment</label>
                <input type="tag" value="{{ $row->payment }}" class="form-control" disabled>

                <label for="">Payment URL</label>
                <a href="{{ $row->payment_url }}" class="form-control">{{ $row->payment_url }}</a>

                <label for="">Status</label>
                <input type="tag" value="{{ $row->status }}" class="form-control" disabled>

                <label for="">Total Price</label>
                <input type="tag" value="{{ $row->total_price }}" class="form-control" disabled>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Go back</button>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
