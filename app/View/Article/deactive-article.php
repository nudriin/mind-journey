<section class="sm:ml-64">
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28 mt-12">
        <?php if (isset($model['article']) && $model['article'] != null && !isset($model['error'])) { ?>
            <div class="flex items-center justify-center">
                <div class="w-3/4 lg:w-2/4">
                    <h1 class="font-rubik font-medium text-4xl text-center mb-12 mt-12">Artikel non-aktif</h1>
                </div>
            </div>

            <div class="flex items-center justify-center flex-wrap -m-4">
                <?php foreach ($model['article'] as $row) { ?>
                    <?php if ($row['status'] != "Active") { ?>
                        <!-- card -->
                        <div class="p-4 w-full sm:w-1/2 md:1/3">
                            <div class="h-full border-2 border-abu rounded-lg overflow-hidden">
                                <img src="<?= getUploadedImg($row['images']) ?? "https://dummyimage.com/600x400/032FF2/ffffff" ?>" alt="" class="h-48 object-cover w-full object-center">
                                <div class="p-6 hover:bg-biru hover:text-white  transition duration-200 ease-in">
                                    <a href="/article/<?= $row['category'] ?>/<?= $row['id'] ?>">
                                        <label for="" class="bg-biru text-white p-2 border-2 border-white rounded-md"><?= $row['category'] ?></label>
                                        <label for="" class="bg-biru text-white py-2 px-2 border-2 border-white rounded-md"><?= $row['status'] ?></label>
                                        <h1 class="font-rubik font-medium text-xl mb-4 mt-4"><?= $row['title'] ?></h1>
                                        <p class=""><?php echo preg_replace($model['pattern'], $model['replacement'], substr($row['paragraph'], 0, 90)) . " ..." ?></p>
                                    </a>
                                    <div class="p-6">
                                        <form action="/active-article" method="post" class="flex flex-row justify-end items-center gap-2">
                                            <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                                            <div class="text-abu">
                                                <select name="status" id="" class="px-2 py-2 border-2 border-abu rounded-lg">
                                                    <option value="Deactive">Deactive</option>
                                                    <option value="Active">Active</option>
                                                </select>
                                            </div>
                                            <div class="">
                                                <button type="submit" class="bg-biru px-3 py-2 border-2 rounded-lg text-dark-white items-center text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
                                                        <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                        <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div>
                                                <a href="/edit-article/<?=$row['id']?>" class="p-2 bg-biru border-2 border-dark-white text-white rounded-lg">Edit</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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