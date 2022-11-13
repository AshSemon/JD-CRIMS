<?php
include('header.php');
$msg="";
$department="";
$abbreviation="";
$id="";

if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($con,$_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from department where id='$id'"));
	$department=$row['department'];
	$abbreviation=$row['abbreviation'];
}

if(isset($_POST['submit'])){
	$department=get_safe_value($con,$_POST['department']);
	$abbreviation=get_safe_value($con,$_POST['abbreviation']);
	$added_on=date('Y-m-d h:i:s');
	
	if($id==''){
		$sql="select * from department where department='$department'";
	}else{
		$sql="select * from department where department='$department' and id!='$id'";
	}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="department already added";
	}else{
		if($id==''){
			mysqli_query($con,"insert into department(department,abbreviation,status,added_on) values('$department','$abbreviation',1,'$added_on')");
		}else{
			mysqli_query($con,"update department set department='$department', abbreviation='$abbreviation' where id='$id'");
		}
		
		redirect('department.php');
	}
}
?>
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
			<h3 class="card-title ml10"><strong>Wolaita Sodo Justice Department</strong>&nbsp;<small>Form</small></h3>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputAddress1">Department</label>
                      <input type="text" name="department" class="form-control" id="exampleInputCity1" placeholder="Department" required value="<?php echo $department?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputAddress1">Abbreviation</label>
                      <input type="text" name="abbreviation" class="form-control" id="exampleInputCity1" placeholder="Abbreviation" required value="<?php echo $abbreviation?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                    <div style="color:red;margin-top: 15px;"><?php echo $msg?></div>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
<?php
include('footer.php');
?>