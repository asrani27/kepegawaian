@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('title')
    AJUKAN KEPANGKATAN
@endsection
@section('content')
<a href="/admin/kepangkatan" class="btn btn-sm bg-gradient-purple"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a><br/><br/>
<div class="row">
    <div class="col-12">
        <form method="post" action="/admin/kepangkatan/create">
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
                    <th>JENJANG</th>
                    <th>RINCIAN BERKAS USUL KENAIKAN PANGKAT</th>
                    <th>PENAMAAN FILE</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td rowspan="7">1</td>    
                        <td rowspan="7">STRUKTURAL</td>
                        <td></td>  
                        <td></td>  
                        <td>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Pangkat Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_skkp}}" target="_blank">{{$pangkat->struktural_skkp}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="struktural" data-penamaan="SKKP" data-field="struktural_skkp">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK jabatan mulai awal promosi s.d Jabatan Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_sklantik}}" target="_blank">{{$pangkat->struktural_sklantik}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="struktural" data-penamaan="SKLANTIK" data-field="struktural_sklantik">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SKP dan DP3 2 tahun Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_skp2thn}}" target="_blank">{{$pangkat->struktural_skp2thn}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary"  data-jenis="struktural" data-penamaan="SKP2THN" data-field="struktural_skp2thn">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK Tugas Belajar (Bagi Yang mencantumkan gelar)</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_sktubel}}" target="_blank">{{$pangkat->struktural_sktubel}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="struktural" data-penamaan="SKTUBEL" data-field="struktural_sktubel">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Izin Belajar (Bagi Yang mencantumkan gelar)</td> 
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_skiznbel}}" target="_blank">{{$pangkat->struktural_skiznbel}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="struktural" data-penamaan="SKIZNBEL" data-field="struktural_skiznbel">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi Ijazah dan Transkrip pendidikan terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/struktural/{{$pangkat->id}}/{{$pangkat->struktural_ijzakhir}}" target="_blank">{{$pangkat->struktural_ijzakhir}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="struktural" data-penamaan="IJZAKHIR" data-field="struktural_ijzakhir">Upload</button>
                        </td>  
                    </tr>

                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td rowspan="11">2</td>    
                        <td rowspan="11">JABATAN FUNGSIONAL TERTENTU</td>
                        <td></td>  
                        <td></td>  
                        <td>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Pangkat Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_skkp}}" target="_blank">{{$pangkat->jft_skkp}}</a></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="jft" data-penamaan="SKKP" data-field="jft_skkp">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Asli PAK lanjutan dari PAK Terakhir</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_pak}}" target="_blank">{{$pangkat->jft_pak}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="jft" data-penamaan="PAK" data-field="jft_pak">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi Sertifikat Uji Kompetensi (Bagi yang naik jenjang)</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_serdiklat}}" target="_blank">{{$pangkat->jft_serdiklat}}</a></strong></td>  
                        <td>
                            <button type="button"  class="btn btn-xs upload btn-primary" data-jenis="jft" data-penamaan="SERDIKLAT" data-field="jft_serdiklat">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK kenaikan jabatan  Fungsional (Bagi yang naik jenjang)</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_sknaikjab}}" target="_blank">{{$pangkat->jft_sknaikjab}}</a></strong></td>  
                        <td>
                            <button type="button"  class="btn btn-xs upload btn-primary" data-jenis="jft" data-penamaan="SKNAIKJAB" data-field="jft_sknaikjab">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SKP dan DP3 2 tahun Terakhir</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_skp2thn}}" target="_blank">{{$pangkat->jft_skp2thn}}</a></strong></td>  
                        <td>
                            <button type="button"  class="btn btn-xs upload btn-primary" data-jenis="jft" data-penamaan="SKP2THN" data-field="jft_skp2thn">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi Ijazah dan Transkrip pendidikan terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_ijzakhir}}" target="_blank">{{$pangkat->jft_ijzakhir}}</a></strong></td>  
                        <td>
                            <button type="button"  class="btn btn-xs upload btn-primary" data-jenis="jft" data-penamaan="IJZAKHIR" data-field="jft_ijzakhir">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK pembebasan JFT *</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_skhentijf}}" target="_blank">{{$pangkat->jft_skhentijf}}</a></strong></td>  
                        <td>
                            <button type="button"  class="btn btn-xs upload btn-primary" data-jenis="jft" data-penamaan="SKHENTIJF" data-field="jft_skhentijf">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK Pengembalian dalam jabatan*</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_skjfkembali}}" target="_blank">{{$pangkat->jft_skjfkembali}}</a></strong></td>  
                        <td>
                            <button type="button"  class="btn btn-xs upload btn-primary" data-jenis="jft" data-penamaan="SKJFKEMBALI" data-field="jft_skjfkembali">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK Tugas Belajar (Bagi Yang mencantumkan gelar)</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_sktubel}}" target="_blank">{{$pangkat->jft_sktubel}}</a></strong></td>  
                        <td>
                            <button type="button"  class="btn btn-xs upload btn-primary" data-jenis="jft" data-penamaan="SKTUBEL" data-field="jft_sktubel">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Izin Belajar (Bagi Yang mencantumkan gelar)</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/jft/{{$pangkat->id}}/{{$pangkat->jft_skiznbel}}" target="_blank">{{$pangkat->jft_skiznbel}}</a></strong></td>  
                        <td>
                            <button type="button"  class="btn btn-xs upload btn-primary" data-jenis="jft" data-penamaan="SKIZNBEL" data-field="jft_skiznbel">Upload</button>
                        </td>  
                    </tr>
                    
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td rowspan="6">3</td>    
                        <td rowspan="6">REGULAR (KPO)</td>
                        <td></td>  
                        <td></td>  
                        <td>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Pangkat Terakhir</td>   
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/reguler/{{$pangkat->id}}/{{$pangkat->reguler_skkp}}" target="_blank">{{$pangkat->reguler_skkp}}</a></strong></td>  
                        <td>
                            <button type="button"  class="btn btn-xs upload btn-primary" data-jenis="reguler" data-penamaan="SKKP" data-field="reguler_skkp">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SKP dan DP3 2 tahun Terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/reguler/{{$pangkat->id}}/{{$pangkat->reguler_skp2thn}}" target="_blank">{{$pangkat->reguler_skp2thn}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="reguler" data-penamaan="SKP2THN" data-field="reguler_skp2thn">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi SK Tugas Belajar (Bagi Yang mencantumkan gelar)</td>
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/reguler/{{$pangkat->id}}/{{$pangkat->reguler_sktubel}}" target="_blank">{{$pangkat->reguler_sktubel}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="reguler" data-penamaan="SKTUBEL" data-field="reguler_sktubel">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td>Fotokopi SK Izin Belajar (Bagi Yang mencantumkan gelar)</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/reguler/{{$pangkat->id}}/{{$pangkat->reguler_skiznbel}}" target="_blank">{{$pangkat->reguler_skiznbel}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="reguler" data-penamaan="SKIZNBEL" data-field="reguler_skiznbel">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td>Fotokopi Ijazah dan Transkrip pendidikan terakhir</td>  
                        <td><strong><a href="/storage/{{$pegawai->nip}}/pangkat/reguler/{{$pangkat->id}}/{{$pangkat->reguler_ijzakhir}}" target="_blank">{{$pangkat->reguler_ijzakhir}}</a></strong></td>  
                        <td>
                            <button type="button" class="btn btn-xs upload btn-primary" data-jenis="reguler" data-penamaan="IJZAKHIR" data-field="reguler_ijzakhir">Upload</button>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                        <td rowspan="5"></td>    
                        <td rowspan="5">CATATAN :</td>
                        <td></td>  
                        <td></td>  
                        <td>
                        </td>  
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td colspan=3>File wajib dalam bentuk PDF dengan maksimal ukuran 2 MB per file</td>
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td colspan=3>Penamaan File wajib sesuai table</td>
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td colspan=3>Berkas fotocopy wajib di legalisir</td>
                    </tr>
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">    
                        <td colspan=3>Yang bertanda * bersifat opsional</td>
                    </tr>
                </tbody>
                </table>
                
            </div>
        </div>
        <a href="/admin/kepangkatan/{{$id}}/kirim" class="btn btn-sm btn-block btn-danger" onclick="return confirm('Yakin Sudah Selesai Semua?')"> <i class="fas fa-paper-plane"></i> <strong>Validasi & Kirim Ke BKD</strong></a><br/>
    </div>
</div>

<div class="modal fade" id="modal-upload" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="/admin/kepangkatan/{{$id}}" enctype="multipart/form-data">
            @csrf
        <div class="modal-header bg-gradient-success" style="padding:10px">
            <h4 class="modal-title text-sm">Upload File</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
  
        <div class="modal-body">
            <input type="file" class="form-control"  name="file" required>
            <input type="hidden" id="jenis" name="jenis">
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
       $('#jenis').val($(this).data('jenis'));
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