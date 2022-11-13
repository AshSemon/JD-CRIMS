<?php
include('header.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($con,$_GET['type']);
	$id=get_safe_value($con,$_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from juser where id='$id'");
		redirect('staf.php');
	}
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update juser set status='$status' where id='$id'");
		redirect('staf.php');
	}

}
$sql="select juser.*,department.department,role.role from juser,department,role where juser.department_id=department.id and juser.role_id=role.id order by juser.id desc";

$res=mysqli_query($con,$sql);

?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        
    <div class="card">
    <div class="card-body">
      <h1 class="grid_title" style="text-align:center;">Wolaita Sodo Justice Department</h1>
			<a href="manage_staff.php" class="btn"><div style="text-align:center;">Add Staff Member</div> </a><br><br>
        <div class="row grid_box">
				  <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr>
                    <th width="10%">S.No #</th>
                    <th width="20%">Name</th>
                    <th width="20%">Department</th>
                    <th width="20%">Role</th>
                    <th width="25%">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(mysqli_num_rows($res)>0){
                  $i=1;
                  while($row=mysqli_fetch_assoc($res)){
                  ?>
                  <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['department']?></td>
                    <td><?php echo $row['role']?></td>
                                    <td>
                                        <?php if($row['status']==1){ ?>
                                            <a href="?id=<?php echo $row['id']?>&type=deactive"><label class="badge badge-danger">Active</label></a>
                                            <?php }else{ ?>
                                            <a href="?id=<?php echo $row['id']?>&type=active"><label class="badge badge-info">Deactive</label></a>
                                            <?php } ?> &nbsp;
                                            <a href="manage_staff.php?id=<?php echo $row['id']?>"><label class="badge badge-success">Edit</label></a>&nbsp;
                                            <a href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-danger delete_red" style="background:red;">Delete</label></a>
                                    </td>
                  </tr>
                  <?php $i++; } } else { ?>
                  <tr>
                    <td colspan="5">No data found</td>
                  </tr>
						      <?php } ?>
                      </tbody>
              </table>
            </div>
				  </div>
        </div>
    </div>
	</div>
  <style>
        /*button css*/
        .btn{
            font-family: "Roboto", sans-serif;
            font-size: 18px;
            font-weight: bold;
            background: #f5f5f5;
            width: 80%;
            margin: 0 100px 0 100px;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            color: 000;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
            -webkit-transition-property: box-shadow, transform;
            transition-property: box-shadow, transform;
        }
        .btn:hover, .btn:focus, .btn:active{
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }
    </style>
<?php
include('footer.php');
?>