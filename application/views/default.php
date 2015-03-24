<html>
<head>
	<title>
		Viral Vadgama - Test
	</title>
	<script type="text/javascript" src="<?php echo site_url()?>assets/jquery.js"></script>
</head>

Clients List:

	<?php 
		
		// id clients more than zero
		if($clients) {?>

		<select id="client">
		<option value="" selected>---select---</option>
		<?php 
			// evaluating through clients in dropdown
			foreach($clients as $client)
			{
		?>
			<option value="<?php echo $client->client_id?>"><?php echo $client->client_name?></option>
		<?php }?>
		</select>
	<?php }?>
<br><br>

Product List: (this field have no effect on search)
<select id="products">
	<!-- default shown to users -->
  <option value="">---select client first---</option>
</select>
<br>
	

<br><br>
Period:
	<!-- period dropdown [static] -->
	<select id="main">
		<option> --- select --- </option>
		<option value="1">Last Month to Date</option>
		<option value="2">This Month</option>
		<option value="3">This Year</option>
		<option value="4">Last Year</option>
	</select>

	<!--  submit button-->
<input type="button" id="submit" value="Submit">

<br><br><br>

<!-- div for ajax replacement -->
<div id="callback">

<!-- table shown to user on first page load -->
	<table style="width:100%">
	  <tr>
	    <th>Invoice Num</th>
	    <th>Invoic Date</th>		
	    <th>Product</th>
	 	<th>Qty</th>
	    <th>Price</th>		
	    <th>Total</th>
	  </tr>  
	</table>

</div>



<script>

// binding event client click select
$(document).ready(function(){

	// defining client change function
	$('#client').change(function(){

		// getting value of selected clients
		var client_id = $(this).val();

		// if client id is non zero
		if(client_id != '')
		{
			// ajax call to retrieve products
			$.ajax({
				  url: "<?php echo site_url()?>index.php/welcome/get_products_ajax/"+client_id,
				  context:document.body
					}).done(function(data)
				{
					$('#products').html(data);
				});
		}
		else
		{
			// if client id is zero
			$('#products').html('<option value="">---select client first---</option>');
		}
	});
});


// binding clicks on buttons
$(document).ready(function(){

	$('#submit').click(function(){
	// evaluates on submit button click

		// get selected preiod from dropdown
		// get client name if selected

		var period = $('#main').val();
		var sel1 = $('#client').val();
		
		// initializing ajax call
		$.ajax({
		    type: "POST",
		    url: "<?php echo site_url()?>index.php/welcome/get_table_data/"+period,
		    data: "client="+sel1,
		    success: function(data)
		    {
		    	// to execute on successfull ajax call
		        $('#callback').html(data);        
		    }
		});
	});
});

</script>

<!-- simple table styles -->

<style>
table, th, td
{
    border: 1px solid black;
    border-collapse: collapse;
}
th, td
{
    padding: 5px;
}
</style>

</html>