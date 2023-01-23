$(document).ready(function () {
    $.fn.dataTable.moment('DD/MM/YYYY HH:mm:ss');
    $("#tableusuarios").DataTable({
      info: !1,
      responsive: !0,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"]
      ],
      columnDefs: [
          { className: "dt-center", "targets":  '_all'  }
      ],
      language: {
        lengthMenu: "_MENU_ Itens",
        zeroRecords: "Não encontrado",
        info: "Pagina _PAGE_ de _PAGES_",
        infoEmpty: "Não Existe Itens",
        search: "Busca:",
        infoFiltered: "(Filtrado de _MAX_ Itens)",
        paginate: {
          first: "Primeiro",
          last: "Ultimo",
          next: "Proximo",
          previous: "Anterior"
        }
      },
      dom: "Bftpl",
      buttons: [{
        extend: "excelHtml5",
        text: "Excel",
        title: "",
        columns:[0,1,2],
      }, {
        extend: "print",
        text: "Imprimir",
        messageBottom: null
      }
    ]
    })
    $("#tablefiliais").DataTable({
      info: !1,
      responsive: !0,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"]
      ],
      columnDefs: [
          { className: "dt-center", "targets":  '_all'  }
      ],
      language: {
        lengthMenu: "_MENU_ Itens",
        zeroRecords: "Não encontrado",
        info: "Pagina _PAGE_ de _PAGES_",
        infoEmpty: "Não Existe Itens",
        search: "Busca:",
        infoFiltered: "(Filtrado de _MAX_ Itens)",
        paginate: {
          first: "Primeiro",
          last: "Ultimo",
          next: "Proximo",
          previous: "Anterior"
        }
      },
      dom: "Bftpl",
      buttons: [{
        extend: "excelHtml5",
        text: "Excel",
        title: "",
        columns:[0,1,2],
      }, {
        extend: "print",
        text: "Imprimir",
        messageBottom: null
      }
    ]
    })
    $("#tablelocal").DataTable({
      info: !1,
      responsive: !0,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"]
      ],
      columnDefs: [
          { className: "dt-center", "targets":  '_all'  }
      ],
      language: {
        lengthMenu: "_MENU_ Itens",
        zeroRecords: "Não encontrado",
        info: "Pagina _PAGE_ de _PAGES_",
        infoEmpty: "Não Existe Itens",
        search: "Busca:",
        infoFiltered: "(Filtrado de _MAX_ Itens)",
        paginate: {
          first: "Primeiro",
          last: "Ultimo",
          next: "Proximo",
          previous: "Anterior"
        }
      },
      dom: "Bftpl",
      buttons: [{
        extend: "excelHtml5",
        text: "Excel",
        title: "",
        columns:[0,1,2],
      }, {
        extend: "print",
        text: "Imprimir",
        messageBottom: null
      }
    ]
    })
    $("#tablecatpatri").DataTable({
      info: !1,
      responsive: !0,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"]
      ],
      columnDefs: [
          { className: "dt-center", "targets":  '_all'  }
      ],
      language: {
        lengthMenu: "_MENU_ Itens",
        zeroRecords: "Não encontrado",
        info: "Pagina _PAGE_ de _PAGES_",
        infoEmpty: "Não Existe Itens",
        search: "Busca:",
        infoFiltered: "(Filtrado de _MAX_ Itens)",
        paginate: {
          first: "Primeiro",
          last: "Ultimo",
          next: "Proximo",
          previous: "Anterior"
        }
      },
      dom: "Bftpl",
      buttons: [{
        extend: "excelHtml5",
        text: "Excel",
        title: "",
        columns:[0,1,2],
      }, {
        extend: "print",
        text: "Imprimir",
        messageBottom: null
      }
    ]
    })
    $("#tablecatinsu").DataTable({
      info: !1,
      responsive: !0,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"]
      ],
      columnDefs: [
          { className: "dt-center", "targets":  '_all'  }
      ],
      language: {
        lengthMenu: "_MENU_ Itens",
        zeroRecords: "Não encontrado",
        info: "Pagina _PAGE_ de _PAGES_",
        infoEmpty: "Não Existe Itens",
        search: "Busca:",
        infoFiltered: "(Filtrado de _MAX_ Itens)",
        paginate: {
          first: "Primeiro",
          last: "Ultimo",
          next: "Proximo",
          previous: "Anterior"
        }
      },
      dom: "Bftpl",
      buttons: [{
        extend: "excelHtml5",
        text: "Excel",
        title: "",
        columns:[0,1,2],
      }, {
        extend: "print",
        text: "Imprimir",
        messageBottom: null
      }
    ]
    })
    $("#tablepatrimonio").DataTable({
      info: !1,
      responsive: !0,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"]
      ],
      columnDefs: [
          { className: "dt-center", "targets":  '_all'  }
      ],
      language: {
        lengthMenu: "_MENU_ Itens",
        zeroRecords: "Não encontrado",
        info: "Pagina _PAGE_ de _PAGES_",
        infoEmpty: "Não Existe Itens",
        search: "Busca:",
        infoFiltered: "(Filtrado de _MAX_ Itens)",
        paginate: {
          first: "Primeiro",
          last: "Ultimo",
          next: "Proximo",
          previous: "Anterior"
        }
      },
      dom: "Bftpl",
      buttons: [{
        extend: "excelHtml5",
        text: "Excel",
        title: "",
        columns:[0,1,2],
      }, {
        extend: "print",
        text: "Imprimir",
        messageBottom: null
      }
    ]
    })
});