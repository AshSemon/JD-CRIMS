<?php
$file1 = "";
header('content-type:application/pdf');
header('content-Description:inline;filename"'.$file1.'"');
header('content-Transfer-Encoding:binary');
header('Accept-Ranges:bytes');
@readfile($file1);
?>