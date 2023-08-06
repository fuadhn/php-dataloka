@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/inbox.css') }}">
@endsection

@section('content')
<div class="bg-white cs-wrap-content">
    <div>
        <div class="d-inline-block w-100 align-middle cs-content-header">
            <div class="float-start">
                <div class="cs-content-title">
                    <h2 class="text-uppercase">Chat & Inbox</h2>
                </div>
            </div>
        </div>

        <p>Route ini nantinya akan digunakan untuk menghandle pengiriman ulang invoice <strong>{{ $nomor_invoice }}</strong> kepada <strong>{{ $user }}</strong> akun.</p>
    </div>
</div>
@endsection