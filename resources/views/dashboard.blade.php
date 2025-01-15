@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
    <h4 class="card-title mb-4">Selamat Datang <span class="fw-bold">{{ auth()->user()->name; }}</span> 🎉</h4>
    <p class="mb-0">Mari kita Lanjut kerja sampai jadi boss muda 😎</p>
    <p></p>
    <a href="javascript:;" class="btn btn-primary">Penjualan</a>
@endsection