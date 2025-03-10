<?php

    // Database connection
    include('functions/connection.php');

    // Fetch open job postings
    $query = "SELECT * FROM majaganiconsulting.job_postings WHERE status = 'Open'";
    $result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Browse Jobs | MAJAGANI CONSULTING</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
   <link href="assets/img/logo.png" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

 
</head>

<body>

  <!-- Header -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center">
      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename">MAJAGANI CONSULTING (PTY) LTD</h1>
      </a>
        
        <nav id="navmenu" class="navmenu">
            <ul>
            <li><a href="index.html#hero" class="active">Home</a></li>
            <li><a href="index.html#about">About</a></li>
            <li><a href="index.html#features">Features</a></li>
            <li><a href="index.html#services">Services</a></li>
            <li><a href="index.html#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <a class="btn-getstarted" href="browse_jobs.php">Career</a>
    </div>
  </header>
  <!-- End Header -->

  <!-- Browse Jobs Section -->
  <main class="main">
    <section id="jobs" class="jobs section">
      <div class="container-fluid" style="margin-top: 100px;">
        <div class="section-title text-center">
          <h2>Available Jobs</h2>
          <p>Browse through the open job postings and send your CV to <strong>recruitment@majaganiconsulting.co.za</strong>.</p>
        </div>

        <!-- Job Postings Table -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover">
            <thead class="table-primary">
              <tr>
                <th>Job Title</th>
                <th>Department</th>
                <th>Job Description</th>
                <th>Job Requirements</th>
                <th>Job Location</th>
							  <th>Job Work Setting</th>
                <th>Application Deadline</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($result->num_rows > 0): ?>
                <?php while ($job = $result->fetch_assoc()): 
				
				   if ($job['application_deadline'] < date('Y-m-d')) {
                        // Update the job status to "Closed" in the database
                        $jobId = $job['id']; // Assuming each job has a unique ID
                        $updateQuery = "UPDATE majaganiconsulting.job_postings SET status = 'Closed' WHERE id = $jobId";
                    
                        if (mysqli_query($conn, $updateQuery)) {
                          // echo "Job ID $jobId has been updated to 'Closed' due to expired deadline.";
                        } else {
                          // echo "Error updating job ID $jobId: " . mysqli_error($conn);
                        }
                    }

                  ?>
                  <tr>
                    <td><?= htmlspecialchars($job['job_title']) ?></td>
                    <td><?= htmlspecialchars($job['department']) ?></td>
                    <td><?= htmlspecialchars($job['job_description']) ?></td>
                    <td><?= htmlspecialchars($job['job_requirements']) ?></td>
                    <td><?= htmlspecialchars($job['jobLoc']) ?></td>
								    <td><?= htmlspecialchars($job['jobAdd']) ?></td>
                    <td><?= htmlspecialchars($job['application_deadline']) ?></td>
                    <td class="text-center">
                      <a href="mailto:recruitment@majaganiconsulting.co.za?subject=Application for <?= urlencode($job['job_title']) ?>" 
                         class="btn btn-primary">
                        Apply Now
                      </a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center">No jobs available at the moment. Please check back later!</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>
  <!-- End Browse Jobs Section -->

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
