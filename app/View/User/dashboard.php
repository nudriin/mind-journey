<!-- dashboard -->
<section class="p-4 md:ml-64">

    <div class="container mx-auto items-center px-4 py-4 lg:px-20 lg:py-10 md:h-screen">
        <div class="grid grid-cols-12 w-9/12 mx-auto items-center justify-center gap-3 h-full mt-12 mb-12">
            <div class="col-span-12 lg:col-span-4 items-center justify-center">
            <img src="<?= getUploadedImg($model['user']->picture) ?? 'https://dummyimage.com/300x300/bababa/ffffff'?>" alt="" class="object-cover border-2 border-biru object-center h-48 w-48 rounded-xl">
                <!-- <img src="https://dummyimage.com/300x300/bababa/ffffff" alt="" class="rounded-full"> -->
            </div>
            <div class="col-span-12 lg:col-span-8 items-center justify-center gap-2">
                <h1 class="font-rubik font-medium text-4xl">Selamat Datang, kembali! <span class="text-biru"><?= $model['user']->name?></span></h1>
                <h1 class="text-lg">Tempat Terbaik untuk Merawat Kesehatan Mental! Dapatkan Wawasan dan Dukungan yang kamu Butuhkan</h1>
            </div>
        </div>
        
    
        <!-- card -->
    
    </section>