$(document).ready(function() {
    $(".dataTables_length label").before("<button class='btn btn-primary' id='btnAdd'>Tambah Data </button>  ");
} );

$(document).on("click", "#add", function(){
    $(".tblBarang tbody").prepend(`
        <tr>
            <td><input type="text" class="form-control kode"></td>
            <td><input type="text" class="form-control nama"></td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btnSave">Simpan</button>
                <button class="btn btn-danger btnCancel">Batal</button>
            </td>
        </tr>
    `);
});