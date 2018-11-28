<?php 

require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
));






require_once('models/annee.php');



switch ($action) {
    case 'list':
        showList();
        break;

}





function showList(){
    global $twig;
    $result = liste();
    

    $template = $twig->load('annee.html.twig');
    echo $template->render(array('title'=>'Liste des Années','annees' => $result));


}