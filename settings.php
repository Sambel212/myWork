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
  <title>Ace | Settings</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/sweetalert/sweetalert2.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
    <?php include_once '../../include/nav.php'; ?>  
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <?php include_once'../../include/side_admin.php';  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Application Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#data" data-toggle="tab">School Data</a></li>
                  <li class="nav-item"><a class="nav-link" href="#class" data-toggle="tab">Class</a></li>
                  <li class="nav-item"><a class="nav-link" href="#subjects" data-toggle="tab">Subject</a></li>
                  <li class="nav-item"><a class="nav-link" href="#dates" data-toggle="tab">School Dates</a></li>
                  <li class="nav-item"><a class="nav-link" href="#set_mk" data-toggle="tab">Set Marks</a></li>
                  <li class="nav-item"><a class="nav-link" href="#set_gr" data-toggle="tab">Set Grade</a></li>

                </ul>
              </div><!-- /.card-header -->
              <?php
                $select1 = $pdo->prepare('SELECT * FROM school_info_tb WHERE sn=1');
                $select1->execute();
                $row1=$select1->fetch(PDO::FETCH_OBJ);

                $select2 = $pdo->prepare('SELECT * FROM settings_tb WHERE sn=1');
                $select2->execute();
                $row2=$select2->fetch(PDO::FETCH_OBJ);
              ?>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="data">
                    <div class="col-md-6" style="float: left;">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">School Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="school_name" value="<?php echo $row1->school_name ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Motto</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEmail" name="motto" value="<?php echo $row1->motto ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" name="address"><?php echo $row1->address ?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Web Address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" name="web_address" value="<?php echo $row1->web_address ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Email Address</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputSkills" name="email" value="<?php echo $row1->email ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Phone 1</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" name="phone1" value="<?php echo $row1->phone1 ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Phone 2</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" name="phone2" value="<?php echo $row1->phone2 ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">School Logo</label>
                          <div class="col-sm-10">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="logo_img" onchange="readURL(this);">
                            <label class="custom-file-label" for="exampleInputFile">Click To Add Image</label>
                          </div>
                          <br>
                          <img id="img_preview" alt="Preview" class="img-responsive" width="250" height="200" src="upload/<?php echo $row1->logo_img  ?>" />


                      </div>                       
                          <!--<div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>-->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary" name="sub1">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                    <div class="col-md-6" style="float: right; margin-top: -30px;">
                      <!-- Table loads here  -->
                        <div class="card-body table-responsive">
                          <h4>Current Data</h4>
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Data</th>
                                <th>Value</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                              $row_count = $select1->rowCount();
                              //$data_array = ("School Name","Motto","Address","Web Address","Email","Phone1","Phone2","Logo"); 
                            ?>
                            <tr>
                              <td><b>School Name</b></td>
                              <td><?php echo $row1->school_name; ?></td>
                            </tr>
                            <tr>
                              <td><b>Motto</b></td>
                              <td><?php echo $row1->motto; ?></td>
                            </tr>
                            <tr>
                              <td><b>Address</b></td>
                              <td><?php echo $row1->address; ?></td>
                            </tr>
                            <tr>
                              <td><b>Web Address</b></td>
                              <td><?php echo $row1->web_address; ?></td>
                            </tr>
                            <tr>
                              <td><b>Email</b></td>
                              <td><?php echo $row1->email; ?></td>
                            </tr>
                            <tr>
                              <td><b>Phone 1</b></td>
                              <td><?php echo $row1->phone1; ?></td>
                            </tr>
                            <tr>
                              <td><b>Phone 2</b></td>
                              <td><?php echo $row1->phone2; ?></td>
                            </tr>
                            <tr>
                              <td><b>Logo</b></td>
                                <td>
                                  <img id="img_preview" src="upload/<?php echo $row1->logo_img ?>" alt="Preview" class="img-responsive" width="250" height="200" />
                                </td>
                            </tr>
                            </tbody>
                          </table>
                        </div>

                    </div>


                  </div>

                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="class">
                    <div class="col-md-5" style="float: left;">
                    <form class="form-horizontal" method="POST">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Add Class</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="class" name="class" placeholder="E.g Year 7A">
                        </div>
                      </div>                  
                          <!--<div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>-->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary" name="sub2" id="sub2">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-7" style="float: right; margin-top: -30px;">
                    <div class="card-body table-responsive">
                      <table class="table" id="example2">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Class</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $select = $pdo->prepare('SELECT * FROM class_tb');
                        $select->execute();
                        $n=1;
                        while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                        <tr>
                          <td><?php echo $n; ?></td>
                          <td><?php echo $row->class_name; ?></td>
                          <td>
                              <a href="#" data-name="<?php echo $row->class_name; ?>" id="edit_but" class="btn btn-primary btn-sm" name="<?php echo $row->sn; ?>"><i class="fas fa-edit"></i></a>
                              <a href="#" data-name="<?php echo $row->class_name; ?>" id="class_delete_but" class="btn btn-danger btn-sm" name="<?php echo $row->sn; ?>"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                      <?php
                      $n++;
                      }
                      ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="subjects">
                    <div class="col-md-5" style="float: left;">
                    <form class="form-horizontal" method="POST">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Add Subject</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="subj" name="subj" autocomplete="off">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Key Stage</label>
                        <div class="col-sm-10">
                          <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="key_stage" required>
                          <option value="5">Nursery</option><option value="1">KS1 & KS2</option>
                          <option value="ks3">KS3</option><option value="ks4">KS4</option>
                          </select>
                        </div>
                      </div> 

                          <!--<div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>-->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary" name="sub3" id="sub3">Submit</button>
                        </div>
                      </div>
                    </form>
                    </div>
                    <div class="col-md-7" style="float: right; margin-top: -30px;">
                      <!-- Table loads here  -->
                        <div class="card-body table-responsive">
                          <table class="table" id="example3">
                            <thead>
                              <tr>
                                <th style="width: 10px">#</th>
                                <th>Subjects</th><th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            $select = $pdo->prepare('SELECT * FROM subject_tb');
                            $select->execute();
                            $n=1;
                            while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                            <tr>
                              <td><?php echo $n++; ?></td>
                              <td><?php echo $row->subject_name; ?></td>
                              <td>
                              <a href="#" data-name="<?php echo $row->subject_name; ?>" id="edit_but" class="btn btn-primary btn-sm" name="<?php echo $row->sn; ?>"><i class="fas fa-edit"></i></a>
                              <a href="#" data-name="<?php echo $row->subject_name; ?>" id="subject_delete_but" class="btn btn-danger btn-sm" name="<?php echo $row->sn; ?>"><i class="fa fa-trash"></i></a>
                              </td>
                            </tr>
                          <?php
                          }
                          ?>
                            </tbody>
                          </table>
                        </div>

                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="dates">
                    <!-- Post -->
                    <div class="col-md-6" style="float: left;">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleSelectBorderWidth2">Curent Academic Session</label>
                        <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="session" required>
                        <?php
                          $c =date("Y");
                          echo '<option>'.($c-1)."/".$c.'</option>';
                          echo '<option>'.$c."/".($c+1).'</option>';
                        ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectBorderWidth2">Current Term</label>
                        <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="term" required>
                        <?php
                          echo '<option value="1">1st Term</option><option value="2">2nd Term</option><option value="3">3rd Term</option>';
                        ?>
                        </select>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Resumption & Closing Date</label>
                        <div class="col-sm-8">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control float-right" id="reservation" name="dates">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-4 col-form-label">Learning Weeks</label>
                        <div class="col-sm-8">
                          <input type="number" id="learning_weeks" class="form-control" name="learning_weeks">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Holidays</label>
                        <div class="col-sm-8">
                          <input type="number" id="holidays" class="form-control" name="holidays">                          
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-4 col-form-label">Mid-Term Breaks</label>
                        <div class="col-sm-8">
                          <input type="number" id="breaks" class="form-control" name="breaks">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-4"><button type="submit" class="btn btn-primary" name="sub4">Update</button></div>
                        <div class="col-sm-8">
                          
                        </div>
                      </div>
                    </form>
                  </div>
                    <div class="col-md-6" style="float: right; margin-top: -30px;">
                      <!-- Table loads here  -->
                        <div class="card-body table-responsive">
                          <h4 style="">Current Date Settings</h4>
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Data</th>
                                <th>Value</th>
                              </tr>
                            </thead>
                            <tbody>
                            <tr>
                              <td><b>Academic Session</b></td>
                              <td><?php echo $row2->session; ?></td>
                            </tr>
                            <tr>
                              <td><b>Term</b></td>
                              <td><?php if($row2->term==1){echo "First Term"; }else if($row2->term==2){echo "Second Term"; }else{
                                echo "Third Term";} ?></td>
                            </tr>
                            <tr>
                              <td><b>Resumption Date</b></td>
                              <td><?php echo date("jS F Y",strtotime($row2->resumption)); ?></td>
                            </tr>
                            <tr>
                              <td><b>Closing Date</b></td>
                              <td><?php echo date("jS F Y",strtotime($row2->closure)); ?></td>
                            </tr>
                            <tr>
                              <td><b>No. of Days School Opens</b></td>
                              <td><?php echo $row2->open_days; ?></td>
                            </tr>
                            <tr>
                              <td><b>No of Holidays</b></td>
                              <td><?php echo $row2->holidays; ?></td>
                            </tr>
                            <tr>
                              <td><b>Mid Term Break</b></td>
                              <td><?php echo $row2->breaks; ?></td>
                            </tr>
                            </tbody>
                          </table>
                        </div>

                    </div>


                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="set_mk">
                    <div class="col-md-6" style="float: left;">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                      <div class="form-group row">
                        <div class="col-sm-5"><b>Assessment Tag</b></div>
                        <div class="col-sm-7"><b>Set Score</b></div>
                      </div>
                      <?php
                        for($i=1; $i<=8; $i++){
                          echo '<div class="form-group row">
                            <div class="col-sm-5">
                            <input type="text" class="form-control" id="inputName" name="ass_'.$i.'" placeholder="Enter Assessment name">
                            </div>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="inputName" name="score_'.$i.'" placeholder="Enter Score">
                            </div>
                            <div class="col-sm-4">
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox'.$i.'" name="term_'.$i.'" value="1">
                                <label for="customCheckbox'.$i.'" class="custom-control-label">1st Half</label>
                              </div>
                            </div>
                          </div>';
                        }
                      ?>
                          <!--<div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>-->
                      <div class="form-group row">
                        <div class="col-sm-5">
                          <button type="submit" class="btn btn-warning" name="sub77">Add More</button>&nbsp;&nbsp;
                          <button type="submit" class="btn btn-primary" name="sub5">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-6" style="float: right; margin-top: -30px;">
                    <!-- Table loads here  -->
                      <div class="card-body table-responsive">
                        <h4>Current Data</h4>
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Assessment</th>
                              <th>Score</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $row_count = $select1->rowCount();
                            //$data_array = ("School Name","Motto","Address","Web Address","Email","Phone1","Phone2","Logo"); 
                          ?>
                            <?php
                              $select = $pdo->prepare("SELECT * FROM assessment_tb");
                              $select->execute();
                              while($row=$select->fetch(PDO::FETCH_OBJ)){
                                echo "<tr><td>".$row->assessment_tag."</td>";
                                echo "<td>".$row->score."</td></tr>";
                                $total += $row->score;
                              }
                              echo "<tr><td>Total:</td><td>".$total."</td></tr>"
                            ?>
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
                  <div class="tab-pane" id="set_gr">
                    <div class="col-md-6" style="float: left;">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                      <div class="form-group row">
                        <div class="col-sm-4"><b>Upper Limit</b></div>
                        <div class="col-sm-4"><b>Lower Limit</b></div>
                        <div class="col-sm-4"><b>Grade</b></div>
                      </div>
                      <?php
                        for($i=1; $i<=7; $i++){
                          echo '<div class="form-group row">
                            <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputName" name="high_'.$i.'" placeholder="Enter Upper limt Score">
                            </div>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="inputName" name="low_'.$i.'" placeholder="Enter Lower Limit Score">
                            </div>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="inputName" name="grade_'.$i.'" placeholder="Enter Grade">
                            </div>
                          </div>';
                        }
                      ?>
                          <!--<div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>-->
                      <div class="form-group row">
                        <div class="col-sm-5">
                          <button type="submit" class="btn btn-warning" name="sub77">Add More</button>&nbsp;&nbsp;
                          <button type="submit" class="btn btn-primary" name="sub6">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-6" style="float: right; margin-top: -30px;">
                    <!-- Table loads here  -->
                      <div class="card-body table-responsive">
                        <h4>Current Data</h4>
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Assessment</th>
                              <th>Score</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $row_count = $select1->rowCount();
                            //$data_array = ("School Name","Motto","Address","Web Address","Email","Phone1","Phone2","Logo"); 
                          ?>
                            <?php
                              $select = $pdo->prepare("SELECT * FROM assessment_tb");
                              $select->execute();
                              while($row=$select->fetch(PDO::FETCH_OBJ)){
                                echo "<tr><td>".$row->assessment_tag."</td>";
                                echo "<td>".$row->score."</td></tr>";
                                $total += $row->score;
                              }
                              echo "<tr><td>Total:</td><td>".$total."</td></tr>"
                            ?>
                          </tbody>
                        </table>
                      </div>
                  </div>


                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
<script src="../../plugins/sweetalert/sweetalert.js"></script>

<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<script type="text/javascript">
  $(function () {
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
    //Money Euro
    $('[data-mask]').inputmask();

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    });
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

  });


$('a#edit_but').on("click", function(e){
    e.preventDefault();
    id = $(this).attr("name");
    fname = $(this).attr("data-name");
    swal({
      title: "Are you sure you want to reset "+fname+"'s password?",
      text: "Once reset, you will not be able to revert the action!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willReset) => {
      if (willReset) {
        $.ajax({
          type: "POST",
          url: "update2.php",
          async: true,
          data: {p_admission_number: id}
        });
        swal("Password successfully reset!", {
          icon: "success",
        });
        setTimeout(function () {
          location.reload(true);
        }, 1000);

      }
    }); 
});

$('a#class_delete_but').on("click", function(e){
    e.preventDefault();
    id = $(this).attr("name");
    class_name = $(this).attr("data-name");
    swal({
      title: "Are you sure you want to delete "+class_name+" record?",
      text: "Once deleted, you will loose all records associated with this class!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: "POST",
          url: "../tables/delete_record.php",
          async: true,
          data: {class: class_name, sn_class: id}
        });
        swal("Record has been deleted!", {
          icon: "success",
        });
        setTimeout(function () {
          location.reload(true);
        }, 1000);

      }
    }); 
});
$('a#subject_delete_but').on("click", function(e){
    e.preventDefault();
    id = $(this).attr("name");
    subject_name = $(this).attr("data-name");
    swal({
      title: "Are you sure you want to delete "+subject_name+" record?",
      text: "Once deleted, you will loose all records associated with this subject!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: "POST",
          url: "../tables/delete_record.php",
          async: true,
          data: {subject: subject_name, sn_subject: id}
        });
        swal("Record has been deleted!", {
          icon: "success",
        });
        setTimeout(function () {
          location.reload(true);
        }, 1000);

      }
    }); 
});
</script>
</body>
</html>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2, #example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script type="text/javascript">
  $('#sub2').on("click", function(e){
    //e.preventDefault();
      setTimeout(function () {
        location.reload(true);
      }, 2000);    
  });
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
  if(isset($_POST['sub1'])){
    $school_name = $_POST['school_name'];
    $motto = $_POST['motto'];
    $address = $_POST['address'];
    $web_address = $_POST['web_address'];
    $email = $_POST['email'];
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];

    if($_FILES['logo_img']['name']!=""){
      $img = $_FILES['logo_img']['name'];
      $img_tmp = $_FILES['logo_img']['tmp_name'];
      $img_size = $_FILES['logo_img']['size'];
      $img_ext = explode('.', $img);
      $img_ext = strtolower(end($img_ext));
      $img_new = uniqid().'.'. $img_ext;
      $store = "upload/".$img_new;
    }else{
      $img_new =$row1->logo_img;
      $img_ext = explode('.', $img_new);
      $img_ext = strtolower(end($img_ext));
    }

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
        move_uploaded_file($img_tmp, $store);
        $update = $pdo->prepare("UPDATE school_info_tb SET school_name=:school_name, motto=:motto,  address=:address, web_address=:web_address,  email=:email, phone1=:phone1, phone2=:phone2, logo_img=:logo_img WHERE sn=1");

        $update->bindParam(':school_name', $school_name);
        $update->bindParam(':motto', $motto);
        $update->bindParam(':address', $address);
        $update->bindParam(':web_address', $web_address);
        $update->bindParam(':email', $email);
        $update->bindParam(':phone1', $phone1);
        $update->bindParam(':phone2', $phone2);
        $update->bindParam(':logo_img', $img_new);

        if($update->execute()){
          echo '<script type="text/javascript">
          jQuery(function validation(){
          swal("Success", "New Information Updated", "success", {
          button: "Continue",
              });
          });
          </script>';
        }
      }
    }else{
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

  if(isset($_POST['sub2'])){
    $class_name = $_POST['class'];
    //$class_id = substr($class_name, 0, 3);
    if(isset($_POST['class'])){
      $select = $pdo->prepare("SELECT class_name FROM class_tb WHERE class_name='$class_name'");
      $select->execute();

      if($select->rowCount() > 0 ){
        echo'<script type="text/javascript">
            jQuery(function validation(){
            swal("Warning", "The Class Name Already Exists", "warning", {
            button: "Continue",
          });
        });
        </script>';
      }
      else{
        $insert = $pdo->prepare("INSERT INTO class_tb(class_name) VALUES(:class_name)");
        $insert->bindParam(':class_name', $class_name);

      if($insert->execute()){
          echo '<script type="text/javascript">
          jQuery(function validation(){
          swal("Success", "New Class Added", "success", {
          button: "Continue",
            });
          });
          </script>';
        }
      }
    }
  }

  if(isset($_POST['sub3'])){
    $subject_name = $_POST['subj'];
    $key_stage = $_POST['key_stage'];
    if(isset($_POST['subj'])){
      $select = $pdo->prepare("SELECT subject_name FROM subject_tb WHERE subject_name='$subject_name' AND ks='$key_stage'");
      $select->execute();
      if($select->rowCount() > 0 ){
          echo'<script type="text/javascript">
              jQuery(function validation(){
              swal("Warning", "The Subject Name For The Key Stage Already Exists", "warning", {
              button: "Continue",
                  });
              });
              </script>';
          }else{
            $subject_array = explode(" ", $subject_name);
            $subject_array_start = strtolower(substr(current($subject_array),0,3));
            $subject_array_end = strtolower(substr(end($subject_array),0,3)); 
            $subject_id = $subject_array_start."_".$subject_array_end."_".rand(1000,9999);
            $create = $pdo->prepare("CREATE TABLE $subject_id (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            admission_number VARCHAR(30) NOT NULL,
            ass_1 INT(3) NOT NULL, ass_2 INT(3) NOT NULL, ass_3 INT(3) NOT NULL, ass_4 INT(3) NOT NULL, 
            ass_5 INT(3) NOT NULL, ass_6 INT(3) NOT NULL, ass_7 INT(3) NOT NULL, ass_8 INT(3) NOT NULL, 
            comments VARCHAR(255) NOT NULL, term INT(1) NOT NULL, session VARCHAR(20) NOT NULL)");
            $create->execute();

            $insert = $pdo->prepare("INSERT INTO subject_tb(subject_name, subject_id, ks) VALUES(:name, :code, :ks)");
            $insert->bindParam(':name', $subject_name);
            $insert->bindParam(':ks', $key_stage);
            $insert->bindParam(':code', $subject_id);

            if($insert->execute()){
              echo '<script type="text/javascript">
              jQuery(function validation(){
              swal("Success", "New Subject Added", "success", {
              button: "Continue",
                  });
              });
              </script>';
            }
          }
    }
  }

  if(isset($_POST['sub4'])){
    $session = $_POST['session'];
    $term = $_POST['term'];
    $date_array = explode(" - ",$_POST['dates']);
    $resumption = date("Y-m-d", strtotime($date_array[0]));
    $closure = date("Y-m-d", strtotime($date_array[1]));
    $weeks = $_POST['learning_weeks'];
    $open_days = (($_POST['learning_weeks'])*5)-($holidays+$breaks);
    $holidays = $_POST['holidays'];
    $breaks = $_POST['breaks'];
    $update = $pdo->prepare("UPDATE settings_tb SET session=:session, term=:term,  resumption=:resumption, closure=:closure, open_days=:open_days, weeks=:weeks, holidays=:holidays, breaks=:breaks WHERE sn=1");

    $update->bindParam(':session', $session);
    $update->bindParam(':term', $term);
    $update->bindParam(':resumption', $resumption);
    $update->bindParam(':closure', $closure);
    $update->bindParam(':open_days', $open_days);
    $update->bindParam(':weeks', $weeks);
    $update->bindParam(':holidays', $holidays);
    $update->bindParam(':breaks', $breaks);

    if($update->execute()){
      echo '<script type="text/javascript">
      jQuery(function validation(){
      swal("Success", "Settings Updated", "success", {
      button: "Continue",
          });
      });
      </script>';
    }
  }

  if(isset($_POST['sub5'])){
    $ass_tag1 = $_POST['ass_1']; $score1 = $_POST['score_1']; $status1 = $_POST['term_1'];
    $ass_tag2 = $_POST['ass_2']; $score2 = $_POST['score_2']; $status2 = $_POST['term_2'];
    $ass_tag3 = $_POST['ass_3']; $score3 = $_POST['score_3']; $status3 = $_POST['term_3'];
    $ass_tag4 = $_POST['ass_4']; $score4 = $_POST['score_4']; $status4 = $_POST['term_4'];    
    $ass_tag5 = $_POST['ass_5']; $score5 = $_POST['score_5']; $status5 = $_POST['term_5'];
    $ass_tag6 = $_POST['ass_6']; $score6 = $_POST['score_6']; $status6 = $_POST['term_6'];
    $ass_tag7 = $_POST['ass_7']; $score7 = $_POST['score_7']; $status7 = $_POST['term_7'];
    $ass_tag8 = $_POST['ass_8']; $score8 = $_POST['score_8']; $status8 = $_POST['term_8'];

    $insert = $pdo->prepare("INSERT INTO assessment_tb(assessment_tag, score, status) VALUES(:tag1, :score1, :status1), (:tag2, :score2, :status2), (:tag3, :score3, :status3), (:tag4, :score4, :status4), (:tag5, :score5, :status5)
      , (:tag6, :score6, :status6), (:tag7, :score7, :status7), (:tag8, :score8, :status8)");
  $insert->bindParam(':tag1', $ass_tag1); $insert->bindParam(':score1', $score1); $insert->bindParam(':status1', $status1);
  $insert->bindParam(':tag2', $ass_tag2); $insert->bindParam(':score2', $score2); $insert->bindParam(':status2', $status2);
  $insert->bindParam(':tag3', $ass_tag3); $insert->bindParam(':score3', $score3); $insert->bindParam(':status3', $status3);
  $insert->bindParam(':tag4', $ass_tag4); $insert->bindParam(':score4', $score4); $insert->bindParam(':status4', $status4);
  $insert->bindParam(':tag5', $ass_tag5); $insert->bindParam(':score5', $score5); $insert->bindParam(':status5', $status5);
  $insert->bindParam(':tag6', $ass_tag6); $insert->bindParam(':score6', $score6); $insert->bindParam(':status6', $status6);
  $insert->bindParam(':tag7', $ass_tag7); $insert->bindParam(':score7', $score2); $insert->bindParam(':status7', $status7);
  $insert->bindParam(':tag8', $ass_tag8); $insert->bindParam(':score8', $score8); $insert->bindParam(':status8', $status8);

    if($insert->execute()){
      echo '<script type="text/javascript">
      jQuery(function validation(){
      swal("Success", "Settings Updated", "success", {
      button: "Continue",
          });
      });
      </script>';
    }
  }

  if(isset($_POST['sub6'])){
    $high1 = $_POST['high_1']; $low1 = $_POST['low_1']; $grade1 = $_POST['grade_1'];
    $high2 = $_POST['high_2']; $low2 = $_POST['low_2']; $grade2 = $_POST['grade_2'];
    $high3 = $_POST['high_3']; $low3 = $_POST['low_3']; $grade3 = $_POST['grade_3'];
    $high4 = $_POST['high_4']; $low4 = $_POST['low_4']; $grade4 = $_POST['grade_4'];    
    $high5 = $_POST['high_5']; $low5 = $_POST['low_5']; $grade5 = $_POST['grade_5'];
    $high6 = $_POST['high_6']; $low6 = $_POST['low_6']; $grade6 = $_POST['grade_6'];
    $high7 = $_POST['high_7']; $low7 = $_POST['low_7']; $grade7 = $_POST['grade_7'];

    $insert = $pdo->prepare("INSERT INTO grade_tb(high_mk, low_mk, grade) VALUES(:hm1, :lm1, :grade1), (:hm2, :lm2, :grade2), (:hm3, :lm3, :grade3), (:hm4, :lm4, :grade4), (:hm5, :lm5, :grade5), (:hm6, :lm6, :grade6), 
      (:hm7, :lm7, :grade7)");
  $insert->bindParam(':hm1', $high1); $insert->bindParam(':lm1', $low1); $insert->bindParam(':grade1', $grade1);
  $insert->bindParam(':hm2', $high2); $insert->bindParam(':lm2', $low2); $insert->bindParam(':grade2', $grade2);
  $insert->bindParam(':hm3', $high3); $insert->bindParam(':lm3', $low3); $insert->bindParam(':grade3', $grade3);
  $insert->bindParam(':hm4', $high4); $insert->bindParam(':lm4', $low4); $insert->bindParam(':grade4', $grade4);
  $insert->bindParam(':hm5', $high5); $insert->bindParam(':lm5', $low5); $insert->bindParam(':grade5', $grade5);
  $insert->bindParam(':hm6', $high6); $insert->bindParam(':lm6', $low6); $insert->bindParam(':grade6', $grade6);
  $insert->bindParam(':hm7', $high7); $insert->bindParam(':lm7', $low7); $insert->bindParam(':grade7', $grade7);

    if($insert->execute()){
      echo '<script type="text/javascript">
      jQuery(function validation(){
      swal("Success", "Grades Updated", "success", {
      button: "Continue",
          });
      });
      </script>';
    }
  }


?>
