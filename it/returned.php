<?php
include('header.php');
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-weight-light mb-4">
                        <?php
                        $start=date('Y-m-d'). '00-00-00';
                        $end=date('Y-m-d'). '23-59-59';
                        $sql="select * from cases where added_on between '".date('Y-m-d')." 00-00-00' and '".date('Y-m-d')." 23-59-59'   and returned='1'";
                        $res=mysqli_query($con,$sql);
                        if($row=mysqli_num_rows($res)){
                            echo"<h4 class='mb-0'>".$row."</h4>";
                        }else{
                            echo"<h4 class='mb-0'>0</h4>";
                        }
                        ?>
                    </h1>
                    <div class="d-flex flex-wrap align-items-center">
                        <div>
                            <h4 class="font-weight-normal">Today Returned Cases</h4>
                            <p class="text-muted mb-0 font-weight-light">Last 24 Hours</p>
                        </div>
                        <i class="mdi mdi-account-card-details icon-lg text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-weight-light mb-4">
                        <?php
                        $start=strtotime(date('Y-m-d'));
                        $start=strtotime("-7 day",$start);
                        $start=date('Y-m-d',$start);
                        $end=date('Y-m-d'). '23-59-59';

                        $sql="select * from cases where added_on between '$start' and '".date('Y-m-d')." 23-59-59'   and returned='1'";
                        $res=mysqli_query($con,$sql);
                        if($row=mysqli_num_rows($res)){
                            echo"<h4 class='mb-0'>".$row."</h4>";
                        }else{
                            echo"<h4 class='mb-0'>0</h4>";
                        }
                         ?>
                    </h1>
                    <div class="d-flex flex-wrap align-items-center">
                        <div>
                            <h4 class="font-weight-normal">Week Returned Cases</h4>
                            <p class="text-muted mb-0 font-weight-light">Last 7 Days</p>
                        </div>
                        <i class="mdi mdi-account-card-details icon-lg text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-weight-light mb-4">
                        <?php
                        $start=strtotime(date('Y-m-d'));
                        $start=strtotime("-30 day",$start);
                        $start=date('Y-m-d',$start);
                        $end=date('Y-m-d'). '23-59-59';
                        $sql="select * from cases where added_on between '$start' and '".date('Y-m-d')." 23-59-59'   and returned='1'";
                        $res=mysqli_query($con,$sql);
                        if($row=mysqli_num_rows($res)){
                            echo"<h4 class='mb-0'>".$row."</h4>";
                        }else{
                            echo"<h4 class='mb-0'>0</h4>";
                        }
                         ?>
                    </h1>
                    <div class="d-flex flex-wrap align-items-center">
                        <div>
                            <h4 class="font-weight-normal">Month Returned Cases</h4>
                            <p class="text-muted mb-0 font-weight-light">Last 30 Days</p>
                        </div>
                        <i class="mdi mdi-account-card-details icon-lg text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-weight-light mb-4">
                        <?php
                        $start=strtotime(date('Y-m-d'));
                        $start=strtotime("-365 day",$start);
                        $start=date('Y-m-d',$start);
                        $end=date('Y-m-d'). '23-59-59';
                        $sql="select * from cases where added_on between '$start' and '".date('Y-m-d')." 23-59-59' and returned='1'";
                        $res=mysqli_query($con,$sql);
                        if($row=mysqli_num_rows($res)){
                            echo"<h4 class='mb-0'>".$row."</h4>";
                        }else{
                            echo"<h4 class='mb-0'>0</h4>";
                        }
                         ?>
                    </h1>
                    <div class="d-flex flex-wrap align-items-center">
                        <div>
                            <h4 class="font-weight-normal">Year Returned Cases</h4>
                            <p class="text-muted mb-0 font-weight-light">Last 365 Days</p>
                        </div>
                        <i class="mdi mdi-account-card-details icon-lg text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-weight-light mb-4">
                        <?php
                        $start=date('Y-m-d'). '00-00-00';
                        $end=date('Y-m-d'). '23-59-59';
                        $sql="select * from court_returned where added_on between '".date('Y-m-d')." 00-00-00' and '".date('Y-m-d')." 23-59-59' and status='1'";
                        $res=mysqli_query($con,$sql);
                        if($row=mysqli_num_rows($res)){
                            echo"<h4 class='mb-0'>".$row."</h4>";
                        }else{
                            echo"<h4 class='mb-0'>0</h4>";
                        }
                        ?>
                    </h1>
                    <div class="d-flex flex-wrap align-items-center">
                        <div>
                            <h4 class="font-weight-normal">Today Updated Cases</h4>
                            <p class="text-muted mb-0 font-weight-light">Last 24 Hours</p>
                        </div>
                        <i class="mdi mdi-account-card-details icon-lg text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-weight-light mb-4">
                        <?php
                        $start=strtotime(date('Y-m-d'));
                        $start=strtotime("-7 day",$start);
                        $start=date('Y-m-d',$start);
                        $end=date('Y-m-d'). '23-59-59';

                        $sql="select * from court_returned where added_on between '$start' and '".date('Y-m-d')." 23-59-59' and status='1'";
                        $res=mysqli_query($con,$sql);
                        if($row=mysqli_num_rows($res)){
                            echo"<h4 class='mb-0'>".$row."</h4>";
                        }else{
                            echo"<h4 class='mb-0'>0</h4>";
                        }
                         ?>
                    </h1>
                    <div class="d-flex flex-wrap align-items-center">
                        <div>
                            <h4 class="font-weight-normal">Week Updated Cases</h4>
                            <p class="text-muted mb-0 font-weight-light">Last 7 Days</p>
                        </div>
                        <i class="mdi mdi-account-card-details icon-lg text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-weight-light mb-4">
                        <?php
                        $start=strtotime(date('Y-m-d'));
                        $start=strtotime("-30 day",$start);
                        $start=date('Y-m-d',$start);
                        $end=date('Y-m-d'). '23-59-59';
                        $sql="select * from court_returned where added_on between '$start' and '".date('Y-m-d')." 23-59-59'  and status='1'";
                        $res=mysqli_query($con,$sql);
                        if($row=mysqli_num_rows($res)){
                            echo"<h4 class='mb-0'>".$row."</h4>";
                        }else{
                            echo"<h4 class='mb-0'>0</h4>";
                        }
                         ?>
                    </h1>
                    <div class="d-flex flex-wrap align-items-center">
                        <div>
                            <h4 class="font-weight-normal">Month Updated Cases</h4>
                            <p class="text-muted mb-0 font-weight-light">Last 30 Days</p>
                        </div>
                        <i class="mdi mdi-account-card-details icon-lg text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-weight-light mb-4">
                        <?php
                        $start=strtotime(date('Y-m-d'));
                        $start=strtotime("-365 day",$start);
                        $start=date('Y-m-d',$start);
                        $end=date('Y-m-d'). '23-59-59';
                        $sql="select * from court_returned where added_on between '$start' and '".date('Y-m-d')." 23-59-59' and status='1'";
                        $res=mysqli_query($con,$sql);
                        if($row=mysqli_num_rows($res)){
                            echo"<h4 class='mb-0'>".$row."</h4>";
                        }else{
                            echo"<h4 class='mb-0'>0</h4>";
                        }
                         ?>
                    </h1>
                    <div class="d-flex flex-wrap align-items-center">
                        <div>
                            <h4 class="font-weight-normal">Year Updated Cases</h4>
                            <p class="text-muted mb-0 font-weight-light">Last 365 Days</p>
                        </div>
                        <i class="mdi mdi-account-card-details icon-lg text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql="select * from cases where returned='1' order by id desc limit 5";
    $res=mysqli_query($con,$sql);
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Latest 5 Cases</h4>
                    <div class="table-responsive">
                        
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">S.No</th>
                                    <th width="10%">Image</th>
                                    <th width="10%">Case</th>
                                    <th width="10%">Plaintff</th>
                                    <th width="10%">Defendent</th>
                                    <th width="10%">Case Cine</th>
                                    <th width="10%">Accusated at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($res)>0){
                                    $i=1;
                                    while($row=mysqli_fetch_assoc($res)){
                                ?>
                                <tr>
                                    <td><?php echo $i?></td>
                                    <td>
                                    <a target="_blank" href="<?php echo CASE_IMAGE_SITE_PATH.$row['image']?>">
                                        <img src="<?php echo CASE_IMAGE_SITE_PATH.$row['image']?>"/>
                                    </a>
                                    </td>
                                    <td><?php echo $row['casetype']?></td>
                                    <td><?php echo $row['accuser']?></td>
                                    <td><?php echo $row['defendent']?></td>
                                    <td><?php echo $row['cine']?></td>
                                    <td><?php echo $row['accusation']?></td>
                                </tr>
                                <?php 
                                    $i++; } } else { ?>
                                    <h6 colspan="5">No data found</h6>
                                <?php } ?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <style>
    .add-btn{
    text-transform: uppercase;
    border: none;
    font-family: inherit;
    padding: 10px 28px;
    cursor: pointer;
    transition: all 0.3s ease-out;
    }
    </style>
<?php
include('footer.php');
?>