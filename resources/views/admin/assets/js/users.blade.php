$(document).ready(function() {
    $('#table-usuarios').DataTable({
        paging: true,
        info: true,
        searching: true,
        serverside: true,
        processing: true,
        ajax: "{{ route('users.getdata') }}",
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
        columns: [
            { data:0, name: "id" },
            { data:1, name: "name" },
            { data:2, name: "email" },
            { data:3, name: "active" },
            { data:4, name: "gender" },
            { data:4, name: "skin" }
        ]
    });
});

function deleteUser(route) {
    swal({
        title: 'Atenção',
        text: 'Deseja realmente excluir este usuário?',
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
