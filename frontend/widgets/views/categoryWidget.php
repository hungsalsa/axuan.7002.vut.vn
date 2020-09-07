<?php Use yii\helpers\Url;
if ($data): ?>
<section class="nav">
  <nav>
    <ul>
      <div class="row">
        <?php foreach ($data as $key => $value): ?>
          <li class="col-lg-3 col-xl-3"><a href="<?= Url::to(['product/index','slug' => $value['slug']]) ?>"><img src="<?= $value['image'] ?>" width="100%" alt="<?= $value['title'] ?>"><span><?= $value['cateName'] ?></span></a></li>
          <?php if (($key+1)/4==0): ?>
            </div>
            <div class="row">
        <?php endif; endforeach ?>
        </div>
    </ul>
  </nav>
</section>
<?php endif ?>