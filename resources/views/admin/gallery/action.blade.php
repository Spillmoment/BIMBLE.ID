<div class="btn-group">
  <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">
      <span class="icon icon-sm">
          <span class="fas fa-ellipsis-h icon-dark"></span>
      </span>
      <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu">
      <a class="dropdown-item" href="{{ route('gallery.edit', $item->id) }}"><span
              class="fas fa-edit mr-2"></span>Sunting</a>
      <form action="{{ route('gallery.destroy', $item->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button id="deleteButton" type="submit" class="dropdown-item text-danger delete-confirm"
              data-name="{{ $item->kursus->nama_kursus }}">
              <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
          </button>
      </form>
  </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $('.delete-confirm').on('click', function (event) {
      var name = $(this).data('name');
      event.preventDefault();
      swal({
          title: 'Apakah Anda Yakin?',
          text: "Menghapus Galeri Kursus  " + name,
          icon: 'warning',
          buttons: ["Cancel", "Yes!"],
      }).then((willDelete) => {
          if (willDelete) {
              $(this).closest("form").submit();
          }
      });
  });

</script>
