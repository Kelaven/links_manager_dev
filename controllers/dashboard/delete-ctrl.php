<?php

require_once __DIR__ . '/../../models/Link.php';
require_once __DIR__ . '/../../helpers/dd.php';


try {
    // ! delete vehicle
    $link_id = intval(filter_input(INPUT_GET, 'link_id', FILTER_SANITIZE_NUMBER_INT)); 
    $delete = Link::delete($link_id);
    if ($delete) {
        header('Location: /controllers/front-ctrl.php');
        die;
    }





} catch (\Throwable $th) {
    dd($th);
}



// ! views

include __DIR__ . '/../../views/templates/dashboard/header.php';
include __DIR__ . '/../../views/front/front.php';
include __DIR__ . '/../../views/templates/dashboard/footer.php';