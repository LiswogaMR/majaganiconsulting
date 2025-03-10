<?php
	include('functions/session_data.php');
	include('functions/connection.php');
	$loggedInUser = $_SESSION['user']['id'];
	$loggedInUserEmail = $_SESSION['user']['email'];


	// Fetch open job postings
    $query = "SELECT * FROM majaganiconsulting.job_postings WHERE status = 'Open'";
    $result = $conn->query($query);

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
	
	 <!-- Favicons -->
   <link href="assets/img/logo.png" rel="icon">

</head>
<body class="container">
	<!-- header starts here -->
    <?php include('admin-header.php'); ?>
	<!-- header ends here -->
	<!-- page content starts here -->
	<section id="page-container">
		<div id="content-wrap">
			<div class="row">
				<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#exampleModal">Add New Vacancy</button>
			</div>
			<br/>



			<!-- Job Postings Table -->
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover">
					<thead class="table-primary">
						<tr>
							<th>Job Title</th>
							<th>Department</th>
							<th>Job description</th>
							<th>Job Requirements</th>
							<th>Job Type</th>
							<th>Job Location</th>
							<th>Job Work Setting</th>
							<th>Deadline</th>
							<th>Status</th>
							<th>Posted By</th>
							<th>Date Posted</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php if ($result->num_rows > 0): ?>
						<?php while ($job = $result->fetch_assoc()): ?>
							<tr>
								<td><?= htmlspecialchars($job['job_title']) ?></td>
								<td><?= htmlspecialchars($job['department']) ?></td>
								<td><?= htmlspecialchars($job['job_description']) ?></td>
								<td><?= htmlspecialchars($job['job_requirements']) ?></td>
								<td><?= htmlspecialchars($job['job_type']) ?></td>
								<td><?= htmlspecialchars($job['jobLoc']) ?></td>
								<td><?= htmlspecialchars($job['jobAdd']) ?></td>
								<td><?= htmlspecialchars($job['application_deadline']) ?></td>
								<td><?= htmlspecialchars($job['status']) ?></td>
								<td><?= htmlspecialchars($job['posted_by']) ?></td>
								<td><?= htmlspecialchars($job['created_at']) ?></td>
								<td class="text-center">
									<!-- Edit Job Button -->
									<a class="editJob" data-toggle="modal" data-target="#editModal"
									data-rec="<?= htmlspecialchars($job['id']) ?>" 
									data-job_title="<?= htmlspecialchars($job['job_title']) ?>" 
									data-department="<?= htmlspecialchars($job['department']) ?>" 
									data-job_description="<?= htmlspecialchars($job['job_description']) ?>" 
									data-job_requirements="<?= htmlspecialchars($job['job_requirements']) ?>" 
									data-job_type="<?= htmlspecialchars($job['job_type']) ?>" 
									data-application_deadline="<?= htmlspecialchars($job['application_deadline']) ?>" 
									data-status="<?= htmlspecialchars($job['status']) ?>" 
									data-posted_by="<?= htmlspecialchars($job['posted_by']) ?>">
										<span class="glyphicon glyphicon-pencil"></span>
									</a>
									<br>
									<!-- Delete Job Button -->
									<a class="deleteJob" href="delete_job.php?id=<?= htmlspecialchars($job['id']) ?>" 
									onclick="return confirm('Are you sure you want to delete this job Post?');">
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</td>
							</tr>

						<?php endwhile; ?>
					<?php else: ?>
						<tr>
						<td colspan="5" class="text-center">No jobs available at the moment Posted that are open. Please Post new jobs to see new post!</td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>

		<!-- Example Modal for Posting a New Job -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModal">Post a New Job</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="functions/functions.php" method="POST" id="jobForm">
							<!-- Job Title -->
							<div class="form-group">
								<label for="jobTitle" class="col-form-label">Job Title:</label>
								<input type="text" id="jobTitle" name="jobTitle" class="form-control" placeholder="Enter the job title" required>
							</div>

							<!-- Department -->
							<div class="form-group">
								<label for="department" class="col-form-label">Department:</label>
								<select id="department" name="department" class="form-control" required>
									<option value="" selected>Please select a department...</option>
									<option value="HR">Human Resources</option>
									<option value="IT">Information Technology</option>
									<option value="Finance">Finance</option>
									<option value="Operations">Operations</option>
									<!-- Add more departments as needed -->
								</select>
							</div>

							<!-- Job Description -->
							<div class="form-group">
								<label for="jobDescription" class="col-form-label">Job Description:</label>
								<textarea id="jobDescription" name="jobDescription" class="form-control" rows="4" placeholder="Provide a detailed job description" required></textarea>
							</div>

							<!-- Job Requirements -->
							<div class="form-group">
								<label for="jobRequirements" class="col-form-label">Job Requirements:</label>
								<textarea id="jobRequirements" name="jobRequirements" class="form-control" rows="3" placeholder="List the job requirements" required></textarea>
							</div>

							<!-- Job Type -->
							<div class="form-group">
								<label for="jobType" class="col-form-label">Job Type:</label>
								<select id="jobType" name="jobType" class="form-control" required>
									<option value="" selected>Please select a job type...</option>
									<option value="Full-time">Full-time</option>
									<option value="Part-time">Part-time</option>
									<option value="Contract">Contract</option>
									<option value="Internship">Internship</option>
								</select>
							</div>

							<!-- Job Location -->
							<div class="form-group">
								<label for="jobLoc" class="col-form-label">Job Location Type:</label>
								<select id="jobLoc" name="jobLoc" class="form-control" required>
									<option value="" selected>Please select a job location Type...</option>
									<option value="Remote">Remote</option>
									<option value="Hybrid">Hybrid</option>
									<option value="Onsite">Onsite</option>
								</select>
							</div>

							<!-- Job Address -->
							<div class="form-group">
								<label for="jobAdd" class="col-form-label">Job Location Address:</label>
								<input type="text" id="jobAdd" name="jobAdd" class="form-control" placeholder="Enter the job Location Address" required>
							</div>

							<!-- Application Deadline -->
							<div class="form-group">
								<label for="applicationDeadline" class="col-form-label">Application Deadline:</label>
								<input type="date" id="applicationDeadline" name="applicationDeadline" class="form-control" required>
							</div>

							<!-- Status -->
							<div class="form-group">
								<label for="status" class="col-form-label">Status:</label>
								<input type="text" id="status" name="status" class="form-control" value="Open" readonly>
							</div>

							<!-- Action Type -->
							<input type="hidden" name="actionType" value="postJob">

							<!-- Modal Footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-custom-close" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" id="submitJob">Post Job</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>


			</div>

			<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editModalLabel">Edit Job Posting</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="functions/functions.php" method="POST" id="editJobForm">
								<!-- Hidden Field for Job ID -->
								<input type="hidden" id="editJobId" name="jobId">

								<!-- Job Title -->
								<div class="form-group">
									<label for="editJobTitle" class="col-form-label">Job Title:</label>
									<input type="text" id="editJobTitle" name="jobTitle" class="form-control" required>
								</div>

								<!-- Department -->
								<div class="form-group">
									<label for="editDepartment" class="col-form-label">Department:</label>
									<select id="editDepartment" name="department" class="form-control" required>
										<option value="HR">Human Resources</option>
										<option value="IT">Information Technology</option>
										<option value="Finance">Finance</option>
										<option value="Operations">Operations</option>
										<!-- Add more departments as needed -->
									</select>
								</div>

								<!-- Job Description -->
								<div class="form-group">
									<label for="editJobDescription" class="col-form-label">Job Description:</label>
									<textarea id="editJobDescription" name="jobDescription" class="form-control" rows="4" required></textarea>
								</div>

								<!-- Job Requirements -->
								<div class="form-group">
									<label for="editJobRequirements" class="col-form-label">Job Requirements:</label>
									<textarea id="editJobRequirements" name="jobRequirements" class="form-control" rows="3" required></textarea>
								</div>

								<!-- Job Type -->
								<div class="form-group">
									<label for="editJobType" class="col-form-label">Job Type:</label>
									<select id="editJobType" name="jobType" class="form-control" required>
										<option value="Full-time">Full-time</option>
										<option value="Part-time">Part-time</option>
										<option value="Contract">Contract</option>
										<option value="Internship">Internship</option>
									</select>
								</div>

								<!-- Job Location -->
								<div class="form-group">
									<label for="jobLoc" class="col-form-label">Job Location Type:</label>
									<select id="jobLoc" name="jobLoc" class="form-control" required>
										<option value="" selected>Please select a job location Type...</option>
										<option value="Remote">Remote</option>
										<option value="Hybrid">Hybrid</option>
										<option value="Onsite">Onsite</option>
									</select>
								</div>

								<!-- Job Address -->
								<div class="form-group">
									<label for="jobAdd" class="col-form-label">Job Location Address:</label>
									<input type="text" id="jobAdd" name="jobAdd" class="form-control" placeholder="Enter the job Location Address" required>
								</div>

								<!-- Application Deadline -->
								<div class="form-group">
									<label for="editApplicationDeadline" class="col-form-label">Application Deadline:</label>
									<input type="date" id="editApplicationDeadline" name="applicationDeadline" class="form-control" required>
								</div>

								<!-- Status -->
								<div class="form-group">
									<label for="editStatus" class="col-form-label">Status:</label>
									<select id="editStatus" name="status" class="form-control" required>
										<option value="Open">Open</option>
										<option value="Closed">Closed</option>
									</select>
								</div>

								<!-- Posted By -->
								<div class="form-group">
									<label for="editPostedBy" class="col-form-label">Posted By:</label>
									<input type="text" id="editPostedBy" name="postedBy" class="form-control" readonly>
								</div>

								<div class="modal-footer">
									<input type="hidden" name="actionType" value="updatepostJob">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save Changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>


		</div>
	<!-- page content ends here -->
	</section>	

	<script>

		$(document).on('click', '.editJob', function () {
			let rec = $(this).data('rec');
			let jobTitle = $(this).data('job_title');
			let department = $(this).data('department');
			let jobDescription = $(this).data('job_description');
			let jobRequirements = $(this).data('job_requirements');
			let jobType = $(this).data('job_type');
			let applicationDeadline = $(this).data('application_deadline');
			let status = $(this).data('status');
			let postedBy = $(this).data('posted_by');

			let jobLoc = $(this).data('jobLoc');
			let jobAdd = $(this).data('jobAdd');


			// Populate the modal fields
			$('#editJobId').val(rec);
			$('#editJobTitle').val(jobTitle);
			$('#editDepartment').val(department);
			$('#editJobDescription').val(jobDescription);
			$('#editJobRequirements').val(jobRequirements);
			$('#editJobType').val(jobType);
			$('#editApplicationDeadline').val(applicationDeadline);
			$('#editStatus').val(status);
			$('#editPostedBy').val(postedBy);

			$('#jobLoc').val(jobLoc);
			$('#jobAdd').val(jobAdd);

		});


	</script>        
</body>
</html>