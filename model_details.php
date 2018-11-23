<style>
	#model_table tbody tr {
		cursor:pointer;
	}
</style>
     <div class="row" style="margin-top:5%;">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <label>Details</label>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="model_table">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Manufacture Name</th>
                                                <th>Model Name</th>
												<th>Count</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody id="model_body">
                                                                                        
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->                                
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>			
			<div id="dataModal" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-lg">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Model Details</h4>
				  </div>
				  <div class="modal-body">
						<div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="inner_model_table">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Manufacture Name</th>
                                        <th>Model Name</th>
										<th>Reg No</th>
										<th>Manufacturing Yr</th>
										<th>Color</th>
										<th>Sold</th>
                                    </tr>
                                </thead>
                                <tbody id="innerModalBody">
                                                                                        
                                </tbody>
                            </table>
                        </div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>

			  </div>
			</div>
                <!-- /.row -->                                                        
            <!-- /#page-wrapper -->
        <!-- DataTables JavaScript -->       
		<script src="js/dataTables/jquery.dataTables.min.js"></script>
        <script src="js/dataTables/dataTables.bootstrap.min.js"></script>
        <script>		
            $(document).ready(function() {
				getModelDetails()
            });
			
			function getModelDetails()
			{
				$.ajax({
					url:'comman_functions.php',
					type:'POST',
					data:{'caseid':'4'},
					success:function(resp){
						//console.log(resp);
						if(resp)
						{
							$("#model_body").html(" ");
							var dataTable = $('#model_table').DataTable({responsive: true});
							var dataObj = JSON.parse(resp);
							if(dataObj.msg == "-1")
							{					
								//$("#model_body").append('<tr><td>1</td><td colspan="3"><span style="color:red;">No data found..</span></td></tr>');
								dataTable.row.add(['1','<span style="color:red;">No data found..</span>','','']);
								dataTable.draw();
							}else{
								var dataArr = [];
								var subArr = [];
								var srno = 0
								for(var i=0; i < dataObj.length; i++)
								{									
									srno =  srno + 1;
									var manName = dataObj[i].man_name; 
									var modelName = dataObj[i].model_name;
									var mcount = dataObj[i].mcount;
									subArr.push(srno);
									subArr.push(manName);
									subArr.push(modelName);
									subArr.push(mcount);
									dataArr.push(subArr);
									subArr = [];
								}
								dataTable.rows.add(dataArr).draw();
								//console.log(dataArr);								
								$('#model_table tbody').on('click', 'tr', function () {
									//console.log(dataTable.row(this).data());
									var rowData = dataTable.row(this).data();
									var man_name = rowData[1];
									var model_name = rowData[2];
									$.ajax({
										url:'comman_functions.php',
										type:'POST',
										data:{'caseid':'5','man_name':man_name,'mname':model_name},
										success:function(resp){
											//console.log(resp);
											if(resp)
											{
												var srno = 0;
												$("#innerModalBody").html(" ");
												var modObj = JSON.parse(resp);
												if(modObj.msg == "-1")
												{
													$("#innerModalBody").html("<tr><td colspan='6'>No data found..!</td></tr>");
												}else{
													
													for(var k = 0; k < modObj.length; k++)
													{
														srno = k + 1;
														var mname = modObj[k].man_name;
														var modelName = modObj[k].model_name;
														var regNo = modObj[k].regno;
														var year = modObj[k].manyear;
														var color = modObj[k].color;
														$("#innerModalBody").append('<tr><td>'+srno+'</td><td>'+mname+'</td><td>'+modelName+'</td><td>'+regNo+'</td><td>'+year+'</td><td>'+color+'</td><td><a style="cursor:pointer;" onclick=soldModel("'+mname+'","'+modelName+'","'+regNo+'","'+year+'","'+color+'",this);>sold</a></td></tr>');
													}
													$("#dataModal").modal('show');													
												}
											}
										}
									});
								});
							}
						}						
					}				
				});
			}
						
			function soldModel(manName,modelName,regno,year,color,ele)
			{
				var row = $(ele).closest('tr').remove();
				console.log(row);
				$.ajax({
					url:'comman_functions.php',
					type:'POST',
					data:{'caseid':'6','man_name':manName,'mname':modelName,'regno':regno,'myear':year,'color':color},
					success:function(resp){
						//console.log(resp);
						if(resp)
						{
							var outRes = JSON.parse(resp);
							if(outRes.msg == "1")
							{
								$('#model_table').DataTable().destroy()
								getModelDetails();
							}
						}
					}
				});
			}
        </script>
    </body>
</html>
