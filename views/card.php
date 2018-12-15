<div class="second">
    <div class="one">
        <h1><?=$model->name?></h1>
        <p><?=$model->discription?></p>
        <?php if ($model->path != ''): ?>
            <img width="300" src="http://<?= $_SERVER['HTTP_HOST'] ?>/images/<?=$model->path?>" alt="sdfdsfsdf">
        <?php else: ?>
            <div class="plug">Фото отсутствует</div>
        <?php endif; ?>
    </div>
    <div class="two">
        <p><?=$model->discription?></p>
    </div>
</div>

