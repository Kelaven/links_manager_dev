<div class="container h-100">
    <div class="row justify-content-center h-50">
        <div class="col-md-6 shadow p-3 pt-5">
            <h2 class="mb-3">Éditer le lien <?= $linkData->url ?></h2>
            <div class="mb-3">
                <form action="" method="post">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Stack overflow" value="<?= $linkData->title ?? '' ?>"/>
                            <label for="title">Titre</label>
                            <div>
                                <small class="text-danger"><?= $error['title'] ?? '' ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="url" class="form-control" id="url" name="url" placeholder="https://stackoverflow.com" value="<?= $linkData->url ?? '' ?>"/>
                            <label for="url">Lien</label>
                            <div>
                                <small class="text-danger"><?= $error['url'] ?? '' ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto d-flex">
                        <button class="btn btn-primary btn-lg">Enregister</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>