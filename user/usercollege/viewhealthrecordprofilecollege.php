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
        require_once('../../db.php');
        if($_SESSION['leveleduc'] == 3){
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
    <title>Health Profile Form</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/dwcl.png"> 


    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
	  <link rel="stylesheet" href="assets/formstyle.css">

    <style>
        /* Define custom styles here */
        .form-container {
            background-color: #fff;
            box-shadow: 4px 4px 4px 4px rgba(76, 84, 177, 0.5);
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .form-title {
            text-align: center;
            color: #4c54b1;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>

</head> 

<body class="app">   	
<?php 
        include $_SERVER['DOCUMENT_ROOT'] . "/DivineClinic/components/navbar.php";
    ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    <div class="position-relative mb-3">
				    <div class="row g-3 justify-content-between">

				    </div>
			    </div>
			    
          <div class="app-card app-card-notification shadow-sm mb-4">
				    <div class="row g-3 align-items-center">
							<?php
								if(isset($_SESSION['success'])){
									echo $_SESSION['success'];
									unset($_SESSION['success']);
								}
							?>
				    </div><!--//app-card-header-->
				    <div class="app-card-body p-4">
              <?php
							$sql = "SELECT * FROM healthrecordformcollege WHERE user_id = '$user_id'";
							$result = $conn->query($sql);
    						while($row = $result->fetch_array()){
						?>

<div class="container">

  <div class="form-container">
            <div class="form-title">
            Health Record Form
            </div>
					
					  <form class="form-horizontal mt-4" action="function/funct.php" method="POST" enctype="multipart/form-data">

				<div class="input_form">

					<div class="input_wrap" style="text-align: center;">
						<div class="image_container" style="display: inline-block; text-align: center;">
							<img src="<?php echo "/CAPSTONE1/upload_image/".$row['image'];?>" style="display: block; margin: 0 auto;">
							<label style="text-align: center; display: block;">Your Image</label>
						</div>
					</div>

        </div>
        <br>

          <div class="input_form">

            <div class="input_wrap">
              <label for="fullname">Full Name</label>
              <input class="input-box" name="fullname" type="text" value="<?= $fullname; ?>" >
            </div>

            <div class="input_wrap">
                <label for="fullname">ID Number</label>
                <input name="idnumber" class="input-box" type="text" value="<?=$row['idnumber'];?>" readonly>
            </div>

            <div class="input_wrap">
              <label for="courseyear">Course & Year</label>
              <input class="input-box" id="courseyear" name="courseyear" type="text" style="width: 553px;" value="<?= isset($row['courseyear']) ? htmlspecialchars($row['courseyear']) : ''; ?>" readonly>
            </div>


          </div>

          <div class="input_form">
            
          <div class="input_wrap">
            <label for="fullname">Role</label>
            <select class="form-select" name="role">
              <option disabled selected><?= isset($row['role']) ? htmlspecialchars($row['role']) : ''; ?></option>
            </select>
          </div>


            <div class="input_wrap">
                <label for="fullname">Gender</label>
                <select class="form-select" name="gender">
                    <option disabled selected><?= $row['gender'];?></option>
                </select>
            </div>

            <div class="input_wrap">
                <label for="fullname">Address</label>
                <input name="address" id ="address" type="text" style="width:  553px;" value="<?=$row['address'];?>" readonly>
            </div>

          </div>
                            
    <div class="input_form">

      <div class="input_wrap">
        <label for="fullname">Phone Number</label>
        <input name="pcontact" class="input-box" type="text" id="form-control contactInput" value="<?=$row['pcontact'];?>" readonly>
      </div>
    
      <div class="input_wrap">
          <label for="fullname">Nationality</label>
          <input class="input-box" name="nationality" id="nationality" type="text" style="width: 240px;" value="<?=$row['nationality'];?>" readonly>
        </div>

      <div class="input_wrap">
        <label for="fullname">Birthday</label>
        <input name="birthday" class="input-box" id="birthday" type="date" value="<?=$row['birthday'];?>" readonly>
      </div>

      <div class="input_wrap">
          <label for="fullname">Religion</label>
          <input name="religion" class="input-box" id="religion" type="text" style="width: 240px;" value="<?=$row['religion'];?>" readonly>
      </div>

    </div>

      <div class="input_form">

        <div class="input_wrap">
            <label for="fullname">Father's/Guardian's Name</label>
            <input name="fguardian" class="input-box" id="fguardian" type="text" value="<?=$row['fguardian'];?>" readonly>
        </div>

        <div class="input_wrap">
            <label for="fullname">Occupation</label>
            <input name="occupation1" class="input-box" id="fguardian" type="text" value="<?=$row['occupation1'];?>" readonly>
        </div>

        <div class="input_wrap">
            <label for="fullname">Mother's Name</label>
            <input name="mother" class="input-box" id="fguardian" type="text" value="<?=$row['mother'];?>" readonly>
        </div>

        <div class="input_wrap">
            <label for="fullname">Occupation</label>
            <input name="occupation2" class="input-box" id="fguardian" type="text" value="<?=$row['occupation2'];?>" readonly>
        </div>

      </div>

      <div class="input_form">

        <div class="input_wrap">
          <label for="fullname">Contact in case of emergency</label>
          <input class="input-box" name="contactemer" id="contactemer" type="text" value="<?=$row['contactemer'];?>" readonly>
        </div>

        <div class="input_wrap">
          <label for="fullname">Contact Numbers</label>
          <input name="contactno" class="input-box" id="con" type="text" value="<?=$row['contactno'];?>" readonly>
        </div>

        <div class="input_wrap">
            <label for="fullname">Address</label>
            <input name="address2" class="input-box" id="con" type="text" value="<?=$row['address'];?>" readonly>
        </div>

        <div class="input_wrap">
            <label for="fullname">Relation to student/employee</label>
            <input name="relation" class="input-box" id="con" type="text" value="<?=$row['relation'];?>" readonly>
        </div>

      </div>

      <div class="input_form">

        <div class="input_wrap">
          <label for="fullname">Hospital of Choice of referral</label>
          <input class="input-box" name="referral" id="referral" type="text" value="<?=$row['referral'];?>" readonly>
        </div>

        <div class="input_wrap">
          <label for="fullname">Contact Numbers</label>
          <input class="input-box" name="contactno2" id="con" type="text" value="<?=$row['contactno2'];?>" readonly>
        </div>

        <div class="input_wrap">
            <label for="fullname">Physician and Number to call</label>
            <input class="input-box" name="physiciannumcall" id="physician" type="text" value="<?=$row['physiciannumcall'];?>" readonly>
        </div>

        <div class="input_wrap">
            <label for="fullname">Address of Hospital</label>
            <input class="input-box" name="addresshospital" id="physician" type="text" value="<?=$row['addresshospital'];?>" readonly>
        </div>

      </div>

    <div>
      <br>
      <b><p class="title" style="font-size: 20px; color: #000;">A. IMMUNIZATION</p></b>
    </div>

    <b><p class="vaccine">VACCINE</p></b>

    <div class="input_form">

      <div class="input_wrap">
        <label for="fullname">Tetanus & Diphtheria (Td) of Tetanus Toxoid</label>
        <input class="input-box" name="td" id="vaccine" type="text" placeholder="Write WHEN and WHERE administered" style="width: 555px;" value="<?=$row['td'];?>" readonly>
      </div>

      <div class="input_wrap" style="margin-left: 65px;">
        <label for="fullname">Measles, Mumps, Rubella (MMR) </label>
        <input class="input-box" name="mmr" id="vaccine" type="text" placeholder="Write WHEN and WHERE administered" style="width: 555px;" value="<?=$row['mmr'];?>" readonly>
      </div>

    </div>

    <div class="input_form">

      <div class="input_wrap">
        <label for="fullname">Hepatitis B</label>
        <input class="input-box" name="hepab" id="vaccine" type="text" placeholder="Write WHEN and WHERE administered" style="width: 555px;" value="<?=$row['hepab'];?>" readonly>
      </div>

      <div class="input_wrap" style="margin-left: 65px;">
        <label for="fullname">Varicella</label>
        <input class="input-box" name="varicella" id="vaccine" type="text" placeholder="Write WHEN and WHERE administered" style="width: 555px;" value="<?=$row['varicella'];?>" readonly>
      </div>

    </div>

    <div>
      <br>
      <b><p class="title" style="font-size: 20px; color: #000;">B. FAMILY HISTORY</p></b>
    </div>

    <b><p class="vaccine">DISEASE</p></b>

    <div class="input_wrap">
      <p>Asthma:</p>

      <div class="row-container">

        <div>
          <input class="checkbox" name="yesasthma" value="yesasthma" type="checkbox" id="yesasthma" value="<?= $row['yesasthma'];?>" <?php if ($row['yesasthma']) echo "checked"; ?>>
          <label class="checkbox-label" for="yesasthma" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>

        <div>
          <input class="checkbox" name="noasthma" value="noasthma" type="checkbox" id="noasthma" value="<?= $row['noasthma'];?>" <?php if ($row['noasthma']) echo "checked"; ?>>
          <label class="checkbox-label" for="noasthma" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>

        <div class="input_wrap">
          <input class="input-box" name="relationasthma" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationasthma'];?>" readonly>
        </div>

      </div>
    </div>

    <div class="input_wrap">
      <p>Bleeding Tendency:</p>

      <div class="row-container">
    
        <div>
          <input class="checkbox" name="yesbleeding" value="yesbleeding" type="checkbox" id="yesbleeding" value="<?= $row['yesbleeding'];?>" <?php if ($row['yesbleeding']) echo "checked"; ?>>
          <label class="checkbox-label" for="yesbleeding" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>
      
        <div>
          <input class="checkbox" name="nobleeding" value="nobleeding" type="checkbox" id="nobleeding" value="<?= $row['nobleeding'];?>" <?php if ($row['nobleeding']) echo "checked"; ?>>
          <label class="checkbox-label" for="nobleeding" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>
      
        <div class="input_wrap">
          <input class="input-box" name="relationbleeding" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationbleeding'];?>" readonly>
        </div>

      </div>
    </div>

    

    <div class="input_wrap">
      <p>Cancer:</p>

      <div class="row-container">
    
        <div>
          <input class="checkbox" name="yescancer" value="yescancer" type="checkbox" id="yescancer" value="<?= $row['yescancer'];?>" <?php if ($row['yescancer']) echo "checked"; ?>>
          <label class="checkbox-label" for="yescancer" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>
      
        <div>
          <input class="checkbox" name="nocancer" value="nocancer" type="checkbox" id="nocancer" value="<?= $row['nocancer'];?>" <?php if ($row['nocancer']) echo "checked"; ?>>
          <label class="checkbox-label" for="nocancer" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>
      
        <div class="input_wrap">
          <input class="input-box" name="relationcancer" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationcancer'];?>" readonly>
        </div>

      </div>
    </div>
    

    <div class="input_wrap">
      <p>Diabetes:</p>

      <div class="row-container">
    
        <div>
          <input class="checkbox" name="yesdiabetes" value="yesdiabetes" type="checkbox" id="yesdiabetes" value="<?= $row['yesdiabetes'];?>" <?php if ($row['yesdiabetes']) echo "checked"; ?>>
          <label class="checkbox-label" for="yesdiabetes" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>
      
        <div>
          <input class="checkbox" name="nodiabetes" value="nodiabetes" type="checkbox" id="nodiabetes" value="<?= $row['nodiabetes'];?>" <?php if ($row['nodiabetes']) echo "checked"; ?>>
          <label class="checkbox-label" for="nodiabetes" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>
      
        <div class="input_wrap">
          <input class="input-box" name="relationdiabetes" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationdiabetes'];?>" readonly>
        </div>

      </div>
    </div>

    

    <div class="input_wrap">
      <p>Heart Disorder:</p>

      <div class="row-container">
    
        <div>
          <input class="checkbox" name="yesheartdis" value="yesheartdis" type="checkbox" id="yesheartdis" value="<?= $row['yesheartdis'];?>" <?php if ($row['yesheartdis']) echo "checked"; ?>>
          <label class="checkbox-label" for="yesheartdis" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>
      
        <div>
          <input class="checkbox" name="noheartdis" value="noheartdis" type="checkbox" id="noheartdis" value="<?= $row['noheartdis'];?>" <?php if ($row['noheartdis']) echo "checked"; ?>>
          <label class="checkbox-label" for="noheartdis" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>
      
        <div class="input_wrap">
          <input class="input-box" name="relationheartdis" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationheartdis'];?>" readonly>
        </div>

      </div>
    </div>
    


    <div class="input_wrap">
      <p>High Blood Pressure:</p>

      <div class="row-container">

        <div>
          <input class="checkbox" name="yesbp" value="yesbp" type="checkbox" id="yesbp" value="<?= $row['yesbp'];?>" <?php if ($row['yesbp']) echo "checked"; ?>>
          <label class="checkbox-label" for="yesbp" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>

        <div>
          <input class="checkbox" name="nobp" value="nobp" type="checkbox" id="nobp" value="<?= $row['nobp'];?>" <?php if ($row['nobp']) echo "checked"; ?>>
          <label class="checkbox-label" for="nobp" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>

        <div class="input_wrap">
          <input class="input-box" name="relationbp" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationbp'];?>" readonly>
        </div>

      </div>
    </div>


    <div class="input_wrap">
      <p>Kidney Problem:</p>

      <div class="row-container">
    
        <div>
          <input class="checkbox" name="yeskidney" value="yeskidney" type="checkbox" id="yeskidney"value="<?= $row['yeskidney'];?>" <?php if ($row['yeskidney']) echo "checked"; ?>>
          <label class="checkbox-label" for="yeskidney" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>

        <div>
          <input class="checkbox" name="nokidney" value="nokidney" type="checkbox" id="nokidney" value="<?= $row['nokidney'];?>" <?php if ($row['nokidney']) echo "checked"; ?>>
          <label class="checkbox-label" for="nokidney" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>

        <div class="input_wrap">
          <input class="input-box" name="relationkidney" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationkidney'];?>" readonly>
        </div>

      </div>
    </div>
    
<!--  -->
    <div class="input_wrap">
      <p>Mental Disorder:</p>

      <div class="row-container">
    
        <div>
          <input class="checkbox" name="yesmental" value="yesmental" type="checkbox" id="yesmental" value="<?= $row['yesmental'];?>" <?php if ($row['yesmental']) echo "checked"; ?>>
          <label class="checkbox-label" for="yesmental" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>

        <div>
          <input class="checkbox" name="nomental" value="nomental" type="checkbox" id="nomental" value="<?= $row['nomental'];?>" <?php if ($row['nomental']) echo "checked"; ?>>
          <label class="checkbox-label" for="nomental" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>

        <div class="input_wrap">
          <input class="input-box" name="relationmental" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationmental'];?>" readonly>
        </div>

      </div>
    </div>
    

    <div class="input_wrap">
      <p>Obesity:</p>

      <div class="row-container">
    
        <div> 
          <input class="checkbox" name="yesobese" value="yesobese" type="checkbox" id="yesobese" value="<?= $row['yesobese'];?>" <?php if ($row['yesobese']) echo "checked"; ?>>
          <label class="checkbox-label" for="yesobese" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>

        <div>
          <input class="checkbox" name="noobese" value="noobese" type="checkbox" id="noobese" value="<?= $row['noobese'];?>" <?php if ($row['noobese']) echo "checked"; ?>>
          <label class="checkbox-label" for="noobese" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>

        <div class="input_wrap">
          <input class="input-box" name="relationobese" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationobese'];?>" readonly>
        </div>

      </div>
    </div>
    

    <div class="input_wrap">
      <p>Seizure Disorder:</p>
    </div>

    <div class="row-container">
    
      <div>
        <input class="checkbox" name="yesseizure" value="yesseizure" type="checkbox" id="yesseizure" value="<?= $row['yesseizure'];?>" <?php if ($row['yesseizure']) echo "checked"; ?>>
        <label class="checkbox-label" for="yesseizure" style="font-size: 14px; padding-left: 30px;">Yes</label>
      </div>

      <div>
        <input class="checkbox" name="noseizure" value="noseizure" type="checkbox" id="noseizure" value="<?= $row['noseizure'];?>" <?php if ($row['noseizure']) echo "checked"; ?>>
        <label class="checkbox-label" for="noseizure" style="font-size: 14px; padding-left: 30px;">No</label>
      </div>

      <div class="input_wrap">
        <input class="input-box" name="relationseizure" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationseizure'];?>" readonly>
      </div>
    </div>

    <div class="input_wrap">
      <p>Stroke:</p>

      <div class="row-container">
    
        <div>
          <input class="checkbox" name="yesstroke" value="yesstroke" type="checkbox" id="yesstroke" value="<?= $row['yesstroke'];?>" <?php if ($row['yesstroke']) echo "checked"; ?>>
          <label class="checkbox-label" for="yesstroke" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>

        <div>
          <input class="checkbox" name="nostroke" value="nostroke" type="checkbox" id="nostroke" value="<?= $row['nostroke'];?>" <?php if ($row['nostroke']) echo "checked"; ?>>
          <label class="checkbox-label" for="nostroke" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>

        <div class="input_wrap">
          <input class="input-box" name="relationstroke" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationstroke'];?>" readonly>
        </div>

      </div>
    </div>

    <div class="input_wrap">
      <p>Tuberculosis:</p>

      <div class="row-container">
    
        <div>
          <input class="checkbox" name="yestb" value="yestb" type="checkbox" id="yestb" value="<?= $row['yestb'];?>" <?php if ($row['yestb']) echo "checked"; ?>>
          <label class="checkbox-label" for="yestb" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>

        <div>
          <input class="checkbox" name="notb" value="notb" type="checkbox" id="notb" value="<?= $row['notb'];?>" <?php if ($row['notb']) echo "checked"; ?>>
          <label class="checkbox-label" for="notb" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>

        <div class="input_wrap">
          <input class="input-box" name="relationtb" id="otherillnesss" type="text" style="width: 400px;" placeholder="Relation(s) to student/employee" value="<?=$row['relationtb'];?>" readonly>
        </div>

      </div>
    </div>

<div>
  <br>
  <b><p class="title" style="font-size: 20px; color: #000;">C. MEDICAL HISTORY:</b></p>
  <p><i> The student/employee has suffered from: (please tick the box)</i></p>
  </div>
    
  <b><p class="vaccine">ILLNESS</p></b>

    <div class="input_form">

        <div>
            <input class="checkbox" name="allergy" value="allergy" type="checkbox" id="allergy" value="<?= $row['allergy'];?>" <?php if ($row['allergy']) echo "checked"; ?>>
            <label class="checkbox-label" for="allergy" style="font-size: 14px; padding-left: 30px;">ALLERGY</label>
        </div>
        <div>
            <input class="checkbox" name="anemia" value="anemia" type="checkbox" id="anemia" value="<?= $row['anemia'];?>" <?php if ($row['anemia']) echo "checked"; ?>>
            <label class="checkbox-label" for="anemia" style="font-size: 14px; padding-left: 30px;">ANEMIA</label>
        </div>
        <div>
            <input class="checkbox" name="asthma" value="asthma" type="checkbox" id="asthma" value="<?= $row['asthma'];?>" <?php if ($row['asthma']) echo "checked"; ?>> 
            <label class="checkbox-label" for="asthma" style="font-size: 14px; padding-left: 30px;">ASTHMA</label>
        </div>
        <div>
            <input class="checkbox" name="behavioral" value="behavioral" type="checkbox" id="behavioral" value="<?= $row['behavioral'];?>" <?php if ($row['behavioral']) echo "checked"; ?>>
            <label class="checkbox-label" for="behavioral" style="font-size: 14px; padding-left: 30px;">BEHAVIORAL PROBLEM</label>
        </div>
        <div>
            <input class="checkbox" name="bleedingprob" value="bleedingprob" type="checkbox" id="bleedingprob" value="<?= $row['bleedingprob'];?>" <?php if ($row['bleedingprob']) echo "checked"; ?>>
            <label class="checkbox-label" for="bleedingprob" style="font-size: 14px; padding-left: 30px;">BLEEDING PROBLEM</label>
        </div>
        <div>
            <input class="checkbox" name="blood" value="blood" type="checkbox" id="blood" value="<?= $row['blood'];?>" <?php if ($row['blood']) echo "checked"; ?>>
            <label class="checkbox-label" for="blood" style="font-size: 14px; padding-left: 30px;">BLOOD ABNORMALITY</label>
        </div>
        <div>
            <input class="checkbox" name="chickenpox" value="chickenpox" type="checkbox" id="chickenpox" value="<?= $row['chickenpox'];?>" <?php if ($row['chickenpox']) echo "checked"; ?>>
            <label class="checkbox-label" for="chickenpox" style="font-size: 14px; padding-left: 30px;">CHICKEN POX</label>
        </div>
        <div>
            <input class="checkbox" name="convulsion" value="convulsion" type="checkbox" id="convulsion" value="<?= $row['convulsion'];?>" <?php if ($row['convulsion']) echo "checked"; ?>>
            <label class="checkbox-label" for="convulsion" style="font-size: 14px; padding-left: 30px;">CONVULSION</label>
        </div>
        <div>
            <input class="checkbox" name="dengue" value="dengue" type="checkbox" id="dengue" value="<?= $row['dengue'];?>" <?php if ($row['dengue']) echo "checked"; ?>>
            <label class="checkbox-label" for="dengue" style="font-size: 14px; padding-left: 30px;">DENGUE</label>
        </div>
        <div>
            <input class="checkbox" name="diabetess" value="diabetess" type="checkbox" id="diabetess" value="<?= $row['diabetess'];?>" <?php if ($row['diabetess']) echo "checked"; ?>>
            <label class="checkbox-label" for="diabetess" style="font-size: 14px; padding-left: 30px;">DIABETES</label>
        </div>
        <div>
            <input class="checkbox" name="earproblem" value="earproblem" type="checkbox" id="earproblem" value="<?= $row['earproblem'];?>" <?php if ($row['earproblem']) echo "checked"; ?>>
            <label class="checkbox-label" for="earproblem" style="font-size: 14px; padding-left: 30px;">EAR PROBLEM</label>
        </div>
        <div>
            <input class="checkbox" name="eating_disorder" value="eating_disorder" type="checkbox" id="eating_disorder" value="<?= $row['eating_disorder'];?>" <?php if ($row['eating_disorder']) echo "checked"; ?>>
            <label class="checkbox-label" for="eating_disorder" style="font-size: 14px; padding-left: 30px;">EATING DISORDER</label>
        </div>

        <div>
            <input class="checkbox" name="epilepsy" value="epilepsy" type="checkbox" id="epilepsy" value="<?= $row['epilepsy'];?>" <?php if ($row['epilepsy']) echo "checked"; ?>>
            <label class="checkbox-label" for="epilepsy" style="font-size: 14px; padding-left: 30px;">EPILEPSY</label>
        </div>
        <div>
            <input class="checkbox" name="eyeproblemm" value="eyeproblemm" type="checkbox" id="eyeproblemm" value="<?= $row['eyeproblemm'];?>" <?php if ($row['eyeproblemm']) echo "checked"; ?>>
            <label class="checkbox-label" for="eyeproblemm" style="font-size: 14px; padding-left: 30px;">EYE PROBLEM</label>
        </div>
        <div>
            <input class="checkbox" name="fracture" value="fracture" type="checkbox" id="fracture" value="<?= $row['fracture'];?>" <?php if ($row['fracture']) echo "checked"; ?>>
            <label class="checkbox-label" for="fracture" style="font-size: 14px; padding-left: 30px;">FRACTURE</label>
        </div>
        <div>
            <input class="checkbox" name="hearing_problem" value="hearing_problem" type="checkbox" id="hearing_problem" value="<?= $row['hearing_problem'];?>" <?php if ($row['hearing_problem']) echo "checked"; ?>>
            <label class="checkbox-label" for="hearing_problem" style="font-size: 14px; padding-left: 30px;">HEARING PROBLEM</label>
        </div>
        <div>
            <input class="checkbox" name="heart_disorder" value="heart_disorder" type="checkbox" id="heart_disorder" value="<?= $row['heart_disorder'];?>" <?php if ($row['heart_disorder']) echo "checked"; ?>>
            <label class="checkbox-label" for="heart_disorder" style="font-size: 14px; padding-left: 30px;">HEART DISORDER</label>
        </div>
        <div>
            <input class="checkbox" name="hyperacidity" value="hyperacidity" type="checkbox" id="hyperacidity" value="<?= $row['hyperacidity'];?>" <?php if ($row['hyperacidity']) echo "checked"; ?>>
            <label class="checkbox-label" for="hyperacidity" style="font-size: 14px; padding-left: 30px;">HYPERACIDITY</label>
        </div>
        <div>
            <input class="checkbox" name="indigestion" value="indigestion" type="checkbox" id="indigestion" value="<?= $row['indigestion'];?>" <?php if ($row['indigestion']) echo "checked"; ?>>
            <label class="checkbox-label" for="indigestion" style="font-size: 14px; padding-left: 30px;">INDIGESTION</label>
        </div>
        <div>
            <input class="checkbox" name="insomia" value="insomia" type="checkbox" id="insomia" value="<?= $row['insomia'];?>" <?php if ($row['insomia']) echo "checked"; ?>>
            <label class="checkbox-label" for="insomia" style="font-size: 14px; padding-left: 30px;">INSOMIA</label>
        </div>
        <div>
            <input class="checkbox" name="kidney_problem" value="kidney_problem" type="checkbox" id="kidney_problem" value="<?= $row['kidney_problem'];?>" <?php if ($row['kidney_problem']) echo "checked"; ?>>
            <label class="checkbox-label" for="kidney_problem" style="font-size: 14px; padding-left: 30px;">KIDNEY PROBLEM</label>
        </div>
        <div>
            <input class="checkbox" name="liver_problem" value="liver_problem" type="checkbox" id="liver_problem" value="<?= $row['liver_problem'];?>" <?php if ($row['liver_problem']) echo "checked"; ?>>
            <label class="checkbox-label" for="liver_problem" style="font-size: 14px; padding-left: 30px;">LIVER PROBLEM</label>
        </div>
        <div>
            <input class="checkbox" name="measless" value="measless" type="checkbox" id="measless" value="<?= $row['measless'];?>" <?php if ($row['measless']) echo "checked"; ?>>
            <label class="checkbox-label" for="measless" style="font-size: 14px; padding-left: 30px;">MEASLES</label>
        </div>
        <div>
            <input class="checkbox" name="mumpss" value="mumpss" type="checkbox" id="mumpss" value="<?= $row['mumpss'];?>" <?php if ($row['mumpss']) echo "checked"; ?>>
            <label class="checkbox-label" for="mumpss" style="font-size: 14px; padding-left: 30px;">MUMPS</label>
        </div>
        <div>
            <input class="checkbox" name="parasitism" value="parasitism" type="checkbox" id="parasitism" value="<?= $row['parasitism'];?>" <?php if ($row['parasitism']) echo "checked"; ?>>
            <label class="checkbox-label" for="parasitism" style="font-size: 14px; padding-left: 30px;">PARASITISM</label>
        </div>
        <div>
            <input class="checkbox" name="pneumonia" value="pneumonia" type="checkbox" id="pneumonia" value="<?= $row['pneumonia'];?>" <?php if ($row['pneumonia']) echo "checked"; ?>>
            <label class="checkbox-label" for="pneumonia" style="font-size: 14px; padding-left: 30px;">PNEUMONIA</label>
        </div>
        <div>
            <input class="checkbox" name="primary_complex" value="primary_complex" type="checkbox" id="primary_complex" value="<?= $row['primary_complex'];?>" <?php if ($row['primary_complex']) echo "checked"; ?>>
            <label class="checkbox-label" for="primary_complex" style="font-size: 14px; padding-left: 30px;">PRIMARY COMPLEX</label>
        </div>
        <div>
            <input class="checkbox" name="scoliosis" value="scoliosis" type="checkbox" id="scoliosis" value="<?= $row['scoliosis'];?>" <?php if ($row['scoliosis']) echo "checked"; ?>>
            <label class="checkbox-label" for="scoliosis" style="font-size: 14px; padding-left: 30px;">SCOLIOSIS</label>
        </div>
        <div>
            <input class="checkbox" name="skin_problem" value="skin_problem" type="checkbox" id="skin_problem" value="<?= $row['skin_problem'];?>" <?php if ($row['skin_problem']) echo "checked"; ?>>
            <label class="checkbox-label" for="skin_problem" style="font-size: 14px; padding-left: 30px;">SKIN PROBLEM</label>
        </div>
        <div>
            <input class="checkbox" name="tonsillitis" value="tonsillitis" type="checkbox" id="tonsillitis" value="<?= $row['tonsillitis'];?>" <?php if ($row['tonsillitis']) echo "checked"; ?>>
            <label class="checkbox-label" for="tonsillitis" style="font-size: 14px; padding-left: 30px;">TONSILLITIS</label>
        </div>
        <div>
            <input class="checkbox" name="typhoid_fever" value="typhoid_fever" type="checkbox" id="typhoid_fever" value="<?= $row['typhoid_fever'];?>" <?php if ($row['typhoid_fever']) echo "checked"; ?>>
            <label class="checkbox-label" for="typhoid_fever" style="font-size: 14px; padding-left: 30px;">TYPHOID FEVER</label>
        </div>
        <div>
            <input class="checkbox" name="vision_defect" value="vision_defect" type="checkbox" id="vision_defect" value="<?= $row['vision_defect'];?>" <?php if ($row['vision_defect']) echo "checked"; ?>>
            <label class="checkbox-label" for="vision_defect" style="font-size: 14px; padding-left: 30px;">VISION DEFECT</label>
        </div>

    </div>

    <div>
        <br>
        <p><i>The student/employee has a history of</i></p>
    </div>

    <div class="row-container">
    
      <b><p>Hospitalization</p></b>

        <div>
          <input class="checkbox" name="yeshospitalization" value="yeshospitalization" type="checkbox" id="yeshospitalization" value="<?= $row['yeshospitalization'];?>" <?php if ($row['yeshospitalization']) echo "checked"; ?>>
          <label class="checkbox-label" for="yeshospitalization" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>

        <div>
          <input class="checkbox" name="nohospitalization" value="nohospitalization" type="checkbox" id="nohospitalization" value="<?= $row['nohospitalization'];?>" <?php if ($row['nohospitalization']) echo "checked"; ?>>
          <label class="checkbox-label" for="nohospitalization" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>
        
        <b><p>Surgical Operation</p></b>

        <div>
          <input class="checkbox" name="yessurgical" value="yessurgical" type="checkbox" id="yessurgical" value="<?= $row['yessurgical'];?>" <?php if ($row['yessurgical']) echo "checked"; ?>>
          <label class="checkbox-label" for="yessurgical" style="font-size: 14px; padding-left: 30px;">Yes</label>
        </div>

        <div>
          <input class="checkbox" name="nosurgical" value="nosurgical" type="checkbox" id="nosurgical" value="<?= $row['nosurgical'];?>" <?php if ($row['nosurgical']) echo "checked"; ?>>
          <label class="checkbox-label" for="nosurgical" style="font-size: 14px; padding-left: 30px;">No</label>
        </div>

    </div>

<br>
        <div class="input_form">
          <div class="input_wrap">
            <label>The student/employee is on special medication</label>
            <input name="specialmed" type="text" style="width: 1185px;" value="<?=$row['specialmed'];?>" readonly>
          </div>
        </div>
        <div class="input_form">
          <div class="input_wrap">
            <label>The student/employee is allergic to the following drugs</label>
            <input name="allergicdrugs" type="text" style="width: 1185px;" value="<?=$row['allergicdrugs'];?>" readonly>
          </div>
        </div>
        <div class="input_form">
          <div class="input_wrap">
            <label>Other relevant information</label>
            <input name="otherrelevant" type="text" style="width: 1185px;" value="<?=$row['otherrelevant'];?>" readonly>
          </div>
        </div>
        
    </div>
            <?php
							}
						?>
</form>
</div>
</div>

				    </div><!--//app-card-body-->
				</div>			    
		    </div>
	    </div>
    </div>  					
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

</body>
</html> 

