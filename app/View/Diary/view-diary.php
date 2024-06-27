<section class="p-4 md:ml-64">
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <?php if (isset($model['diary']) && $model['diary'] != null && !isset($model['error'])) { ?>
            <div class="w-9/12 mx-auto space-y-3">
                <!-- title -->
                <h1 class="font-rubik font-medium text-biru text-4xl"><?= $model['diary']->title ?></h1>
                <!-- author & date -->
                <p class="opacity-70 mb-4"><?= $model['diary']->user_email ?? "" ?> > <span><?= $model['diary']->date ?></span></p>
                <!-- text -->
                <p class="indent-8 text-justify">
                    <?= preg_replace($model['pattern'], $model['replacement'], $model['diary']->paragraph); ?>
                    <!-- <$model['converter']->convert($model['diary']->paragraph)?> -->
                </p>
            </div>
        <?php } else { ?>
            <div class="flex w-9/12 mx-auto h-screen items-center justify-center">
                <h1 class="font-rubik font-medium text-4xl text-center mb-4"><?= $model['error'] ?></h1>
            </div>
        <?php } ?>
    </div>
</section>