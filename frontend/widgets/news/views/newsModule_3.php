<?php use yii\helpers\Url; ?>
<?php if ($data['dataNews']): ?>
<div class="panel panel-default module-navicat slider">
    <div class="panel-heading"> <h3 class="panel-title"><?= $data['name'] ?></h3> </div>
    <div class="panel-body">
            <ul class="owl-carousel owl-theme newstabhomejcarousel-items">
                <?php foreach ($data['dataNews'] as $key => $child): ?>
                    <?php if ($key==0): ?>
                    
                    <li class="item">
                        <div class="row">
                    <?php endif ?>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="height-tabs">
                                    <div class="img float-left">
                                        <?php $img =  str_replace('uploads', 'thumbs', $child['images']); ?>
                                        <a href="<?= Url::to(['news/view', 'slugCate'=>$child['slugCate'], 'slug'=>$child['newSlug'],'idNew'=>$child['id']],true) ?>" title="<?= $child['name'] ?>">
                                            <img style="max-width: 100px" src="<?= ($img=='')?'/images/no-image.jpg': $img ?>" alt="<?= $child['htmltitle'] ?>">
                                        </a>
                                        <!-- <div class="text-muted"> <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;19/03/2018 01:37</div> -->
                                    </div>
                                    <div class="ct">
                                        <h3><a class="show" href="<?= Url::to(['news/view', 'slugCate'=>$child['slugCate'], 'slug'=>$child['newSlug'],'idNew'=>$child['id']],true) ?>" title="<?= $child['htmltitle'] ?>"><?= $child['name'] ?></a></h3>
                                        <div class="htext"><?= $child['short_description'] ?></div>
                                    </div>
                                    <div class="backgroup-viewdetail"><a href="<?= Url::to(['news/index', 'slugCate' => $child['slugCate'], 'idCate' => $child['id']]) ?>" class="more">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                            <?php if (($key+1)!=count($data['dataNews']) && ($key+1)%2==0): ?>
                        </div>
                    </li>
                    <li class="item"> 
                        <div class="row">
                            <?php endif ?>
                            <?php if (($key+1)==count($data['dataNews'])): ?>
                        </div>
                    </li>
                            <?php endif ?>

            <?php endforeach ?>
            </ul>
    </div>
</div>
<?php
$script = <<< JS
    var itemsolw = $(".owl-carousel.newstabhomejcarousel-items");
    if(itemsolw.length>0){
        itemsolw.owlCarousel({
            items:1,
            // itemsDesktop : [1199,10],
            // itemsDesktopSmall : [980,9],
            // itemsTablet: [768,5],
            // itemsTabletSmall: [768,8],
            // // itemsTabletSmall: false,
            // itemsMobile : [479,4],
            nav: true,
            autoplay: true,
            loop:true,
            autoplayTimeout:5000,
            // margin: 0,
            // responsiveClass: true,
            // smartSpeed: 500,

            // singleItem : true,
            dots: true,
            // loop: true,
            // smartSpeed: 200,
            //Basic Speeds
            // slideSpeed : 200,
            // paginationSpeed : 300,
            responsiveClass:false,

            // loop:true,
            // merge:true,
            // center:true,

            /*responsive:{
                0:{
                    items:1,
                    // loop:true,
                    // autoplayTimeout:1000,
                },
                600:{
                    items:1,
                    // loop:true,
                    // autoplayTimeout:1000,
                },
                1000:{
                    items:1,
                    // slide auto - slide hot
                    // nav:true,
                    // loop:false,
                    // autoplayTimeout:1000,
                }
            }*/
        });
    }
JS;
$this->registerJs($script);
?>
<?php endif ?>
