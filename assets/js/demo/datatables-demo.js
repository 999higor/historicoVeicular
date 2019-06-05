// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').dataTable({   
    searching: false,                           
    oLanguage: {
      sLengthMenu: "Mostrar _MENU_ registros por página",
      sZeroRecords: "Nenhum registro encontrado",
      sInfo: "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
      sInfoEmpty: "Mostrando 0 / 0 de 0 registros",
      sInfoFiltered: "(filtrado de _MAX_ registros)",
      sSearch: "Pesquisar: ",
      oPaginate: {
          sFirst: "Início",
          sPrevious: "Anterior",
          sNext: "Próximo",
          sLast: "Último"
        }
    }
  })
});
