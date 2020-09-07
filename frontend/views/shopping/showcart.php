<?php 
use yii\helpers\Html;use yii\widgets\ActiveForm;
$this->title ='Tra cứu đơn hàng';
?>
<div class="row">
	<div class="col-md-12">
		<div class="card border-success">
			<div class="card-header text-success"> Tìm kiếm thông tin đơn hàng </div>
			<div class="card-body">
				<?php $form = ActiveForm::begin(); ?>
				<section class="formSearch row">
					<div class="form-group col-sm-8">
						<?= $form->field($model, 'peopleId') ?>
					</div>
					<div class="form-group col-sm-2">
						<label for="">&nbsp;</label><br>
						<?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']); ?>
					</div>
				</section>
				<?php ActiveForm::end(); ?>
				<section class="Result border-info border-top">
					<div class="jumbotron p-2">
						<p class="lead"></p>
						<hr class="my-4">
						<p>Các đơn hàng : </p>

					</div>

					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="card-link">Card link</a>
						<a href="#" class="card-link">Another link</a>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>