$(document).ready(function(){
    if(canCreate == true && role == "admin"){
        $(".dataTables_length label").before("<button class='btn btn-primary' id='add'>Tambah</button>");
    }
});

// ketika tombol tambah ditekan 
$(document).on("click", "#add", function(){
    var id = makeid(10);
    $(".tblBarang tbody").prepend(`
        <tr class="tr_${id}">
            <td><input type="text" class="form-control kode"></td>
            <td><input type="text" class="form-control nama"></td>
            <td>0</td>
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


$(document).on("click", ".btnSave", function(){
    var id = $(this).attr("id").replace("btnSave_","");
    var data = getData(id);
    console.log(data);

    // aksi buat kirim data ke controller
    $.ajax({
        url : "barang/store",
        type : "POST",
        data : data,
        success:function(respond){
            console.log(respond);
            var htmlNewRecore = `
            <tr class="tr_${respond.last_insert_id}">
                <td class="kode">${data.kode}</td>
                <td class="nama">${data.nama}</td>
                <td class="stok">0</td>
                <td>
                    <button class="btn btn-warning btn-sm btnEdit" id="brg_${respond.last_insert_id}">Edit</button>
                    <button class="btn btn-danger btn-sm btnHapus" id="brg_${respond.last_insert_id}">Hapus</button>
                </td>
            </tr>
            `;
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
    data.kode = $(`.tr_${classTr} .kode`).val();
    data.nama =  $(`.tr_${classTr} .nama`).val();
    data.stok =  0;//$(`.tr_${classTr} .stok`).val();
    data._token = $('meta[name="csrf-token"]').attr('content');
    return data;
}


function getDataFromRecord(classTr){
    data = new Object();
    data.id = classTr;
    data.kode = $(`.tr_${classTr} .kode`).html().trim();
    data.nama =  $(`.tr_${classTr} .nama`).html().trim()
    data.stok =  $(`.tr_${classTr} .stok`).html().trim()
    data._token = $('meta[name="csrf-token"]').attr('content');
    return data;
}

$(document).on("click", ".btnEdit", function(){
    var classTr = $(this).attr("id").replace("brg_","");
    var data = getDataFromRecord(classTr);
    console.log(data);

    var htmlFormEdit = `
        <tr class="tr_${data.id} formEdit_${data.id}">
            <td><input type="text" class="form-control kode" value="${data.kode}"></td>
            <td><input type="text" class="form-control nama" value="${data.nama}"></td>
            <td><input type="text" class="form-control stok" value="${data.stok}" readonly></td>
            <td>
                <button class="btn btn-primary btnSaveEdit" id="btnSave_${data.id}">Update</button>
                <button class="btn btn-danger btnCancelEdit" id="btnCancel_${data.id}">Batal</button>
            </td>
        </tr>
        `;
    $(`.tr_${data.id}`).addClass("old");
    $(`.tr_${data.id}`).hide();
    $(`.tr_${data.id}`).before(htmlFormEdit);
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
        url : "barang/update",
        type : "POST",
        data : data,
        success:function(respond){
            console.log(respond);
            var htmlNewRecore = `
            <tr class="tr_${data.id}">
                <td class="kode">${data.kode}</td>
                <td class="nama">${data.nama}</td>
                <td class="stok">${data.stok}</td>
                <td>
                    <button class="btn btn-warning btn-sm btnEdit" id="brg_${data.id}">Edit</button>
                    <button class="btn btn-danger btn-sm btnHapus" id="brg_${data.id}">Hapus</button>
                </td>
            </tr>
            `;
            $('.formEdit_'+ id).after(htmlNewRecore);
            $('.formEdit_'+id).remove();
            $('.tr_'+id + '.old').remove();
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
        url : "barang/hapus",
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