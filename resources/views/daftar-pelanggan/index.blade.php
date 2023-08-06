@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/daterangepicker.css') }}" />

<link rel="stylesheet" href="{{ URL::asset('css/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/buttons.dataTables.min.css') }}" />

<link rel="stylesheet" href="{{ URL::asset('css/daftar-pelanggan.css') }}">
@endsection

@section('content')
<div class="bg-white cs-wrap-content">
    <div>
        <div class="d-inline-block w-100 align-middle cs-content-header">
            <div class="float-start">
                <div class="cs-content-title">
                    <h2 class="text-uppercase">Daftar Pelanggan</h2>
                </div>
            </div>
            <div class="float-end">
                <div class="cs-add-pelanggan">
                    <button type="button" class="btn bg-dark text-white text-uppercase">
                        <img class="icon" src="{{ URL::asset('img/icon-add-pelanggan.svg') }}" alt="" />
                        <span>Create Pelanggan</span>
                    </button>
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

                <div class="cs-filter-button">
                    <button type="submit" class="btn bg-success text-white text-uppercase">
                        <span>Filter</span>
                    </button>
                </div>
            </div>
        </form>

        <div class="d-inline-block w-100 align-middle" style="margin-bottom: -64px; z-index: 10; position: relative;">
            <div class="input-group cs-search-table float-start">
                <input type="text" class="form-control" placeholder="No Invoice / Nama Pelanggan" aria-label="No Invoice / Nama Pelanggan" aria-describedby="basic-addon2" autocomplete="off">
                <span class="input-group-text" id="basic-addon2">
                    <img class="icon" src="{{ URL::asset('img/icon-search-white.svg') }}" alt="" />
                    <span class="label">CARI</span>
                </span>
            </div>
            
            <div class="cs-additional-button float-end">
                <div class="dropdown d-inline-flex cs-dropdown-filter">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="icon" src="{{ URL::asset('img/icon-dropdown-filter.svg') }}" alt="" />
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Status Berlangganan</a></li>
                        <li><input type="radio" name="filter_status_berlangganan" value="" style="margin-left: 14px;" checked="checked" autocomplete="off" />&nbsp;Semua</li>
                        <li><input type="radio" name="filter_status_berlangganan" value="sb:aktif" style="margin-left: 14px;" autocomplete="off" />&nbsp;Aktif</li>
                        <li><input type="radio" name="filter_status_berlangganan" value="sb:tidak aktif" style="margin-left: 14px;" autocomplete="off" />&nbsp;Tidak Aktif</li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#">Status Akun</a></li>
                        <li><input type="radio" name="filter_status_akun" value="" style="margin-left: 14px;" checked="checked" autocomplete="off" />&nbsp;Semua</li>
                        <li><input type="radio" name="filter_status_akun" value="st:aktif" style="margin-left: 14px;" autocomplete="off" />&nbsp;Aktif</li>
                        <li><input type="radio" name="filter_status_akun" value="st:suspend" style="margin-left: 14px;" autocomplete="off" />&nbsp;Tidak Aktif</li>
                    </ul>
                </div>

                <div class="dropdown d-inline-flex cs-dropdown-export">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="icon" src="{{ URL::asset('img/icon-dropdown-export.svg') }}" alt="" />
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item cs-buttons-excel" href="#">Excel</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <table id="daftarPelanggan" class="display cs-tables">
            <thead>
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkAllRows" autocomplete="off">
                        </div>  
                    </th>
                    <th class="exportable">Invoice</th>
                    <th>Status</th>
                    <th>Status</th>
                    <th class="exportable">Tanggal Bergabung</th>
                    <th class="exportable">Pelanggan</th>
                    <th class="exportable">Tipe Pelanggan</th>
                    <th class="exportable">Status Berlangganan</th>
                    <th class="exportable">Status Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($pelanggan)
                @foreach ($pelanggan as $row)
                @if (!is_null($row->berlangganan_produk))
                <tr id="rowId{{ $row->ID_PELANGGAN }}">
                    <td>
                        <div class="form-check">
                            <input class="form-check-input cs-check-item" type="checkbox" value="{{ $row->ID_PELANGGAN }}" id="checkItem1" autocomplete="off">
                        </div>
                    </td>
                    <td>{{ get_invoice($row->berlangganan_produk->ID_BERLANGGANAN) }}</td>
                    <td>st:{{ $row->STATUS_AKUN }}</td>
                    <td>sb:{{ time() >= strtotime($row->berlangganan_produk->TANGGAL_MULAI) && time() <= strtotime($row->berlangganan_produk->TANGGAL_AKHIR) ? 'aktif' : 'tidak aktif' }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->berlangganan_produk->TANGGAL_MULAI)) }}</td>
                    <td>
                        <strong>{{ $row->NAMA_PELANGGAN }}</strong>
                        <p>{{ $row->NO_HP }}</p>
                    </td>
                    <td>{{ ($row->STATUS_PELANGGAN == 'b2b' ? 'Institusi' : 'Retail') }}</td>
                    <td>
                        @if(time() >= strtotime($row->berlangganan_produk->TANGGAL_MULAI) && time() <= strtotime($row->berlangganan_produk->TANGGAL_AKHIR))
                        <span class="cs-badge success">Aktif</span>
                        @else
                        <span class="cs-badge secondary">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        <label class="cs-switch">
                            <input type="checkbox" class="cs-toggle-status" autocomplete="off" data-id="{{ $row->ID_PELANGGAN }}" {{ ($row->STATUS_AKUN == 'aktif' ? 'checked="checked"' : '') }}>
                            <span class="cs-slider cs-round"></span>
                            <span style="opacity: 0;">{{ $row->STATUS_AKUN }}</span>
                        </label>
                    </td>
                    <td>
                        <a href="{{ route('inbox.search', $row->ID_PELANGGAN) }}" class="cs-btn-icon primary">
                            <img src="{{ URL::asset('img/icon-btn-send.svg') }}" alt="" />
                        </a>
                        <a href="{{ route('profil_pelanggan.index', $row->ID_PELANGGAN) }}" class="cs-btn-icon warning">
                            <img src="{{ URL::asset('img/icon-btn-pencil.svg') }}" alt="" />
                        </a>
                        <a href="#" class="cs-btn-icon danger cs-delete-pelanggan" data-id="{{ $row->ID_PELANGGAN }}">
                            <img src="{{ URL::asset('img/icon-btn-trash.svg') }}" alt="" />
                        </a>
                    </td>
                </tr>
                @endif
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
        <form action="{{ route('daftar_pelanggan.bulk') }}" method="POST">
            @csrf
            <input type="hidden" name="ids_pelanggan" value="" autocomplete="off">
            <div class="d-inline-flex align-middle w-100 cs-footer-form">
                <div class="cs-label">
                    <span>Apply to selected</span>
                </div>

                <select name="aksi" class="form-select" aria-label="Bulk Actions" style="max-width: 150px; margin-right: 21px;" autocomplete="off" required="required">
                    <option value="" selected>Status akun</option>
                    <option value="aktif">Aktifkan</option>
                    <option value="suspend">Nonaktifkan</option>
                    <option value="delete">Hapus</option>
                </select>

                <div class="cs-filter-button">
                    <button type="submit" class="btn bg-success text-white text-uppercase">
                        <span>Apply</span>
                    </button>
                </div>
            </div>
        </form>
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
                            <input type="text" class="form-control" id="nama_lengkap" value="">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" value="">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" value="">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="no_hp" class="col-sm-3 col-form-label">No Hp</label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control" id="no_hp" value="">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="L">
                                <label class="form-check-label" for="inlineRadio1">Pria</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="P">
                                <label class="form-check-label" for="inlineRadio2">Wanita</label>
                            </div>
                              
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="ttl" class="col-sm-3 col-form-label">Tempat & Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="tempat_lahir" value="">
                                </div>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="tanggal_lahir" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="alamat" value="">
                        </div>
                    </div>
                    <div class="row kyc-form-row">
                        <label for="kota" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kota" value="">
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
                                <option value="pelanggan">Perorangan</option>
                                <option value="mitra">Mitra</option>
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
                            <button type="button" class="btn bg-dark text-white text-uppercase kyc-btn-reset-password">
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
                                <img src="" alt="" class="kyc-preview-image">
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
        var _table = $('#daftarPelanggan').DataTable({
            columnDefs: [
                {
                    target: 1,
                    visible: false
                },
                {
                    target: 2,
                    visible: false
                },
                {
                    target: 3,
                    visible: false
                }
            ],
            dom: 'lBfrtip',
            lengthMenu: [ 2, 5, 10, 25, 50, 75, 100 ],
            iDisplayLength: 10,
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: 'th.exportable'
                    }
                }
            ]
        });

        $('.cs-wrap-filter .icon').click(function(e) {
            e.preventDefault();

            $(this).prevAll('input[name="daterange"]').click();
        })

        $('.cs-search-table input').keyup(function() {
            _table.search( $(this).val() ).draw();
        })

        $('input[name="filter_status_berlangganan"]').on('change', (function() {
            _table.columns(3).search($('input[name="filter_status_berlangganan"]:checked').val()).draw();
        }))

        $('input[name="filter_status_akun"]').on('change', (function() {
            _table.columns(2).search($('input[name="filter_status_akun"]:checked').val()).draw();
        }))

        $('.cs-buttons-excel').click(function(e) {
            e.preventDefault();

            $('.buttons-excel').click();
        })

        var update_ids_pelanggan = function() {
            var _ids = [];

            $('.cs-check-item:checked').each(function() {
                _ids.push($(this).val());
            })

            var _str_ids = _ids.join(':');
            
            $('input[name="ids_pelanggan"]').val(_str_ids);
        }

        $('.cs-check-item').on('change', (function() {
            update_ids_pelanggan();
        }))

        $('#checkAllRows').click(function() {
            if($(this).prop('checked')) {
                $('.cs-check-item').prop('checked', true);
            } else {
                $('.cs-check-item').prop('checked', false);
            }

            update_ids_pelanggan();
        })

        $('.cs-toggle-status').on('change', (function() {
            var _url = "{{ route('api.update_status_akun') }}";
            var _id_pelanggan = $(this).data('id');
            var _status_akun = ($(this).prop('checked') ? 'aktif' : 'suspend');

            $.ajax({
                method: 'PUT',
                url: _url,
                data: 'id_pelanggan=' + _id_pelanggan + '&status_akun=' + _status_akun,
                dataType: 'json',
                processData: false,
                success: function(response) {
                    // Silent is gold
                    console.log(response); // this is for debug only
                }
            })
        }))

        $('.cs-delete-pelanggan').on('click', (function(e) {
            e.preventDefault();

            var _url = "{{ route('api.delete_pelanggan') }}";
            var _id_pelanggan = $(this).data('id');
            var _confirm = confirm('Apakah Anda yakin ingin menghapus pelanggan ini?');

            if(_confirm) {
                $.ajax({
                    method: 'DELETE',
                    url: _url,
                    data: 'id_pelanggan=' + _id_pelanggan,
                    dataType: 'json',
                    processData: false,
                    success: function(response) {
                        // Silent is gold
                        console.log(response); // this is for debug only

                        $('#rowId' + _id_pelanggan).remove();
                    }
                })
            } else {
                // Silent is gold
            }
        }))

        $('.cs-add-pelanggan button').click(function() {
            $('#kyc-pelanggan').toggle();
        })
        
        // KYC
        $('.kyc-media-pencil').click(function() {
            var _preview_id = $(this).data('id');

            $('#' + _preview_id + ' .kyc-preview-file').click();
        })

        $('.kyc-preview-file').on('change', (function() {
            var _preview_id = $(this).data('id');
            
            var file = $(this).get(0).files[0];
            
            if(file){
                var reader = new FileReader();
                
                reader.onload = function(){
                    $("#" + _preview_id + ' .kyc-preview-image').attr("src", reader.result);
                }
                
                reader.readAsDataURL(file);
            }
        }))

        $('.kyc-btn-cancel').click(function() {
            $('#kyc-pelanggan').toggle();
        })
        // KYC
    } );
</script>
@endsection