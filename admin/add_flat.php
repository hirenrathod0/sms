<?php include ('header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	<div class="container">
			<br />
			
			<h3 align="center">Add New Flat</a></h3><br />
			<br />
			<div align="right" style="margin-bottom:5px;">
			<button type="button" name="add" id="add" class="btn btn-success btn-xs">Add</button>
			</div>
			<div class="table-responsive"  id="user_data">
				
			</div>
			<br />
		</div>
		
		<div id="user_dialog" title="Add Data">
			<form method="post" id="user_form">
				<div class="form-group">
					<label>Enter Block No.</label>
					<input type="text" name="block" id="block" class="form-control" />
					<span id="error_first_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Flat No.</label>
					<input type="text" name="flat_num" id="flat_num" class="form-control" />
					<span id="error_last_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Area</label>
					<input type="text" name="area" id="area" class="form-control" />
					<span id="error_last_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter BHK</label>
					<input type="text" name="BHK" id="BHK" class="form-control" />
					<span id="error_last_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Floor No.</label>
					<input type="text" name="floor_no" id="floor_no" class="form-control" />
					<span id="error_last_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Price</label>
					<input type="text" name="price" id="price" class="form-control" />
					<span id="error_last_name" class="text-danger"></span>
				</div>
				<!-- <div class="form-group">
					<label>Enter Uid</label>
					<input type="text" name="uid" id="uid" class="form-control" />
					<span id="error_last_name" class="text-danger"></span>
				</div> -->
				<div class="form-group">
					<input type="hidden" name="action" id="action" value="insert" />
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Insert" />
				</div>
			</form>
		</div>
		
		<div id="action_alert" title="Action">
			
		</div>
		
		<div id="delete_confirmation" title="Confirmation">
		<p>Are you sure you want to Delete this data?</p>
		</div>
      </div>
  </div>
</div>

<?php include ('footer.php'); ?>

<script>  


$(document).ready(function(){  

	load_data();
    
	function load_data()
	{
		$.ajax({
			url:"fetch.php",
			method:"POST",
			success:function(data)
			{
				$('#user_data').html(data);
			}
		});
	}
	
	$("#user_dialog").dialog({
		autoOpen:false,
		width:400
	});
	
	$('#add').click(function(){
		$('#user_dialog').attr('title', 'Add Data');
		$('#action').val('insert');
		$('#form_action').val('Insert');
		$('#user_form')[0].reset();
		$('#form_action').attr('disabled', false);
		$("#user_dialog").dialog('open');
	});
	
	$('#user_form').on('submit', function(event){
		event.preventDefault();
		var error_first_name = '';
		var error_last_name = '';
		if($('#block').val() == '')
		{
			error_first_name = 'First Name is required';
			$('#error_first_name').text(error_first_name);
			$('#block').css('border-color', '#cc0000');
		}
		else
		{
			error_first_name = '';
			$('#error_first_name').text(error_first_name);
			$('#block').css('border-color', '');
		}
		if($('#last_name').val() == '')
		{
			error_last_name = 'Last Name is required';
			$('#error_last_name').text(error_last_name);
			$('#flat_num').css('border-color', '#cc0000');
		}
		else
		{
			error_last_name = '';
			$('#error_last_name').text(error_last_name);
			$('#flat_num').css('border-color', '');
		}
		
		if(error_first_name != '' || error_last_name != '')
		{
			return false;
		}
		else
		{
			$('#form_action').attr('disabled', 'disabled');
			var form_data = $(this).serialize();
			$.ajax({
				url:"process.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					
					$('#user_dialog').dialog('close');
					$('#action_alert').html(data);
					$('#action_alert').dialog('open');
					load_data();
					$('#form_action').attr('disabled', false);
				}
			});
		}
		
	});
	
	$('#action_alert').dialog({
		autoOpen:false
	});
	
	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		//alert('clicked');
		$.ajax({
			type: "POST",
			url: 'process.php',			
			data: {id:id, action:action},
			success: function(data)
			{
				alert(data);
				var arr = data.split(',');
				alert(arr[0]+" "+arr[1]+" "+arr[2]+" "+arr[3]+" "+arr[4]+" "+arr[5]);
 
	
				
				$('#block').val(arr[0]);
				$('#flat_num').val(arr[1]);
				$('#area').val(arr[2]);
				$('#BHK').val(arr[3]);
				$('#floor_no').val(arr[4]);
				$('#price').val(arr[5]);				
				// $('#uid').val(data.uid);
				$('#user_dialog').attr('title', 'Edit Data');
				$('#action').val('update');
				$('#hidden_id').val(id);
				$('#form_action').val('Update');
				$('#user_dialog').dialog('open');
							
			}
		});
	});
	
	$('#delete_confirmation').dialog({
		autoOpen:false,
		modal: true,
		buttons:{
		Ok : function(){
				var id = $(this).data('id');
				var action = 'delete';
				$.ajax({
					url:"process.php",
					method:"POST",
					data: {id:id, action:action},
					success:function(data)
					{
						$('#delete_confirmation').dialog('close');
						$('#action_alert').html(data);
						$('#action_alert').dialog('open');
						load_data();
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}	
	});
	
	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		$('#delete_confirmation').data('id', id).dialog('open');
	});
	
});  
</script>
