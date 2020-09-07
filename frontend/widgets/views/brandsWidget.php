<?php if (Yii::$app->controller->id=='site'): ?>
   <div class="container-fluid">
      <?php if ($brands):  ?>
         <div class="row">
          <div class="owl-carousel brands">
            <?php foreach ($brands as $brand): ?>
               <div class="item"><img src="<?= Yii::$app->homeUrl.$brand['image'] ?>" alt="<?= $brand['alt'] ?>"></div>
            <?php endforeach ?>
         </div>
      </div>
   <?php endif?>
  
      <?php if ($settingModules): foreach ($settingModules as $module): ?>
         <div class="row">
            <div class="col-lg-2 col-xl-12">
               <?= $module['content'] ?>
            </div>
         </div>
      <?php endforeach; endif?>
   </div>
<?php endif ?>