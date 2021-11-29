@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('title')
    DATA PENGAJUAN KARSU
@endsection
@section('content')
<a href="/karpeg/karsu" class="btn btn-sm bg-gradient-purple"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a><br/><br/>
<div class="row">
    <div class="col-12">
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
                    </tr>
                </thead>
                <tbody>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>1</td>
                        <td>Surat Pengantar dari Instansi</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karsu/{{$karsu->id}}/{{$karsu->spi}}" target="_blank">{{$karsu->spi}}</a></strong></td>  
                        
                          
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>2</td>
                        <td>Laporan Perkawinan Pertama/Kedua</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karsu/{{$karsu->id}}/{{$karsu->lkp}}" target="_blank">{{$karsu->lkp}}</a></strong></td>  
                          
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>3</td>
                        <td>Daftar Susunan Keluarga PNS</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karsu/{{$karsu->id}}/{{$karsu->dskp}}" target="_blank">{{$karsu->dskp}}</a></strong></td>  
                         
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>4</td>
                        <td>FC SK CPNS dilegalisir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karsu/{{$karsu->id}}/{{$karsu->sk_cpns}}" target="_blank">{{$karsu->sk_cpns}}</a></strong></td>  
                         
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>5</td>
                        <td>FC SK PNS dilegalisirr</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karsu/{{$karsu->id}}/{{$karsu->sk_pns}}" target="_blank">{{$karsu->sk_pns}}</a></strong></td>  
                         
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>6</td>
                        <td>FC Karpeg dilegalisir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karsu/{{$karsu->id}}/{{$karsu->karpeg}}" target="_blank">{{$karsu->karpeg}}</a></strong></td>  
                          
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>7</td>
                        <td>FC Akte Nikah dilegalisir di KUA setempat</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karsu/{{$karsu->id}}/{{$karsu->akte_nikah}}" target="_blank">{{$karsu->akte_nikah}}</a></strong></td>  
                          
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>8</td>
                        <td>FC Akte Cerai, apabila yang bersangkutan bercerai</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karsu/{{$karsu->id}}/{{$karsu->akte_cerai}}" target="_blank">{{$karsu->akte_cerai}}</a></strong></td>  
                          
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>9</td>
                        <td>Surat Kematian, apabila cerai mati</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karsu/{{$karsu->id}}/{{$karsu->sk_mati}}" target="_blank">{{$karsu->sk_mati}}</a></strong></td>  
                          
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>10</td>
                        <td>Surat keterangan kehilangan dari kepolisian, apabila karsu/karis hilang</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karsu/{{$karsu->id}}/{{$karsu->skh}}" target="_blank">{{$karsu->skh}}</a></strong></td>  
                          
                    </tr>
                </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<!-- Select2 -->
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