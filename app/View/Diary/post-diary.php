<section x-data="{open : true}" class="p-4 md:ml-64">
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <div class="mt-12">
            <div class="items-center justify-center space-y-4">
                <div class="w-9/12 mx-auto">
                    <?php if (isset($model['error'])) { ?>
                        <div x-show="open" class="flex flex-row bg-red-600 rounded-md opacity-50 py-3 px-5 items-center justify-between" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                            <h1 class="text-white text-lg"><?= $model['error'] ?></h1>
                            <button @click="open = !open" class="border-2 border-inherit text-white py-2 px-4 rounded-full">X</button>
                        </div>
                    <?php } ?>
                </div>
                <div class="mt-20">
                    <h1 class="font-rubik font-medium text-[38px] text-center mb-4">Tulis Diary</h1>
                </div>
                <form method="post" action="/user/post-diary" enctype="multipart/form-data">
                    <div class="flex flex-col w-9/12 mx-auto gap-2">
                        <label for="judul" class="font-semibold ">Judul</label>
                        <input type="text" name="diary_title" class="p-4" placeholder="Tuliskan judul harimu disini..." required value="<?=$model['post_title'] ?? ""?>">
                    </div>
                    <div class="flex flex-col w-9/12 mx-auto gap-2">
                        <label for="judul" class="font-semibold ">Pesan</label>
                        <textarea name="diary_paragraph" id="" cols="30" rows="10" class="p-4" required placeholder="Tuliskan perasaan kamu hari ini..."><?=$model['paragraph'] ?? ""?></textarea>
                    </div>
                    <div class="flex flex-col w-9/12 mx-auto gap-2">
                        <label for="diary_mood" class="font-semibold">Mood kamu</label>
                        <select name="diary_mood" id="diary_mood" class="bg-dark-white rounded-md py-2 px-4" required>
                            <option value="Sangat Bahagia" class="">Sangat Bahagia</option>
                            <option value="Bahagia" class="" selected >Bahagia</option>
                            <option value="Netral" class="">Biasa Aja</option>
                            <option value="Sedih" class="">Sedih</option>
                            <option value="Sangat Sedih" class="">Sangat Sedih</option>
                        </select>
                    </div>
                    <div class="w-9/12 mx-auto mt-4">
                        <button class="bg-biru px-9 py-2 rounded-full font-semibold text-white" type="submit">Posting</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>