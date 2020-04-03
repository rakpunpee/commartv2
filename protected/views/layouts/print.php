<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
<style>
body{
	font-size:12px;
}
@media all
{
	.page-break	{ display:none; }
	.page-break-no{ display:none; }
}
@media print
{
	button{display:none;}	
	.page-break	{ display:block;height:1px; page-break-before:always; }
	.page-break-no{ display:block;height:1px; page-break-after:avoid; }	
}
@media page{size 210mm 297mm;}
</style>
</head>

<body>
<?php echo $content; ?>
</body>
</html>