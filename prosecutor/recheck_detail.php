<?php 
include('header.php');
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($con,$_GET['id']);

  if(isset($_GET['jarchive'])){
    $jarchive=get_safe_value($con,$_GET['jarchive']);
    mysqli_query($con,"update cases set jachive_id='$jarchive' where id='$id'");
    redirect(SITE_PATH.'prosecutor/recheck_detail.php?id='.$id);
  }

  $sql="select * from cases where id='$id' order by id asc";
  $res=mysqli_query($con,$sql);
  if(mysqli_num_rows($res)>0){
    $courtRow=mysqli_fetch_assoc($res);
  }else{
    redirect('index.php');
  }
}else{
  redirect('index.php');
}

?>
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
              <h3 class="page-title"> Case Details </h3>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card px-2">
                  <div class="card-body">
                    <div class="container-fluid">
                      <h3 class="text-right my-5">Case&nbsp;&nbsp;#<?php echo $courtRow['id']?></h3>
                      <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                      <div class="col-lg-3 pl-0">
                        <p class="mt-5 mb-2"><b>Plaintiff: <i><?php echo $courtRow['accuser']?></i></b></p>
                        <p >Gender : <i><?php echo $courtRow['agender']?></i></p>
                        <p >Age : <i>
                          <?php
                            $dateOfBirth = $courtRow['adob'];
                            $today = date("Y-m-d");
                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                            echo $diff->format('%y');
                          ?>
                        </i></p>
                        <p >Phone : <i><?php echo $courtRow['aphone']?></i></p>
                        <p >Address : <i><?php echo $courtRow['aaddress']?></i></p>
                        <p >Work : <i><?php echo $courtRow['awork']?></i></p>
                      </div>
                      <div class="col-lg-3 pr-0">
                        <img src="<?php echo CASE_IMAGE_SITE_PATH.$courtRow['image']?>" alt="" width="200" height="200">
                        <p class="mt-5 mb-2 text-right"><b>Defendent : <i><?php echo $courtRow['defendent']?></i></b></p>
                        <p class=" text-right">Gender : <i><?php echo $courtRow['dgender']?></i></p>
                        <p class=" text-right">Age : <i>
                          <?php
                            $dateOfBirth = $courtRow['ddob'];
                            $today = date("Y-m-d");
                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                            echo $diff->format('%y');
                          ?></i></p>
                        <p class=" text-right">Phone : <i><?php echo $courtRow['dphone']?></i></p>
                        <p class=" text-right">Address : <i><?php echo $courtRow['daddress']?></i></p>
                        <p class=" text-right">Work : <i><?php echo $courtRow['dwork']?></i></p>
                        <p class=" text-right">Family Status : <i><?php echo $courtRow['dfamily']?></i></p>
                      </div>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                      <div class="col-lg-3 pl-0">
                        <p>Crime Category : <b><?php echo $courtRow['casetype']?></b></p>
                        <p >Crime Cine : <b><?php echo $courtRow['cine']?></b></p><br>
                        <p>Accusation date : <?php echo $courtRow['accusation']?></p>
                        <p>Imprisioned date : <?php echo $courtRow['imprisioned']?></p>
                        <p>Imprisioned File Number : <?php echo $courtRow['arn']?></p>
                      </div>
                    </div>
                    <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                      <div class="table-responsive w-100">
                        <h5>Plaintiff's statement</h5>
                        <p><?php echo $courtRow['pstatement']?></p><br>
                        <h5>Defendant's statement</h5>
                        <p><?php echo $courtRow['dstatement']?></p><br>
                        
                        <?php if($courtRow['witness']=='') {?>

                        <?php }else{?>
                        <h5>Witness's statement</h5>
                        <p><b><i><?php echo $courtRow['witness'];?> : </i></b></p><br>
                        <p><?php echo $courtRow['statement'];?></p>
                        <?php } ?>
                      </div>
                    </div>
                    <!--Second cell investigation-->
                    <?php if($courtRow['invest_statement']=='') {?>

                    <?php }else{?>
                    <div class="cell">
                      <div class="card-body">
                        <div class="container-fluid">
                        <h4 class="text-middle">INVERSTIGATION REPORT</h4>
                          <h3 class="text-right my-3">Case&nbsp;&nbsp;#<?php echo $courtRow['caseid']?></h3>
                          <hr>
                        </div>
                        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                          <div class="table-responsive w-100">
                            <p><?php echo $courtRow['invest_statement'];?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <!--Second cell investigation-->
                    
                    <!--Thrid cell Prosecutor-->
                    <?php if($courtRow['pro_decision']=='') {?>

                    <?php }else{?>
                    <div class="cell">
                      <div class="card-body">
                        <div class="container-fluid">
                        <h4 class="text-middle">PROSECUTOR STATEMENT</h4>
                          <h3 class="text-right my-3">WSJD Case&nbsp;&nbsp;#<?php echo $courtRow['id']?></h3>
                          <h3 class="text-right my-3">Police case&nbsp;&nbsp;#<?php echo $courtRow['caseid']?></h3>
                          <hr>
                        </div>
                        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                          <div class="table-responsive w-100">
                            <?php 
                              $prosecution_res=mysqli_query($con,"select * from prosecution where status='1' and cases_id='".$courtRow['id']."' order by id asc");
                            ?>
                            <p>
                              <?php
                              while($prosecution_row=mysqli_fetch_assoc($prosecution_res)) {
                              ?>
                                <?php
                                echo "<h6>Procecutor :- ".getProcecutorNameById($courtRow['prosecutor_id'])."</h6>"
                                ?>
                                <p><?php echo $prosecution_row['statemant'];?></p>
                              <?php } ?>
                            </p><br>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <!--Thrid cell Prosecutor-->
                    
                    <div class="container-fluid w-100">
                      <a href="#" class="btn btn-primary float-right mt-4 ml-2"><i class="mdi  mdi-folder-download mr-1"></i>Download</a>
                    </div>

                    <?php if($courtRow['pro_decision']=='prosecution'){ ?>
                        <?php if($courtRow['prosecution_id']=='0'){ ?>
                              <?php
                                $archiveAssignRes=mysqli_query($con,"select * from juser where role_id='3' and status=1 order by id asc");
                              ?>
                              <div>
                                <?php
                                echo "<h4>Assign to Archive :- ".getArchiveById($courtRow['prosecution_id'])."</h4>"
                                ?>
                                <select name="jarchive" id="jarchive" class="form-control w200" onclick="updatejarchiveAssign()">
                                  <option value="">Assigned to archive</option>
                                  <?php
                                    while($archiveAssignRow=mysqli_fetch_assoc($archiveAssignRes)){
                                      echo "<option value=".$archiveAssignRow['id'].">".$archiveAssignRow['name']."</option>";
                                    }
                                  ?>
                                </select>
                              </div>
                        <?php } ?>
                    <?php }elseif($courtRow['pro_decision']=='incomplete'){ ?>
                      <?php
                        $caseStatusRes=mysqli_query($con,"select * from cases_status order by id asc");
                        $caseAssignRes=mysqli_query($con,"select * from user where role='detective' and status=1 order by name asc");
                      ?>
                      <div>
                          <?php
                          echo "<h4>Assign Detective For Incomplete Checkup:- ".getDetectiveNameById($courtRow['detective_id'])."</h4>"
                          ?>
                        <select name="detective" id="detective" class="form-control w200" onclick="updateAssign()">
                          <option value="">Assign Detective</option>
                          <?php
                            while($caseAssignRow=mysqli_fetch_assoc($caseAssignRes)){
                              echo "<option value=".$caseAssignRow['id'].">".$caseAssignRow['name']."</option>";
                            }
                          ?>
                        </select>
                    </div>

                      <?php }elseif($courtRow['pro_decision']=='canceled'){ ?>
                        
                    <?php } ?>
                  </div>
                </div>
              </div> 
              <style>
                .w200{
                  width:250px;
                }
              </style> 
              <script>
                function updateprocecutorAssign(){
                  var procecutor=jQuery('#procecutor').val();
                  if(procecutor!=''){
                    var oid="<?php echo $id?>";
                    window.location.href='<?php echo SITE_PATH?>prosecutor/recheck_detail.php?id='+oid+'&procecutor='+procecutor;
                  }
                }
              </script>
              
<?php include('footer.php');?>