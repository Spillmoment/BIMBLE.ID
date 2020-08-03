
      <form action="/tutor/nilai/{{ $nilai->id }}/edit" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="id" value="{{ $nilai->id }}">
        <div class="form-group">
          <label for="nilai">Nilai</label>
          <input type="text" class="form-control {{ $errors->first('nilai') ? 'is-invalid' : '' }}" name="nilai" id="nilai" value="{{ old('nilai', $nilai->nilai) }}">
          <div class="invalid-feedback">
            {{ $errors->first('nilai') }}
          </div>
        </div>
       <div class="form-group">
         <label for="keterangan">Keterangan</label>
         <input type="text" class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan" value="{{ old('keterangan', $nilai->keterangan) }}">
         <div class="invalid-feedback">
          {{ $errors->first('keterangan') }}
        </div>
        </div>
        
            <button type="submit" class="btn btn-primary btn-block">Edit Nilai</button>
      </form>
    