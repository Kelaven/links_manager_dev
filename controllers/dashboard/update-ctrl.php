<?php

require_once __DIR__ . '/../../models/Link.php';
require_once __DIR__ . '/../../helpers/dd.php';
require_once __DIR__ . '/../../config/init.php';




try {
    $link_id = intval(filter_input(INPUT_GET, 'link_id', FILTER_SANITIZE_NUMBER_INT)); 

    $linkData = Link::get($link_id); // pour afficher le lien dans le front


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = [];
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($title)) {
            $error['title'] = 'Le champ ne peut pas être vide. Merci de le vérifier';
        } else {
            $isOk = filter_var($title, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_TITLE_AND_URL . '/')));
            if (!$isOk) {
                $error['title'] = 'Erreur, le titre est invalide (il doit comporter entre 2 et 150 caractères maximum). Merci de le vérifier';
            }
        }
        $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
        if (empty($url)) {
            $error['url'] = 'Le champ ne peut pas être vide. Merci de le vérifier';
        } else {
            $isOk = filter_var($url, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_TITLE_AND_URL . '/')));
            if (!$isOk) {
                $error['title'] = 'Erreur, l\'url est invalide (elle doit comporter entre 2 et 150 caractères maximum). Merci de le vérifier';
            }
        }

        if (empty($error)) {
            $updateLink = new Link();
            $updateLink->setTitle($title);
            $updateLink->setUrl($url);

            $updateLink->update($link_id);

            if ($updateLink) {
                header('Location: /controllers/front-ctrl.php');
                die;
            }
        }
    }







} catch (\Throwable $th) {
    //throw $th;
}







// ! views

include __DIR__ . '/../../views/templates/dashboard/header.php';
include __DIR__ . '/../../views/dashboard/update.php';
include __DIR__ . '/../../views/templates/dashboard/footer.php';