@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    TAMBAH PEGAWAI
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            
            <div class="card-body table-responsive p-0">
                <form class="form-horizontal" method="GET" action="/superadmin/pegawai/checktobkd">
                    @csrf
                    <div class="card-body">

                    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <span class="badge badge-warning">Informasi : Masukkan NIP, klik check to server BKD, jika data di temukan akan tampil di bawah, kemudian simpan data tersebut</span>
                    </div>
                    </div>
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">MASUKKAN NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nip" value="{{ old('nip') }}" placeholder="NIP" required>
                        </div>
                        </div>

                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-info btn-block">Check To Server BKD</button>
                        </div>
                        </div>
                    </div>
                <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-12">
        <form method="post" action="/superadmin/pegawai">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data['nip'] }}" name="nip" readonly>
                            </div>
                            </div>

                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data['nm_lengkap'] }}" name="nama" required readonly>
                            </div>
                            </div>
                            
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Unit Kerja</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data['nm_unitkerja'] }}" name="unit_kerja" required readonly>
                            </div>
                            </div>

                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status Kepegawai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data['status_pns'] }}" name="status_pegawai" required readonly>
                            </div>
                            </div>

                            <input type="hidden" class="form-control" value="1" name="status_aktif" required readonly>
                            <input type="hidden" class="form-control" value="{{ $data['nm_pangkat'] }}" name="nm_pangkat" required readonly>
                            <input type="hidden" class="form-control" value="{{ $data['gol_pangkat'] }}" name="gol_pangkat" required readonly>
                            <input type="hidden" class="form-control" value="{{ $data['nm_skpd'] }}" name="skpd" required readonly>
                            <input type="hidden" class="form-control" value="{{ $data['ket_jabatan'] }}" name="ket_jabatan" required readonly>
                            <input type="hidden" class="form-control" value="{{ $data['nm_pangkat'] }}" name="nm_pangkat" required readonly>
                            <input type="hidden" class="form-control" value="{{ $data['tmt_pangkat'] }}" name="tmt_pangkat" required readonly>
                            {{-- <input type="hidden" class="form-control" value="{{ $data['tmt_eselon'] }}" name="tmt_eselon" required readonly> --}}

                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-block btn-primary"><strong>SIMPAN</strong></button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')

@endpush