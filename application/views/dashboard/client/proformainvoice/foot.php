<!-- Bootstrap 4 -->
<script src="<?=base_url('assets')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets')?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets')?>/dist/js/demo.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script src="<?=base_url('assets')?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
function getFirstLetters(str) {
    const firstLetters = str
        .split(' ')
        .map(word => word[0])
        .join('');

    return firstLetters;
}
function clickclient(client_name, client_address, client_ref) {
    // alert(client_name);
    short_name = getFirstLetters(client_name);
    $("#upload_client").html("<div class='text-left ml-10'><p class='font-bold text-lg' id='client_name'>"+client_name+"</p><p class='text-base' id='client_address'>"+client_address+"</p></div>");
    $("#input_inputreference").val(client_ref);
}
var coinInfo = "<?=(($company['Coin']=="EURO")?"€":(($company['Coin']=="POUND")?"£":(($company['Coin']=="USD")?"$":"LEI")))?>";
function onrefreshtotalmark() {
    $("#subtotal").html("0.0");
    $("#vat").html("0.0");
    $("#total").html("0.0");
}

$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": 100,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#invoicetable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": 100,
        "buttons": ["copy", "csv", "excel", {
            text: 'PDF',
            pageSize: 'LEGAL',
            customize: function (doc) {
                doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
                doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
                if (doc.content[1].table.body.length === 0)
                    return;
                for (var i=0;i<doc.content[1].table.body.length;i++) {
                    doc.content[1].table.body[i].splice(6, 1);
                }
                doc.content[1].table.widths = ['10%', '16%', '18%', '18%', '16%', '16%'];
            },
            action: function ( e, dt, node, config ) {
                var ethis = this;
                swal({
                    title: "PDF Option",
                    showCancelButton: true,
                    html: true,
                    text: '<div class="row"><div class="col-sm-6"><p>Page:</p><p>PDF Name:</p></div><div class="col-sm-6"><select placeholder="Page style" id="input1" style="border: 1px solid black;" class="w-full m-1"><option>Portrait</option><option>Landscape</option></select><input class="w-full m-1" id="input2" type="text" placeholder="PDF Name" style="border: 1px solid black;" value="<?=$company['name'].' ('.date('Y-m-d H-i').')'?>" /></div></div>',
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "OK",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function() {
                    ln1 = $('#input1').val();
                    ln2 = $('#input2').val();
                    console.log(ln1, ln2);
                    config.orientation = ln1;
                    config.pageSize = 'LEGAL';
                    config.filename = ln2;
                    config.title = "<?=str_replace('_', ' ', $company['name'])?>";
                    config.header = true;
                    config.exportOptions = {
                        format: {
                            header: function ( data, columnIdx ) {
                                if (data === "Actions" || data === "Action" || data === "Pay")
                                    return "";
                                return data;
                            }
                        }
                    };
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(ethis, e, dt, node, config);
                });
                    // Call the default csvHtml5 action method to create the CSV file
            }
        }, "print", "colvis"]
    }).buttons().container().appendTo('#invoicetable_wrapper .col-md-6:eq(0)');

    $("select[id=invoice_coin]").on('change', function (){
        const elements = $(".coinsymbol");
        for (var i = elements.length - 1; i >= 0; i--) {
            $(elements[i]).html(this.value);
        }
    });
    $("select[id=invoice_coin]").trigger('change');

    $("#table_in_modal").DataTable({
      "responsive": true, "bFilter": true, "bInfo": false, "pagingType": "simple_numbers", "autoWidth": false,
    }).buttons().container().appendTo('#table_in_modal_wrapper .col-md-6:eq(0)');

});

</script>