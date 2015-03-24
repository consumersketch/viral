<table style="width:100%">
  <tr>
    <th>Invoice Num</th>
    <th>Invoic Date</th>		
    <th>Product</th>
 	<th>Qty</th>
    <th>Price</th>		
    <th>Total</th>
  </tr>
 <?php

  		// check if we got result
  		// if not, return tablewith - 'dashed' marking

  	 if($data1)
		{
			// evaluating result table to show in table format
			foreach($data1 as $item)
			{

				// get total from product pric and quantity.
				$total = ($item->price) * ($item->invoice_num);
  ?>
		  <tr>
		    <td><?php echo $item->invoice_num?></td>
		    <td><?php echo $item->invoice_date?></td>		
		    <td><?php echo $item->product_description?></td>
		    <td><?php echo $item->qty?></td>
		    <td><?php echo $item->price?></td>		
		    <td><?php echo $total?></td>
		  </tr>

		  <?php }}else{?>
			<tr>
			    <td>-</td>
			    <td>-</td>		
			    <td>-</td>
			    <td>-</td>
			    <td>-</td>		
			    <td>-</td>
		  	</tr>
	<?php }?>
	
</table>
