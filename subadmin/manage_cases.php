<?php 
include('header.php');
$msg="";
$decision="";
$statemant="";
$id="";



if(isset($_POST['submit'])){
	$decision=get_safe_value($con,$_POST['decision']);
    $statemant=get_safe_value($con,$_POST['statemant']);
	$added_on=date('Y-m-d h:i:s');
	
	if($id==''){
		$did=get_safe_value($con,$_GET['id']);
		$sql="select * from prosecution where decision='$decision' and statemant='$statemant' and cases_id='$did' ";	
	}else{
		$did=get_safe_value($con,$_GET['id']);
		$sql="select * from prosecution where decision='$decision' and statemant='$statemant' and cases_id='$did' and id!='$id'";	
	}
	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Prosecution already added";
	}else{
		if($id==''){
			$did=get_safe_value($con,$_GET['id']);
			$file=$_FILES["file"]["name"];
			$tmp_name=$_FILES["file"]["tmp_name"];
			$path=FILE_SITE_PATH.$file;
			$file1=explode(".",$file);
			$ext=$file1[1];
			$allowed=array("jpg","png","gif","pdf","wmv","pdf","zip");
			if(in_array($ext,$allowed))
			{
			move_uploaded_file($tmp_name,$path);
			mysqli_query($con,"insert into prosecution(cases_id,decision,statemant,file,status,added_on) values('$did','$decision','$statemant','$file',1,'$added_on')");
			mysqli_query($con,"update cases set pro_decision='$decision' where id='$did'");
			mysqli_query($con,"update cases set prosecutor_id='".$_SESSION['SUBADMIN_ID']."' where id='$id'");
			}
		}else{
			$file_condition='';
			$did=get_safe_value($con,$_GET['id']);
			if($_FILES['file']['name']!=''){
                $file=$_FILES["file"]["name"];
				$tmp_name=$_FILES["file"]["tmp_name"];
				$path=FILE_SITE_PATH.$file;
				$file1=explode(".",$file);
				$ext=$file1[1];
				$allowed=array("jpg","png","gif","pdf","wmv","pdf","zip");
			    if(in_array($ext,$allowed))
				{
				move_uploaded_file($tmp_name,$path);
				$file_condition=", file='$file'";
				}
            }
			mysqli_query($con,"update prosecution set decision='$decision' , statemant='$statemant' $file_condition  where cases_id='$did'");
		}
		
		redirect('special.php');
	}
}
?>
<div class="main-panel">
    <div class="content-wrapper">
		<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Prosecution</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputAddress1">Decision</label>
                      <select name="decision" id="" class="form-control" required>
                        <option value="">Select Department</option>
                        <option value="prosecution">Prosecution</option>
                        <option value="incomplete">Incomplete</option>
                        <option value="canceled">Canceled</option>
                      </select>
                    </div>
					<div class="form-group">
                      <label for="exampleInputName1" required>Statement</label>
                      <textarea name="statemant" id="" class="form-control" placeholder="Prosecutor statement" ><?php echo $statemant?></textarea>
                    </div>
					<div class="form-group">
                      <label for="exampleInputName1" required>File</label>
					  <input type="file" name="file" class="form-control" placeholder="Defendent Image" >
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button><br>
					<span class="error mt8"><?php echo $msg ?></span>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
        <style>
			.error{
				color:red;
			}
			.mt8{
				margin-top:8px;
			}
		</style>
<?php include('footer.php');?>