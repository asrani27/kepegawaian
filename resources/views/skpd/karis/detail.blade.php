@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('title')
    AJUKAN KARIS
@endsection
@section('content')
<a href="/admin/karis" class="btn btn-sm bg-gradient-purple"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a><br/><br/>
<div class="row">
    <div class="col-12">
        <form method="post" action="/admin/karis/create">
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
                        <td>Surat Pengantar dari Instansi</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karis/{{$karis->id}}/{{$karis->spi}}" target="_blank">{{$karis->spi}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SPI" data-field="spi">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>2</td>
                        <td>Laporan Perkawinan Pertama/Kedua</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karis/{{$karis->id}}/{{$karis->lpk}}" target="_blank">{{$karis->lpk}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="LPK" data-field="lpk">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>3</td>
                        <td>Daftar Susunan Keluarga PNS</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karis/{{$karis->id}}/{{$karis->dskp}}" target="_blank">{{$karis->dskp}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="DSKP" data-field="dskp">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>4</td>
                        <td>FC SK CPNS dilegalisir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karis/{{$karis->id}}/{{$karis->sk_cpns}}" target="_blank">{{$karis->sk_cpns}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SKCPNS" data-field="sk_cpns">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>5</td>
                        <td>FC SK PNS dilegalisirr</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karis/{{$karis->id}}/{{$karis->sk_pns}}" target="_blank">{{$karis->sk_pns}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SKPNS" data-field="sk_pns">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>6</td>
                        <td>FC Karpeg dilegalisir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karis/{{$karis->id}}/{{$karis->karpeg}}" target="_blank">{{$karis->karpeg}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="KARPEG" data-field="karpeg">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>7</td>
                        <td>FC Akte Nikah dilegalisir di KUA setempat</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karis/{{$karis->id}}/{{$karis->akte_nikah}}" target="_blank">{{$karis->akte_nikah}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="AKTENIKAH" data-field="akte_nikah">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>8</td>
                        <td>FC Akte Cerai, apabila yang bersangkutan bercerai</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karis/{{$karis->id}}/{{$karis->akte_cerai}}" target="_blank">{{$karis->akte_cerai}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="AKTECERAI" data-field="akte_cerai">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>9</td>
                        <td>Surat Kematian, apabila cerai mati</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karis/{{$karis->id}}/{{$karis->sk_mati}}" target="_blank">{{$karis->sk_mati}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SKMATI" data-field="sk_mati">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>10</td>
                        <td>Surat keterangan kehilangan dari kepolisian, apabila karis/karis hilang</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karis/{{$karis->id}}/{{$karis->skh}}" target="_blank">{{$karis->skh}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-penamaan="SKH" data-field="skh">Upload</button>
                        </td>  
                    </tr>
                </tbody>
                </table>
                
            </div>
        </div>
        <a href="/admin/karis/{{$id}}/kirim" class="btn btn-sm btn-block btn-danger" onclick="return confirm('Yakin Sudah Selesai Semua?')"> <i class="fas fa-paper-plane"></i> <strong>Validasi & Kirim Ke BKD</strong></a><br/>
    </div>
</div>

<div class="modal fade" id="modal-upload" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="/admin/karis/{{$id}}" enctype="multipart/form-data">
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