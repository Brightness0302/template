<body>
    <section id="hero" class="align-items-center">
        <div data-aos="fade-up" data-aos-delay="100">
            <a href="<?=base_url('product/index')?>"><button
                    class="backbutton w-8 sm:w-12 h-8 sm:h-12 text-sm sm:text-2xl"
                    title="Add New Client">&#8249;</button></a>
        </div>
        <div class="position-relative m-5" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9 text-center">
                    <h1>Supplier Invoice modifier</h1>
                </div>
            </div>

            <div class="pages">
                <div class="text-sm">
                    <div id="section1" class="row d-flex justify-content-center align-items-center border border-lime-600">
                        <div class="col-sm-4 text-center">
                            <table class="table " style="border : 1px solid gray; text-align: left">
                                <tr>
                                    <td style="border : 1px solid black"> Supplier Name: </td>
                                    <td>
                                        <select class="form-select" id="supplierid">
                                        <?php foreach ($suppliers as $index => $supplier):?>
                                            <option value="<?=$supplier['id']?>" <?=($supplier['id']==$product['supplierid'])?"selected":""?>>
                                                <?=str_replace("_"," ", $supplier['name'])?>
                                            </option>
                                        <?php endforeach;?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border : 1px solid black">Observations:</td>
                                    <td>
                                        <div class="m-auto">
                                            <input type="text" class="form-control " id="observation" value="<?=$product['observation']?>" title="Choose your color">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-4 text-center">
                          <table class="table " style="border : 1px solid gray; text-align: left">
                              <tr>
                                  <td style="border : 1px solid black">NIR Document No: </td>
                                  <td><?=$product['id']?></td>
                              </tr>
                              <tr>
                                  <td style="border : 1px solid black">Date:</td>
                                  <td><?=$product['date_of_reception']?></td>
                              </tr>
                          </table>
                        </div>
                        <div class="col-sm-4 text-center">
                            <table class="table " style="border : 1px solid gray; text-align: left">
                                <tr>
                                    <td style="border : 1px solid black">Invoice Date:</td>
                                    <td>
                                        <input type="date" class="form-control " id="invoice_date" value="<?=$product['invoice_date']?>" title="Choose your color">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border : 1px solid black">Invoice Number: </td>
                                    <td>
                                        <input type="text" class="form-control " id="invoice_number" value="<?=$product['invoice_number']?>" title="Choose your color">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border : 1px solid black">Coin:</td>
                                    <td>
                                        <select class="form-select" id="invoice_coin">
                                            <option value="EURO" <?=($product['invoice_coin']=="EURO")?"selected":""?>>€</option>
                                            <option value="POUND" <?=($product['invoice_coin']=="POUND")?"selected":""?>>£</option>
                                            <option value="USD" <?=($product['invoice_coin']=="USD")?"selected":""?>>$</option>
                                            <option value="LEI" <?=($product['invoice_coin']=="LEI")?"selected":""?>>LEI</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row d-flex justify-content-center align-items-center border border-lime-600">
                        <div id="section2" class="row row d-flex justify-content-center align-items-center">
                            <div class="col-sm-3 text-center d-flex">
                                <table class="table " style="border : 1px solid gray; text-align: left">
                                    <tr>
                                        <td style="border : 1px solid black">Production Description: </td>
                                        <td>
                                            <div class="m-auto">
                                                <input type="text" class="form-control" id="production_description" value="" title="Choose your color">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border : 1px solid black">Select Stock to save:</td>
                                        <td>
                                            <select class="form-select" id="stockid">
                                            <?php foreach ($stocks as $index => $stock):?>
                                                <option value="<?=$stock['id']?>">
                                                    <?=str_replace("_"," ", $stock['name'])?>
                                                </option>
                                            <?php endforeach;?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border : 1px solid black">Select Expense Category:</td>
                                        <td>
                                            <select class="form-select" id="expenseid">
                                                <option value="0">
                                                    No Expenses Category
                                                </option>
                                            <?php foreach ($categories as $index => $category):?>
                                                <option value="<?=$category['id']?>">
                                                    <?=str_replace("_"," ", $category['name'])?>
                                                </option>
                                            <?php endforeach;?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border : 1px solid black">Assign to Project:</td>
                                        <td>
                                            <select class="form-select" id="projectid">
                                                <option value="0">
                                                    Not for a project
                                                </option>
                                            <!-- <?php foreach ($categories as $index => $category):?>
                                                <option value="<?=$category['id']?>">
                                                    <?=str_replace("_"," ", $category['name'])?>
                                                </option>
                                            <?php endforeach;?> -->
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-3 text-center">
                                <table class="table " style="border : 1px solid gray; text-align: left">
                                    <tr>
                                        <td style="border : 1px solid black">Code EAN:</td>
                                        <td>
                                            <div class="m-auto">
                                                <input type="text" class="form-control" id="code_ean" list="stock_lines" name="browser" title="Choose your color">
                                                <datalist id="stock_lines">
                                                    <?php foreach($totallines as $line):?>
                                                    <option value="<?=$line['code_ean']?>">
                                                    <?php endforeach;?>
                                                </datalist>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border : 1px solid black">Acquisition unit price:</td>
                                        <td>
                                            <div class="m-auto">
                                                <input type="number" class="form-control " id="acquisition_unit_price" value="0" title="Choose your color">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border : 1px solid black">VAT %:</td>
                                        <td>
                                            <div class="m-auto">
                                                <input type="number" min="0" max="100" class="form-control " id="vat_percent" value="0" title="Choose your color">
                                            </div>  
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-3 text-center">
                                <table class="table " style="border : 1px solid gray; text-align: left">
                                    <tr>
                                        <td style="border : 1px solid black">Unit: </td>
                                        <td>
                                            <select class="form-select" id="unit">
                                                <option value="Pieces">Pieces</option>
                                                <option value="Hours">Hours</option>
                                                <option value="KG">KG</option>
                                                <option value="Pair">Pair</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border : 1px solid black">Quantity on document: </td>
                                        <td>
                                            <div class="m-auto">
                                                <input type="number" class="form-control " id="quantity_on_document" value="0" title="Choose your color">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border : 1px solid black">Quantity received:</td>
                                        <td>
                                            <div class="m-auto">
                                                <input type="number" class="form-control " id="quantity_received" value="0" title="Choose your color">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-3 text-center">
                                <table class="table" style="border: 1px solid gray; text-align: left">
                                    <tr>
                                        <td style="border: 1px solid black">Mark Up%: </td>
                                        <td>
                                            <div class="m-auto">
                                                <input type="number" min="0" max="100" class="form-control " id="mark_up_percent" value="0" title="Choose your color">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid black">Selling Unit Price without VAT:</td>
                                        <td>
                                            <div class="m-auto">
                                                <input type="number" min="0" max="100" class="form-control " id="selling_unit_price_without_vat" value="0.00" title="Choose your color" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="section3" class="row row d-flex justify-content-center align-items-center m-2">
                            <div class="flex justify-end gap-3">
                                <button class="btn btn-primary" onclick="SaveItem()">Save Item</button>
                                <button class="btn btn-default" onclick="ClearItem()">Clear Item</button>
                            </div>
                        </div>
                        <?php
                            $total_first=0;$total_second=0;$total_third=0;$total_forth=0;$total_fifth=0;$total_sixth=0;
                        ?>
                        <table id="lines" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Code EAN</th>
                                    <th>Registered Stock</th>
                                    <th>Registered Expense</th>
                                    <th>Registered Project</th>
                                    <th>Product description</th>
                                    <th>Units</th>
                                    <th>Quantity on document</th>
                                    <th>Received quantity</th>
                                    <th>Acquisition price without VAT</th>
                                    <th>VAT</th>
                                    <th>Acquisition price with VAT</th>
                                    <th id="first">Amount without VAT</th>
                                    <th id="second">Amount VAT</th>
                                    <th id="third">Total amount</th>
                                    <th id="forth">Selling price without VAT</th>
                                    <th id="fifth">VAT value</th>
                                    <th id="sixth">Selling price with VAT</th>
                                    <!-- <th>Selling amount without VAT</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                            <?php foreach ($lines as $index => $line):?>
                                <tr>
                                    <td><?=$line['code_ean']?></td>
                                    <td>
                                    <?php
                                        $result;
                                        foreach ($stocks as $index => $stock) {
                                            if ($stock['id']==$line['stockid'])
                                                $result = $stock;
                                        }
                                        $total_first+=$line['amount_without_vat'];
                                        $total_second+=$line['amount_vat_value'];
                                        $total_third+=$line['total_amount'];
                                        $total_forth+=$line['selling_unit_price_without_vat'];
                                        $total_fifth+=$line['selling_unit_vat_value'];
                                        $total_sixth+=$line['selling_unit_price_with_vat'];
                                        echo $result['name'];
                                    ?>
                                    </td>
                                    <td>
                                    <?php
                                        $result;
                                        foreach ($categories as $index => $category) {
                                            if ($category['id']==$line['expenseid'])
                                                $result = $category;
                                        }
                                        echo $result['name'];
                                    ?>
                                    </td>
                                    <td>
                                    <?php
                                        echo $line['projectid'];
                                    ?>
                                    </td>
                                    <td><?=$line['production_description']?></td>
                                    <td><?=$line['units']?></td>
                                    <td><?=$line['quantity_on_document']?></td>
                                    <td><?=$line['quantity_received']?></td>
                                    <td><?=$line['acquisition_unit_price']?></td>
                                    <td><?=$line['acquisition_vat_value']?></td>
                                    <td><?=$line['acquisition_unit_price_with_vat']?></td>
                                    <td><?=$line['amount_without_vat']?></td>
                                    <td><?=$line['amount_vat_value']?></td>
                                    <td><?=$line['total_amount']?></td>
                                    <td><?=$line['selling_unit_price_without_vat']?></td>
                                    <td><?=$line['selling_unit_vat_value']?></td>
                                    <td><?=$line['selling_unit_price_with_vat']?></td>
                                    <td hidden><?=$line['stockid']?></td>
                                    <td hidden><?=$line['expenseid']?></td>
                                    <td hidden><?=$line['projectid']?></td>
                                    <td class='align-middle flex justify-center'>
                                        <div id='btn_edit_row' onclick='edit_tr(this)'><i class='bi bi-terminal-dash p-1' title='Edit'></i></div>
                                        <div id='btn_remove_row' onclick='remove_tr(this)'><i class='bi bi-trash3-fill p-1' title="Delete"></i></div>
                                    </td>
                                    <td hidden><?=$line['id']?></td>
                                    <td hidden><?=$line['lineid']?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <table id="total-table" class="table table-bordered table-striped relative text-center" data-aos="fade-up" data-aos-delay="100">
            <thead>
                <tr>
                    <th></th>
                    <th>Sub Total</th>
                    <th>VAT Amount</th>
                    <th>Total Amount</th>
                    <th>Sub Total selling without VAT</th>
                    <th>Selling</th>
                    <th>Total selling amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="downtotalmark">Total:</td>
                    <td id="total_first"><?=$total_first?></td>
                    <td id="total_second"><?=$total_second?></td>
                    <td id="total_third"><?=$total_third?></td>
                    <td id="total_forth"><?=$total_forth?></td>
                    <td id="total_fifth"><?=$total_fifth?></td>
                    <td id="total_sixth"><?=$total_sixth?></td>
                </tr>
            </tbody>
        </table>
        <div class="position-relative m-5" data-aos="fade-up" data-aos-delay="100">
            <div class="text-center">
                <div class="absolute">
                    <label for="file-upload" id="file-text" class="btn btn-outline-secondary" style="color: red;">
                        <i class="fa fa-cloud-upload"></i> <?=$attached?>
                    </label>
                    <input id="file-upload" name='upload_cont_img' type="file" style="display:none;">
                    <button class="btn btn-outline-danger" onclick="DeleteAttachedFile()">Delete attached file</button>
                </div>
                <button class="cbutton bg-red" onclick="EditProduct('<?=$product['id']?>')">Save</button> / <a
                    href="<?=base_url('product/index')?>"><button class="cbutton bg-white">Cancel</button></a>
            </div>
        </div>
    </section><!-- End Hero -->
<script type="text/javascript">
    function getOffset(el) {
      const rect = el.getBoundingClientRect();
      return {
        left: rect.left,
        top: rect.top,
        width: rect.width
      };
    }

    function refreshbrowser() {
      const first_row_1 =  getOffset(first);
      const first_row_2 = getOffset(second);
      const first_row_3 = getOffset(third);
      const first_row_4 =  getOffset(forth);
      const first_row_5 = getOffset(fifth);
      const first_row_6 = getOffset(sixth);

      console.log(first_row_1.left);

      document.getElementById("total-table").style.left = parseFloat(first_row_1.left - 100)+"px";

      document.getElementById("total-table").style.width = parseFloat(100+first_row_1.width+first_row_2.width+first_row_3.width+first_row_4.width+first_row_5.width+first_row_6.width) + "px";
      document.getElementById("downtotalmark").style.width = 100+"px";
      document.getElementById("total_first").style.width  = first_row_1.width + "px";
      document.getElementById("total_second").style.width  = first_row_2.width + "px";
      document.getElementById("total_third").style.width  = first_row_3.width + "px";
      document.getElementById("total_forth").style.width  = first_row_4.width + "px";
      document.getElementById("total_fifth").style.width  = first_row_5.width + "px";
      document.getElementById("total_sixth").style.width  = first_row_6.width + "px";
    }

    refreshbrowser();
    
    onresize = (event) => {
      refreshbrowser();
    };
</script>