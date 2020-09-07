<?php use yii\helpers\Url; ?>
<div class="cart">
	<div class="cart-summary">
		<span class="header-cart-icon"><i class="fas fa-shopping-bag"></i></span>
		<b id="count_shopping_cart_store"><?= ($infoCart) ? count($infoCart): 0 ?></b>
		<a id="gotoShopping" data-count="<?= ($infoCart) ? count($infoCart): 0 ?>" href="<?= Url::to(['shopping/index'])?> ">Giỏ hàng</a>
	</div>
</div>