<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<?php
$cont=null;
$act=null;
if(isset(Yii::app()->controller->id)){
	$cont=Yii::app()->controller->id;
}
if(isset(Yii::app()->controller->action->id)){
	$act=Yii::app()->controller->action->id;
}
?>
<div class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
			data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span> <span
			class="icon-bar"></span> <span class="icon-bar"></span> <span
			class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="http://172.18.0.30/commartv02/index.php/main/index"><?php echo CHtml::image("$baseUrl/images/jibcommart.png","this is alt tag of image",array("width"=>"85px" ,"height"=>"45px"));?></a>


	</div>
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav">



		</ul>
		
	</div>
	<!--/.nav-collapse -->
</div>
</div>