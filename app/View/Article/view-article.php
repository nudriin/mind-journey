<section>
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <?php if (isset($model['article']) && $model['article'] != null && !isset($model['error'])) { ?>
            <div class="w-9/12 mx-auto space-y-3">
                <!-- category -->
                <p class="flex gap-2 text-[5px] opacity-70">
                    <span><a href="/article">Artikel</a></span>>
                    <span><a href="/article/<?=$model['article']->category?>"><?=$model['article']->category?></a></span>>
                    <span><a href="/article/<?=$model['article']->category?>/<?=$model['article']->id?>"><?=$model['article']->title?></a></span>
                </p>
                <!-- title -->
                <h1 class="font-rubik font-medium text-4xl"><?=$model['article']->title?></h1>
                <!-- author & date -->
                <p class="opacity-70 mb-4"><?= $model['article']->author ?? ""?> <span><?=$model['date']?></span></p>
                <!-- image -->
                <img src="<?=getUploadedImg($model['article']->images)?>" alt="" class="h-60 object-cover w-full object-center mb-4">
                <!-- text -->
                <p class="indent-8 text-justify">
                    <?=preg_replace($model['pattern'], $model['replace'], $model['article']->paragraph);?>
                    <!-- <$model['converter']->convert($model['article']->paragraph)?> -->
                </p>
            </div>
        <?php } else { ?>
            <div class="flex w-9/12 mx-auto h-screen items-center justify-center">
                <h1 class="font-rubik font-medium text-4xl text-center mb-4"><?= $model['error'] ?></h1>
            </div>
        <?php } ?>
    </div>
</section>