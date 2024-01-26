<?php

require_once __DIR__ . '/../models/Link.php';
require_once __DIR__ . '/../helpers/dd.php';
require_once __DIR__ . '/../config/init.php';


try {
    // ! afficher les liens
    $links = Link::getAll();

    // ! ajouter un nouveau lien à l'aide du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = [];
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($title)) {
            $error['title'] = 'Le champ est vide.';
        } else {
            $isOk = filter_var($title, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_TITLE_AND_URL . '/')));
            if (!$isOk) {
                $error['title'] = 'Erreur, le titre est invalide (il doit comporter entre 2 et 150 caractères maximum).';
            }
        }
        $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
        if (empty($url)) {
            $error['url'] = 'Le champ est vide.';
        } else {
            $isOk = filter_var($url, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_TITLE_AND_URL . '/')));
            if (!$isOk) {
                $error['url'] = 'Erreur, l\'url est invalide (elle doit comporter entre 2 et 150 caractères maximum).';
            }
        }

        if (empty($error)) {
            $addLink = new Link();
            $addLink->setTitle($title);
            $addLink->setUrl($url);

            $addedLink = $addLink->insert();

            if ($addedLink) {
                $links = Link::getAll(); // mettre à jour la liste en restant sur la même page
            }
        }
    }





} catch (\Throwable $th) {
    dd($th);
}



// ! views

include __DIR__ . '/../views/templates/dashboard/header.php';
include __DIR__ . '/../views/front/front.php';
include __DIR__ . '/../views/templates/dashboard/footer.php';