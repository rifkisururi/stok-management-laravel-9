<?php 
    session_start();
    $userLogin = $_SESSION["userLogin"];
?>
@extends('template/sbadmin')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered tblBarang" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dt)
                        <tr class="tr_{{$dt->id}}">
                            <td class="kode">{{$dt->kode}}</td>
                            <td class="nama">{{$dt->nama}}</td>
                            <td class="stok">{{$dt->masuk}}</td>
                            <td class="stok">{{$dt->keluar}}</td>
                            <td class="stok">{{$dt->stok}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="js/barang.js"></script>
<script>
    var canCreate = true;
</script>
@endsection