@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/daterangepicker.css') }}" />

<link rel="stylesheet" href="{{ URL::asset('css/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/buttons.dataTables.min.css') }}" />

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
                            <span>Kirim Pesan</span>
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
                        <a href="#" class="cs-invoice cs-toggle-invoice" data-id="{{ $row->ID_TAGIHAN }}">
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
                                $daftar_produk = get_daftar_produk($row->ID_TAGIHAN)['daftar_produk'];
                                
                                foreach($daftar_produk as $item) {
                                    echo '<li><div class="dropdown-item text-sm">' . $item['nama_produk'] . '@' . $item['qty'] . '</div></li>';
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
            <button type="button" class="btn bg-primary text-white text-uppercase cs-footer-back-btn">
                <img src="{{ URL::asset('img/icon-chevron-left.svg') }}" alt="" />
                <span>Kembali</span>
            </button>
        </a>
    </div>
</div>

{{-- KYC --}}
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
                            <button type="button" class="btn bg-dark text-white text-uppercase kyc-btn-reset-password mt-2">
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
        <button type="button" class="btn bg-dark text-white text-uppercase kyc-btn-cancel">
            <span>Batalkan</span>
        </button>
        <button type="button" class="btn bg-dark text-white text-uppercase kyc-btn-save">
            <span>Simpan</span>
        </button>
    </div>
</div>

{{-- INVOICE --}}
<div id="invoice">
    <div class="header">
        <div class="d-inline-block w-100 align-middle">
            <div class="float-start">
                <img src="{{ URL::asset('img/logo-ticmi.jpg') }}" alt="" />
            </div>
            <div class="float-end">
                <label for="invoice-number" class="cs-invoice-label">INVOICE</label>
                <h2 class="cs-invoice-number" id="inv-nomor-tagihan">#NOMOR_TAGIHAN</h2>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="cs-meta-pelanggan">
            <div class="row">
                <div class="col-sm-3">
                    <span>Pelanggan</span>
                    <p id="inv-nama-pelanggan">#NAMA_PELANGGAN</p>
                </div>
                <div class="col-sm-3">
                    <span>Tanggal Transaksi</span>
                    <p id="inv-tanggal-tagihan">#TANGGAL_TAGIHAN</p>
                </div>
                <div class="col-sm-3">
                    <span>Tanggal Jatuh Tempo</span>
                    <p id="inv-tanggal-jatuh-tempo">#TANGGAL_JATUH_TEMPO</p>
                </div>
                <div class="col-sm-3">
                    <span>Metode Pembayaran</span>
                    <p id="inv-metode-pembayaran">#METODE_PEMBAYARAN</p>
                </div>
            </div>
        </div>

        <table class="cs-invoice-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Periode Langganan</th>
                    <th>Harga Satuan</th>
                    <th>Diskon</th>
                    <th>Pajak</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <span>Pre-Packaged A</span>
                        <a href="#">Lihat Produk</a>
                    </td>
                    <td>1</td>
                    <td>1 Tahun</td>
                    <td>Rp 300.000</td>
                    <td>
                        <span>0%</span>
                        <small>Diskon spesial A</small>
                    </td>
                    <td>11%</td>
                    <td>Rp 300.0000</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">
                        <div class="cs-invoice-note">
                            <strong>Catatan: </strong>
                            <span></span>
                        </div>
                    </th>
                    <th colspan="4" style="text-align: right;">
                        <table class="cs-pricing-table">
                            <tbody>
                                <tr>
                                    <td><strong>Subtotal</strong></td>
                                    <td><strong id="inv-subtotal">#SUB_TOTAL</strong></td>
                                </tr>
                                <tr>
                                    <td>Termasuk PPN 11%</td>
                                    <td id="inv-ppn">#PPN</td>
                                </tr>
                                <tr>
                                    <td><strong>Jumlah</strong></td>
                                    <td><strong id="inv-jumlah">#JUMLAH</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>DP / Uang Muka</strong></td>
                                    <td><strong id="inv-uang-muka">#UANG_MUKA</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Diskon</strong></td>
                                    <td><strong id="inv-diskon">#DISKON</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Bayar</strong></td>
                                    <td><strong id="inv-total">#TOTAL</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </th>
                </tr>
            </tfoot>
        </table>

        <div class="cs-corporate d-flex flex-row w-100">
            <div class="column-1">
                <div>
                    <img src="{{ URL::asset('img/logo-corporate-ticmi.jpg') }}" alt="" />
                </div>
            </div>
            <div class="column-2">
                <div>
                    <p>
                        <strong>PT Indonesian Capital Market Electronic Library</strong>
                        <span class="d-block">Indonesian Stock Exchange Building, Tower II, 1st Floor Jl. Jend. Sudirman Kav. 52-53, Jakarta-12190</span>
                        <br>
                        <strong>Telp : 021 515 23 18</strong>
                        <span class="d-block">info@icamel.co.id</span>
                    </p>
                </div>
            </div>
            <div class="column-3">
                <div>
                    <span>NPWP TICMI</span>
                    <p>729.832.2500-23</p>
                </div>
            </div>
        </div>

        <div class="cs-invoice-buttons">
            <button type="button" class="btn bg-dark text-white text-uppercase print">
                <img class="icon" src="{{ URL::asset('img/icon-print-white.svg') }}" alt="" />
                <span>Cetak & Lihat</span>
            </button>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn bg-transparent text-white dropdown dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <span><strong>Status : </strong>Belum Bayar</span>
                </button>
                <ul class="dropdown-menu">
                  <li><div class="dropdown-item">Belum Bayar</div></li>
                  <li><div class="dropdown-item">Dibayar</div></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer">
        <button type="button" class="btn bg-transparent text-dark invoice-btn-label">
            <span>Simpan Perubahan?</span>
        </button>
        <button type="button" class="btn bg-dark text-white text-uppercase invoice-btn-cancel">
            <span>Batalkan</span>
        </button>
        <button type="button" class="btn bg-dark text-white text-uppercase invoice-btn-save">
            <span>Simpan</span>
        </button>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/daterangepicker.min.js') }}"></script>
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

<script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('js/buttons.print.min.js') }}"></script>
<script>
    $(document).ready( function () {
        var formatRupiah = function(num=0){
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            
            if(str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }

            str = str.split("").reverse();
            for(var j = 0, len = str.length; j < len; j++) {
                if(str[j] != ",") {
                output.push(str[j]);
                if(i%3 == 0 && j < (len - 1)) {
                    output.push(".");
                }
                i++;
                }
            }
            
            formatted = output.reverse().join("");
            return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };

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

        $('.cs-toggle-invoice').click(function(e) {
            e.preventDefault();

            var _url = "{{ route('api.get_invoice') }}";
            var _id_tagihan = $(this).data('id');

            $.ajax({
                method: 'POST',
                url: _url,
                data: 'id_tagihan=' + _id_tagihan,
                dataType: 'json',
                processData: false,
                success: function(response) {
                    // Silent is gold
                    console.log(response); // this is for debug only

                    if(response.success) {
                        $('#inv-nomor-tagihan').text(response.data.nomor_tagihan);
                        $('#inv-nama-pelanggan').text(response.data.nama_pelanggan);
                        $('#inv-tanggal-tagihan').text(response.data.tanggal_tagihan);
                        $('#inv-tanggal-jatuh-tempo').text(response.data.tanggal_jatuh_tempo);
                        $('#inv-metode-pembayaran').text(response.data.metode_pembayaran);

                        // Clear table
                        $('.cs-invoice-table > tbody').html('');
                        
                        for(i=0;i<response.data.daftar_produk.length;i++) {
                            $('.cs-invoice-table > tbody').append('<tr>'+
                                '<td>' + (i + 1) + '</td>'+
                                '<td>'+
                                    '<span>' + response.data.daftar_produk[i].nama_produk + '</span>'+
                                    '<a href="#">Lihat Produk</a>'+
                                '</td>'+
                                '<td>' + response.data.daftar_produk[i].qty + '</td>'+
                                '<td>' + response.data.daftar_produk[i].periode + ' Bulan</td>'+
                                '<td>Rp ' + formatRupiah(response.data.daftar_produk[i].harga_satuan) + '</td>'+
                                '<td>'+
                                    '<span>0%</span>'+
                                    '<small>Tidak ada</small>'+
                                '</td>'+
                                '<td>Tidak ada</td>'+
                                '<td>Rp ' + formatRupiah(response.data.daftar_produk[i].harga_satuan * response.data.daftar_produk[i].qty) + '</td>'+
                            '</tr>');
                        }

                        $('#inv-subtotal').text('Rp ' + formatRupiah(response.data.jumlah_tagihan));
                        $('#inv-ppn').text('Rp ' + formatRupiah(response.data.ppn));
                        $('#inv-jumlah').text('Rp ' + formatRupiah(response.data.ppn + response.data.jumlah_tagihan));
                        $('#inv-uang-muka').text('Rp ' + formatRupiah(response.data.uang_muka));
                        $('#inv-diskon').text('Rp ' + formatRupiah(response.data.diskon));
                        $('#inv-total').text('Rp ' + formatRupiah(response.data.jumlah_bayar));

                        console.log(response.data.uang_muka);

                        $('#invoice').toggle();
                    }
                }
            })
        })

        $('.invoice-btn-cancel').click(function() {
            $('#invoice').toggle();
        })
    } );
</script>
@endsection