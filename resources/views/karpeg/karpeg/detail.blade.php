@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('title')
    DATA PENGAJUAN KARPEG
@endsection
@section('content')
<a href="/karpeg/karpeg" class="btn btn-sm bg-gradient-purple"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a><br/><br/>
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
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karpeg/{{$karpeg->id}}/{{$karpeg->spi}}" target="_blank">{{$karpeg->spi}}</a></strong></td>  
                        
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>2</td>
                        <td>FC SK CPNS Dilegalisir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karpeg/{{$karpeg->id}}/{{$karpeg->sk_cpns}}" target="_blank">{{$karpeg->sk_cpns}}</a></strong></td>  
                       
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>3</td>
                        <td>FC SK PNS dilegalisir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karpeg/{{$karpeg->id}}/{{$karpeg->sk_pns}}" target="_blank">{{$karpeg->sk_pns}}</a></strong></td>  
                       
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>4</td>
                        <td>FC Surat Tanda Tamat Pendidikan Dan Pelatihan Prajabatan (STTPL) dilegalisir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karpeg/{{$karpeg->id}}/{{$karpeg->sttpl}}" target="_blank">{{$karpeg->sttpl}}</a></strong></td>  
                       
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>5</td>
                        <td> FC Surat perintah melaksanakan tugas (SPMT) dilegalisir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karpeg/{{$karpeg->id}}/{{$karpeg->spmt}}" target="_blank">{{$karpeg->spmt}}</a></strong></td>  
                        
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>6</td>
                        <td>Surat Keterangan Kehilangan dari kepolisian jika Karpeg Hilang</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/karpeg/{{$karpeg->id}}/{{$karpeg->skh}}" target="_blank">{{$karpeg->skh}}</a></strong></td>  
                        
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