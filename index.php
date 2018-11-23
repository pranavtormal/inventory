<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Car Inventory System</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/startmin.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
        <!-- DataTables Responsive CSS -->
        <link href="css/dataTables/dataTables.responsive.css" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">Car Inventory System</a>
                </div>
               
                <ul class="nav navbar-right navbar-top-links">                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> test <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">                            
                            <li class="divider"></li>
                            <li><a href=""><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">                            
                            <li>
                                <a href="index.php" class="active">
								<i class="fa fa-dashboard fa-fw"></i> 
									ADD Manufacture
								</a>
                            </li>
                            <li>
                                <a href="#" id="add_model"class="" ><i class="fa fa-dashboard fa-fw"></i> <span >ADD Model</span></a>
                            </li>
							<li>
                                <a href="#" class="" id="view_data"><i class="fa fa-dashboard fa-fw"></i> View </a>
                            </li>                                                                              
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
					<div class ="row" style="margin-top:6%;">
						<div class="col-sm-3">
							<label for="man_name" style="vertical-align: sub;">Enter Manufacture Name:</label>
						</div>
						<div class="col-sm-6">
							 <div class="form-group">
								
								<input type="text" placeholder="Manufacture Name" class="form-control" id="man_name">
								<span id="errFname" style="" class="text text-danger"></span><span id="errFname1" style="" class="text text-success"></span>
							</div>
						</div>
						<div class="col-sm-2">
							<button type="button" class="btn btn-success" id="submit_btn" disabled="true">Submit</button>
						</div>
					</div>
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>		
		<script>
			$("#man_name").focus();
			//validation
			$("#man_name").keyup(function(){
				var manName = $("#man_name").val();
				if(manName)
				{
					$("#submit_btn").attr('disabled',false);
				}else{
					$("#submit_btn").attr('disabled',true);
				}
			});
			
			$("#submit_btn").click(function(){
				var manName = $("#man_name").val();
				if(manName)
				{
					$.ajax({
						url:"comman_functions.php",
						type:'POST',
						data:{'caseid':'1','man_name':manName},
						success:function(resp)
						{					
							if(resp)
							{
								var out = JSON.parse(resp);
								//console.log(out);
								if(out.msg == 1)
								{
									$("#errFname1").html(" ");
									$("#errFname").html(" ");
									$("#man_name").val(" ");
									$("#errFname1").html("Manufacture Added Successfully.");
								}else{
									$("#errFname").html(" ");
									$("#errFname1").html(" ");
									$("#errFname").html(out.msg);
								}
							}
						}
					});	
				}else{
					$("#errFname").html("Enter Manufacture Name...");
				}
			});
			//load model
			$("#add_model").click(function(e){
				 e.preventDefault()
				$.ajax({
					url:"addmodel.php",
					type:"POST",
					success:function(resp){
						$("#page-wrapper").html(resp);
					}
				});
			});
			//load model Details
			$("#view_data").click(function(e){
				 e.preventDefault()
				$.ajax({
					url:"model_details.php",
					type:"POST",
					success:function(resp){
						$("#page-wrapper").html(resp);
					}
				});
			});
		</script>

    </body>
</html>
