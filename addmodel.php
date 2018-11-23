<div class="" style="margin-top:4%;">
	<div class="row">
		<div class="col-sm-3">
			<label for="model_name" style="vertical-align: sub;">Enter Model Name:</label>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<input type="text" placeholder="Model Name" class="form-control" id="model_name" maxlength="50">
				<span id="model_name_err" style="" class="text text-danger"></span>
			</div>
		</div>
		<div clsss="col-sm-5">
			<div class="form-group">
			  <label for="man_list">Select Manufacture:</label>
			  <select class="form-control" id="man_list" style="display:inline-block;width:20%;">
				<option value="-1">--Select--</option>
			  </select>
			  <span id="model_man_err" style="" class="text text-danger"></span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<label for="model_year" style="vertical-align: sub;">Manufacturing Year:</label>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<input type="text" placeholder="Manufacturing Year" onkeypress="return isNumber(event)" class="form-control" id="model_year" maxlength="4">
				<span id="model_year_err" style="" class="text text-danger"></span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<label for="reg_no" style="vertical-align: sub;">Registration No:</label>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<input type="text" placeholder="Registration no" class="form-control" id="reg_no">
				<span id="reg_no_err" style="" class="text text-danger"></span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<label for="model_color" style="vertical-align: sub;">Color:</label>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<input type="text" placeholder="Color" class="form-control" id="model_color">
				<span id="model_color_err" style="" class="text text-danger"></span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<button type="button" class="btn btn-success" id="add_model_btn">Submit</button>
		</div>
		<div class="col-sm-4">
			<span id="model_resp_err" style="" class="text text-success"></span>
		</div>
	</div>
</div>

<script>

	$(document).ready(function(){
		//get Manufacture
		$.ajax({
			url:'comman_functions.php',
			type:'POST',
			data:{'caseid':'2'},
			success:function(resp)
			{
				//console.log(resp);
				if(resp)
				{	
					var manObj = JSON.parse(resp);
					if(manObj.msg)
					{
						$("#add_model_btn").attr("disabled",true);
						alert("Add at least one Manufacture!");
					}else{
						$("#add_model_btn").attr("disabled",false);
						for(var i=0; i < manObj.length; i++)
						{
							var man_name = manObj[i].man_name;
							var man_id = manObj[i].id;
							$("#man_list").append('<option value="'+ man_id +'">'+ man_name +'</option>');
						}
					}
				}
			}
		});
	});
	//Submit model details
	$("#add_model_btn").click(function(){
		var model_name = $("#model_name").val();
		var manufacture = $("#man_list").val();
		var man_name = $("#man_list option:selected").text();
		var man_year = $("#model_year").val();
		var reg_no = $("#reg_no").val();
		var color = $("#model_color").val();
		//console.log(model_name,manufacture,man_name,man_year,reg_no,color);
		if(!model_name)
		{
			$("#model_name_err").html("Enter model name...");
			return false;
		}
		if(manufacture == "-1")
		{
			$("#model_man_err").html("Select Manufacture...");
			return false;
		}
		if(!man_year)
		{
			$("#model_year_err").html("Enter manufacturing year...");
			return false;
		}
		if(!reg_no)
		{
			$("#reg_no_err").html("Enter registration no...");
			return false;
		}
		if(!color)
		{
			$("#model_color_err").html("Enter color...");
			return false;
		}
		
		$.ajax({
				url:"comman_functions.php",
				type:"POST",
				data:{'caseid':'3','mname':model_name,'manid':manufacture,'man_name':man_name,'myear':man_year,'regno':reg_no,'color':color},
				success:function(resp)
				{
					var respObj = JSON.parse(resp);
					if(respObj.msg == 1)
					{
						$("#model_name").val(" ");
						$("#man_list").val("-1");
						//$("#man_list option:selected").text();
						$("#model_year").val(" ");
						$("#reg_no").val(" ");
						$("#model_color").val(" ");
						//clear error msgs
						$("#model_name_err").html(" ");
						$("#model_man_err").html(" ");
						$("#model_year_err").html(" ");
						$("#reg_no_err").html(" ");
						$("#model_color_err").html(" ");
						$("#model_resp_err").html("Model Added Successfully..!");
						
					}
				}
		});
	});
	
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			$("#model_year_err").html("Enter only numbers");
			return false;
		}
		$("#model_year_err").html("");
		return true;
	}
</script>