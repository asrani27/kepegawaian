@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endpush
@section('title')
Beranda
@endsection
@section('content')
<div class="row">
  <div class="col-md-4 col-sm-6 col-12">
    <div class="info-box bg-gradient-info">
      <span class="info-box-icon"><i class="fas fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Kenaikan Pangkat</span>
        <span class="info-box-number">{{$berkala}}</span>

        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
        <span class="progress-description">
          Total Data Pengajuan Kenaikan Pangkat
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-4 col-sm-6 col-12">
    <div class="info-box bg-gradient-success">
      <span class="info-box-icon"><i class="fas fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Kenaikan Diproses</span>
        <span class="info-box-number">{{$pangkat}}</span>

        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
        <span class="progress-description">
          Total Data Kenaikan Pangkat Diproses
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-4 col-sm-6 col-12">
    <div class="info-box bg-gradient-warning">
      <span class="info-box-icon"><i class="fas fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Kenaikan Selesai</span>
        <span class="info-box-number">0</span>

        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
        <span class="progress-description">
          Total Data kenaikan Pangkat Selesai
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar ASN yang mengajukan kenaikan pangkat</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-sm">
          <thead>
            <tr class="bg-gradient-primary">
              <th style="width: 10px">#</th>
              <th>Tanggal</th>
              <th>NIK/Nama</th>
              <th>Dokumen</th>
              <th>Di Proses Oleh</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key=> $item)
            <tr>
              <td>{{$key +1}}</td>
              <td>{{\CArbon\CArbon::parse($item->created_at)->format('d M Y')}}</td>
              <td>
                {{$item->pegawai->nama}} <br /> {{$item->pegawai->nip}}<br /> {{$item->pegawai->nm_pangkat}}
                {{$item->pegawai->gol_pangkat}}
              </td>
              <td>
                <a href="/kepangkatan/dokumen/{{$item->id}}" class="btn btn-xs btn-primary"><i class="fa fa-file"></i>
                  Dokumen Persyaratan</a>
              </td>
              <td>
                {{$item->nama_verifikator == null ? null : $item->nama_verifikator->name}}
              </td>
              <td>
                @if ($item->nama_verifikator == null)

                <a href="/kepangkatan/prosespengajuan/{{$item->id}}" onclick="return confirm('Yakin Ingin di proses?')"
                  class="btn btn-xs btn-success"><i class="fa fa-check"></i> PROSES</a>
                @endif
                <a href="/kepangkatan/deletepengajuan/{{$item->id}}" onclick="return confirm('Yakin Ingin Dihapus?')"
                  class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>
                  HAPUS</a>
              </td>
            </tr>
            @endforeach
            {{-- <tr>
              <td>1.</td>
              <td>Update software</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
              </td>
              <td><span class="badge bg-danger">55%</span></td>
            </tr> --}}

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')

@endpush