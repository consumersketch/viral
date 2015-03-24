Products:
<?php 

// check if any products are received
if($products){

?>
<select id="products">
	<?php

		// if products rceived, evalating it in select
		foreach($products as $product)
		{
			?>
<option value="<?php echo $product->product_id?>"><?php echo $product->product_description?></option>

	<?php } // endforeach ?>

</select>

<?php } // endif?>