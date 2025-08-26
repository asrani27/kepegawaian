@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="/theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('title')
Beranda
@endsection
@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6 col-12">
        <a href="/slks/baru">
            <div class="info-box bg-gradient-info">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">SLKS</span>
                    <span class="info-box-number">{{$slks}}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        Total Data Pengajuan SLKS Baru
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">
        <a href="/slks/diproses">
            <div class="info-box bg-gradient-success">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">SLKS Diproses</span>
                    <span class="info-box-number">{{$diproses}}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        Total Data SLKS Diproses
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">

        <a href="/slks/selesai">
            <div class="info-box bg-gradient-warning">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">SLKS Memenuhi Syarat</span>
                    <span class="info-box-number">{{$selesai}}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        Total Data SLKS Memenuhi Syarat
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>
    <!-- /.col -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar ASN yang mengajukan kenaikan pangkat</h3>
                <div class="card-tools">
                    <a href="/slks/download" class="btn btn-xs btn-primary" target="_blank">
                        <i class="fas fa-download"></i> Download</a>
                    <a href="/slks/export" class="btn btn-xs btn-danger" target="_blank">
                        <i class="fas fa-file"></i> Export</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-sm" id="example1">
                    <thead>
                        <tr class="bg-gradient-primary">
                            <th style="width: 10px">#</th>
                            <th>Tanggal</th>
                            <th>NIK/Nama</th>
                            <th>Golongan</th>
                            <th>Dokumen</th>
                            <th>Keterangan</th>
                            <th>Di Proses Oleh</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $key=> $item)
                        <tr>
                            <td>{{$key +1}}</td>
                            <td>{{\CArbon\CArbon::parse($item->created_at)->format('d M Y')}}</td>
                            <td>
                                {{$item->pegawai->nama}} <br /> {{$item->pegawai->nip}}<br />
                                {{$item->pegawai->nm_pangkat}}

                            </td>
                            <td> {{$item->pegawai->gol_pangkat}}</td>
                            <td>
                                <a href="/slks/dokumen/{{$item->id}}" class="btn btn-xs btn-primary"><i
                                        class="fa fa-file"></i>
                                    Dokumen Persyaratan</a>
                            </td>
                            <td>
                                @if ($item->upload->where('verifikasi', 2)->count() != 0)
                                <span class="text-danger"> {{$item->upload->where('verifikasi', 2)->count()}} <i
                                        class="fa fa-times"></i></span> Perlu Perbaikan <br />
                                @endif
                                @if ($item->upload->where('perbaikan', 1)->count() != 0)
                                <span class="text-success">{{$item->upload->where('perbaikan', 1)->count()}}<i
                                        class="fa fa-check"></i></span> Telah Diperbaiki <br />
                                @endif
                            </td>
                            <td>
                                {{$item->nama_verifikator == null ? null : $item->nama_verifikator->name}}
                            </td>
                            <td>
                                @if ($item->status == 1 && $item->verifikator != null)
                                <span class="badge badge-warning"> DIPROSES</span>
                                @endif
                                @if ($item->status == 2)
                                <span class="badge badge-success"> SELESAI</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->nama_verifikator == null)

                                <a href="/slks/prosespengajuan/{{$item->id}}"
                                    onclick="return confirm('Yakin Ingin di proses?')" class="btn btn-xs btn-success"><i
                                        class="fa fa-recycle"></i> PROSES</a>
                                @endif
                                <a href="/slks/deletepengajuan/{{$item->id}}"
                                    onclick="return confirm('Yakin Ingin Dihapus?')" class="btn btn-xs btn-danger"><i
                                        class="fa fa-trash"></i>
                                    HAPUS</a>
                                @if ($item->nama_verifikator != null)
                                <a href="/slks/selesaipengajuan/{{$item->id}}"
                                    onclick="return confirm('Yakin sudah selesai?')" class="btn btn-xs btn-success"><i
                                        class="fa fa-check"></i>
                                    SELESAI</a>
                                @endif
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

<!-- DataTables -->
<script src="/theme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush