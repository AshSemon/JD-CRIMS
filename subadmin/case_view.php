<?php
include('header.php');
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($con,$_GET['id']);

  if(isset($_GET['jarchive'])){
    $jarchive=get_safe_value($con,$_GET['jarchive']);
    mysqli_query($con,"update cases set jachive_id='$jarchive' where id='$id'");
    redirect(SITE_PATH.'subadmin/case_view.php?id='.$id);
  }

  $sql="SELECT * FROM cases ORDER BY id desc";
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
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div>
        <?php
            $archiveAssignRes=mysqli_query($con,"select * from juser where role_id='3' and status=1 order by id asc");
        ?>
        <div>
            <?php
                echo "<h4>Assign to Archive :- ".getArchiveById($courtRow['jachive_id'])."</h4>"
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
        </div>
        <!--PDF View-->

        <!--PDF View-->

    <script>
        function updatejarchiveAssign(){
        var jarchive=jQuery('#jarchive').val();
        if(jarchive!=''){
            var oid="<?php echo $id?>";
            window.location.href='<?php echo SITE_PATH?>subadmin/case_view.php?id='+oid+'&jarchive='+jarchive;
            }
        }
        $('.main-carousel').flickity({
            // options
            wrapAround: true,
            freeScroll: true
        });
    </script>
        <style>
        .w200{
            width:250px;
        }
        .cell{
            width: 100%;
            height: fit-content;
            margin: 0 15 px;
            overflow: hidden;
            border-radius: 8px;
        }
        .cell img{
            width: 100%;
            height: 350px;
            object-fit: cover;
        }
    </style> 
<?php
include('footer.php');
?>