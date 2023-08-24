@extends('adminlte::page')
@section('title', 'Edit Reservasi')
@section('content_header')
<h1 class="m-0 text-dark">Edit Reservasi</h1>
@stop
@section('content')
<form action="{{route('reservasi.update',  $reservasi)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(auth()->user()->level == 'pelanggan' )
                    <div class="form-group">
                        <label for="id_pelanggan" class="form-label">Email</label>
                        <input class="form-control" type="email" readonly value="{{Auth::user()->email }}"
                            placeholder="john.doe@example.com">
                        @error('id_pelanggan') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    @else
                    <div class="form-group">
                        <label for="id_pelanggan">Pelanggan</label>
                        <div class="input-group">
                            <input type="hidden" name="id_pelanggan" id="id_pelanggan"
                                value="{{$reservasi->fpelanggan->id ?? old('id_pelanggan')}}">
                            <input type="text" class="form-control
@error('pelanggan') is-invalid @enderror" placeholder="pelanggan" id="pelanggan" name="pelanggan"
                                value="{{$reservasi->fpelanggan->pelanggan ?? old('pelanggan')}}" aria-label="pelanggan"
                                aria-describedby="cari" readonly>
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari"
                                data-bs-target="#staticBackdrop"></i>
                                Cari Data Pelanggan</button>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="id_paket">Paket Wisata</label>
                            <div class="input-group">
                                <input type="hidden" name="id_paket" id="id_paket"
                                    value="{{$reservasi->fpelanggan->id ?? old('id_paket')}}">
                                <input type="text" class="form-control
@error('pktwisata') is-invalid @enderror" placeholder="pktwisata" id="pktwisata" name="pktwisata"
                                    value="{{$reservasi->fpelanggan->pktwisata ?? old('pktwisata')}}"
                                    aria-label="pktwisata" aria-describedby="cari" readonly>
                                <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari"
                                    data-bs-target="#staticBackdrop1"></i>
                                    Cari Data Paket Wisata</button>
                            </div>
                            <div class="form-group">
                                <label for="tgl_reservasi_wisata">Tanggal Reservasi</label>
                                <input type="date" class="form-control"
                                    class="form-control @error('tgl_reservasi_wisata') is-invalid @enderror"
                                    id="tgl_reservasi_wisata" placeholder="Tanggal Upload" name="tgl_reservasi_wisata"
                                    value="{{$reservasi->tgl_reservasi_wisata ??old('tgl_reservasi_wisata')}}">
                                @error('tgl_reservasi_wisata') <span class="textdanger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" class="form-control 
@error('harga') is-invalid @enderror" id="harga" placeholder="Harga" step="1" name="harga" aria-label="harga"
                                    aria-describedby="cari" value="{{$reservasi->harga ??old('harga')}}" readonly>
                                @error('harga') <span class="textdanger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="jumlah_peserta">Jumlah Peserta</label>
                                <input type="number" class="form-control
@error('jumlah_peserta') is-invalid @enderror" id="jumlah_peserta" placeholder="Jumlah Peserta" name="jumlah_peserta"
                                    value="{{$reservasi->harga ??old('harga')}}">
                                @error('jumlah_peserta') <span class="textdanger">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="diskon">Diskon</label>
                                <input type="number" class="form-control
@error('diskon') is-invalid @enderror" id="diskon" placeholder="Diskon" name="diskon" aria-label="diskon"
                                    aria-describedby="cari" readonly min="0" max="100" step="1"
                                    value="{{$reservasi->harga ??old('harga')}}">
                                @error('diskon') <span class="textdanger">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="nilai_diskon">Nilai Diskon</label>
                                <input type="text" class="form-control
@error('nilai_diskon') is-invalid @enderror" id="nilai_diskon" placeholder="Nilai Diskon" name="nilai_diskon"
                                    value="{{$reservasi->harga ??old('harga')}}" onchange="hai1()">
                                @error('nilai_diskon') <span class="textdanger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="total_bayar">Total</label>
                                <input type="text" class="form-control
@error('total_bayar') is-invalid @enderror" id="total_bayar" placeholder="Total" name="total_bayar"
                                    value="{{$reservasi->harga ??old('harga')}}">
                                @error('total_bayar') <span class="textdanger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="file_bukti_tf" class="formlabel">Bukti Transfer</label>
                                <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil1" alt="..."
                                    width="15%" id="tampil1">
                                <input class="form-control @error('file_bukti_tf') isinvalid @enderror" type="file"
                                    id="file_bukti_tf" name="file_bukti_tf">
                                @error('file_bukti_tf') <span class="textdanger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="status_reservasi_wisata">Status Reservasi</label>
                                <select class="form-control @error('status_reservasi_wisata') isinvalid @enderror"
                                    id="status_reservasi_wisata" name="status_reservasi_wisata">
                                    <option value="pesan" @if($reservasi->status_reservasi_wisata ==
                                        'pesan' || old('status_reservasi_wisata') == 'pesan')selected @endif>
                                        Pesan
                                    </option>
                                    <option value="bayar" @if($reservasi->status_reservasi_wisata ==
                                        'bayar' || old('status_reservasi_wisata') == 'bayar')selected @endif>
                                        Bayar
                                    </option>
                                    <option value="selesai" @if($reservasi->status_reservasi_wisata ==
                                        'selesai' || old('status_reservasi_wisata') == 'selesai')selected @endif>
                                        Selesai
                                    </option>

                                </select>
                                @error('status_reservasi_wisata') <span class="textdanger">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('reservasi.index')}}" class="btn
btn-default">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Data Pelanggan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover table-bordered tablestripped" id="example2">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Lengkap</th>
                                        <th>No Telepon</th>
                                        <th>User</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pelanggan as $key => $pl)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$pl->nama_lengkap}}</td>
                                        <td>{{$pl->no_hp}}</td>
                                        <td>{{$pl->fuser->email}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary
btn-xs" onclick="pilih('{{$pl->id}}','{{$pl->fuser->email}}', '{{$pl->nama_lengkap}}', '{{$pl->no_hp}}',  )"
                                                data-bs-dismiss="modal">
                                                Pilih
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->

            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Data Paket Wisata</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover table-bordered tablestripped" id="example3">
                                <thead>
                                    <tr>
                                        <th>No.</th>

                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Diskon</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pktwisata as $key => $pw)
                                    <tr>
                                        <td>{{$key+1}}</td>

                                        <td id={{$key+1}}>{{$pw->nama_paket}}</td>

                                        <td id={{$key+1}}>{{ 'Rp ' . number_format($pw->harga_per_pack, 0, ',', '.') }}
                                        </td>
                                        <td id={{$key+1}}>{{ $pw->diskon ? $pw->diskon . '%' : '-' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary
btn-xs" onclick="pilih1('{{$pw->id}}','{{$pw->nama_paket}}', '{{$pw->harga_per_pack}}', '{{$pw->diskon}}',  )"
                                                data-bs-dismiss="modal">
                                                Pilih
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->


            @stop
            @push('js')

            <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#tampil1').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }

            }
            $("#file_bukti_tf").change(function() {
                readURL(this);

            });



            $('#example2').DataTable({
                "responsive": true,
            });


            function pilih(id, pl) {
                document.getElementById('id_pelanggan').value = id
                document.getElementById('pelanggan').value = pl
            }

            $('#example3').DataTable({
                "responsive": true,
            });


            function pilih1(id, pkt, harga, diskon) {
                document.getElementById('id_paket').value = id
                document.getElementById('pktwisata').value = pkt;
                document.getElementById('harga').value = harga;
                document.getElementById('diskon').value = diskon;



            }

            // function pilih1(id, harga, pkt) {
            //     // Dapatkan elemen kolom form harga
            //     var kolomHarga = document.getElementById("kolom-harga");

            //     // Dapatkan harga berdasarkan ID terpilih dari tabel modal
            //     var harga = dapatkanHargaBerdasarkanID(idTerpilih);

            //     // Mengisi harga ke kolom form
            //     kolomHarga.value = harga;
            // }

            // // Fungsi untuk mendapatkan harga berdasarkan ID terpilih dari tabel modal
            // function dapatkanHargaBerdasarkanID(idTerpilih) {
            //     // Dapatkan tabel modal
            //     var tabelModal = document.getElementById("tabel-modal");

            //     // Dapatkan baris dengan ID terpilih
            //     var barisTerpilih = tabelModal.querySelector(`tr[data-id="${idTerpilih}"]`);

            //     // Dapatkan harga dari kolom harga dalam baris terpilih
            //     var kolomHarga = barisTerpilih.querySelector("td:nth-child(3)");
            //     var harga = kolomHarga.textContent;

            //     // Kembalikan harga yang ditemukan
            //     return harga;
            // }

            function hai1() {
                let harga = document.getElementById("harga").value;
                let diskon = document.getElementById("diskon").value;
                let jumlah = document.getElementById("jumlah_peserta").value;
                let nilai_diskon = (harga) * diskon / 100
                let nilaiDiskon = document.getElementById("nilai_diskon").value = nilai_diskon;
                let total_bayar = document.getElementById("total_bayar");
                total_bayar.value = (harga - nilai_diskon) * jumlah;
            }




            // function nilaiDiskon() {
            //     // e.preventDefault();
            //     let harga = document.getElementById("harga").value;
            //     let diskon = document.getElementById("diskon").value;
            //     let jumlah = document.getElementById("jumlah_peserta").value;
            //     let nilai_diskon = (harga) * diskon / 100
            //     let nilaiDiskon = document.getElementById("nilai_diskon").value = nilai_diskon;
            //     let total_bayar = document.getElementById("total_bayar");
            //     total_bayar.value = (harga - nilai_diskon) * jumlah;
            // }

            // function pilih1(id, pkt, harga) {
            //     // Dapatkan elemen kolom form harga dan nama paket

            //     var kolomHarga = document.getElementById("harga");
            //     var kolomNamaPaket = document.getElementById("pktwisata");

            //     // Dapatkan harga dan nama paket berdasarkan ID terpilih dari tabel modal
            //     var dataPaket = dapatkanDataPaketBerdasarkanID('id_paket');
            //     var harga = dataPaket.harga;
            //     var pktwisata = dataPaket.pktwisata;

            //     // Mengisi harga dan nama paket ke kolom form
            //     kolomHarga.value = harga;
            //     kolomNamaPaket.value = pktwisata;
            // }

            // function formatRupiah(input) {
            //     // Mengambil nilai input
            //     var nilai = input.value;

            //     // Mengubah nilai menjadi format rupiah
            //     var formatRupiah = parseInt(nilai).toLocaleString("id-ID", {
            //         style: "currency",
            //         currency: "IDR"
            //     });

            //     // Menampilkan nilai dengan format rupiah pada input
            //     input.value = formatRupiah;
            // }
            // 
            </script>

            @endpush