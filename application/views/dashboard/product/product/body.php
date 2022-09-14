<?php $first=0; $second=0; $third=0; $fourth=0;?>
<a class="btn btn-success mb-2" href="<?=base_url('product/addproduct')?>">Add New</a>
<table id="producttable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th id="first">Materials Amount</th>
            <th id="second">Labours Amount</th>
            <th id="third">Auxiliary Amount</th>
            <th id="fourth">Total Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach($products as $index=>$product):?>
      <tr>
        <td><?=$product['id']?></td>
        <td><?=$product['name']?></td>
        <td>
          <?php 
            $total = 0;
            $total_material=0;
            $materials = json_decode($product['materials'], true);
            foreach ($materials as $key => $material) {
              $total_material += number_format($material['amount']*$material['selling_unit_price_without_vat'], 2, '.', "");
            }
            $total += $total_material;
            $first += $total_material;
            echo $total_material;
          ?>
        </td>
        <td>
          <?php 
            $total_labour=0;
            $labours = json_decode($product['labours'], true);
            foreach ($labours as $key => $labour) {
              $total_labour += number_format($labour['time']*$labour['hourly'], 2, '.', "");
            }
            $total += $total_labour;
            $second += $total_labour;
            echo $total_labour;
          ?>
        </td>
        <td>
          <?php 
            $total_auxiliary=0;
            $auxiliaries = json_decode($product['auxiliaries'], true);
            foreach ($auxiliaries as $key => $auxiliary) {
              $total_auxiliary += number_format($auxiliary['value'], 2, '.', "");
            }
            $total += $total_auxiliary;
            $third += $total_auxiliary;
            echo $total_auxiliary;
          ?>
        </td>
        <td><?=$total?></td>
        <td class="form-inline flex justify-around">
            <a class="btn btn-primary" href="<?=base_url('product/editproduct/'.$product['id'])?>"><i class="bi bi-terminal-dash"></i></a>
            <button class="btn btn-danger " onclick="delProduct('<?=$product['id']?>')" <?=$product['isremoved']?"disabled":""?>><i class="bi bi-trash3-fill"></i></button>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
</table>
<table id="total-table" class="table table-bordered table-striped absolute">
    <thead>
        <tr>
            <th></th>
            <th>Materials Total</th>
            <th>Labours Total</th>
            <th>Auxiliary Total</th>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td id="downtotalmark">Total:</td>
            <td id="total_first"><?=$first?></td>
            <td id="total_second"><?=$second?></td>
            <td id="total_third"><?=$third?></td>
            <td id="total_fourth"><?=$first+$second+$third?></td>
        </tr>
    </tbody>
</table>
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
      const first_row_4 =  getOffset(fourth);

      console.log(first_row_1.left);

      document.getElementById("total-table").style.left = parseFloat(first_row_1.left - 100)+"px";

      document.getElementById("total-table").style.width = parseFloat(100+first_row_1.width+first_row_2.width+first_row_3.width+first_row_4.width) + "px";
      document.getElementById("downtotalmark").style.width = 100+"px";
      document.getElementById("total_first").style.width  = first_row_1.width + "px";
      document.getElementById("total_second").style.width  = first_row_2.width + "px";
      document.getElementById("total_third").style.width  = first_row_3.width + "px";
      document.getElementById("total_fourth").style.width  = first_row_4.width + "px";
    }

    refreshbrowser();
    
    onresize = (event) => {
      refreshbrowser();
    };
</script>