$(document).ready(function(){
    $(".dataTables_length label").before("<button class='btn btn-primary' id='add'>Tambah</button>");
});

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

$(document).on("click", ".btnCancel", function(){
    var classTr = $(this).attr("id").replace("btnCancel_","tr_");
    $("."+classTr).remove();
});


$(document).on("click", ".btnSave", function(){
    var id = $(this).attr("id").replace("btnSave_","");
    var data = getData(id);
    console.log(data);

    // aksi buat kirim data ke controller
});

function getData(classTr){
    data = new Object();
    data.id = classTr;
    data.kode = $(`.tr_${classTr} .kode`).val();
    data.nama =  $(`.tr_${classTr} .nama`).val();;

    return data;
}