@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
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

        <div class="d-inline-flex align-middle cs-wrap-filter">
            <div class="cs-filter-date">
                <input type="text" name="daterange" value="2022-07-07 ~ 2022-07-07" />
                <img class="icon" src="{{ URL::asset('img/icon-filter-date.svg') }}" alt="" />
            </div>

            <div class="input-group cs-filter-product">
                <span class="input-group-text" id="filter-product">Produk :</span>
                <select class="form-select" aria-label="filter-product">
                    <option selected>All</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

            <div class="cs-filter-button">
                <button type="button" class="btn bg-success text-white text-uppercase">
                    <span>Filter</span>
                </button>
            </div>
        </div>

        <table id="daftarPelanggan" class="display cs-tables">
            <thead>
                <tr>
                    <th style="width: 80px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkAllRows">
                        </div>  
                    </th>
                    <th>Tanggal Bergabung</th>
                    <th>Pelanggan</th>
                    <th>Tipe Pelanggan</th>
                    <th>Status Berlangganan</th>
                    <th>Status Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkItem1">
                        </div>
                    </td>
                    <td>08-08-2022</td>
                    <td>
                        <strong>Nico</strong>
                        <p>089878636343</p>
                    </td>
                    <td>Retail</td>
                    <td>
                        <span class="cs-badge secondary">Tidak Aktif</span>
                    </td>
                    <td>
                        <label class="cs-switch">
                            <input type="checkbox">
                            <span class="cs-slider cs-round"></span>
                        </label>
                    </td>
                    <td>
                        <a href="#" class="cs-btn-icon primary">
                            <img src="{{ URL::asset('img/icon-btn-send.svg') }}" alt="" />
                        </a>
                        <a href="#" class="cs-btn-icon warning">
                            <img src="{{ URL::asset('img/icon-btn-pencil.svg') }}" alt="" />
                        </a>
                        <a href="#" class="cs-btn-icon danger">
                            <img src="{{ URL::asset('img/icon-btn-trash.svg') }}" alt="" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkItem1">
                        </div>
                    </td>
                    <td>08-08-2022</td>
                    <td>
                        <strong>Nico</strong>
                        <p>089878636343</p>
                    </td>
                    <td>Retail</td>
                    <td>
                        <span class="cs-badge success">Aktif</span>
                    </td>
                    <td>
                        <label class="cs-switch">
                            <input type="checkbox">
                            <span class="cs-slider cs-round"></span>
                        </label>
                    </td>
                    <td>
                        <a href="#" class="cs-btn-icon primary">
                            <img src="{{ URL::asset('img/icon-btn-send.svg') }}" alt="" />
                        </a>
                        <a href="#" class="cs-btn-icon warning">
                            <img src="{{ URL::asset('img/icon-btn-pencil.svg') }}" alt="" />
                        </a>
                        <a href="#" class="cs-btn-icon danger">
                            <img src="{{ URL::asset('img/icon-btn-trash.svg') }}" alt="" />
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            startDate: moment(),
            endDate: moment(),
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
        $('#daftarPelanggan').DataTable({
            dom: 'lBfrtip',
            lengthMenu: [ 2, 5, 10, 25, 50, 75, 100 ],
            buttons: [
                'excel'
            ]
        });

        $('.cs-wrap-filter .icon').click(function(e) {
            e.preventDefault();

            $(this).prevAll('input[name="daterange"]').click();
        })
    } );
</script>
@endsection