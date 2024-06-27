<!-- Hero Section -->
<section>
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28 mt-12">
        <div class="grid grid-cols-12 items-center">
            <div class="col-span-12 lg:col-span-4 order-2 lg:order-1">
                <div class="">
                    <!--  leading untuk membuat teks dempet  -->
                    <h1 class="mt-4 mb-4 font-rubik font-medium text-[38px] md:text-[54px] leading-tight text-center lg:text-left">
                        Kesehatan <span class="text-biru">mental</span> demi generasi penerus bangsa</h1>
                    <p class="text-center lg:text-left mt-4 mb-4">Tempat Terbaik untuk Merawat Kesehatan Mental!
                        Dapatkan Wawasan dan Dukungan yang kamu Butuhkan</p>
                    <div class="flex justify-center flex-col">
                        <button class="px-9 py-4 bg-biru rounded-full text-dark-white font-semibold"><a href="/user/register">Daftar sekarang</a></button>
                    </div>
                </div>
            </div>
            <!-- order untuk urutan jadi gambarnya peratama-->
            <div class="col-span-12 lg:col-span-8 order-1 lg:order-2">
                <div class="flex justify-center">
                    <img src="<?= getImage("docter.svg") ?>" alt="">
                </div>
            </div>

            <div class="col-span-12 flex items-center justify-center flex-wrap flex-row -m-4 mt-4 order-3">
                <!-- <div class="p-4 w-full sm:w-1/2 drop-shadow-sm">
                    <div class="h-48 drop-shadow-md overflow-hidden">
                        <div class="flex flex-col items-center justify-center p-6 bg-dark-white h-full">
                            <p class="text-center text-2xl lg:text-4xl mb-3 font-semibold">
                                <ion-icon name="chatbubble" class="text-biru text-2xl"></ion-icon>
                                <span class="opacity-70">Butuh bantuan?</span>
                            </p>
                            <p class="text-center text-sm w-9/12 mb-2 opacity-70">Perlu teman curhat? atau perlu bantuan profesional? mari konsultasikan sekarang</p>
                            <a href="/user/consult" class="bg-biru border border-dark-white px-4 py-2 rounded-full font-semibold text-xl text-center text-dark-white">Konsultasi</a>
                        </div>
                    </div>
                </div> -->
                <div class="p-4 w-full drop-shadow-sm">
                    <div class="h-40 drop-shadow-md overflow-hidden">
                        <div class="flex flex-col items-center justify-center p-6 bg-dark-white h-full">
                            <p class="text-center text-2xl lg:text-4xl mb-3 font-semibold">
                                <ion-icon name="call" class="text-biru text-2xl"></ion-icon>
                                <span class="opacity-70">Panggilan darurat</span>
                            </p>
                            <h1 class="font-rubik font-medium text-2xl text-center">+6281549193834 (WhatsApp)</h1>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="flex flex-col justify-center items-center col-span-12 lg:col-span-6 px-9 py-4 bg-dark-white w-full h-60 order-4 mt-4 lg:ml-4 lg:mt-20">
                    <p class="text-center text-2xl lg:text-4xl mb-3 font-semibold">
                        <ion-icon name="call" class="text-biru text-2xl"></ion-icon>
                        <span class="opacity-70">Butuh teman curhat?</span>
                    </p>
                    <h1 class="font-rubik font-medium text-2xl text-center">Konsultasi field</h1>
                </div>
                <div class="flex flex-col justify-center items-center col-span-12 lg:col-span-6 px-9 py-4 bg-dark-white w-full h-60 order-4 mt-4 lg:ml-4 lg:mt-20">
                    <p class="text-center text-2xl lg:text-4xl mb-3 font-semibold">
                        <ion-icon name="call" class="text-biru text-2xl"></ion-icon>
                        <span class="opacity-70">Butuh teman curhat?</span>
                    </p>
                    <h1 class="font-rubik font-medium text-2xl text-center">+6281549193834 (WhatsApp)</h1>
                </div> -->
                </div>
            </div>
        </div>
</section>

<!-- section 2 : Card-->
<section>
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <div class="grid grid-cols-12 items-center">
            <div class="flex col-span-12 items-center justify-center">
                <div class="w-3/4 lg:w-2/4">
                    <h1 class="font-rubik font-medium text-4xl text-center mb-4">Buat dirimu merasa lebih nyaman
                        bersama <span class="text-biru">MindJourney</span></h1>
                </div>
            </div>
            <!-- <div class="flex flex-col lg:flex-row col-span-12 items-center justify-center gap-2">
                <div class="flex flex-col items-start justify-center order-1 px-9 py-4 w-full h-64 md:h-[300px] bg-white mt-4 drop-shadow-lg">
                    <h1 class="font-rubik font-medium text-2xl">Tidur</h1>
                    <p class="">Tidur yang cukup memiliki hubungan yang sangat erat dengan kesehatan mental.
                        Kualitas tidur yang baik berperan penting dalam menjaga keseimbangan emosi, kestabilan mood,
                        dan kinerja kognitif seseorang.</p>
                    <p class="text-sm mt-2 opacity-70">Artikel tentang tidur<a class="text-biru" href="/article/Tidur"> disini</a></p>
                </div>

                <div class="flex flex-col items-start justify-center order-1 px-9 py-4 w-full h-64 md:h-[300px] bg-white mt-4 drop-shadow-lg lg:mx-4">
                    <h1 class="font-rubik font-medium text-2xl">Olahraga</h1>
                    <p class="">Manfaat olahraga bagi kesehatan mental antara lain bisa mengurangi stres hingga
                        meningkatkan rasa percaya diri, terutama jika dilakukan secara rutin dan diimbangi dengan
                        pola hidup sehat lainnya.</p>
                    <p class="text-sm mt-2 opacity-70">Artikel tentang Olahraga<a class="text-biru" href="/article/Olahraga"> disini</a></p>

                </div>

                <div class="flex flex-col items-start justify-center order-1 px-9 py-4 w-full h-64 md:h-[300px] bg-white mt-4 drop-shadow-lg">
                    <h1 class="font-rubik font-medium text-2xl">Stres</h1>
                    <p class="">Dampak stres karena pekerjaan, tugas kuliah atau tugas sekolah tidak hanya mengganggu kejiwaan, tapi juga berdampak
                        pada kesehatan fisik secara menyeluruh.</p>
                    <p class="text-sm mt-2 opacity-70">Artikel tentang stres<a class="text-biru" href="/artcile/Stres"> disini</a></p>
                </div>
            </div> -->
            <div class="col-span-12 flex items-center justify-center flex-wrap flex-row -m-4 mt-4">
                <div class="p-4 w-full sm:w-1/2">
                    <div class="h-full shadow-lg overflow-hidden">
                        <a href="/article/Tidur">
                            <div class="p-6 bg-white hover:bg-biru hover:text-white hover:border-white  transition duration-200 ease-in h-full">
                                <div class="items-center justify-center">
                                    <h1 class="font-rubik font-medium text-xl text-center">Tidur</h1>
                                </div>
                                <p class="mb-3 mt-3">Tidur yang cukup memiliki hubungan yang sangat erat dengan kesehatan mental.
                                    Kualitas tidur yang baik berperan penting dalam menjaga keseimbangan emosi, kestabilan mood,
                                    dan kinerja kognitif seseorang.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="p-4 w-full sm:w-1/2">
                    <div class="h-full shadow-lg overflow-hidden">
                        <a href="/article/Olahraga">
                            <div class="p-6 bg-white hover:bg-biru hover:text-white hover:border-white  transition duration-200 ease-in h-full">
                                <div class="items-center justify-center">
                                    <h1 class="font-rubik font-medium text-xl text-center">Olahraga</h1>
                                </div>
                                <p class="mb-3 mt-3">Manfaat olahraga bagi kesehatan mental antara lain bisa mengurangi stres hingga
                                    meningkatkan rasa percaya diri, terutama jika dilakukan secara rutin dan diimbangi dengan
                                    pola hidup sehat lainnya.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="p-4 w-full sm:w-1/2">
                    <div class="h-full shadow-lg overflow-hidden">
                        <a href="/article/Stres">
                            <div class="p-6 bg-white hover:bg-biru hover:text-white hover:border-white  transition duration-200 ease-in h-full">
                                <div class="items-center justify-center">
                                    <h1 class="font-rubik font-medium text-xl text-center">Stres</h1>
                                </div>
                                <p class="mb-3 mt-3">Dampak stres karena pekerjaan, tugas kuliah atau tugas sekolah tidak hanya mengganggu kejiwaan, tapi juga berdampak
                                    pada kesehatan fisik secara menyeluruh.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- section 3 : About us-->
<section class="bg-dark-white mb-3">
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <div class="grid grid-cols-12 items-center justify-center gap-3">
            <!-- Gmabar -->
            <div class="col-span-12 lg:col-span-8 items-center justify-center">
                <img src="<?= getImage("aboutUs.svg") ?>" alt="">
            </div>

            <!-- about us -->
            <div class="col-span-12 lg:col-span-4 items-center justify-center">
                <h1 class="font-rubik font-medium text-4xl mb-4 mt-4 text-center">Tentang kami</h1>
                <p class="mt-4"><span class="font-rubik font-medium">MindJourney</span> adalah sebuah website yang
                    didedikasikan untuk membahas topik kesehatan mental. MindJourney bertujuan untuk menyediakan
                    informasi yang akurat dan berguna mengenai berbagai aspek kesehatan mental, serta membantu
                    individu untuk mengelola stres, kecemasan, depresi, dan masalah kesehatan mental lainnya.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 4 : latest Article -->
<section>
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <div class="flex text-center mb-4 w-full lg:w-9/12 mx-auto items-center justify-center">
            <h1 class="font-rubik font-medium text-4xl text-center mb-4">Temukan <span class="text-biru">solusi, tips dan trik</span> yang dapat membantumu disini</h1>
        </div>
        <div class="grid grid-cols-12 items-center">
            <div class="flex col-span-12 items-center justify-center">
                <div class="w-3/4 lg:w-2/4">
                    <h1 class="text-4xl text-center mb-4">Artikel terbaru</h1>
                </div>
            </div>
            <?php if (!isset($model['error']) && isset($model['article']) && $model['article'] != null) { ?>
                <div class="flex flex-wrap col-span-12 -m-4 mt-4 justify-center">
                    <?php if (sizeof($model['article']) == 1) { ?>
                        <?php for ($i = 0; $i < 1; $i++) { ?>
                            <?php if ($model['article'][$i]['status'] == "Active") { ?>
                                <div class="p-4 w-full sm:w-1/2 md:1/3">
                                    <div class="h-full border-2 border-abu rounded-lg overflow-hidden">
                                        <a href="/article/<?= $model['article'][$i]['category'] ?>/<?= $model['article'][$i]['id'] ?>">
                                            <img src="<?= getUploadedImg($model['article'][$i]['images']) ?? "https://dummyimage.com/600x400/032FF2/ffffff" ?>" alt="" class="h-48 object-cover w-full object-center">
                                            <div class="p-6 hover:bg-biru hover:text-white  transition duration-200 ease-in">
                                                <button type="button" class="bg-biru  border-2 border-white text-white px-2 py-2 rounded-md" disabled><?= $model['article'][$i]['category'] ?></button>
                                                <h1 class="font-rubik font-medium text-xl mb-4 mt-4"><?= $model['article'][$i]['title'] ?></h1>
                                                <p class=""><?php echo preg_replace($model['pattern'], $model['replacement'], substr($model['article'][$i]['paragraph'], 0, 150)) . " ..." ?></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <?php for ($i = 0; $i < 2; $i++) { ?>
                            <?php if ($model['article'][$i]['status'] == "Active") { ?>
                                <div class="p-4 w-full sm:w-1/2 md:1/3">
                                    <div class="h-full border-2 border-abu rounded-lg overflow-hidden">
                                        <a href="/article/<?= $model['article'][$i]['category'] ?>/<?= $model['article'][$i]['id'] ?>">
                                            <img src="<?= getUploadedImg($model['article'][$i]['images']) ?? "https://dummyimage.com/600x400/032FF2/ffffff" ?>" alt="" class="h-48 object-cover w-full object-center">
                                            <div class="p-6 hover:bg-biru hover:text-white  transition duration-200 ease-in">
                                                <label for="" class="bg-biru text-white border-2 border-white py-2 px-2 rounded-md"><?= $model['article'][$i]['category'] ?></label>
                                                <h1 class="font-rubik font-medium text-xl mb-4 mt-4"><?= $model['article'][$i]['title'] ?></h1>
                                                <p class=""><?php echo preg_replace($model['pattern'], $model['replacement'], substr($model['article'][$i]['paragraph'], 0, 150)) . " ..." ?></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="flex col-span-12 items-center justify-center">
                    <div class="w-3/4 lg:w-2/4">
                        <h1 class="text-3xl text-center mb-4"><?= $model['error'] ?></h1>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- tim mind -->
<!-- <section>
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <div class="grid grid-cols-12 items-center justify-center gap-4">
            <div class="col-span-12 items-center justify-center">
                <h1 class="font-rubik font-medium text-[38px] text-center mb-4">Tim <span class="text-biru">MindJourney</span></h1>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <p class="text-center lg:text-left mb-5 text-lg">Dalam mengembangkan website ini, saya sebagai pengembang utama telah
                    berkomitmen untuk memberikan yang terbaik. Dengan fokus dan dedikasi penuh, saya berusaha menjadikan
                    proyek ini sukses. Keberhasilan ini tak terlepas dari dukungan dari berbagai pihak yang memberikan
                    inspirasi dan bantuan, serta peningkatan kontinu melalui pembelajaran dan eksperimen. Terimakasih
                    kepada semua yang telah berkontribusi dalam pencapaian kesuksesan ini.</p>
            </div>
            <div class="col-span-12 lg:col-span-6 items-center justify-center">
                <img src="<?= getImage("profile2.jpeg") ?>" alt="" class="h-72 w-72 mx-auto object-cover object-center rounded-2xl mt-4">
            </div>
        </div>
    </div>
</section> -->

<!-- kritik saran -->
<section class="bg-dark-white">
    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <div class="grid grid-cols-12 items-center">
            <div class="col-span-12 items-center justify-center space-y-4">
                <h1 class="font-rubik font-medium text-[38px] text-center mb-4">Kritik dan saran</h1>
                <p class="text-center w-9/12 mx-auto">Kami sangat menghargai pandangan Anda dan kami selalu terbuka untuk menerima kritik dan saran yang membangun. Jika Anda memiliki komentar, kritik, atau saran, silakan bagikan kepada kami di bawah ini.</p>
                <form method="post" action="/">
                    <div class="flex flex-col w-9/12 gap-2 mb-4 mx-auto lg:w-1/4">
                        <input type="email" name="email" class="border-2 border-abu rounded-lg py-2 w-full px-4" required placeholder="Email">
                    </div>
                    <div class="flex flex-col w-9/12 gap-2 mb-4 mx-auto lg:w-1/4">
                        <input type="nama" name="name" class="border-2 border-abu rounded-lg w-full py-2 px-4" required placeholder="Nama">
                    </div>
                    <div class="flex flex-col w-9/12 gap-2 mb-4 mx-auto lg:w-1/4">
                        <textarea name="message" id="" cols="30" rows="10" class="border-2 border-abu rounded-lg py-2 h-20 w-full px-4" placeholder="Pesan" required></textarea>
                    </div>
                    <div class="w-9/12 mt-4 mx-auto lg:w-1/4">
                        <button class="bg-biru px-9 py-2 rounded-full font-semibold text-white" type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>