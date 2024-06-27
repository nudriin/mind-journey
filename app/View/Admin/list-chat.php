<section class="p-4 sm:ml-64">
    <div class="container mx-auto px-4 py-4">
        <?php if (isset($model['user']) && $model['user'] != null && !isset($model['error'])) { ?>
            <div class="w-full">
                <ul class="flex gap-2">
                    <?php foreach ($model['user'] as $row) { ?>
                        <li>
                            <a href="/admin/chat/<?= $row['email']?>"><?= $row['email'] ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } else { ?>
            <h1><?= $model['error'] ?></h1>
        <?php } ?>
    </div>
</section>