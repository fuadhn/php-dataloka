@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

<link rel="stylesheet" href="{{ URL::asset('css/profil-pelanggan.css') }}">
@endsection

@section('content')
<div class="bg-white cs-wrap-content">
    <div>
        <div class="d-inline-block w-100 align-middle cs-content-header">
            <div class="float-start">
                <div class="cs-content-title">
                    <h2 class="text-uppercase">Daftar Transaksi</h2>
                </div>
            </div>
        </div>

        <div class="d-inline-block w-100 align-middle" style="margin-bottom: -64px; z-index: 10; position: relative;">
            <div class="input-group cs-search-table float-start">
                <input type="text" class="form-control" placeholder="No Invoice" aria-label="No Invoice" aria-describedby="basic-addon2" autocomplete="off">
                <span class="input-group-text" id="basic-addon2">
                    <img class="icon" src="{{ URL::asset('img/icon-search-white.svg') }}" alt="" />
                    <span class="label">CARI</span>
                </span>
            </div>
        </div>

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
                        <a href="#" class="cs-resend-invoice">
                            <span>Kirim Ulang</span>
                        </a>
                    </td>
                    <td>{{ date('d-m-Y', strtotime($row->TANGGAL_TAGIHAN)) }}</td>
                    <td>{{ get_jenis_pembayaran($row->ID_TAGIHAN) }}</td>
                    <td>
                        <a href="#" class="cs-list-produk">
                            <img src="{{ URL::asset('img/icon-list-produk.svg') }}" alt="" />
                            <span>Lihat Daftar</span>
                        </a>
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
@endsection

@section('js')
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

        $('.cs-search-table input').keyup(function() {
            _table.columns(1).search( $(this).val() ).draw();
        })
    } );
</script>
@endsection