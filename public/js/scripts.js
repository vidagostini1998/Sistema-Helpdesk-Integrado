//Reset Form
function reset() {
    document.getElementById('form_adc_patrimonio').reset();
}

//Usuario
$(document).on('click', '.modal_edit_usuario', function () {
    var id = $(this).val();
    $.get('/administracao/users/edit/' + id, function (data) {
        //success data
        //console.log(data);
        $('#id').val(data.id);
        $('#nome').val(data.nome);
        $('#email').val(data.email);
        $('#img_perfil').attr('src', 'http://sistema-iap.test/img/profiles/' + data.foto_perfil + '')
        $('#myModal').modal('show');
    })
});

function edit_user() {
    let form = document.getElementById('form_edit');
    form.submit();
}

function adc_user() {
    let form = document.getElementById('form_adc');
    form.submit();
}
//

//Permissões
$(document).on('click', '#modal_perm', function () {
    var id = $(this).val();
    $.get('/administracao/users/edit/' + id, function (data_perm) {
        //success data
        //console.log(data_perm);
        $('#id_perm').val(data_perm.id);
        $('#nome_perm').val(data_perm.nome);
        $('#permModal').modal('show');
    })
});
//

//Filial
$(document).on('click', '#modal_edit_filial', function () {
    var id = $(this).val();
    $.get('/cadastros/filiais/edit/' + id, function (data_filial) {
        //success data
        console.log(data_filial);
        $('#id_filial').val(data_filial.id);
        $('#nome_filial').val(data_filial.nome_filial);
        $('#filialModal').modal('show');
    })
});

function adc_filial() {
    let form = document.getElementById('form_adc');
    form.submit();
}

function edit_filial() {
    let form = document.getElementById('form_edit');
    form.submit();
}
//

//Local
$(document).on('click', '#modal_edit_local', function () {
    var id = $(this).val();
    $.get('/cadastros/locals/edit/' + id, function (data_local) {
        //success data
        //console.log(data_local);
        $('#id_local').val(data_local.id);
        $('#nome_local').val(data_local.nome_local);
        $('#localModal').modal('show');
    })
});

function edit_local() {
    let form = document.getElementById('form_edit');
    form.submit();
}

function adc_local() {
    let form = document.getElementById('form_adc');
    form.submit();
}
//

//Categoria Patrimonio
$(document).on('click', '#modal_edit_cate_patri', function () {
    var id = $(this).val();
    $.get('/cadastros/categorias/edit_patri/' + id, function (data_patri) {
        //success data
        //console.log(data_patri);
        $('#id_cate_patri').val(data_patri.id);
        $('#nome_cate_patri').val(data_patri.nome_cate_patrimonio);
        $('#categoriaPatrimonioModal').modal('show');
    })
});

function edit_cate_patri() {
    let form = document.getElementById('form_edit_patri');
    form.submit();
}

function adc_cate_patri() {
    let form = document.getElementById('form_adc_patri');
    form.submit();
}
//

//Categoria Insumo
$(document).on('click', '#modal_edit_cate_insu', function () {
    var id = $(this).val();
    $.get('/cadastros/categorias/edit_insu/' + id, function (data_insu) {
        //success data
        //console.log(data_insu);
        $('#id_cate_insu').val(data_insu.id);
        $('#nome_cate_insu').val(data_insu.nome_cate_insumos);
        $('#categoriaInsumoModal').modal('show');
    })
});

function edit_cate_insu() {
    let form = document.getElementById('form_edit_insu');
    form.submit();
}

function adc_cate_insu() {
    let form = document.getElementById('form_adc_insu');
    form.submit();
}
//

//Patrimonio
function adc_patrimonio() {
    let form = document.getElementById('form_adc_patrimonio');
    form.submit();
}

function edit_patrimonio() {
    let form = document.getElementById('form_edit_patrimonio');
    form.submit();
}

$(document).on('click', '#modal_edit_patrimonio', function () {
    
    var id = $(this).val();
    $.get('/cadastros/patrimonios/edit_patrimonio/' + id, function (data_patrimonio) {
        //success data
        //console.log(data_patrimonio);
        //Mandando dados para modal
        $('#id_patri').val(data_patrimonio[0].id);
        $('#id_patrimonio').val(data_patrimonio[0].id);
        $('#patrimonio_patri').val(data_patrimonio[0].patrimonio);
        $('#nome_patri').val(data_patrimonio[0].nome);
        $('#marca_patri').val(data_patrimonio[0].marca);
        $('#modelo_patri').val(data_patrimonio[0].modelo);
        $('#n_serie_patri').val(data_patrimonio[0].n_serie);
        $('#fornecedor_patri').val(data_patrimonio[0].fornecedor);
        $('#ref_patri').text(data_patrimonio[0].ref);
        $('#obs_patrimonio_patri').text(data_patrimonio[0].obs_patrimonio);
        $('#preventiva').val(data_patrimonio[0].manut_preventiva);
        $('#local_patri').val(data_patrimonio[0].id_local);
        $('#categoria_patri').val(data_patrimonio[0].id_categoria);
        $('#filial_patri').val(data_patrimonio[0].id_filial);
        $("#table tr td").remove();
        //

        //Inserindo dados na tabela Situação
        let tbody = document.getElementById('tbody');
        for(let i = 0;i < data_patrimonio[1].length;i++){
            let tr = tbody.insertRow();
            let td_data=tr.insertCell();
            let td_motivo=tr.insertCell();
            let td_adc=tr.insertCell();
            let td_btn=tr.insertCell();

            td_data.innerText = data_patrimonio[1][i].data_situacao;
            td_motivo.innerText = data_patrimonio[1][i].motivo_situacao;
            td_adc.innerText = data_patrimonio[1][i].nome;
            td_btn.innerHTML = "<button type='button' class='btn btn-warning'><i class='fa-solid fa-pen-to-square'></i></button> <button type='button' class='btn btn-danger'><i class='fa-solid fa-trash'></i></button>";
        }
        //

        $('#editModal').modal('show');
    })
});
//


//Manutenção

//