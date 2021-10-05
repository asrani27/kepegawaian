@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endpush
@section('title')
Beranda
@endsection
@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Pegawai</span>
          <span class="info-box-number">5.430</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            Total Data Pegawai
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box bg-gradient-success">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">PNS</span>
          <span class="info-box-number">410</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            Total Data PNS
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box bg-gradient-warning">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">CPNS</span>
          <span class="info-box-number">10</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            Total Data CPNS
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box bg-gradient-danger">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pensiun</span>
          <span class="info-box-number">30</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            Total Data Pensiun
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-secondary">
          <h3 class="card-title">Daftar Pengajuan Pegawai</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover table-sm table-striped">
              <thead>
                  <th>No</th>
                  <th>Tgl</th>
                  <th>NIP/Nama</th>
                  <th>Nama Layanan</th>
                  <th>File Persyaratan</th>
                  <th>Status</th>
              </thead>
              <tbody>
                @foreach ($pengajuan as $key => $item)
                    
                <tr>
                    <td>{{$pengajuan->firstItem() + $key}}</td>
                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</td>
                    <td>{{$item->pegawai->nip}} <br/>{{$item->pegawai->nama}}</td>
                    <td>{{$item->layanan->nama}}</td>
                    <td>
                      <ul>
                        @foreach (listSyarat($item->persyaratan_id) as $file)
                            <li><a href="/storage/{{$item->pegawai->nip}}/{{$file->file}}" target="_blank">{{$file->persyaratan->nama}}</a></li>
                        @endforeach
                      </ul>
                    </td>
                    <td>
                      @if ($item->status == 0)
                          <span class="badge badge-success">Di Proses</span>
                      @else
                          <span class="badge badge-primary">Selesai</span>
                      @endif
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
</div>
@endsection

@push('js')

@endpush