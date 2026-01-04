<!-- Modal -->
<div class="modal fade" id="confirmationDelete-{{ $data->id }}" tabindex="-1" aria-labelledby="confirmationDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('produk.destroy', $data->id) }}" method="post" class="d-inline">
        @csrf
         <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="confirmationDeleteLabel">Konfirmasi Hapus</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin akan menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-success">Hapus</button>
            </div>
        </div>
    </form>
  </div>
</div>