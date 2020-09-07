<?php 
use yii\helpers\Url;
// use yii\helpers\Html;
// $news = $data['model']['news'];
$this->title = $data['model']->htmltitle;
// $this->registerCssFile('@web/css/change.css');
 ?>
<section id="breadcrumb">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="<?= Url::to(['news/index', 'slugCate' => $category['slug'], 'idCate' => $category['id']]) ?>"><?= $category['cateName'] ?></a></li>
      </ol>
    </nav>
</section>
<section class="content">
    <article class="fck_detail" id="content_detail">
        <h1 class="title-detail"><?= $data['model']->name ?></h1>
        <div class="views">Lượt xem: <?= $data['model']->view  ?></div>
        <p class="description"><?= $data['model']->short_description ?></p>
        <section class="mucluc">
            <p class="heading"><strong>Tóm tắt nội dung</strong></p>
            <ul id="mucluc_toc"></ul>
        </section>
        <div class="all-questions"><?= $data['model']->content ?></div>
    </article>
</section>
<?php if (!empty($data['model']->tagsAll)): ?>
    <section class="tags">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="after-post-tags">
                    <div class="post-categories aretags">
                        <?php foreach ($data['model']->tagsAll as $tag): ?>
                            <a class="btn btn-outline-secondary" href="<?= Url::to(['news/tags', 'slugNewTag'=>$tag['slugTag']],true) ?>" role="button"><?= $tag['value'] ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
<?php if (!empty($data['related_news'])): //dbg($data['news'])?>
    <section class="news-topic">
        <div class="row"><div class="col-lg-12 col-xl-12"><h2>Tin liên quan</h2></div></div>
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <ul style="clear: both;">
                    <?php foreach ($data['related_news'] as $news): ?>
                        <li><a href="<?= Url::to(['news/view', 'slugCate'=>$news['slugCate'], 'slug'=>$news['newSlug'],'idNew'=>$news['id']],true) ?>"><?= $news['name'] ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif ?>
<?php if (!empty($data['related_products'])): ?>
    <section class="product-more">
        <div class="row"><div class="col-lg-12 col-xl-12"><h2>Sản phẩm liên quan</h2></div></div>
        <div class="row">
            <?php foreach ($data['related_products'] as $product): //dbg($product)?>
            <div class="col-lg-3 col-xl-3">
                <div class="thumbnail">
                    <a class="img" href="<?= Url::to(['product/view', 'slugCate'=>$product['slugCate'], 'slug'=>$product['slug']],true) ?>"><img src="<?= isset($product['imageOne']['image']) ? $product['imageOne']['image']:''; ?>" width="100%" alt="<?= $product['title'] ?>" class="img-thumbnail"></a>
                    <div class="caption">
                        <a class="title" href="<?= Url::to(['product/view', 'slugCate'=>$product['slugCate'], 'slug'=>$product['slug']],true) ?>"><h3><?= $product['pro_name'] ?></h3></a>
                        <?php if ($product['price_sales']>0): ?>
                            <p class="price"><span><?= $product['price_sales'] ?><sup>đ</sup></span> <span><del><?= $product['price'] ?><sup>đ</sup></del></span></p>
                        <?php endif ?>
                        <p class="attr"><?= $product['short_introduction'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </section>
<?php endif ?>
<?php if (!empty($data['related_albums'])): ?>
    <section class="product-more">
        <div class="row"><div class="col-lg-12 col-xl-12"><h2>Album liên quan</h2></div></div>
        <div class="row">
            <?php foreach ($data['related_albums'] as $albums): //dbg($product)?>
            <div class="col-lg-3 col-xl-3">
                <div class="thumbnail">
                    <a class="img" href="<?= Url::to(['albums/view', 'slug'=>$albums['slug']],true) ?>"><img src="<?= isset($albums['oneImages']['image']) ? $albums['oneImages']['image']:'/images/no-image.jpg'; ?>" width="100%" alt="<?= $albums['title'] ?>" class="img-thumbnail"></a>
                    <div class="caption">
                        <a class="title" href="<?= Url::to(['albums/view', 'slug'=>$albums['slug']],true) ?>"><h3><?= $albums['name'] ?></h3></a>
                        <p class="attr"><?= $albums['short_description'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </section>
<?php endif ?>
<?php if (isset($data['related_downloads'])): ?>
    <section class="downloads_news">
        <div class="row"><div class="col-lg-12 col-xl-12"><h2>Tài liệu liên quan</h2></div></div>
            <div class="col-lg-12 col-xl-12">
                <ul>
                    <?php foreach ($data['related_downloads'] as $keyd => $download): ?>
                        <li> <?= $keyd+1 ?> : <?= $download['name'] ?> <a href="<?= Url::to(['downloads/view', 'slug'=>$download['link']],true) ?>"><i class="fas fa-download pull-right">  Tải</i></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
    </section>
<?php endif ?>
<?php if ($data['model']->formshow==1){
    echo frontend\widgets\formNews::widget(['name'=>'Đăng ký tư vấn','content'=>null,'model'=>$model_customer]);
}?>
<?php
$this->registerJsFile("@web/js/jquery.toc.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main_news.js", ['depends' => [yii\web\JqueryAsset::className()]]);
// $this->registerJsFile("@web/js/mucluc.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>