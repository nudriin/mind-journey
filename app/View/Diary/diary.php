<section class="p-4 md:ml-64">
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <?php if (isset($model['diary']) && $model['diary'] != null && !isset($model['error'])) { ?>
            <div class="flex items-center justify-center md:justify-start">
                <div class="w-3/4 lg:w-2/4">
                    <h1 class="font-rubik font-medium text-4xl text-center mb-4 mt-12">Diary</h1>
                </div>
            </div>
            <div class="flex items-center justify-center flex-wrap -m-4">
                <?php foreach ($model['diary'] as $row) { ?>
                    <!-- card -->
                    <div class="p-4 w-full sm:w-1/2">
                        <div class="h-full border-2 border-abu rounded-lg overflow-hidden">
                            <div class="p-6 hover:bg-biru hover:text-white hover:border-white  transition duration-200 ease-in h-full">
                                <a href="/user/diary/<?= $row['user_email'] ?>/<?= $row['id'] ?>">
                                    <div class="flex flex-col lg:flex-row lg:items-center gap-2">
                                        <div class="order-2 lg:order-1">
                                            <label for="" class="bg-biru text-white py-1 px-2 rounded-md mb-3"><?= $row['mood'] ?></label>
                                        </div>
                                        <div class="order-1 lg:order-2">
                                            <h1 class="font-rubik font-medium text-xl"><?= $row['title'] ?></h1>
                                        </div>
                                    </div>
                                    <h1 class="text-sm mb-3 mt-2"><?= $row['date'] ?></h1>
                                    <p class="mb-3 mt-3">
                                        <?php echo preg_replace($model['pattern'], $model['replacement'], substr($row['paragraph'], 0, 50) . "...") ?>
                                    </p>
                                </a>
                                <div class="flex justify-end items-center gap-2">
                                    <!-- <a href="/user/edit-diary/" class="text-left p-2 bg-biru rounded-lg text-dark-white border border-white hover:bg-green-600 text-sm">Edit</a> -->
                                    <button class="text-left p-2 bg-biru rounded-lg text-dark-white border border-white hover:bg-red-600 text-sm" onclick="confirm('Kamu yakin ingin menghapus diary?')"><a href="/user/delete/<?= $row['user_email'] ?>/<?= $row['id'] ?>">Hapus</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="flex w-9/12 mx-auto h-screen items-center justify-center">
                <h1 class="font-rubik font-medium text-4xl text-center mb-4"><?= $model['error'] ?></h1>
            </div>
        <?php } ?>
    </div>
</section>