<?php
  session_start();
  include_once'../../db/connect_db.php';
  error_reporting();
     
  if(!isset($_SESSION['username']) OR !isset($_SESSION['username'])){
    header('location:../examples/logout.php');
  }

if(isset($_POST['add_record'])){
  $admission_year = $_POST['admission_year'];
  $blood_grp = "A";

  $select = $pdo->prepare("SELECT * FROM student_tb ORDER BY id DESC LIMIT 1;");
  $select->execute();
  $row_count = $select->rowCount();
  $row = $select->fetch(PDO::FETCH_OBJ);
  $id = $row->id;

  if($id<10){
    $admission_number = 'RC'.$admission_year.'00'.($id);
  }
  else if($id>10 && $id<100){
    $admission_number = 'RC'.$admission_year.'0'.($id);
  }
  else{
    $admission_number = 'RC'.$admission_year.($id);
  }
  
  $select = $pdo->prepare("SELECT admission_number FROM student_tb WHERE admission_number='$admission_number'");
  $select->execute();

  if($select->rowCount() > 0){
    echo'<script type="text/javascript">
    jQuery(function validation(){
    swal("Warning", "A student with this admission number already exists", "warning", {
    button: "Continue",
      });
    });
    </script>';
  }
  else{
    $img = $_FILES['student_img']['name'];
    $img_tmp = $_FILES['student_img']['tmp_name'];
    $img_size = $_FILES['student_img']['size'];
    $img_ext = explode('.', $img);
    $img_ext = strtolower(end($img_ext));
    $img_new = uniqid().'.'. $img_ext;
    $store = "upload/".$img_new;

    if($img_ext == 'jpg' || $img_ext == 'jpeg' || $img_ext == 'png' || $img_ext == 'gif'){
      if($img_size>= 1000000){
        $error ='<script type="text/javascript">
        jQuery(function validation(){
        swal("Error", "File Should Not Be More Than 1MB", "error", {
        button: "Continue",
          });
        });
        </script>';
        echo $error;
      }
      else{
        if(move_uploaded_file($img_tmp, $store)){
          $student_img = $img_new;
          if(!isset($error)){
            $firstname = $_POST['firstname'];
            $surname = $_POST['surname'];
            $class = $_POST['class'];
            $gender = $_POST['gender'];
            $blood_grp = "A";
            $password = $admission_number;
            $state = $_POST['state'];
            $lga = $_POST['lga'];
            $pob = $_POST['pob'];
            $mother_name = $_POST['mother_name'];
            $mother_phone = $_POST['mother_phone'];
            $father_name = $_POST['father_name'];
            $father_phone = $_POST['father_phone'];
            $dob = date("Y-d-m", strtotime($_POST['dob']));
            $address = $_POST['address']; 

            $insert = $pdo->prepare("INSERT INTO student_tb (firstname, surname, admission_number, password, gender, class, dob, blood_grp, yr_admission, state, lga, birth_place, mother_name, mother_phone, father_name, father_phone, Address, img) values (:firstname, :surname, :admission_number, :password, :gender, :class, :dob, :blood_grp, :yr_admission, :state, :lga, :birth_place, :mother_name, :mother_phone, :father_name, :father_phone, :address, :img)");                              
            $insert->bindParam(':firstname', $firstname);
            $insert->bindParam(':surname', $surname);
            $insert->bindParam(':admission_number', $admission_number);
            $insert->bindParam(':password', $password);
            $insert->bindParam(':gender', $gender);
            $insert->bindParam(':class', $class);
            $insert->bindParam(':dob', $dob);
            $insert->bindParam(':blood_grp', $blood_grp);
            $insert->bindParam(':yr_admission', $admission_year);
            $insert->bindParam(':state', $state);
            $insert->bindParam(':lga', $lga);
            $insert->bindParam(':birth_place', $pob);
            $insert->bindParam(':mother_name', $mother_name);
            $insert->bindParam(':mother_phone', $mother_phone);
            $insert->bindParam(':father_name', $father_name);
            $insert->bindParam(':father_phone', $father_phone);
            $insert->bindParam(':address', $address);
            $insert->bindParam(':img', $student_img);
          }else{
            echo '<script type="text/javascript">
            jQuery(function validation(){
            swal("Error", "There was an error.", "error", {
            button: "Continue",
              });
            });
            </script>';
          }
        }

      }
    }
    else{
      $error = '<script type="text/javascript">
      jQuery(function validation(){
      swal("Error", "Please upload an image with format : jpg, jpeg, png, gif", "error", {
      button: "Continue",
          });
      });
      </script>';
      echo $error;
    }
  }
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
<!--     <div class="preloader flex-column justify-content-center align-items-center">
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
              <h1>Add Learners</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Learners</li>
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="firstname" placeholder="Enter Firstname" required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Surname</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="surname" placeholder="Enter Surname" required>
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
                            <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="dob" required>
                          </div>
                          <!-- /.input group -->
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleSelectBorderWidth2">Gender</label>
                          <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="gender" required>
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleSelectBorderWidth2">Year of Admission</label>
                          <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="admission_year" required>
                          <?php
                            for($c=2015; $c<=date("Y"); $c++){
                              echo '<option>'.$c.'</option>';
                            }
                          ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleSelectBorderWidth2">Class</label>
                          <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="class" required>
                          <?php
                            $select = $pdo->prepare('SELECT * FROM class_tb');
                            $select->execute();
                            $class_array = [];
                            while($row1=$select->fetch(PDO::FETCH_OBJ)){
                              array_push($class_array, $row1->class_name);
                            }
                            for($c=0; $c<count($class_array); $c++){
                              echo '<option>'.$class_array[$c].'</option>';
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

                            <option value="" selected="selected" >- Select -</option>
                            <option value='Abia'>Abia</option>
                            <option value='Adamawa'>Adamawa</option>
                            <option value='AkwaIbom'>AkwaIbom</option>
                            <option value='Anambra'>Anambra</option>
                            <option value='Bauchi'>Bauchi</option>
                            <option value='Bayelsa'>Bayelsa</option>
                            <option value='Benue'>Benue</option>
                            <option value='Borno'>Borno</option>
                            <option value='Cross River'>Cross River</option>
                            <option value='Delta'>Delta</option>
                            <option value='Ebonyi'>Ebonyi</option>
                            <option value='Edo'>Edo</option>
                            <option value='Ekiti'>Ekiti</option>
                            <option value='Enugu'>Enugu</option>
                            <option value='FCT'>FCT</option>
                            <option value='Gombe'>Gombe</option>
                            <option value='Imo'>Imo</option>
                            <option value='Jigawa'>Jigawa</option>
                            <option value='Kaduna'>Kaduna</option>
                            <option value='Kano'>Kano</option>
                            <option value='Katsina'>Katsina</option>
                            <option value='Kebbi'>Kebbi</option>
                            <option value='Kogi'>Kogi</option>
                            <option value='Kwara'>Kwara</option>
                            <option value='Lagos'>Lagos</option>
                            <option value='Nasarawa'>Nasarawa</option>
                            <option value='Niger'>Niger</option>
                            <option value='Ogun'>Ogun</option>
                            <option value='Ondo'>Ondo</option>
                            <option value='Osun'>Osun</option>
                            <option value='Oyo'>Oyo</option>
                            <option value='Plateau'>Plateau</option>
                            <option value='Rivers'>Rivers</option>
                            <option value='Sokoto'>Sokoto</option>
                            <option value='Taraba'>Taraba</option>
                            <option value='Yobe'>Yobe</option>
                            <option value='Zamfara'>Zamafara</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleSelectBorderWidth2">LGA</label>
                          <select name="lga" id="lga" class="form-control select-lga" required>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Place of Birth</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Place of Birth" name="pob" required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Address</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Home Address" name="address" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Father's Name</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Father's Name" name="father_name">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Father's Phone Number</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Father's Phone Number" name="father_phone" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mother's Name</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Mother's Name" name="mother_name" required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Mother's Phone Number</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Mother's Phone Number" name="mother_phone" required>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="student_img" onchange="readURL(this);" required>
                            <label class="custom-file-label" for="exampleInputFile">Add Learner's Image</label>
                          </div>                       
                          <!--<div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>-->
                        </div>
                      </div>
                          <br>
                          <img id="img_preview" alt="Preview" class="img-responsive" />

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

  ?>
  <?php
if(isset($_POST['add_record'])){
        if($insert->execute()){
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
