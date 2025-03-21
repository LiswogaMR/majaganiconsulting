<?php
    include('functions/session_data.php');
   
?>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#">
                        <div class="pa-logo">
                            <!-- <img src="images/Fordel.png" style="width:48px"> -->
                            <img src="assets/img/logo.png" alt="" style="width:48px">
                        </div>
                    </a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="employee.php">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Administration
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="admin-leave-status.php">vacancy  Status</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle glyphicon glyphicon-menu" data-toggle="dropdown" href="#">
                        Profile
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div style="background-color:5CB85C; colour:#FFF; margin: 10px; text-align:center;">
                                    <?php echo $_SESSION['user']['name'] . ' ' . $_SESSION['user']['surname']; ?>
                                    <br/>
                                </div>
                            </li>
                            <li><a href="changePassword.php?email=<?php echo $_SESSION['user']['email']; ?>"><span class="glyphicon glyphicon-edit"></span>&nbsp;Change password</a></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php 
                if(strlen($_SESSION['msg'])){
                    echo "<div id='toast_message'> ".$_SESSION['msg']." </div>";
                }
                $_SESSION['msg'] = '';
            ?>
        </nav>

<script type="text/javascript">
    $('#toast_message').delay(2500).fadeOut();
</script>