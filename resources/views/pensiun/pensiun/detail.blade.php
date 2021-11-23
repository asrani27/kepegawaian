@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('title')
    PENSIUN
@endsection
@section('content')
<a href="/pensiun/pensiun" class="btn btn-sm bg-gradient-purple"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a><br/><br/>
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
                        <td>Surat Keputusan CPNS</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->skcp}}" target="_blank">{{$pensiun->skcp}}</a></strong></td>  
                         
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>2</td>
                        <td>Surat Keputusan Kenaikan Pangkat Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->skkp}}" target="_blank">{{$pensiun->skkp}}</a></strong></td>  
                         
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>3</td>
                        <td>SKP 1 Tahun Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->skp1thn}}" target="_blank">{{$pensiun->skp1thn}}</a></strong></td>  
                        
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>4</td>
                        <td>Surat pernyataan tidak pernah di jatuhi hukuman Disiplin Tingkat Sedang/ Berat</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->superhd}}" target="_blank">{{$pensiun->superhd}}</a></strong></td>  
                        
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>5</td>
                        <td>Surat pernyataan tidak sedang menjalani proses pidana / pernah di pidana</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->superpdna}}" target="_blank">{{$pensiun->superpdna}}</a></strong></td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>6</td>
                        <td>Surat Permohonan Berhenti atas Permintaan Sendiri sebagai PNS</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->sphentiaps}}" target="_blank">{{$pensiun->sphentiaps}}</a></strong></td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>7</td>
                        <td>Surat Usul Pemberhentian Atas Permintaan Sendiri sebagai PNS dari Kepala SKPD</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pensiun/{{$pensiun->jenis}}/{{$pensiun->id}}/{{$pensiun->apsppk}}" target="_blank">{{$pensiun->apsppk}}</a></strong></td>  
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