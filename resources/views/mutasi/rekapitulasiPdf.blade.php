<table class="" id="" border="1" width="100%" cellspacing="0">
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