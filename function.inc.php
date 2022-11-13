<?php
function pr($arr){
    echo'<pre>';
    print_r($arr);
}
function prx($arr){
    echo'<pre>';
    print_r($arr);
    die();
}
function get_safe_value($con,$str){
    if($str!=''){
        $str=trim($str);
        return mysqli_real_escape_string($con,$str);
    }
}
function redirect($link){
    ?>
    <script>
        window.location.href='<?php echo $link?>'
    </script>
    <?php
    die();
}
//user detective name and phone
function getDetectiveNameById($id){
    global $con;
    $sql="select name,phone from user where role='detective' and id='$id'";
    $data=array();
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        return $row['name'].' ('.$row['phone'].')';
    }else{
        return 'Not Assigned';
    }
}
//user achive name and phone
function getArchiveNameById($id){
    global $con;
    $sql="select name,phone from user where role='archive' and id='$id'";
    $data=array();
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        return $row['name'].' ('.$row['phone'].')';
    }else{
        return 'Not Assigned';
    }
}
//juser achive name and phone
function getArchiveById($id){
    global $con;
    $sql="select name,phone from juser where role_id='3' and id='$id'";
    $data=array();
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        return $row['name'].' ('.$row['phone'].')';
    }else{
        return 'Not Assigned';
    }
}
//juser procecutor name and phone
function getProcecutorNameById($id){
    global $con;
    $sql="select name,phone from juser where role_id='1' and id='$id'";
    $data=array();
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        return $row['name'].' ('.$row['phone'].')';
    }else{
        return 'Not Assigned';
    }
}
//decision 
function getDecisionById($id){
    global $con;
    $sql="select decision from prosecution where status='1' and id='$id'";
    $data=array();
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        return $row['decision'];
    }else{
        return 'Not Decided';
    }
}
function getDecisionResultIDById($id){
    global $con;
    $sql="select pro_decision from cases where status='1' and prosecutor_id='".$_SESSION['PROSECUTOR_ID']."' order by id desc";
    $data=array();
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        return $row['pro_decision'];
    }else{
        return 'Not Decided Yet!!';
    }
}
function getUserDetailsByid(){
	global $con;
	$data['name']='';
    $data['dob']='';
	$data['email']='';
	$data['phone']='';
    $data['address']='';
    $data['station']='';
	
	if(isset($_SESSION['POLICE_ID'])){
		$row=mysqli_fetch_assoc(mysqli_query($con,"select * from juser where id=".$_SESSION['JARCHIVE_ID']));
		$data['name']=$row['name'];
		$data['dob']=$row['dob'];
        $data['email']=$row['email'];
		$data['phone']=$row['phone'];
        $data['address']=$row['address'];
        $data['station']=$row['station'];
	}
	return $data;
}
//station
function getStationById($id){
    global $con;
    $sql="select station,address from station where status='1' and id='$id'";
    $data=array();
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        return $row['station'].' ('.$row['address'].')';
    }else{
        return 'Not Decided';
    }
}
//department
function getDepartmentById($id){
    global $con;
    $sql="select department,abbreviation from department where status='1' and id='$id'";
    $data=array();
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        return $row['department'].' ('.$row['abbreviation'].')';
    }else{
        return 'Not Decided';
    }
}
?>