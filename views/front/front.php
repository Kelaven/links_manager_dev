<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="mb-3">
                <form method="post">
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Stack overflow"/>
                                <label for="title">Titre</label>
                                <div>
                                    <small class="text-danger"><?= $error['title'] ?? '' ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="url" class="form-control" id="url" name="url" placeholder="https://stackoverflow.com"/>
                                <label for="url">Lien</label>
                                <div>
                                    <small class="text-danger"><?= $error['url'] ?? '' ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto d-flex">
                            <button class="btn btn-primary btn-lg">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="list-group">
                <?php foreach ($links as $link) {
                ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="<?= $link->url; ?>"><?= $link->title; ?></a>
                        <span>
                            <a href="/controllers/dashboard/update-ctrl.php?link_id=<?= $link->link_id ?>"><i class="fa-regular fa-pen-to-square me-1 text-warning"></i></a>
                            <a href="/controllers/dashboard/delete-ctrl.php?link_id=<?= $link->link_id ?>"><i class="fa-solid fa-trash ms-1 text-danger"></i></a>
                        </span>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>