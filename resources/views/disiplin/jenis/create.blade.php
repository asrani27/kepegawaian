@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('title')
Beranda
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">TAMBAH DATA JENIS</h3>
                <div class="card-tools">
                    <a href="/disiplin/jenis" class="btn btn-xs btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Kembali</a>

                </div>
            </div>
            <!-- /.card-header -->
            <form method="post" action="/disiplin/jenis/add">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>NAMA JENIS</label>
                        <input type="text" class="form-control" name="nama" value="{{old('nama')}}"
                            placeholder="nama jenjab" required>
                    </div>

                    <div class="form-group">
                        <label>KATEGORI</label>
                        <select class="form-control select2" name="m_kategori_disiplin_id" style="width: 100%;"
                            required>
                            <option value="">-pilih-</option>
                            @foreach ($kategori as $item)
                            <option value="{{$item->id}}" {{old('m_kategori_disiplin_id')==$item->id ?
                                'selected':''}}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> SIMPAN</button>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>

@endsection

@push('js')
<script src="/theme/plugins/select2/js/select2.full.min.js"></script>

<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
})
</script>
@endpush