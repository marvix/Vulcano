$(document).ready(function() {
    $('#table-roles').DataTable({
        paging: false,
        info: false,
        searching: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
        columns: [
            { name: 'ID' },
            { name: 'Chave' },
            { name: 'Descrição' },
            { name: 'Ações', orderable: false, searchable: false }
        ],
    });

    changeSuperAdmin();
});


function deleteRole(route) {
    swal({
        title: 'Atenção',
        text: 'Deseja realmente excluir este papel?',
        icon: 'warning',
        closeModal: false,
        dangerMode: true,
        buttons: {
            cancel: { text: "Não", value: false, visible: true },
            confirm: { text: "Sim", value: true, visible: true },
        }
    }).then((value) => {
        if (value) {
            location.href=route;
        }
    });
}

function changeSuperAdmin() {
    var is_superadmin = document.getElementById("is_superadmin").value;
    var panel = document.getElementById("roles-permissions");

    if (is_superadmin == 1) {
        panel.style.display="none";
    } else {
        panel.style.display="block";
    }
}

function markAll(item) {
    var todos = document.getElementsByName('todos[]');
    var acessar = document.getElementsByName('acessar[]');
    var criar = document.getElementsByName('criar[]');
    var editar = document.getElementsByName('editar[]');
    var visualizar = document.getElementsByName('visualizar[]');
    var excluir = document.getElementsByName('excluir[]');

    if (todos[item].checked) {
        if (typeof acessar[item] != "undefined" && ! acessar[item].disabled) {
            acessar[item].checked = true;
        }
        if (typeof criar[item] != "undefined"  && ! criar[item].disabled) {
            criar[item].checked = true;
        }
        if (typeof editar[item] != "undefined" && ! editar[item].disabled) {
            editar[item].checked = true;
        }
        if (typeof visualizar[item] != "undefined" && ! visualizar[item].disabled) {
            visualizar[item].checked = true;
        }
        if (typeof excluir[item] != "undefined" && ! excluir[item].disabled) {
            excluir[item].checked = true;
        }
    } else {
        if (typeof acessar[item] != "undefined" && ! acessar[item].disabled) {
            acessar[item].checked = false;
        }
        if (typeof criar[item] != "undefined" && ! criar[item].disabled) {
            criar[item].checked = false;
        }
        if (typeof editar[item] != "undefined" && ! editar[item].disabled) {
            editar[item].checked = false;
        }
        if (typeof visualizar[item] != "undefined" && ! visualizar[item].disabled) {
            visualizar[item].checked = false;
        }
        if (typeof excluir[item] != "undefined" && ! excluir[item].disabled) {
            excluir[item].checked = false;
        }
    }
}
