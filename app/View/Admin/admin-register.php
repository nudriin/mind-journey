<section x-data="{open : true}" class="sm:ml-64">
        <div class="container mx-auto px-4 py-4 lg:px-20 lg:py-28 items-center justify-center mt-12">
            <div class="p-4">
                <h1 class="font-rubik font-medium text-4xl text-center mb-5">Daftarkan admin</h1>
                <div class="border-2 border-abu rounded-lg w-full lg:w-9/12 mx-auto bg-dark-white">
                    <form action="/admin/register" method="post" class="flex flex-col gap-3">
                        <div class="flex flex-col gap-1 px-4 mt-4">
                            <label for="" class="text-xl font-semibold">Email</label>
                            <input type="text" name="email" class="border-2 border-abu rounded-lg p-2">
                        </div>
                        <div class="flex flex-col gap-1 px-4">
                            <label for="" class="text-xl font-semibold">Nama</label>
                            <input type="text" name="name" class="border-2 border-abu rounded-lg p-2">
                        </div>
                        <div class="flex flex-col gap-1 px-4">
                            <label for="" class="text-xl font-semibold">Password</label>
                            <input type="password" name="password" class="border-2 border-abu rounded-lg p-2">
                        </div>
                        <div class="flex items-center justify-center mb-4 px-4 mt-4">
                            <button type="submit" class="font-semibold text-dark-white text-center bg-biru rounded-lg text-xl w-full p-2">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>