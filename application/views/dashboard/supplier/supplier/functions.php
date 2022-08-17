<script type="text/javascript">
function AddSupplier() {
    const name = $("#Suppliername").val();
    const number = $("#Suppliernumber").val();
    const address = $("#Supplieraddress").val();
    const VAT = $("#Suppliervat").val();
    const bankname = $("#Supplierbankname").val();
    const bankaccount = $("#Supplierbankaccount").val();
    const EORI = $("#Suppliereori").val();
    const Ref = $("#SupplierRef").val();

    const form_data = {
        name: name,
        number: number,
        address: address,
        VAT: VAT,
        bankname: bankname,
        bankaccount: bankaccount,
        EORI: EORI,
        Ref: Ref
    };

    try {
        $.ajax({
            url: "<?=base_url('home/savesupplier')?>",
            method: "POST",
            data: form_data,
            success: function(res) {
                try {
                    alert(res);
                    const id = res;
                    if (id === null || id === '') {
                        swal("Add Supplier", "Server Error", "error");
                        return;
                    }
                    if (id === -1) {
                        swal("Add Supplier", "Conflict database", "warning");
                        return;
                    } else {
                        swal({
                                title: "Add Supplier",
                                text: "Supplier success",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Letz go",
                                cancelButtonText: "No, cancel plx!",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            },
                            function() {
                                window.location.href = "<?=base_url('home/suppliermanager')?>";
                            });
                    }
                } catch (err) {
                    swal("Add Supplier", "Server Error", "warning");
                }
            }
        });
    } catch (err) {
        swal("Add Supplier", "Server Error", "warning");
    }
}

function EditSupplier(supplierid) {
    const name = $("#Suppliername").val();
    const number = $("#Suppliernumber").val();
    const address = $("#Supplieraddress").val();
    const VAT = $("#Suppliervat").val();
    const bankname = $("#Supplierbankname").val();
    const bankaccount = $("#Supplierbankaccount").val();
    const EORI = $("#Suppliereori").val();
    const Ref = $("#SupplierRef").val();

    const form_data = {
        name: name,
        number: number,
        address: address,
        VAT: VAT,
        bankname: bankname,
        bankaccount: bankaccount,
        EORI: EORI,
        Ref: Ref
    };

    try {
        $.ajax({
            url: "<?=base_url('home/savesupplier?id=')?>" + supplierid,
            method: "POST",
            data: form_data,
            success: function(res) {
                try {
                    const id = res;
                    if (id != 1) {
                        swal("Edit Supplier", "Server Error", "error");
                        return;
                    }
                    if (id == -1) {
                        swal("Edit Supplier", "Conflict database", "warning");
                        return;
                    }
                    swal({
                            title: "Edit Supplier",
                            text: "Supplier success",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Letz go",
                            cancelButtonText: "No, cancel plx!",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        },
                        function() {
                            window.location.href = "<?=base_url('home/suppliermanager')?>";
                        });
                    return;
                } catch (err) {
                    swal("Edit Supplier", "Server Error", "warning");
                }
            }
        });
    } catch (err) {
        swal("Edit Supplier", "Server Error", "warning");
    }
}

function delSupplier(supplierid) {
    swal({
            title: "Are you sure?",
            text: "Delete " + supplierid + ".",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-warning",
            cancelButtonText: "No, cancel plx!",
            confirmButtonText: "Yes, I do",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isconfirm) {
            if (!isconfirm) {
                alert(false);
                return;
            }
            try {
                $.ajax({
                    url: "<?=base_url('home/delsupplier/')?>"+supplierid,
                    method: "POST",
                    dataType: 'text',
                    async: true,
                    success: function(res) {
                        if (res != 1) {
                            swal("Delete " + supplierid, "Failed", "error");
                            return;
                        }
                        swal({
                                title: "Delete " + supplierid,
                                text: "Supplier Success",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Letz go",
                                cancelButtonText: "No, cancel plx!",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            },
                            function() {
                                window.location.href = "<?=base_url('home/suppliermanager')?>";
                            });
                    },
                    error: function(jqXHR, exception) {
                        swal("Delete " + supplierid, "Server Error", "warning");
                    }
                });
            } catch (error) {
                swal("Delete " + supplierid, "Server Error", "warning");
            }
        });
}
</script>