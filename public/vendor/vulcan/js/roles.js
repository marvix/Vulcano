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
        acessar[item].checked = true;
        criar[item].checked = true;
        editar[item].checked = true;
        visualizar[item].checked = true;
        excluir[item].checked = true;
    } else {
        acessar[item].checked = false;
        criar[item].checked = false;
        editar[item].checked = false;
        visualizar[item].checked = false;
        excluir[item].checked = false;
    }
}
