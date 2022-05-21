$(document).ready(function(){
    $(".dataTables_length label").before("<button class='btn btn-primary' id='add'>Tambah</button>");
});

// ketika tombol tambah ditekan 
$(document).on("click", "#add", function(){
    var id = makeid(10);
    drBarang = makeDropdownBarang();
    $(".tblBarang tbody").prepend(`
        <tr class="tr_${id}">
            <td></td>
            <td>
                <select class="form-control id_barang">
                    ${drBarang}
                </select>
            </td>
            <td><input type="date" class="form-control tanggal"></td>
            <td><input type="number" min="0" class="form-control jumlah"></td>
            <td><input type="number" min="0" class="form-control harga"></td>
            <td>
                <select class="form-control category">
                    <option value="Masuk">Masuk</option>
                    <option value="Keluar">Keluar</option>
                </select>            
            </td>
            <td>
                <button class="btn btn-primary btnSave" id="btnSave_${id}">Simpan</button>
                <button class="btn btn-danger btnCancel" id="btnCancel_${id}">Batal</button>
            </td>
        </tr>
    `);
});

// ketika tombol cancel di tekan
$(document).on("click", ".btnCancel", function(){
    var classTr = $(this).attr("id").replace("btnCancel_","tr_");
    $("."+classTr).remove();
});

// ketika tombol save ditekan
$(document).on("click", ".btnSave", function(){
    var id = $(this).attr("id").replace("btnSave_","");
    var data = getData(id);
    console.log(data);

    // aksi buat kirim data ke controller
    $.ajax({
        url : "mutasibarang/store",
        type : "POST",
        data : data,
        success:function(respond){
            console.log(respond);
            var htmlNewRecore = `
            <tr class="tr_${respond.id}">
                <td class="kode">${respond.kode}</td>
                <td class="id_barang" hidden>${data.id_barang}</td>
                <td class="nama">${respond.nama}</td>
                <td class="tanggal">${data.tanggal}</td>
                <td class="jumlah">${data.jumlah}</td>
                <td class="harga">${data.harga}</td>
                <td class="category">${data.category}</td>
                <td>
                    <button class="btn btn-warning btn-sm btnEdit" id="brg_${respond.id}">Edit</button>
                </td>
            </tr>
            `;
            // <button class="btn btn-danger btn-sm btnHapus" id="brg_${respond.id}">Hapus</button>
            $(`tbody`).prepend(htmlNewRecore);
            $('.tr_'+id).remove();
        },
        error:function(){
            alert("terjadi kesalahan");
        }
    })
});

function getData(classTr){
    data = new Object();
    data.id = classTr;
    data.id_barang = $(`.tr_${classTr} .id_barang`).val();
    data.namaBarang = $(`.tr_${classTr} .id_barang option:selected`).text();
    data.tanggal =  $(`.tr_${classTr} .tanggal`).val();
    data.jumlah =  $(`.tr_${classTr} .jumlah`).val();
    data.category =  $(`.tr_${classTr} .category`).val();
    data.harga =  $(`.tr_${classTr} .harga`).val();
    data._token = $('meta[name="csrf-token"]').attr('content');
    return data;
}


function getDataFromRecord(classTr){
    data = new Object();
    data.id = classTr;
    data.id_barang = $(`.tr_${classTr} .id_barang`).html();
    data.namaBarang = $(`.tr_${classTr} .id_barang option:selected`).text();
    data.tanggal =  $(`.tr_${classTr} .tanggal`).html();
    data.jumlah =  $(`.tr_${classTr} .jumlah`).html();
    data.category =  $(`.tr_${classTr} .category`).html();
    data.harga =  $(`.tr_${classTr} .harga`).html();
    data._token = $('meta[name="csrf-token"]').attr('content');
    return data;
}

$(document).on("click", ".btnEdit", function(){
    var classTr = $(this).attr("id").replace("brg_","");
    var data = getDataFromRecord(classTr);
    drBarang = makeDropdownBarang();
    console.log(data);

    var htmlFormEdit = `
        <tr class="tr_${data.id} formEdit_${data.id}">
            <td></td>
            <td>
                <select class="form-control id_barang">
                    ${drBarang}
                </select>
            </td>
            <td><input type="date" class="form-control tanggal" value="${data.tanggal}"></td>
            <td><input type="text" class="form-control jumlah" value="${data.jumlah}"></td>
            <td><input type="text" class="form-control harga" value="${data.harga}"></td>
            <td>
                <select class="form-control category">
                    <option value="Masuk">Masuk</option>
                    <option value="Keluar">Keluar</option>
                </select>
            </td>
            <td>
                <button class="btn btn-primary btnSaveEdit" id="btnSave_${data.id}">Update</button>
                <button class="btn btn-danger btnCancelEdit" id="btnCancel_${data.id}">Batal</button>
            </td>
        </tr>
        `;
    $(`.tr_${data.id}`).hide();
    $(`.tr_${data.id}`).before(htmlFormEdit);
    $(`.tr_3 .id_barang`).val(data.id_barang).change();
    $(`.tr_3 .category`).val(data.category).change();
});

// cancel edit
$(document).on("click", ".btnCancelEdit", function(){
    var id = $(this).attr("id").replace("btnCancel_","");
    $(`.formEdit_${id}`).remove();
    $(`.tr_${id}`).show();
});

// action update 
$(document).on("click", ".btnSaveEdit", function(){
    var id = $(this).attr("id").replace("btnSave_","");
    var data = getData(id);
    console.log(data);

    // aksi buat kirim data ke controller
    $.ajax({
        url : "mutasibarang/update",
        type : "POST",
        data : data,
        success:function(respond){
            console.log(respond);
            var htmlNewRecore = `
            <tr class="tr_${data.id}">
                <td class="id_barang" hidden>${data.id_barang}</td>
                <td class="kode">${respond.kode}</td>
                <td class="nama">${respond.nama}</td>
                <td class="tanggal">${data.tanggal}</td>
                <td class="jumlah">${data.jumlah}</td>
                <td class="harga">${data.harga}</td>
                <td class="category">${data.category}</td>
                <td>
                    <button class="btn btn-warning btn-sm btnEdit" id="brg_${respond.id}">Edit</button>
                    
                </td>
            </tr>
            `;
            // <button class="btn btn-danger btn-sm btnHapus" id="brg_${respond.id}">Hapus</button>
            $(`tbody`).prepend(htmlNewRecore);
            $('.formEdit_'+id).remove();
        },
        error:function(){
            alert("terjadi kesalahan");
        }
    })
});

// hapus data
$(document).on("click", ".btnHapus", function(){
    var id = $(this).attr("id").replace("brg_","");
    var data = getData(id);

    $.ajax({
        url : "mutasibarang/hapus",
        type : "POST",
        data : data,
        success:function(respond){
            console.log(respond);
            $('.tr_'+id).remove();
        },
        error:function(){
            alert("terjadi kesalahan");
        }
    })
});

function makeDropdownBarang(){
    var dr = "";
    for(var i = 0; i< barang.length; i++){
        dr += `<option value='${barang[i].id}'>${barang[i].kode} - ${barang[i].nama}</option>`;
    }

    return dr;
}


$(document).on("click", ".filterData", function(){
    var mulai = $(".mulai").val();
    var selesai = $(".selesai").val();
    window.location.href = `http://localhost:8000/mutasibarang?mulai=${mulai}&selesai=${selesai}`;
});