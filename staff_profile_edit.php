<?php
  session_start();
   include_once'../../db/connect_db.php';
   error_reporting(0);
   
  if(!isset($_SESSION['username']) OR !isset($_SESSION['username'])){
    header('location:../examples/logout.php');
  }
    $staffid = $_GET['id'];
    
    $select_class = $pdo->prepare("SELECT * FROM class_tb");
    $select_class->execute();
    $class_count = $select_class->rowCount();


    $select = $pdo->prepare("SELECT * FROM staff_tb WHERE staffid='$staffid'");
    $select->execute();
    $row_count = $select->rowCount();
    $row = $select->fetch(PDO::FETCH_OBJ);

  if(isset($_POST['add_record'])){
    $select = $pdo->prepare("SELECT email FROM staff_tb WHERE email='$email'");
    $select->execute();

    $img = $_FILES['staff_img']['name'];
    $img_tmp = $_FILES['staff_img']['tmp_name'];
    $img_size = $_FILES['staff_img']['size'];
    $img_ext = explode('.', $img);
    $img_ext = strtolower(end($img_ext));
    $img_new = uniqid().'.'. $img_ext;
    $store = "upload/".$img_new;
    $staff_img = $img_new;
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $dob = date("Y-m-d", strtotime($_POST['dob']));
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    if($_POST['class']==""){
      $class = "None";
    }
    else{
      $class = $_POST['class'];
    }                         
    $class = $_POST['class'];
    $state = $_POST['state'];
    $lga = $_POST['lga'];
    //foreach ($_POST['subjects'] as $subjects){
    $assign_sub = implode(",", $_POST['subjects']);
    //}                          
    $qualification = $_POST['qualification'];      
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $employment_year = $_POST['employment_year'];
    $blood_grp = $_POST['blood_grp'];

    $update = $pdo->prepare("UPDATE staff_tb SET firstname=:firstname, surname=:surname, dob=:dob, gender=:gender, role=:role, class=:class, employment_year=:employment_year, blood_grp=:blood_grp, state=:state, lga=:lga, subjects=:subjects, qualification=:qualification, phone=:phone, email=:email, Address=:address WHERE staffid='$staffid'");    
        
    $update->bindParam(':firstname', $firstname);
    $update->bindParam(':surname', $surname);
    $update->bindParam(':dob', $dob);
    $update->bindParam(':gender', $gender);
    $update->bindParam(':role', $role);
    $update->bindParam(':class', $class);
    $update->bindParam(':employment_year', $employment_year);
    $update->bindParam(':blood_grp', $blood_grp);
    $update->bindParam(':state', $state);
    $update->bindParam(':lga', $lga);
    $update->bindParam(':subjects', $assign_sub);
    $update->bindParam(':qualification', $qualification);
    $update->bindParam(':phone', $phone);
    $update->bindParam(':email', $email);
    $update->bindParam(':address', $address);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ace | IMS </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
<!--   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <?php include_once'../../pages/include/nav.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once'../../pages/include/side_admin.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Staff</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Staff</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Fill in the Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST" name="form_product" enctype="multipart/form-data" autocomplete="off">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Firstname</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="firstname" placeholder="Enter Firstname" value="<?php echo $row->firstname; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Surname</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Surname" value="<?php echo $row->surname; ?>" name="surname" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Date of Birth:</label>

                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                          <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" value="<?php echo date("Y-m-d", strtotime($row->dob)); ?>" data-mask name="dob" required>
                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleSelectBorderWidth2">Gender</label>
                        <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2"
                        name="gender" required>
                            <?php
                            if($row->gender=="Male"){
                              echo "<option selected>Male</option><option>Female</option>";
                            }else{
                              echo "<option>Male</option><option selected>Female</option>";
                            }
                            ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleSelectBorderWidth2">Role</label>
                          <select class="role custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="role" required>
                            <?php
                            $role1 = array("Class Teacher", "Subject Teacher", "Accountant", "Hostel Manager");
                            for($r=0; $r<count($role1); $r++){
                              if($rol1e[$r]==$row->role){
                                echo '<option selected>'.$role1[$r].'</option>';
                              }else{
                              echo '<option>'.$role1[$r].'</option>';
                              }
                            }
                            ?>
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group classes">
                        <label for="exampleSelectBorderWidth2">Class</label>
                        <select class="classes custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="class" required>
                          <?php
                            while($row1=$select_class->fetch(PDO::FETCH_OBJ)){
                              if($row->class==$row1->class_name){
                                echo '<option selected> '.$row1->class_name.'</option>';
                              }else{
                                echo '<option> '.$row1->class_name.'</option>';
                              }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleSelectBorderWidth2">State of Orgin</label>
                        <select onchange="toggleLGA(this);" name="state" class="custom-select form-control-border border-width-2" id="state" required>
                      <?php
                      $states = array("Abia","Adamawa","AkwaIbom","Anambra","Bauchi",
                        "Bayelsa","Benue","Borno","Cross River","Delta","Ebonyi",
                        "Edo","Ekiti","Enugu","FCT - Abuja","Gombe","Imo","Jigawa",
                        "Kaduna","Kano","Katsina","Ondo","Osun","Oyo","Plateau",
                        "Rivers","Sokoto","Taraba","Yobe","Zamfara");

                      for($s=0; $s<=count($states); $s++){
                        if($states[$s]==$row->state){
                          echo '<option selected>'.$states[$s].'</option>';
                        }else{
                        echo '<option>'.$states[$s].'</option>';
                        }
                      }                    

                      ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleSelectBorderWidth2">LGA</label>
                        <select name="lga" id="lga" class="form-control select-lga" required>
                            <?php
                            echo '<option selected>'.$row->lga.'</option>';
                            ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Assign Subject(s)</label>
                        <select class="select2" id="assign_sub" multiple="multiple" data-placeholder="You can select multiple subjects" style="width: 100%;" name="subjects[]">
                          <?php
                            $subject_array = ['Agricultural Science', 'Biology', 'Financial Accounting', 'Chemistry','Civic Education', 'CRK', 'Economics','English Language', 'French','Geography', 'Further Mathematics', 'Mathematics', 'Physics', 'Home Economics', 'Social Studies', 'Security Education', 'Technical Drawing', 'Basic Technology', 'Basic Science'];
                            
                            $assign_sub1 = explode(",", $row->subjects);

                            for($s=0; $s<count($subject_array); $s++){
                              for($t=0; $t<count($assign_sub1); $t++){
                                if($assign_sub1[$t]==$subject_array[$s]){
                                  $options .= "<option selected>".$assign_sub1[$t]."</option>";
                                  $s++;
                                }
                              }
                              $options .= "<option>".$subject_array[$s]."</option>";
                            }
                            echo $options;
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Qualification</label>
                        <select class="form-control select2" data-placeholder="Select Your Highest Qualification" style="width: 100%;" name="qualification">
                          <?php
                          $qualification1 = array("HND", "BSc", "BArt", "BTech", "BEd", "PGD", "MSc", "MEd", "PhD");
                            for($q=0; $q<count($qualification1); $q++){
                              if($qualification1[$q]==$row->qualification){
                                echo '<option selected>'.$qualification1[$q].'</option>';
                              }else{
                              echo '<option>'.$qualification1[$q].'</option>';
                              }
                            }

                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Phone Number" value="<?php echo $row->phone; ?>" name="phone" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email Address" name="email" value="<?php echo $row->email; ?>" required>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleSelectBorderWidth2">Year of Employment</label>
                          <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="employment_year" required>
                          <?php
                            for($ey=2015; $ey<=date("Y"); $ey++){
                              if($ey==$row->employment_year){
                                echo '<option selected>'.$ey.'</option>';
                              }else{
                              echo '<option>'.$ey.'</option>';
                              }
                            }
                          ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleSelectBorderWidth2">Blood Group</label>
                          <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="blood_grp" required>
                          <?php
                          $blood_grp1 = array("A", "B", "AB", "O");
                            for($b=0; $b<count($blood_grp1); $b++){
                              if($blood_grp1[$b]==$row->blood_grp){
                                echo '<option selected>'.$blood_grp1[$b].'</option>';
                              }else{
                              echo '<option>'.$blood_grp1[$b].'</option>';
                              }
                            }
                          ?>
                          </select>
                        </div>
                      </div>
                    </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Home Address</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Current Home Address" value="<?php echo $row->Address; ?>" name="address" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
<!--                         <label for="exampleInputFile">Add Staff Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="staff_img" value="C:/fakepath/<?php //echo $row->img; ?>" onchange="readURL(this);" required>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>                       
                        </div> -->
                      </div>
                    </div>
                        <br>
                        <img id="img_preview" src="upload/<?php echo $row->img?>" alt="Preview" class="img-responsive" width="250" height="200" />

                  </div>
                  <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="add_record">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- /.card -->
            <!-- Horizontal Form -->
          
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- footer -->
    <?php include_once'../../include/footer.php'; ?>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->

<script src="../../dist/js/lga.js"></script>

<script src="../../plugins/sweetalert/sweetalert.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $('.role').change(function(){
      var selected_role = $(this).children("option:selected").val();
      if(selected_role == 'Class Teacher'){
        $('select.classes').prop('disabled', false)
        $('select#assign_sub').prop('disabled', false);
      }
      else if(selected_role != 'Class Teacher' && selected_role != 'Subject Teacher'){
        $('select#assign_sub').prop('disabled', true);
      }
      else{
        $('select.classes').prop('disabled', true);
        $('select#assign_sub').prop('disabled', false);
      }
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End

  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#img_preview').attr('src', e.target.result)
              .width(250)
              .height(200);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }

</script>
<?php
if(isset($_POST['add_record'])){
      if($update->execute()){
        echo'<script type="text/javascript">
        jQuery(function validation(){
          swal("Success", "Record Saved Successfully", "success", {
            button: "Continue",
          });
        });
            </script>';
      }else{
        echo '<script type="text/javascript">
          jQuery(function validation(){
            swal("Error", "There was an error.", "error", {
              button: "Continue",
            });
          );
              </script>';
        }
      }

?>
</body>
</html>
