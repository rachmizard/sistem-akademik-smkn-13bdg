
<!-- modal edit kelas -->
@foreach($kelas as $in)
    <div class="modal fade" id="delete{{ $in->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Konfirmasi
                </div>
                <div class="modal-body">
                <div class="panel-body">
                    Anda yakin ingin menghapusnya?
                </div>
                <div class="modal-footer">
                    <a href="/kelas/delete/{{$in->id}}" class="btn btn-danger">Ya</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>
                </div>
            </div>
        </div>
    </div>
<!-- end modal edit kelas -->    

@endforeach
