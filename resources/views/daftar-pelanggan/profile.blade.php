@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

<link rel="stylesheet" href="{{ URL::asset('css/profil-pelanggan.css') }}">
@endsection

@section('content')
<div class="bg-white cs-wrap-content">
    <div>
        <div class="d-flex flex-row w-100 cs-profil-pelanggan">
            <div class="column-1">
                <div>
                    <img class="avatar" src="{{ $pelanggan->PROFILE_PHOTO }}" alt="" />
                    <a href="#">
                        <button type="button" class="btn bg-success-transparent text-white text-uppercase mb-2 cs-profil-btn cs-lihat-kyc" data-id="{{ $pelanggan->ID_PELANGGAN }}">
                            <span>Lihat KYC</span>
                        </button>
                    </a>
                    <a href="{{ route('inbox.search', $pelanggan->ID_PELANGGAN) }}">
                        <button type="button" class="btn bg-success text-white text-uppercase cs-profil-btn">
                            <img class="icon" src="{{ URL::asset('img/icon-send-white.svg') }}" alt="" />
                            <span>Lihat Pesan</span>
                        </button>
                    </a>
                </div>
            </div>
            <div class="column-2">
                <div>
                    <h2 class="cs-profil-nama">{{ $pelanggan->NAMA_PELANGGAN }}</h2>
                    <p class="cs-profil-email">{{ $pelanggan->EMAIL }}</p>

                    <table class="cs-profil-meta">
                        <tbody>
                            <tr>
                                <td>Bergabung</td>
                                <td>:</td>
                                <td>{{ date('d M Y', strtotime($pelanggan->kyc->TGL_MULAI_AKTIF)) }}</td>
                            </tr>
                            <tr>
                                <td>User ID</td>
                                <td>:</td>
                                <td>{{ $pelanggan->ID_PELANGGAN }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{ ($pelanggan->kyc->STATUS_AKTIF == 'Y' ? 'Aktif' : 'Tidak Aktif') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="column-3">
                <div>
                    <p class="mb-2">Status Akun :</p>

                    @if($pelanggan->STATUS_AKUN != 'aktif')
                    <a href="#" class="cs-aktifkan-pelanggan" data-id="{{ $pelanggan->ID_PELANGGAN }}">
                        <button type="button" class="btn bg-primary text-white text-uppercase mb-2 cs-profil-btn">
                            <span>Aktifkan</span>
                        </button>
                    </a>
                    @endif

                    @if($pelanggan->STATUS_AKUN != 'delete')
                    <a href="#" class="cs-delete-pelanggan" data-id="{{ $pelanggan->ID_PELANGGAN }}">
                        <button type="button" class="btn bg-danger text-white text-uppercase mb-2 cs-profil-btn">
                            <span>Delete</span>
                        </button>
                    </a>
                    @endif
                    
                    @if($pelanggan->STATUS_AKUN != 'suspend')
                    <a href="#" class="cs-suspend-pelanggan" data-id="{{ $pelanggan->ID_PELANGGAN }}">
                        <button type="button" class="btn bg-dark text-white text-uppercase cs-profil-btn">
                            <span>Suspend</span>
                        </button>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="d-inline-block w-100 align-middle cs-content-header">
            <div class="float-start">
                <div class="cs-content-title">
                    <h2 class="text-uppercase">Daftar Transaksi</h2>
                </div>
            </div>
        </div>

        <form action="" method="POST">
            @csrf
            <input type="hidden" name="tanggal_mulai" value="{{ !is_null($tanggal_mulai) ? $tanggal_mulai : date('Y-m-d', $min_date) }}" />
            <input type="hidden" name="tanggal_akhir" value="{{ !is_null($tanggal_akhir) ? $tanggal_akhir : date('Y-m-d', $max_date) }}" />
            <div class="d-inline-flex align-middle cs-wrap-filter">
                <div class="cs-filter-date">
                    <input type="text" name="daterange" value="{{ !is_null($tanggal_mulai) ? $tanggal_mulai : date('Y-m-d') }} - {{ !is_null($tanggal_akhir) ? $tanggal_akhir : date('Y-m-d') }}" />
                    <img class="icon" src="{{ URL::asset('img/icon-filter-date.svg') }}" alt="" />
                </div>

                <div class="input-group cs-filter-product">
                    <span class="input-group-text" id="filter-product">Produk :</span>
                    <select name="id_paket_produk" class="form-select" aria-label="filter-product" autocomplete="off">
                        <option value="" selected="selected">Semua</option>
                        @if ($paket_produk)
                        @foreach ($paket_produk as $row)
                        <option value="{{ $row->ID_PAKET_PRODUK }}" {{ $row->ID_PAKET_PRODUK == $id_paket_produk ? 'selected="selected"' : '' }}>{{ $row->NAMA_PRODUK }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="input-group cs-filter-status">
                    <span class="input-group-text" id="filter-status">Status Berlangganan :</span>
                    <select name="status_berlangganan" class="form-select" aria-label="filter-status" autocomplete="off">
                        <option value="" selected="selected">Semua</option>
                        <option value="aktif" {{ ($status_berlangganan == 'aktif' ? 'selected="selected"' : '') }}>Aktif</option>
                        <option value="tidak_aktif" {{ ($status_berlangganan == 'tidak_aktif' ? 'selected="selected"' : '') }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>
        

            <div class="d-inline-block w-100 align-middle" style="margin-bottom: -64px; z-index: 10; position: relative;">
                <div class="input-group cs-search-table float-start">
                    <input type="text" name="no_invoice" class="form-control" placeholder="No Invoice" aria-label="No Invoice" aria-describedby="basic-addon2" autocomplete="off" value="{{ $no_invoice }}">
                    <button type="submit" class="input-group-text" id="basic-addon2">
                        <img class="icon" src="{{ URL::asset('img/icon-search-white.svg') }}" alt="" />
                        <span class="label">CARI</span>
                    </button>
                </div>
            </div>
        </form>

        <table id="daftarTransaksi" class="display cs-tables">
            <thead>
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkAllRows" autocomplete="off">
                        </div>  
                    </th>
                    <th class="exportable">Invoice</th>
                    <th class="exportable">Tanggal Order</th>
                    <th class="exportable">Jenis Pembayaran</th>
                    <th class="exportable">Nama Produk</th>
                    <th class="exportable">Qty</th>
                    <th class="exportable">Harga Satuan</th>
                    <th class="exportable">Total</th>
                    <th class="exportable">Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($tagihan)
                @foreach ($tagihan as $row)
                <tr id="rowId{{ $row->ID_TAGIHAN }}">
                    <td>
                        <div class="form-check">
                            <input class="form-check-input cs-check-item" type="checkbox" value="{{ $row->ID_TAGIHAN }}" id="checkItem1" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <a href="#" class="cs-invoice cs-toggle-invoice">
                            <span>{{ $row->NOMOR_TAGIHAN }}</span>
                        </a>
                        <a href="{{ route('inbox.resend_invoice', ['id_pelanggan' => $pelanggan->ID_PELANGGAN, 'nomor_invoice' => $row->NOMOR_TAGIHAN]) }}" class="cs-resend-invoice">
                            <span>Kirim Ulang</span>
                        </a>
                    </td>
                    <td>{{ date('d-m-Y', strtotime($row->TANGGAL_TAGIHAN)) }}</td>
                    <td>{{ get_jenis_pembayaran($row->ID_TAGIHAN) }}</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" class="cs-list-produk dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ URL::asset('img/icon-list-produk.svg') }}" alt="" />
                                <span>Lihat Daftar</span>
                            </a>
                            <ul class="dropdown-menu">
                                @php
                                $daftar_produk = get_daftar_produk($row->ID_TAGIHAN);
                                
                                foreach($daftar_produk as $item) {
                                    echo '<li><div class="dropdown-item text-sm">' . $item . '</div></li>';
                                }
                                @endphp
                            </ul>
                        </div>
                    </td>
                    <td>{{ $row->TOTAL_ITEM }}</td>
                    <td>{{ get_harga_satuan($row->ID_TAGIHAN) }}</td>
                    <td>{{ get_format_rupiah($row->JUMLAH_TAGIHAN) }}</td>
                    <td>
                        <span class="cs-badge {{ $row->STATUS_TAGIHAN == 'DIBAYAR' ? 'success' : 'secondary' }}">{{ $row->STATUS_TAGIHAN }}</span>
                    </td>
                    <td>
                        <a href="#" class="cs-btn-icon success cs-toggle-invoice" data-id="{{ $row->ID_TAGIHAN }}">
                            <img src="{{ URL::asset('img/icon-eye.svg') }}" alt="" style="width: 15px; height: 15px;" />
                        </a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('footer')
<div class="cs-footer-actions">
    <div>
        <a href="{{ route('daftar_pelanggan.list') }}">
            <button type="submit" class="btn bg-primary text-white text-uppercase cs-footer-back-btn">
                <img src="{{ URL::asset('img/icon-chevron-left.svg') }}" alt="" />
                <span>Kembali</span>
            </button>
        </a>
    </div>
</div>

<div id="kyc-pelanggan">
    <div>
        <div class="kyc-wrap-header">
            <h3>KYC PELANGGAN</h3>
        </div>

        <div class="d-flex flex-row w-100">
            <div class="kyc-column-1">
                <div>
                    <div class="row kyc-form-row">
                        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_lengkap" value="{{ $pelanggan->NAMA_PELANGGAN }}">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" value="{{ $pelanggan->USERNAME }}">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" value="{{ $pelanggan->EMAIL }}">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="no_hp" class="col-sm-3 col-form-label">No Hp</label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control" id="no_hp" value="{{ $pelanggan->NO_HP }}">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="L" {{ ($pelanggan->GENDER == 'L' ? 'checked="checked"' : '') }}>
                                <label class="form-check-label" for="inlineRadio1">Pria</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="P" {{ ($pelanggan->GENDER == 'P' ? 'checked="checked"' : '') }}>
                                <label class="form-check-label" for="inlineRadio2">Wanita</label>
                            </div>
                              
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="ttl" class="col-sm-3 col-form-label">Tempat & Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="tempat_lahir" value="{{ $pelanggan->TEMPAT_LAHIR }}">
                                </div>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="tanggal_lahir" value="{{ $pelanggan->TANGGAL_LAHIR }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="alamat" value="{{ $pelanggan->ALAMAT_KTP }}">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="kota" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kota" value="{{ $pelanggan->KOTA_DOMISILI }}">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="npwp" class="col-sm-3 col-form-label">NPWP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="npwp" value="">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="npwp" class="col-sm-3 col-form-label">Linked Account</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="kyc-linked-btn">
                                        <img src="{{ URL::asset('img/icon-facebook.svg') }}" alt="" />
                                        <span>Facebook</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="kyc-linked-btn">
                                        <img src="{{ URL::asset('img/icon-gmail.svg') }}" alt="" />
                                        <span>Gmail</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="tipe_akun" class="col-sm-3 col-form-label">Tipe Akun</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="tipe_akun" aria-label="Tipe Akun">
                                <option value="pelanggan" {{ ($pelanggan->STATUS_MITRA == 'pelanggan' ? 'selected="selected"' : '') }}>Perorangan</option>
                                <option value="mitra" {{ ($pelanggan->STATUS_MITRA == 'mitra' ? 'selected="selected"' : '') }}>Mitra</option>
                            </select>
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" value="" placeholder="Eg. ********">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn bg-dark text-white text-uppercase kyc-btn-reset-password mt-2">
                                <span>Reset Password</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kyc-column-2">
                <div>
                    <div class="mb-3 kyc-form-row">
                        <label for="password" class="col-form-label">Foto Profil</label>
                        <div>
                            <div id="previewFotoProfil" class="kyc-preview-wrap">
                                <img src="{{ $pelanggan->PROFILE_PHOTO }}" alt="" class="kyc-preview-image">
                                <input type="file" class="kyc-preview-file" accept="image/png, image/gif, image/jpeg" data-id="previewFotoProfil">

                                <img src="{{ URL::asset('img/icon-media-download.svg') }}" alt="" class="kyc-media-download" />
                                <img src="{{ URL::asset('img/icon-media-pencil.svg') }}" alt="" class="kyc-media-pencil" data-id="previewFotoProfil" />
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 kyc-form-row">
                        <label for="password" class="col-form-label">Foto KTP</label>
                        <div>
                            <div id="previewFotoKTP" class="kyc-preview-wrap">
                                <img src="" alt="" class="kyc-preview-image">
                                <input type="file" class="kyc-preview-file" accept="image/png, image/gif, image/jpeg" data-id="previewFotoKTP">

                                <img src="{{ URL::asset('img/icon-media-download.svg') }}" alt="" class="kyc-media-download" />
                                <img src="{{ URL::asset('img/icon-media-pencil.svg') }}" alt="" class="kyc-media-pencil" data-id="previewFotoKTP" />
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 kyc-form-row">
                        <label for="password" class="col-form-label">Foto NPWP</label>
                        <div>
                            <div id="previewFotoNPWP" class="kyc-preview-wrap">
                                <img src="" alt="" class="kyc-preview-image">
                                <input type="file" class="kyc-preview-file" accept="image/png, image/gif, image/jpeg" data-id="previewFotoNPWP">

                                <img src="{{ URL::asset('img/icon-media-download.svg') }}" alt="" class="kyc-media-download" />
                                <img src="{{ URL::asset('img/icon-media-pencil.svg') }}" alt="" class="kyc-media-pencil" data-id="previewFotoNPWP" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <button type="submit" class="btn bg-dark text-white text-uppercase kyc-btn-cancel">
            <span>Batalkan</span>
        </button>
        <button type="submit" class="btn bg-dark text-white text-uppercase kyc-btn-save">
            <span>Simpan</span>
        </button>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(function() {
        var _tanggal_mulai = $('input[name="tanggal_mulai"]').val();
        var _tanggal_akhir = $('input[name="tanggal_akhir"]').val();

        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            startDate: _tanggal_mulai,
            endDate: _tanggal_akhir,
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end, label) {
            // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready( function () {
        var _table = $('#daftarTransaksi').DataTable({
            // columnDefs: [
            //     {
            //         target: 1,
            //         visible: false
            //     },
            //     {
            //         target: 2,
            //         visible: false
            //     },
            //     {
            //         target: 3,
            //         visible: false
            //     }
            // ],
            dom: 'lBfrtip',
            lengthMenu: [ 2, 5, 10, 25, 50, 75, 100 ],
            iDisplayLength: 10,
            // buttons: [
            //     {
            //         extend: 'excel',
            //         exportOptions: {
            //             columns: 'th.exportable'
            //         }
            //     }
            // ]
        });

        $('.cs-wrap-filter .icon').click(function(e) {
            e.preventDefault();

            $(this).prevAll('input[name="daterange"]').click();
        })

        // $('.cs-search-table input').keyup(function() {
        //     _table.columns(1).search( $(this).val() ).draw();
        // })

        $('.cs-aktifkan-pelanggan').on('click', (function(e) {
            e.preventDefault();

            var _url = "{{ route('api.update_status_akun') }}";
            var _id_pelanggan = $(this).data('id');
            var _confirm = confirm('Apakah Anda yakin ingin mengaktifkan pelanggan ini?');

            if(_confirm) {
                $.ajax({
                    method: 'PUT',
                    url: _url,
                    data: 'id_pelanggan=' + _id_pelanggan + '&status_akun=aktif',
                    dataType: 'json',
                    processData: false,
                    success: function(response) {
                        // Silent is gold
                        console.log(response); // this is for debug only

                        document.location.href = "";
                    }
                })
            } else {
                // Silent is gold
            }
        }))

        $('.cs-delete-pelanggan').on('click', (function(e) {
            e.preventDefault();

            var _url = "{{ route('api.update_status_akun') }}";
            var _id_pelanggan = $(this).data('id');
            var _confirm = confirm('Apakah Anda yakin ingin menghapus pelanggan ini?');

            if(_confirm) {
                $.ajax({
                    method: 'PUT',
                    url: _url,
                    data: 'id_pelanggan=' + _id_pelanggan + '&status_akun=delete',
                    dataType: 'json',
                    processData: false,
                    success: function(response) {
                        // Silent is gold
                        console.log(response); // this is for debug only

                        document.location.href = "";
                    }
                })
            } else {
                // Silent is gold
            }
        }))

        $('.cs-suspend-pelanggan').on('click', (function(e) {
            e.preventDefault();

            var _url = "{{ route('api.update_status_akun') }}";
            var _id_pelanggan = $(this).data('id');
            var _confirm = confirm('Apakah Anda yakin ingin suspend pelanggan ini?');

            if(_confirm) {
                $.ajax({
                    method: 'PUT',
                    url: _url,
                    data: 'id_pelanggan=' + _id_pelanggan + '&status_akun=suspend',
                    dataType: 'json',
                    processData: false,
                    success: function(response) {
                        // Silent is gold
                        console.log(response); // this is for debug only

                        document.location.href = "";
                    }
                })
            } else {
                // Silent is gold
            }
        }))

        $('.cs-lihat-kyc').click(function(e) {
            e.preventDefault();

            $('#kyc-pelanggan').toggle();
        })

        $('.kyc-btn-cancel').click(function() {
            $('#kyc-pelanggan').toggle();
        })
    } );
</script>
@endsection