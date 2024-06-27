<section x-data="{open : true}" class="sm:ml-64">
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <div class="grid grid-cols-12 items-center">
            <div class="col-span-12 items-center justify-center">
                <div class="w-9/12 mx-auto">
                    <?php if (isset($model['error'])) { ?>
                        <div x-show="open" class="flex flex-row bg-red-600 rounded-md opacity-50 py-3 px-5 items-center justify-between" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                            <h1 class="text-white text-lg"><?= $model['error'] ?></h1>
                            <button @click="open = !open" class="border-2 border-inherit text-white py-2 px-4 rounded-full">X</button>
                        </div>
                    <?php } ?>
                </div>
                <h1 class="font-rubik font-medium text-[38px] text-center mb-4 mt-4">Posting artikel</h1>
                <form method="post" action="/edit-article/<?= $model['article']->id ?>" enctype="multipart/form-data">
                    <div class="flex flex-col w-9/12 mx-auto gap-2">
                        <label for="judul" class="font-semibold">Judul</label>
                        <input type="text" name="title" class="border-2 border-abu font-rubik bg-dark-white py-2 rounded-md px-4" required value="<?= $model['article']->title ?? $model['post_title'] ?>" placeholder="Judul">
                    </div>
                    <div class="flex flex-col w-9/12 mx-auto gap-2">
                        <img id="preview" src="<?= getUploadedImg($model['article']->images) ?>" alt="" class="h-48 object-cover w-full object-center mt-4 border-2 border-abu rounded-lg">
                        <label class="block mt-2 font-semibold text-abu dark:text-white" for="file_input">Gambar</label>
                        <input id="file_input" class="block w-full font-rubik text-abu border-2 border-abu rounded-md cursor-pointer bg-dark-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="images" type="file" required>
                    </div>
                    <div class="flex flex-col w-9/12 mx-auto gap-2">
                        <label for="judul" class="font-semibold mt-2">Konten</label>
                        <textarea name="paragraph" id="" cols="30" rows="10" class="border-2 border-abu bg-dark-white font-rubik rounded-md" required><?= $model['article']->paragraph ?? $model['paragraph'] ?></textarea>
                    </div>
                    <div class="flex flex-col w-9/12 mx-auto gap-2">
                        <label for="judul" class="font-semibold mt-2">Kategori</label>
                        <select name="category" id="" class="border-2 border-abu rounded-md py-2 px-4" required">
                            <option value="Tidur" class="">Tidur</option>
                            <option value="Olahraga" class="">Olahraga</option>
                            <option value="Stres" class="">Stres</option>
                            <option value="Lainnya" class="">Lainnya</option>
                        </select>
                    </div> 
                    <div class="flex flex-row gap-4 w-9/12 mx-auto mt-4">
                        <button class="bg-biru px-9 py-2 rounded-full font-semibold text-white" type="submit">Update</button>
                        <a class="bg-biru px-9 py-2 rounded-full font-semibold text-white" href="/<?=strtolower($model['article']->status) . "-article"?>">Kembali</a>
                    </div>
                </form>
                <script type="text/javascript">
                    document.getElementById("file_input").onchange = function() {
                        document.getElementById("preview").src = URL.createObjectURL(file_input.files[0]);
                    }
                </script>
            </div>
        </div>
    </div>
</section>