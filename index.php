<?php  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aub";
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


/*
=================================
	Add Student
=================================
*/
if (isset($_POST['submit'])) {

	$error = array();

	if (isset($_POST['st_name']) && $_POST['st_name']!="") {
		$st_name = htmlspecialchars($_POST['st_name']);
	}else{
		$error[] = 'Student name is not find';
	}
		if (isset($_POST['st_vc_id']) && $_POST['st_vc_id']!="") {
			$st_vc_id = htmlspecialchars($_POST['st_vc_id']);
		}else{
			$error[] = 'Student Id is not find';
		}
			if (isset($_POST['st_phone']) && $_POST['st_phone']!="") {
				$st_phone = htmlspecialchars($_POST['st_phone']);
			}else{
				$error[] = 'Student Phone is not find';
			}
				if (isset($_POST['st_size']) && $_POST['st_size']!="") {
					$st_size = htmlspecialchars($_POST['st_size']);
				}else{
					$error[] = 'Student T-shirt Size is not find';
				}
					if (isset($_POST['select_dete']) && $_POST['select_dete']!="") {
						$select_dete = htmlspecialchars($_POST['select_dete']);
					}else{
						$error[] = 'Select date is not find';
					}
						if (isset($_POST['st_join']) && $_POST['st_join']!="") {
							$st_join = htmlspecialchars($_POST['st_join']);
						}else{
							$error[] = 'Why are you not Join !!!';
						}

	if (empty($error)) {
		$sql = "INSERT INTO students (st_name, st_phone, st_size, select_dete, st_join, st_vc_id) VALUES ('$st_name', '$st_phone', '$st_size', '$select_dete', '$st_join', '$st_vc_id')";

		if ($conn->query($sql) === TRUE) {
		    $error[] = "New record created successfully";
		} else {
		    $error[] = "Sorry your data not inserted !!!";
		}
	}
}

?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Material Design for Bootstrap fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <!-- Material Design for Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>AUB-CSE-DIP-53 RAG DAY REG FORM</title>
  </head>
  <body>
    
    <section id="main">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-8">
					<div class="main_form">
						<?php  
							if (!empty($error)) {
								foreach ($error as $item) {
						?>
						<div class="alert alert-success alert-dismissible fade show mt-2 mb-1" role="alert">
						  <strong><?php echo $item ?></strong>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<?php
								}
							}
						?>

						<form action="<?php echo $actual_link; ?>" method="POST">
							<div class="form-group">
								<label for="name" class="bmd-label-floating">Your Name</label>
								<input name="st_name" type="text" class="form-control" id="name" autocomplete="OFF" required>
								<span class="bmd-help">Your full name (Nick name can be use here)</span>
							</div>
							<div class="form-group">
								<label for="StudentId" class="bmd-label-floating">Your Student ID</label>
								<input name="st_vc_id"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" class="form-control" id="StudentId" autocomplete="OFF" required>
								<span class="bmd-help">Your Student ID. Ex: 201630265</span>
							</div>
							<div class="form-group">
								<label for="phone" class="bmd-label-floating">Your Phone Number</label>
								<input name="st_phone"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "11" class="form-control" id="phone" autocomplete="OFF" required>
								<span class="bmd-help">Your Phone. Ex: 01675716053</span>
							</div>
							<label class="bmd-label-floating size">Your T-shirt Size</label>
							<div class="radio mt-2">
								<label>
									<input type="radio" name="st_size" id="optionsRadios1" value="Medium"> Medium - M
								</label>
							</div>
							<div class="radio mt-2">
								<label>
									<input type="radio" name="st_size" id="optionsRadios1" value="Large" checked> Large - L
								</label>
							</div>
							<div class="radio mt-2">
								<label>
									<input type="radio" name="st_size" id="optionsRadios1" value="Extra Large"> Extra Large - XL
								</label>
							</div>
							<div class="radio mt-2">
								<label>
									<input type="radio" name="st_size" id="optionsRadios1" value="Badhon"> Badhon - XXXL
								</label>
							</div>

							
							<div class="form-group bmd-form-group is-filled">
                                <label for="exampleSelect1" class="bmd-label-floating" style="color:#000;">I Think This Date Maybe Best</label>
                                <select class="form-control" id="exampleSelect1" name="select_dete">
                                  <option value="2019-03-29">2019-03-29</option>
                                  <option value="2019-04-05">2019-04-05</option>
                                </select>
                              </div>

							<div class="checkbox mt-3">
								<label><input name="st_join" type="checkbox" value="1"> Yes, I'm excited to join this.</label>
							</div>
							
							<button name="submit" type="submit" class="btn btn-primary btn-raised mt-3">Yes, I'm In</button>

						</form>
					</div>
    			</div><!--  end col md 8  -->
    			<div class="col-md-4">
    				<div class="applied_area main_form">
    					<div class="title">
    					    <?php
    					    	$sql = "SELECT * FROM students order by st_id DESC";
	    					    $get_student = $conn->query($sql);
    					    ?>
	    					<h4 class="text-center">Already Registered - [<?php echo $get_student->num_rows; ?>]</h4>
	    				</div>
    					<ul class="list-group bmd-list-group-sm">
    					<?php  
    					
	    					if ($get_student->num_rows > 0) {
	    					    // output data of each row
	    					    while($row = $get_student->fetch_assoc()) {	    					    
    					?>
						  <li class="list-group-item">
						    <div class="bmd-list-group-col">
						      <p><?php echo $row["st_name"] ?></p>
						      <small><?php echo $row["st_vc_id"] ?></small>
						    </div>
						  </li>
						<?php  
							    }
							} else {
							    echo "0 results";
							}
						?>
						</ul>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap-material-design.js"></script>
    <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script>

    	$(document).ready(function() { $('body').bootstrapMaterialDesign(); });
    
	</script>
  </body>
</html>

<?php $conn->close(); ?>