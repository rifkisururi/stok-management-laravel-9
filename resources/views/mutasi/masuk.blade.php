
<?php 
    session_start();
    $userLogin = $_SESSION["userLogin"];
?>
@extends('template/sbadmin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Mutasi Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="row">
                <label class="col-1" style="text-align:right;">Mulai</label>
                <input type="date" class="form-control col-2 mulai">
                <label class="col-1" style="text-align:right;">Selesai</label>
                <input type="date"  class="form-control col-2 selesai">
                <button class="btn btn-primary filterData">Filter data</button>
            </div>
            <br>
            <table class="table table-bordered tblBarang" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden>Id Barang</th>
                        <th>Kode</th>
                        <th>Nama barang</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $dt)
                        <tr class="tr_{{$dt->id}}">
                            <td class="id_barang" hidden>{{$dt->id_barang}}</td>
                            <td class="kode">{{$dt->kode}}</td>
                            <td class="nama">{{$dt->nama}}</td>
                            <td class="tanggal">{{$dt->tanggal}}</td>
                            <td class="jumlah">{{$dt->jumlah}}</td>
                            <td class="harga">{{$dt->harga}}</td>
                            <?php
                                echo "<td>".$dt->harga*$dt->jumlah."</td>";
                            ?>
                            <td class="category">{{$dt->category}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="js/mutasibarang.js?date=<?php echo floor(microtime(true) * 1000)?>")></script>
<script>
    var canCreate = false;
    var barang = <?php echo $barang ?>;
</script>
@endsection