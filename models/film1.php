<?php
    $basedonne = new PDO("mysql:host=127.0.0.1;dbname=annuaire_film; charset=utf8", "root", "online@2017");


    function liste(){
        global $basedonne;
        $sql = "SELECT films.titre, films.description, films.annee
                FROM `films`";
        
        $requete = $basedonne->prepare($sql);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }
    
    