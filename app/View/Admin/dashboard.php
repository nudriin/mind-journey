<!-- dashboard -->
<section x-data="{open : true}" class="sm:ml-64">

    <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28">
        <div class="mt-12">
            <div class="flex items-center justify-center">
                <div class="w-3/4 lg:w-2/4">
                    <h1 class="font-rubik font-medium text-4xl text-center mb-12 mt-12">Dashboard</h1>
                </div>
            </div>

            <div class="flex flex-wrap -m-4">
                <!-- card -->
                <div class="p-4 w-full sm:w-1/2">
                    <div class="h-full border-2 border-abu rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h1 class="font-rubik font-medium text-2xl text-center">Artikel</h1>
                        </div>
                        <div class="p-6 space-y-2">
                            <div class="border-2 border-abu p-6 rounded-lg bg-dark-white">
                                <p class="text-center text-2xl font-semibold"><?= $model['size_article'] ?? 0 ?> </p>
                            </div>
                            <div>
                                <a href="/post-article">
                                    <div class="border-2 border-abu p-6 rounded-lg bg-biru text-white transition duration-200 ease-in">
                                        <p class="text-center text-xl">Tambah Artikel</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card -->
                <div class="p-4 w-full sm:w-1/2">
                    <div class="h-full border-2 border-abu rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h1 class="font-rubik font-medium text-2xl text-center">Artikel aktif</h1>
                        </div>
                        <div class="p-6 space-y-2">
                            <div class="border-2 border-abu p-6 rounded-lg bg-dark-white">
                                <p class="text-center text-2xl font-semibold"><?= $model['size_active'] ?? 0 ?> </p>
                            </div>
                            <div>
                                <a href="/active-article">
                                    <div class="border-2 border-abu p-6 rounded-lg bg-biru text-white transition duration-200 ease-in">
                                        <p class="text-center text-xl">Lihat</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card -->
                <div class="p-4 w-full sm:w-1/2">
                    <div class="h-full border-2 border-abu rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h1 class="font-rubik font-medium text-2xl text-center">Artikel non-aktif</h1>
                        </div>
                        <div class="p-6 space-y-2">
                            <div class="border-2 border-abu p-6 rounded-lg bg-dark-white">
                                <p class="text-center text-2xl font-semibold"><?= $model['size_deactive'] ?? 0 ?> </p>
                            </div>
                            <div>
                                <a href="/deactive-article">
                                    <div class="border-2 border-abu p-6 rounded-lg bg-biru text-white transition duration-200 ease-in">
                                        <p class="text-center text-xl">Lihat</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card -->
                <div class="p-4 w-full sm:w-1/2">
                    <div class="h-full border-2 border-abu rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h1 class="font-rubik font-medium text-2xl text-center">Kritik dan saran</h1>
                        </div>
                        <div class="p-6 space-y-2">
                            <div class="border-2 border-abu p-6 rounded-lg bg-dark-white">
                                <p class="text-center text-2xl font-semibold"><?= $model['size_suggestions'] ?? 0 ?></p>
                            </div>
                            <div>
                                <a href="/suggestions">
                                    <div class="border-2 border-abu p-6 rounded-lg bg-biru text-white transition duration-200 ease-in">
                                        <p class="text-center text-xl">Lihat</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>