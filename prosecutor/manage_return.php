<?php
include('header.php');
$msg="";
$decision="";
$prosecution="";
$pro_statement="";
$id="";

if(isset($_GET['id']) && $_GET['id']>0){
	$did=get_safe_value($con,$_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from court_returned where id='$did'"));
	$pro_statement=$row['pro_statement'];
}

if(isset($_POST['submit'])){
	$decision=get_safe_value($con,$_POST['decision']);
    $prosecution=get_safe_value($con,$_POST['prosecution']);
	$pro_statement=get_safe_value($con,$_POST['pro_statement']);
	$added_on=date('Y-m-d h:i:s');
	
	if($id==''){
		$did=get_safe_value($con,$_GET['id']);
		$sql="select * from court_returned where pro_statement='$pro_statement' and decision='$decision' and id='$did' ";	
	}else{
		$did=get_safe_value($con,$_GET['id']);
		$sql="select * from court_returned where pro_statement='$pro_statement' and decision='$decision' and id='$did' and id!='$id'";	
	}
	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Prosecution already added";
	}else{
		if($id==''){
			mysqli_query($con,"update court_returned set decision='$decision' where id='$did'");
            mysqli_query($con,"update court_returned set pro_statement='$pro_statement'where id='$did'");
			mysqli_query($con,"update court_returned set prosecution='$prosecution' where id='$did'");
            mysqli_query($con,"update court_returned set rejection='' where id='$did'");
			
		}else{
			mysqli_query($con,"update court_returned set pro_statement='$pro_statement', decision='$decision'  where id='$did'");
		}
		
		redirect('returned.php');
	}
}
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
    <div class="container py-3" id="page-container">
        <?php 
        if(isset($_SESSION['msg'])):
        ?>
        <div class="alert alert-<?php echo $_SESSION['msg']['type'] ?>">
            <div class="d-flex w-100">
                <div class="col-11"><?php echo $_SESSION['msg']['text'] ?></div>
                <div class="col-1"><button class="btn-close" onclick="$(this).closest('.alert').hide('slow')"></button></div>
            </div>
        </div>
        <?php 
            unset($_SESSION['msg']);
        endif;
        ?>
        <div class="card">
            <div class="card-header">
                Manage Prosecution
            </div>
            <div class="card-body">
                <form class="forms-sample" method="post" enctype="multipart/form-data" id="content-form">
                    <div class="form-group">
					  <input type="hidden" id="prosecution" name="prosecution" value="yes">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputAddress1">Decision</label>
                      <select name="decision" id="" class="form-control" required>
                        <option value="">Select Department</option>
                        <option value="prosecution">Prosecution</option>
                        <option value="incomplete">Incomplete</option>
                        <option value="canceled">Canceled</option>
                      </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="content" class="control-label">Statement</label>
                        <textarea name="pro_statement" placeholder="Court Decision statement" id="content" class="summernote" required value="<?php echo $pro_statement?>" ><?php echo isset($_SESSION['POST']['content']) ? $_SESSION['POST']['content'] : (isset($_GET['page']) ? file_get_contents("./pages/{$_GET['page']}") : '')  ?><?php echo $pro_statement?></textarea>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2" name="submit" form="content-form">Submit</button>
                <a class="btn btn-sm rounded-0 btn-light" href="./case.php">Cancel</a>
            </div>
        </div>
    </div>
<?php
include('footer.php');
?>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./summernote/summernote-lite.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./summernote/summernote-lite.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <style>
         :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }
        
        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }
        input.form-control.border-0{
            transition:border .3s linear
        }
        input.form-control.border-0:focus{
            box-shadow:unset !important;
            border-color:var(--bs-info) !important
        }
        .note-editor.note-frame .note-editing-area .note-editable, .note-editor.note-airframe .note-editing-area .note-editable {
            background: var(--bs-white);
        }
    </style>
    <script>
      $('.summernote').summernote({
        placeholder: 'Create you Statement here.',
        tabsize: 5,
        height: '50vh',
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>