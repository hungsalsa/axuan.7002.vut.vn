<?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
$this->title = $data['title'];
 ?>
 <style type="text/css">
 	.fotorama__wrap {
    margin: 0 auto;
}
 </style>
     	<h1><?= $data['name'] ?></h1>
<div class="fotorama"
     data-allowfullscreen="true">
     <?php foreach ($data['listImages']as $value): ?>
     	<img alt="" src="<?= $value['image'] ?>">
     <?php endforeach ?>
</div>
<!-- Fotorama from CDNJS, 19 KB -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
<script type="text/javascript">
	var fotorama_height = '100%';
	var fotorama_width = '100%';				
	$('.fotorama').fotorama({
		// width: 700,
		// maxwidth: '100%',
		// ratio: 16/9,
		allowfullscreen: true,
		hash  : true,
		loop  : true,
		height: fotorama_height,
		width: fotorama_width,
		
		// trackpad  : true,
		nav: 'thumbs'
	});
	$(document).ready(function() {
		$('.fotorama').css('background-color', '#000');
	});
</script>