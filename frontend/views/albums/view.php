<!-- Page Content -->
<div class="container">
    <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0"><?= $data['name'] ?></h1>
    <hr class="mt-2">
    <div class="description mb-5"><?= $data['descriptions'] ?></div>
    <div class="row text-center text-lg-left" id="lightgallery">
        <?php foreach ($data['listImages'] as $value): ?>
            <a class="col-lg-3 col-md-4 col-6" href="<?= $value['image'] ?>" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="<?= $value['image'] ?>" alt="<?= $value['title'] ?>">
            </a>
        <?php endforeach ?>
    </div>
</div>
<!-- /.container -->