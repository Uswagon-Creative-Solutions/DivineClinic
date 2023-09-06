<?php
    session_start();
    include '../../db.php';

    if (!isset($_SESSION['user_id'])){
        echo '<script>window.alert("PLEASE LOGIN FIRST!!")</script>';
        echo '<script>window.location.replace("../login.php");</script>';
        exit; // Exit the script to prevent further execution
    }

    $user_id = $_SESSION['user_id'];
    $sql_query = "SELECT * FROM users WHERE user_id ='$user_id'";
    $result = $conn->query($sql_query);
    while($row = $result->fetch_array()){
        $user_id = $row['user_id'];
        $fullname = $row['fullname'];
        $idnumber = $row['idnumber'];
        require_once('../../db.php');
        if($_SESSION['leveleduc'] == 1){
            // User type 1 specific code here
        }
        else{
            header('location: ../login.php');
            exit; // Exit the script to prevent further execution
        }
    }
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Physical Examination Record</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="assets/images/dwcl.png"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <link rel="stylesheet" href="assets/dentalstyles.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../../assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" type="text/css" href="../../assets/css/select2.min.css">

<link rel="stylesheet" href="../../assets/plugins/simple-calendar/simple-calendar.css">

<link rel="stylesheet" href="../../assets/plugins/datatables/datatables.min.css">

<link rel="stylesheet" type="text/css" href="../../assets/plugins/slick/slick.css">
<link rel="stylesheet" type="text/css" href="../../assets/plugins/slick/slick-theme.css">

<link rel="stylesheet" href="../../assets/plugins/feather/feather.css">

<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">



</head> 

<body class="app">   	

<?php  	
// Retrieve the health record for the given ID number
$sql = "SELECT * FROM physicalexaminationgsjhs WHERE idnumber = '$idnumber'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = $result->fetch_assoc(); 
    $idnumber = $row['idnumber'];
    $fullname = $row['fullname'];
    $age= $row['age'];
    $sex = $row['sex'];
    $levelsection = $row['levelsection'];
    $pastsurgeries = $row['pastsurgeries'];
    $familyhistory = $row['familyhistory'];
    $bp = $row['bp'];
    $pr = $row['pr'];
    $height = $row['height'];
    $weight= $row['weight'];
    $bmi = $row['bmi'];
    $heent = $row['heent'];
    $cvs = $row['cvs'];
    $gis = $row['gis'];
    $gus = $row['gus'];
    $remarks = $row['remarks'];
    $medicalexaminer = $row['medicalexaminer'];
    $dateexamined = $row['dateexamined'];
  
  
      }
   else {
   } 
  ?>   
  <header class="app-header fixed-top">	   	
      
  <div class="main-wrapper">
  <div class="header">
  <div class="header-left">
  <a href="#" class="logo">
  <img src="../assets/images/dwcl.png" width="35" height="35" alt> <span>DWCL Clinic</span>
  </a>
  </div>
  <a id="toggle_btn" href="javascript:void(0);"><img src="../../assets/img/icons/bar-icon.svg" alt></a>
  <a id="mobile_btn" class="mobile_btn float-start" href="#sidebar"><img src="../../assets/img/icons/bar-icon.svg" alt></a>
  <ul class="nav user-menu float-end">
  <li class="nav-item dropdown d-none d-md-block">
  <li class="nav-item dropdown has-arrow user-profile-list">
  <a href="#" class="dropdown-toggle nav-link user-link" data-bs-toggle="dropdown">
  <div class="user-names">
  <h5><?= $fullname;?></h5>
  </div>
  <span class="user-img">
  <img src="assets/images/user.png">
  </span>
  </a>
  <div class="dropdown-menu">
  <a class="dropdown-item" href="function/logout.php">Log Out</a>
  </div>
  </li>
  </ul>
  </div>
          <div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
  <div id="sidebar-menu" class="sidebar-menu">
  <ul>
  <li class="menu-title">Main</li>
  
  <li>
  <a href="healthrecordformgsjhs.php"><span class="menu-side"><img src="../../assets/img/icons/menu-icon-13.svg" alt></span> <span>Health Profile</span></a>
  </li>
  <li class="submenu">
  <a href="#"><span class="menu-side"><img src="../../assets/img/icons/menu-icon-04.svg" alt></span> <span> Appointment </span> <span class="menu-arrow"></span></a>
  <ul style="display: none;">
                      <li class="submenu-item"><a class="submenu-link" href="adddentalmessagegsjhs.php">Request Dental Scheduling</a></li>
                      <li class="submenu-item"><a class="submenu-link" href="addmedicalmessagegsjhs.php">Request Medical Scheduling</a></li>
                      <li class="submenu-item"><a class="submenu-link" href="addphysicianmessagegsjhs.php">Request Physician Scheduling</a></li>
  </ul>
  </li>
  <li class="submenu">
  <a href="#"><span class="menu-side"><img src="../../assets/img/icons/menu-icon-15.svg" alt></span>  <span> Clinic Records </span> <span class="menu-arrow"></span></a>
  <ul style="display: none;">
  <li class="submenu-item"> <a class="submenu-link" href="viewhealthrecordprofile.php">Health Profile Record</a>
                    <li class="submenu-item"> <a class="submenu-link" href="viewdentalappgsjhs.php">Dental Record</a>
                                      <li class="submenu-item"> <a class="submenu-link" href="viewmedicalappgsjhs.php">Medical Record</a>
                                      <li class="submenu-item"> <a class="submenu-link" href="viewphysicianappgsjhs.php">Physician Record</a>
                    <li class="submenu-item"> <a class="submenu-link" href="viewdiagnosisgsjhs.php">Diagnosis/Chief Complaints, Management & Treatment Record</a>
                    <li class="submenu-item"> <a class="submenu-link" href="viewschoolassesgsjhs.php">School Health Assessment Record</a>
                    <li class="submenu-item"> <a class="active" class="submenu-link" href="viewphysicalexaminationrecordgsjhs.php">Physical Examination Record</a>
                    <li class="submenu-item"> <a class="submenu-link" href="viewphysicianorderandprogressnotesgsjhs.php">Physician's Order Sheet and Progress Notes Record</a>
  </ul>
  </li>
  </div>
  </div>
      </header>
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    <div class="position-relative mb-3">
				    <div class="row g-3 justify-content-between">
					    <div class="col-auto">
					        <h1 class="app-page-title mb-0"></h1>
					    </div>
						
				    </div>
			    </div>
			    
                <div class="app-card app-card-notification shadow-sm mb-4">
				    <div class="app-card-header px-4 py-3">
				        <div class="row g-3 align-items-center">
					        <div class="col-12 col-lg-auto text-center text-lg-start">
						        <h4 class="notification-title mb-1">Physical Examination Record</h4>
					        </div>
                            <?php
								if(isset($_SESSION['success'])){
									echo $_SESSION['success'];
									unset($_SESSION['success']);
								}
							?>
				        </div><!--//row-->
				    </div><!--//app-card-header-->
                    <div class="app-card-body p-4">
                   
                    <?php
							$sql = "SELECT * FROM physicalexaminationgsjhs WHERE idnumber = '$idnumber'";
							$result = $conn->query($sql);
    						while($row = $result->fetch_array()){
						?>
                  
                   <div class="row">
  <div class="col-sm-3">
    <div class="form-group">
      <label for="idnumber" class="col-sm-12 control-label">Patient ID Number</label>
      <input type="text" class="form-control" id="idnumber" name="idnumber" value="<?=$row['idnumber'];?>" readonly>
    </div>
  </div>
  <div class="col-sm-5">
    <div class="form-group">
      <label for="fullname" class="col-sm-12 control-label">Name</label>
      <input type="text" class="form-control" id="fullname" name="fullname" value="<?=$row['fullname'];?>" readonly>
    </div>
  </div>
  <div class="col-sm-1">
    <div class="form-group">
      <label for="age" class="col-sm-12 control-label">Age</label>
      <input type="text" class="form-control" id="age" name="age" value="<?=$row['age'];?>" readonly>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="form-group">
    <label for="fullname">Sex</label>
                <select class="form-select" name="sex">
                <option disabled selected><?= $row['sex'];?></option>
                </select>
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-sm-7">
                         <div class="form-group">
                           <label for="levelsection" class="col-sm-12 control-label">Level/Section</label>
                           <input type="text" id="levelsection" name="levelsection" class="form-control" value="<?=$row['levelsection'];?>" readonly>
                         </div>
                       </div>
                  </div>
    <br>

   <b><i> <p>Significant Medical History:</b></i></p>

   <div class="row">
  <div class="col-sm-9">
                         <div class="form-group">
                           <label for="pastsurgeries" class="col-sm-12 control-label">Past Illnesses/Surgeries</label>
                           <input type="text" id="pastsurgeries" name="pastsurgeries" class="form-control" value="<?=$row['pastsurgeries'];?>" readonly>
                         </div>
                       </div>
                  </div>
   <br> 
<div class="row">
  <div class="col-sm-9">
                         <div class="form-group">
                           <label for="allergies" class="col-sm-12 control-label">Allergies</label>
                           <input type="text" id="allergies" name="allergies" class="form-control" value="<?=$row['allergies'];?>" readonly>
                         </div>
                       </div>
                  </div>
    
                  <br> 
<div class="row">
  <div class="col-sm-9">
                         <div class="form-group">
                           <label for="familyhistory" class="col-sm-12 control-label">Family History</label>
                           <input type="text" id="familyhistory" name="familyhistory" class="form-control" value="<?=$row['familyhistory'];?>" readonly>
                         </div>
                       </div>
                  </div>

<br>
   <b><i> <p>Physical Examination:</b></i></p>

   <div class="row">
  <div class="col-sm-2">
    <div class="form-group" style="margin-right: 20px">
      <label for="bp" class="col-sm-12 control-label">BP</label>
      <input type="text" class="form-control" id="bp" name="bp" value="<?=$row['bp'];?>" readonly>
    </div>
  </div>
  <div class="col-sm-2" style="margin-right: 20px">
    <div class="form-group">
      <label for="pr" class="col-sm-12 control-label">PR</label>
      <input type="text" class="form-control" id="pr" name="pr" value="<?=$row['pr'];?>" readonly>
    </div>
  </div>
  <div class="col-sm-2" style="margin-right: 20px">
    <div class="form-group">
      <label for="height" class="col-sm-12 control-label">Height</label>
      <input type="text" class="form-control" id="height" name="height" value="<?=$row['height'];?>" readonly>
    </div>
  </div>
  <div class="col-sm-2" style="margin-right: 20px">
    <div class="form-group">
      <label for="weight" class="col-sm-12 control-label">Weight</label>
      <input type="text" class="form-control" id="weight" name="weight" value="<?=$row['weight'];?>" readonly>
    </div>
  </div>
  <div class="col-sm-2" style="margin-right: 20px">
    <div class="form-group">
      <label for="bmi" class="col-sm-12 control-label">BMI</label>
      <input type="text" class="form-control" id="bmi" name="bmi" value="<?=$row['bmi'];?>" readonly>
    </div>
  </div>
</div>

<br>
   <b><i> <p>General Appearance:</b></i></p>

   <div class="row">
  <div class="col-sm-9">
                         <div class="form-group">
                           <label for="heent" class="col-sm-12 control-label">HEENT</label>
                           <input type="text" id="heent" name="heent" class="form-control" value="<?=$row['heent'];?>" readonly>
                         </div>
                       </div>
                  </div>
   <br> 
<div class="row">
  <div class="col-sm-9">
                         <div class="form-group">
                           <label for="cvs" class="col-sm-12 control-label">CVS</label>
                           <input type="text" id="cvs" name="cvs" class="form-control"value="<?=$row['cvs'];?>" readonly>
                         </div>
                       </div>
                  </div>
    
                  <br> 
<div class="row">
  <div class="col-sm-9">
                         <div class="form-group">
                           <label for="gis" class="col-sm-12 control-label">GIS</label>
                           <input type="text" id="gis" name="gis" class="form-control" value="<?=$row['gis'];?>" readonly>
                         </div>
                       </div>
                  </div>

                  <br> 
<div class="row">
  <div class="col-sm-9">
                         <div class="form-group">
                           <label for="gus" class="col-sm-12 control-label">GUS</label>
                           <input type="text" id="gus" name="gus" class="form-control" value="<?=$row['gus'];?>" readonly>
                         </div>
                       </div>
                  </div>

                  <br> 
<div class="row">
  <div class="col-sm-9">
                         <div class="form-group">
                           <label for="extremities" class="col-sm-12 control-label">Extremities</label>
                           <input type="text" id="extremities" name="extremities" class="form-control" value="<?=$row['extremities'];?>" readonly>
                         </div>
                       </div>
                  </div>
                  <br>
<div class="row">
  <div class="col-sm-9">
                         <div class="form-group">
                           <label for="remarks" class="col-sm-12 control-label"><b>Remarks</b></label>
                           <input type="text" id="remarks" name="remarks" class="form-control" value="<?=$row['remarks'];?>" readonly>
                         </div>
                       </div>
                  </div>

                  <br><br>
<div class="row">
  <div class="col-sm-6">
                         <div class="form-group">
                           <label for="medicalexaminer" class="col-sm-12 control-label">Medical Examiner</label>
                           <input type="text" id="medicalexaminer" name="medicalexaminer" class="form-control" value="<?=$row['medicalexaminer'];?>" readonly>
                         </div>
                       </div>
 <div class="col-sm-6">
                         <div class="form-group">
                           <label for="dateexamined" class="col-sm-12 control-label">Date Examined</label>
                           <input type="date" id="dateexamined" name="dateexamined" class="form-control" value="<?=$row['dateexamined'];?>" readonly>
                         </div>
                       </div>
                  </div>

<br><br>
                  <?php } ?>

                
    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 
	
	<script>
		// Timer to remove success message after 5 seconds (5000 milliseconds)
		setTimeout(function(){
			var successMessage = document.getElementById('success-message');
			if(successMessage){
				successMessage.remove();
			}
		}, 5000);
	</script>


<div class="sidebar-overlay" data-reff></div>

<script src="../../assets/js/jquery-3.6.1.min.js"></script>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>

<script src="../../assets/js/feather.min.js"></script>

<script src="../../assets/js/jquery.slimscroll.js"></script>

<script src="../../assets/js/select2.min.js"></script>

<script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/plugins/datatables/datatables.min.js"></script>

<script src="../../assets/plugins/simple-calendar/jquery.simple-calendar.js"></script>
<script src="../../assets/js/calander.js"></script>

<script src="../../assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="../../assets/plugins/apexchart/chart-data.js"></script>

<script src="../../assets/js/circle-progress.min.js"></script>

<script src="../../assets/plugins/slick/slick.js"></script>

<script src="../../assets/js/app.js"></script>
</body>
</html> 

