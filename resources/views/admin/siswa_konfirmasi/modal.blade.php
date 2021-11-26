@isset($item->file)
<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-file"> <i class="fas fa-eye"></i> Detail
</button> <br>
@if (!is_null($item->invalid_message))
    <span class="text-warning">Bukti transfer masih dalam proses pembaharuan.</span>
@endif
<!-- Modal Content -->
<div class="modal fade" id="modal-file" tabindex="-1" role="dialog" aria-labelledby="modal-file" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Detail Bukti Upload </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('assets/images/bukti-siswa/'.$item->file) }}" width="600" height="450">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-danger ml-auto" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@else
N/A
@endisset
