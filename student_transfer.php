<?php
  session_start();
   include_once'../../db/connect_db.php';
   error_reporting(0);
   
  if(!isset($_SESSION['username']) OR !isset($_SESSION['username'])){
    header('location:../examples/logout.php');
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
              <h1>Transfer/Promote Learners</h1>
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
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Student Transfer Page</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="exampleSelectBorderWidth2">Source Class</label>
                  <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="class" required>
                    <?php
                      $select = $pdo->prepare('SELECT * FROM class_tb');
                      $select->execute();
                      $class_array = [];
                      while($row1=$select->fetch(PDO::FETCH_OBJ)){
                        array_push($class_array, $row1->class_name);
                      }
                      for($c=0; $c<count($class_array); $c++){
                        echo '<option data-name="'.$class_array[$c].'" class="sel1">'.$class_array[$c].'</option>';
                      }
                    ?>
                  </select>
                  <br>
                  <select name="from" id="lstview" class="form-control" multiple="multiple" style="margin-top: 10px; height: 250px;">
                    <?php
                      $select = $pdo->prepare("SELECT * FROM student_tb WHERE class='Year 7a'");
                      $select->execute();
                      while($row=$select->fetch(PDO::FETCH_OBJ)){
                        echo '<option value="'.$row->admission_number.'">'.$row->firstname.' '.$row->surname.'</option>';
                      }
                    ?>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-2" style="margin-top: 20px;">
                <center>
                <button type="button" id="lstview_rightSelected" class="btn btn-primary btn-md"><i class="fas fa-angle-right right"></i></button>
                <br><br>
                <button type="button" id="lstview_leftSelected" class="btn btn-primary btn-md"  id="remover"><i class="fas fa-angle-left right"></i></button>
                <br><br>
                <button type="button" id="transfer" class="btn btn-primary btn-md"><i class="fa fa-arrow"></i> Transfer</button>

                </center>              
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="exampleSelectBorderWidth2">Destination Class</label>
                <select class="custom-select form-control-border border-width-2" name="class" required>
                    <?php
                      $select = $pdo->prepare('SELECT * FROM class_tb');
                      $select->execute();
                      $class_array = [];
                      while($row1=$select->fetch(PDO::FETCH_OBJ)){
                        array_push($class_array, $row1->class_name);
                      }
                      for($c=0; $c<count($class_array); $c++){
                        echo '<option data-name="'.$class_array[$c].'" class="sel2">'.$class_array[$c].'</option>';
                      }
                    ?>
                  </select>
                  <br>
                  <select  name="to" id="lstview_to" class="form-control" multiple="multiple" style="margin-top:10px; height:250px;">

                  </select>
                </div>
                <!-- /.form-group -->
              </div>


              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">

          </div>
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
  <script src="../../dist/js/multiselect.js"></script>
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
  $(document).ready(function() {
  $('#lstview').multiselect();
  });


  $('#callback').simpleMultiSelect({
    source: '#source',
    destination: '#destination',
    adder: '#adder',
    remover: '#remover'
  }).on('option:added', function(e, $option) {
    $('#callback_message').append('added: ' + $option.val() + '<br>');
  }).on('option:removed', function(e, $option) {
    $('#callback_message').append('removed: ' + $option.val() + '<br>');
  });
  </script>


  <script>
    $(function(){
      $(".sel1").on("click", function(e){
        e.preventDefault();
        var selvalue = $(this).attr("data-name");
        //alert(selvalue);
        $.ajax({
          type: "POST",
          url: "select.php",
          data: {x: selvalue},
          cache: false,
          success: function(data){
            document.getElementById("lstview").innerHTML = data;
          }
        });
      });
      $(".sel2").on("click", function(e){
        e.preventDefault();
        var selvalue2 = $(this).attr("data-name");
        //alert(selvalue2);
        $.ajax({
          type: "POST",
          url: "select.php",
          data: {x: selvalue2},
          cache: false,
          success: function(data){
            document.getElementById("lstview_to").innerHTML = data;
          }
        });
      $("#transfer").on("click", function(e){
        e.preventDefault();
        var opt = [];
        
        for(var option of document.getElementById("lstview_to").options){
          opt.push(option.value);
        }
        //alert(JSON.stringify(opt));
        $.ajax({
          type: "POST",
          url: "transfer_script.php",
          data: {y_opt: opt, class1:selvalue2},
          cache: false,
          success: function(data){
            //$("#source").load(data);
            //console.log(data);
          jQuery(function validation(){
            if(data.includes("Unsuccessful")){
              swal("Warning", data, "warning", {
                button: "Continue",
              });
            }else{
              swal("Success", data, "success", {
                button: "Continue",
              });
            }
          });

            //alert(data);
          }
        });
      });

      });
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
