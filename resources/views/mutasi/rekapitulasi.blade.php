<?php 
    session_start();
    $userLogin = $_SESSION["userLogin"];
?>
@extends('template/sbadmin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rekapitulsi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered tblBarang" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Pembelian</th>
                        <th>Penjualan</th>
                        <th>Laba</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dt)
                        <tr class="">
                            <td class="kode">{{$dt->nama}}</td>
                            <td class="nama">{{$dt->pembelian}}</td>
                            <td class="tanggal">{{$dt->penjualan}}</td>
                            <?php
                                echo "<td>".$dt->penjualan-$dt->pembelian."</td>";
                            ?>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('js')

@endsection