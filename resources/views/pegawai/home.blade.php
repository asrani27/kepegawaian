@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    BERANDA
@endsection
@section('content')
<div class="row">
    <div class="col-lg-9 col-md-6">
      <div class="card">
        <div class="card-header bg-gradient-secondary">
          <h3 class="card-title">Riwayat Pengajuan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover table-sm table-striped">
              <thead>
                  <th>No</th>
                  <th>NIP/Nama</th>
                  <th>Layanan</th>
                  <th>Tanggal Di Buat</th>
                  <th>Status</th>
                  <th></th>
              </thead>
              @php
                  $no=1;
              @endphp
              <tbody>
                @foreach ($pengajuan as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->pegawai->nip}} <br/>{{$item->pegawai->nama}}</td>
                    <td>{{$item->layanan->nama}}</td>
                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i')}}</td>
                    <td>{{$item->status == 0 ? 'di proses':'selesai'}}</td>
                    <td>
                      <a href="/pegawai/home/{{$item->id}}/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin Di Hapus?');"> <i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    @include('pegawai.layanan.menu')
</div>
@endsection

@push('js')

@endpush