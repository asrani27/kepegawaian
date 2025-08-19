@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
BIODATA PEGAWAI
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <tr>
            <td>
                <a href="/pegawai/home" class="btn bg-xs bg-gradient-danger"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </td>
        </tr>
    </div>
</div>
<br />
<div class="row">
    <div class="col-lg-5 col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <table style="font-size:14px">
                    <tr>
                        <td>No. Permohonan</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td>Tgl Permohonan</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td>Permohonan</td>
                        <td>: {{$data->layanan->nama}}</td>
                    </tr>
                    <tr>
                        <td>No. HP/WA Aktif</td>
                        <td>:</td>
                    </tr>
                </table>
                <hr height="2px" style="color: black">
                <table style="font-size:14px">
                    <tr>
                        <td>NIP</td>
                        <td>: {{$data->pegawai->nip}}</td>
                    </tr>
                    <tr>
                        <td>Nama Pegawai</td>
                        <td>: {{$data->pegawai->nama}}</td>
                    </tr>
                    <tr>
                        <td>Pangkat / Gol</td>
                        <td>: {{$data->pegawai->nm_pangkat}} {{$data->pegawai->gol_pangkat}}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>: {{$data->pegawai->ket_jabatan}}</td>
                    </tr>
                    <tr>
                        <td>SKPD</td>
                        <td>: {{$data->pegawai->skpd}}</td>
                    </tr>
                    <tr>
                        <td>UNIT KERJA</td>
                        <td>: {{$data->pegawai->skpd}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr style="background-color: rgb(216, 216, 214)">
                            <th style="width: 10px; border:1px solid black">No Urut</th>
                            <th style="width: 30%;border:1px solid black">Persyaratan Dokumen</th>
                            <th style="width: 15%;border:1px solid black">File</th>
                            <th style="border:1px solid black">Preview</th>
                            <th style="border:1px solid black;">Keterangan</th>
                            <th style="width: 10%;border:1px solid black">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (dokumen($layanan_id, $data->jenis) as $key=> $item)

                        <tr>
                            <td style="border:1px solid black;">{{$item->no_urut}}</td>
                            <td style="border:1px solid black;">{{$item->nama}} {{$item->wajib == null ? null :
                                '('.$item->wajib.')'}}</td>
                            <td style="border:1px solid black;">PDF 1 MB</td>
                            <td style="border:1px solid black;">
                                @php
                                $dokumen = checkFile($id, $data->pegawai->id, $item->id);
                                @endphp
                                @if ($dokumen)
                                <a class="btn btn-xs btn-success" target="_blank"
                                    href="/storage/{{$data->jenis}}/{{$data->pegawai->nip}}/pengajuan{{$id}}/{{$dokumen->file}}">
                                    preview
                                </a>
                                @else - @endif

                            </td>
                            <td style="border:1px solid black;">
                                @if ($dokumen != null)
                                @if ($dokumen->verifikasi == 1)
                                <span class="badge badge-success"><i class="fa fa-check"></i></span>
                                @endif @if ($dokumen->verifikasi == 2)
                                <span class="badge badge-danger"><i class="fa fa-times"></i></span> -
                                {{$dokumen->keterangan}}
                                @endif
                                @endif
                            </td>
                            <td style="border:1px solid black;">

                                @if ($data->status != 2)

                                @if ($dokumen->verifikasi == 2)
                                <button class="btn btn-secondary btn-xs upload-perbaikan" data-id="{{$item->id}}"
                                    data-nama="{{$item->nama}}">Upload </button>
                                @else
                                <button class="btn btn-secondary btn-xs upload-dokumen" data-id="{{$item->id}}"
                                    data-nama="{{$item->nama}}">upload </button>
                                @endif

                                |
                                <a href="/pegawai/home/{{$id}}/deletedokumen/{{$item->id}}"
                                    onclick="return confirm('Yakin Ingin Dihapus?')" class="btn btn-danger btn-xs">hapus
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br />
                @if ($data->status != 2)
                <a href="/pegawai/home/{{$id}}/dokumen/kirim" class="btn btn-md btn-outline-primary btn-block"
                    onclick="return confirm('Yakin Siap untuk di kirim?');"><i class="fa fa-paper-plane"></i> Kirim
                    Pengajuan</a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-upload" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/pegawai/home/{{$id}}/dokumen" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-secondary" style="padding:10px">
                    <h4 class="modal-title text-sm">Upload <span id="nama-upload"></span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Max 1 MB</p>
                    <input type="hidden" id="persyaratan_id" name="persyaratan_id">
                    <input type="file" name="file" accept="application/pdf" required>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-image"></i> Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-perbaikan" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/pegawai/home/{{$id}}/perbaikan" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-secondary" style="padding:10px">
                    <h4 class="modal-title text-sm">Upload Perbaikan <span id="nama-perbaikan"></span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Max 1 MB</p>
                    <input type="hidden" id="perbaikan_id" name="perbaikan_id">
                    <input type="file" name="file" accept="application/pdf" required>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-image"></i> Upload
                        Perbaikan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).on('click', '.upload-dokumen', function() {
   $('#perbaikan_id').val($(this).data('id'));

    $('#nama-upload').text($(this).data('nama'));
   $("#modal-upload").modal();
});
</script>
<script>
    $(document).on('click', '.upload-perbaikan', function() {
        console.log('d');
   $('#perbaikan_id').val($(this).data('id'));

    $('#nama-perbaikan').text($(this).data('nama'));
   $("#modal-perbaikan").modal();
});
</script>
@endpush