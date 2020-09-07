<?php use yii\helpers\Url; ?><?php if($data['dataNews']): ?><div class="panel panel-default module-navicat slider"><div class="panel-heading"><h3 class="panel-title"><?=$data['name']?></h3></div><div class="panel-body"><ul class="owl-carousel owl-theme newstabhomejcarousel-items"><?php foreach($data['dataNews']as $key=>$child): ?><?php if($key==0): ?><li class="item"><div class="row"><?php endif  ?><div class="col-xs-12 col-sm-6 col-md-6"><div class="height-tabs"><div class="img float-left"><a href="<?=Url::to(['news/view','slugCate'=>$child['slugCate'],'slug'=>$child['newSlug'],'idNew'=>$child['id']],true)?>"title="<?=$child['name']?>"><img style="max-width:100px"src="<?=$child['images']?>"alt="<?=$child['htmltitle']?>"></a></div><div class="ct"><h3><a class="show"href="<?=Url::to(['news/view','slugCate'=>$child['slugCate'],'slug'=>$child['newSlug'],'idNew'=>$child['id']],true)?>"title="<?=$child['images']?>"><?=$child['name']?></a></h3><div class="htext"><?=$child['short_description']?></div></div><div class="backgroup-viewdetail"><a href="<?=Url::to(['news/index','slugCate'=>$child['slugCate'],'idCate'=>$child['id']])?>"class="more">Chi tiết</a></div></div></div><?php if(($key+1)!=count($data['dataNews'])&&($key+1)%2==0): ?></div></li><li class="item"><div class="row"><?php endif  ?><?php if(($key+1)==count($data['dataNews'])): ?></div></li><?php endif  ?><?php endforeach  ?></ul></div></div>
<?php $script = <<< JS
    var itemsolw = $(".owl-carousel.newstabhomejcarousel-items");
    if(itemsolw.length>0){
        itemsolw.owlCarousel({
            items:1, nav: true, autoplay: true, loop:true, autoplayTimeout:5000, dots: true, responsiveClass:false, 
            });
    }
JS;
$this->registerJs($script);
?><?php endif  ?>