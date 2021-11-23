@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('title')
    AJUKAN PENSIUN
@endsection
@section('content')
<a href="/admin/pensiun" class="btn btn-sm bg-gradient-purple"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a><br/><br/>
<div class="row">
    <div class="col-12">
        <form method="post" action="/admin/pensiun/create">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$pegawai->nip}}" readonly>
                            </div>
                            </div>
                            
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NAMA</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$pegawai->nama}}" readonly>
                            </div>
                            </div>
                            
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">PANGKAT/GOLONGAN</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$pegawai->nm_pangkat}}" readonly>
                            </div>
                            </div>
                            
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">JENIS PENSIUN</label>
                            <div class="col-sm-10">
                                @if ($pensiun->jenis == 1)
                                    <input type="text" class="form-control" value="APS" readonly>
                                @elseif ($pensiun->jenis == 2)
                                    <input type="text" class="form-control" value="BUP" readonly>
                                @elseif ($pensiun->jenis == 3)
                                    <input type="text" class="form-control" value="UZUR/SAKIT" readonly>
                                @elseif ($pensiun->jenis == 4)
                                    <input type="text" class="form-control" value="JANDA/DUDA/YATIM" readonly>
                                    
                                @endif
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-sm table-bordered">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>PERSAYARATAN SOFTCOPY</th>
                    <th>PENAMAAN FILE</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>1</td>
                        <td>Surat Keputusan CPNS</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->skcp}}" target="_blank">{{$pensiun->skcp}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SKCP" data-field="skcp">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>2</td>
                        <td>Surat Keputusan Kenaikan Pangkat Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->skkp}}" target="_blank">{{$pensiun->skkp}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SKKP" data-field="skkp">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>3</td>
                        <td>SKP 1 Tahun Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->skp1thn}}" target="_blank">{{$pensiun->skp1thn}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SKP1THN" data-field="skp1thn">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>4</td>
                        <td>Surat pernyataan tidak pernah di jatuhi hukuman Disiplin Tingkat Sedang/ Berat</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->superhd}}" target="_blank">{{$pensiun->superhd}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SUPERHD" data-field="superhd">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>5</td>
                        <td>Surat pernyataan tidak sedang menjalani proses pidana / pernah di pidana</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->superpdna}}" target="_blank">{{$pensiun->superpdna}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SUPERPDNA" data-field="superpdna">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>6</td>
                        <td>Surat Permohonan Berhenti atas Permintaan Sendiri sebagai PNS</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->sphentiaps}}" target="_blank">{{$pensiun->sphentiaps}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SPHENTIAPS" data-field="sphentiaps">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>7</td>
                        <td>Surat Usul Pemberhentian Atas Permintaan Sendiri sebagai PNS dari Kepala SKPD</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->apsppk}}" target="_blank">{{$pensiun->apsppk}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="APSPPK" data-field="apsppk">Upload</button>
                        </td>  
                    </tr>
                </tbody>
                </table>
                
            </div>
        </div>
        <a href="/admin/pensiun/{{$id}}/kirim" class="btn btn-sm btn-block btn-danger" onclick="return confirm('Yakin Sudah Selesai Semua?')"> <i class="fas fa-paper-plane"></i> <strong>Validasi & Kirim Ke BKD</strong></a><br/>
    </div>
</div>

<div class="modal fade" id="modal-upload" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="/admin/pensiun/{{$id}}" enctype="multipart/form-data">
            @csrf
        <div class="modal-header bg-gradient-success" style="padding:10px">
            <h4 class="modal-title text-sm">Upload File</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
  
        <div class="modal-body">
            <input type="file" class="form-control"  name="file" required>
            <input type="hidden" id="field" name="field">
            <input type="hidden" id="penamaan" name="penamaan">
        </div>
        
        <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-block btn-success"><i class="fas fa-paper-plane"></i> Upload</button>
        </div>
        </form>
        </div>
    </div>
  </div>
@endsection

@push('js')

<!-- Select2 -->
<script src="/theme/plugins/select2/js/select2.full.min.js"></script>

<script>
    $(document).on('click', '.upload', function() {
       $('#field').val($(this).data('field'));
       $('#penamaan').val($(this).data('penamaan'));
       $("#modal-upload").modal();
    });
  </script>
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