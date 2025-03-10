<?php
	include('functions/session_data.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>MAJAGANI CONSULTING (PTY) LTD</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="vendor/css/bootstrap.min.css">
	<script src="vendor/js/jquery.min.js"></script>
	<script src="vendor/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="vendor/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="vendor/css/jquery-confirm.min.css">
	<script src="vendor/js/jquery-confirm.min.js"></script>
	<link rel="stylesheet" href="vendor/css/jquery-ui.css">
	<script type="text/javascript" src="vendor/js/datatables.min.js"></script>
	<link rel="stylesheet" href="vendor/css/dataTables.jqueryui.min.css">
	<script type="text/javascript" src="vendor/js/dataTables.jqueryui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="vendor/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" type="text/css" href="vendor/css/buttons.dataTables.min.css"/>
	<link rel="stylesheet" type="text/css" href="vendor/js/jquery.dataTables.min.js"/>
	<script type="text/javascript" src="vendor/js/dataTables.select.min.js"></script>
	<script type="text/javascript" src="vendor/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="vendor/js/jszip.min.js"></script>
	<script type="text/javascript" src="vendor/js/pdfmake.min.js"></script>
	<script type="text/javascript" src="vendor/js/vfs_fonts.js"></script>
	<script type="text/javascript" src="vendor/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="vendor/js/buttons.print.min.js"></script>
</head>
<body class="container">
	<!-- header starts here -->
    <?php include('admin-header.php'); ?>
	<!-- header ends here -->
	<!-- page content starts here -->
	<section id="page-container">
		<div id="content-wrap">
			<div class="row">
				<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#exampleModal">Add User</button>
			</div>
			<br/>
			<div class="employee">
				<div class="row">
					<div class="pa-tbl-cnt col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<table id="users" class="display" style="width:100%">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Status</th>
									<th>created/Updated</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Status</th>
									<th>created/Updated</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		
		</div>
	<!-- page content ends here -->
	</section>
	<!-- footer ends here -->	
	<script type="text/javascript">
		$(document).ready(function() {
			// var full.order_notes = 'true';
			var userTable = $('#users').DataTable( {
				"serverSide": true,
				//"processing": true,
				"pagingType": "full_numbers",
				// "lengthMenu":[[25,50,100],[25,50,100]],
				"order": [[ 1, "desc" ]],
				"ajax": {
					"url": 'functions/tables/users.php',
					"type": "POST",
				},
				"initComplete": function (settings, json) {
					$('tr.tableLoader').fadeOut('slow');
					$('tr.triggerActions').fadeIn('slow');
				},
					"dom": 'RfBrtlip',//Bfrtip
					"buttons": ['excel'],

				"columns":[
					{ "data": "name", "name": "name", "searchable": true},
					{ "data": "email", "name": "email", "searchable": false},
					{ "data": "status", "name": "status", "searchable": false},
					{ "data": "created", "name": "created", "searchable": false},
					// {render: function( data, type, full ){if(full.order_notes != null){return full.order_notes+' <button style="cursor:pointer;" class="btn btn-satgreen editComments"><small>Edit</small></button>'}else{return '<button style="cursor:pointer;" class="btn btn-satgreen editComments"><small>Edit</small></button>'}}, "name": "order_notes", "searchable": false, "orderable": false}
				],
				"createdRow": function( row, data){
					$(row).attr("id", data.rowID);
					$(row).attr("rec", data.rec);
					$(row).attr("class", "triggerActions");
				},
			});

			$('.dataTables_filter').addClass('pull-left');
			$('.dataTables_length').addClass('pull-right');

			//move buttons to container
			$('.buttonsContainer').append(userTable.buttons().containers());

		});
	</script>

</body>
</html>