<section class="sm:ml-64">
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28 mt-12">
        <div class="mt-12">
            <div class="flex items-center justify-center">
                <div class="w-3/4 lg:w-2/4">
                    <h1 class="font-rubik font-medium text-4xl text-center mb-12 mt-12">Kritik dan saran</h1>
                </div>
            </div>

            <div class="flex flex-wrap -m-4">
                <!-- card -->
                <?php if (isset($model['suggestions']) && $model['suggestions'] != null && !isset($model['error'])) {  ?>
                    <?php foreach ($model['suggestions'] as $row) { ?>
                        <div class="p-4 w-full sm:w-1/2 md:1/3">
                            <div class="h-full border-2 border-abu rounded-lg">
                                <div class="p-6  space-y-2 flex flex-col overflow-hidden">
                                    <div class="flex flex-row gap-3">
                                        <label for="" class="font-rubik font-medium text-xl">Email : </label>
                                        <h1 class="text-xl"><?= $row['email'] ?></h1>
                                    </div>
                                    <div class="flex flex-row gap-[6px]">
                                        <label for="" class="font-rubik font-medium text-xl">Nama :</label>
                                        <h1 class="text-xl"><?= $row['name'] ?></h1>
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        <label for="" class="font-rubik font-medium text-xl">Pesan</label>
                                        <div class="p-3 border-2 border-abu rounded-lg">
                                            <p class="text-xl"><?= $row['message'] ?></p>
                                        </div>
                                    </div>
                                    <div class="">
                                        <form action="/suggestions" method="post" class="flex flex-row justify-end items-center gap-2">
                                            <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                                            <div class="bg-biru px-3 py-3 rounded-lg text-dark-white items-center text-center text-xl hover:bg-red-600 hover:text-white transition duration-200 ease-in">
                                                <button type="submit" onclick="alert('Anda yakin ingin menghapus?')">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="flex w-9/12 mx-auto h-screen items-center justify-center">
                        <h1 class="font-rubik font-medium text-4xl text-center mb-4"><?= $model['error'] ?></h1>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>