<div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
  <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
  <?php 
  $totalAmount = $total = 0;
  if (isset($infoCart)) {
    foreach ($infoCart as $value) {
      $totalAmount += $value['amount'];
      $total += $value['price_sales']*$value['amount'];
    }
  }
  ?>
  <div class="dropdown dropdown-cart">
    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
      <div class="items-cart-inner">
        <div class="basket">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="basket-item-count"><span class="count" id="amount-cart"><?= Yii::$app->formatter->asDecimal($totalAmount) ?></span></div>
        <div class="total-price-basket">
          <span class="lbl">Tổng tiền -</span>
          <span class="total-price">
            <span class="value" id="total-cart"><?= Yii::$app->formatter->asDecimal($total) ?></span><span class="sign"> Đ</span>
          </span>
        </div>
      </div>
    </a>
      
    
    <ul class="dropdown-menu">
      <li>
        <div class="cart-item product-summary" id="listCartItem">
    <?php if (empty($infoCart)): //dbg($infoCart)?>
              <h3 class="name" id="noCart"><a href="/">Không có sản phẩm nào</a></h3>
      <?php else: ?>
          <?php foreach ($infoCart as $key => $value): ?>
          
          <div class="row" id="item_<?=$key ?>">
            <div class="col-xs-4">
              <div class="image">
                <a href="detail.html"><img src="<?= Yii::$app->homeUrl.$value['image']?>" alt="<?= $value['pro_name'] ?>"></a>
              </div>
            </div>
            <div class="col-xs-7">
              <h3 class="name"><a href="index.php?page-detail"><?= $value['pro_name'] ?></a></h3>
              <div class="price"><?= Yii::$app->formatter->asDecimal($value['price_sales']) ?> Đ</div>
            </div>
            <div class="col-xs-1 action">
              <a href="javascript:void(0)" onclick="deleteCart(<?= $key ?>)"><i class="fa fa-trash"></i></a>
            </div>
          </div>
          <hr>
          <?php endforeach ?>
    <?php endif ?>
        </div>
        <!-- /.cart-item -->
        
      
        <div class="clearfix"></div>
        <div class="clearfix cart-total">
          <div class="pull-right">
            <span class="text">Tổng tiền :</span><span class='price' id="cart_total"><?= Yii::$app->formatter->asDecimal($total) ?> VNĐ</span>
          </div>
          <div class="clearfix"></div>
          <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Đặt hàng</a> 
        </div>
        <!-- /.cart-total-->
      </li>
    </ul>
    <!-- /.dropdown-menu-->
  </div>
  <!-- /.dropdown-cart -->
  <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->        
</div>