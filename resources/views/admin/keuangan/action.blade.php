<form action="{{  route('keuangan.update', $item->id) }}" method="POST">
  @csrf
  @method('PUT')
  <button id="updateButton" type="submit" class="btn btn-sm {{ $item->status == 'active' ? 'btn-warning' : 'btn-success' }} data-name="{{ $item->id }}">
      <span class="fas {{ $item->status == 'active' ? 'fa-undo' : 'fa-calendar-check' }} mr-2"></span> {{ $item->status == 'active' ? 'Urungkan' : 'Bayar' }}</a>
  </button>
</form>