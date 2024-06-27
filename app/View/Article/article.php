<section>
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <?php if (isset($model['article']) && $model['article'] != null && !isset($model['error'])) { ?>
            <div class="flex items-center justify-center">
                <div class="w-3/4 lg:w-2/4">
                    <h1 class="font-rubik font-medium text-4xl text-center mb-12 mt-12">Artikel</h1>
                </div>
            </div>

            <div class="flex items-center justify-center flex-wrap -m-4">
                <?php foreach ($model['article'] as $row) { ?>
                    <?php if ($row['status'] == "Active") { ?>
                        <!-- card -->
                        <div class="p-4 w-full sm:w-1/2 md:1/3">
                            <div class="h-full border-2 border-abu rounded-lg overflow-hidden">
                                <a href="/article/<?= $row['category'] ?>/<?= $row['id'] ?>">
                                    <img src="<?= getUploadedImg($row['images']) ?? "https://dummyimage.com/600x400/032FF2/ffffff" ?>" alt="" class="h-48 object-cover w-full object-center">
                                    <div class="p-6 hover:bg-biru hover:text-white  transition duration-200 ease-in">
                                        <label for="" class="bg-biru text-white p-2 border-2 border-white rounded-md"><?= $row['category'] ?></label>
                                        <h1 class="font-rubik font-medium text-xl mb-4"><?= $row['title'] ?></h1>
                                        <p><?php echo preg_replace($model['pattern'], $model['replacement'], substr($row['paragraph'], 0, 90) . "...") ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <div class="flex w-9/12 mx-auto h-screen items-center justify-center">
                    <h1 class="font-rubik font-medium text-4xl text-center mb-4"><?= $model['error'] ?></h1>
                </div>
            <?php } ?>
            </div>
</section>