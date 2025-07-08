<div class="col-lg-10 col-md-6">
  <div class="card">
    <div class="card-header bg-gradient-secondary">
      Profil Pegawai
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="text-center">
            <a href="{{$pegawai->foto == null ? '/theme/dist/img/default-150x150.png':$pathfoto}}" target="_blank"><img
                class="profile-user-img img-fluid"
                src="{{$pegawai->foto == null ? '/theme/dist/img/default-150x150.png':$pathfoto}}"></a>
          </div>

          <h3 class="profile-username text-center"> {{$pegawai->nip}}</h3>
          <p class="text-muted text-center"> {{$pegawai->nama}} <br />
            <a href="#" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-default"><i
                class="fas fa-image"></i> Foto</a>
          </p>
        </div>
        <div class="col-lg-9 col-md-6">
          <table class="table table-sm">
            <tbody>
              <tr>
                <td class="text-right">Nama</td>
                <td>: {{$pegawai->nama}}</td>
              </tr>
              <tr>
                <td class="text-right">NIP</td>
                <td>: {{$pegawai->nip}}</td>
              </tr>
              <tr>
                <td class="text-right">NIK</td>
                <td>: {{$pegawai->nik}}</td>
              </tr>
              <tr>
                <td class="text-right">Jenis Kelamin</td>
                <td>: {{$pegawai->jenis_kelamin}}</td>
              </tr>
              <tr>
                <td class="text-right">Tempat, Tanggal Lahir</td>
                <td>: {{$pegawai->tempat_lahir}},{{\Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y')}}
                </td>
              </tr>
              <tr>
                <td class="text-right">Umur</td>
                <td>: </td>
              </tr>
              <tr>
                <td class="text-right">Golongan Darah</td>
                <td>: </td>
              </tr>
              <tr>
                <td class="text-right">Agama</td>
                <td>: </td>
              </tr>
              <tr>
                <td class="text-right">Status Pernikahan</td>
                <td>: </td>
              </tr>
              <tr>
                <td class="text-right">No Telp</td>
                <td>: </td>
              </tr>
              <tr>
                <td class="text-right">Alamat</td>
                <td>: </td>
              </tr>
              <tr>
                <td class="text-right">Status Kepegawaian</td>
                <td>: {{$pegawai->status_pegawai}}</td>
              </tr>
              <tr>
                <td class="text-right">Status Aktif</td>
                <td>: {{$pegawai->status_aktif == 1 ? 'AKTIF':'TIDAK AKTIF'}}</td>
              </tr>
              {{-- <tr>
                <td class="text-right"></td>
                <td><a href="/pegawai/detail/edit_profil" class="btn btn-sm btn-outline-primary"><i
                      class="fa fa-edit"></i> Ubah</a></td>
              </tr> --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card-footer">
    </div>
  </div>
</div>