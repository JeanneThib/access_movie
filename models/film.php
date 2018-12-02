<?php
    require'models/connection_bdd.php';


    function liste(){
        global $basedonne;
        $sql = "SELECT  films.titre,films.annee,films.description,films.image_film, 
        GROUP_CONCAT(DISTINCT genre.type SEPARATOR ', ') AS genre, 
        GROUP_CONCAT(DISTINCT realisateur.realisateur SEPARATOR ', ') AS realisateur, 
        GROUP_CONCAT(DISTINCT acteur.acteur SEPARATOR ', ') AS acteur
        FROM film_genre 
        INNER JOIN films ON film_genre.film = films.id 
        INNER JOIN film_realisateur ON film_realisateur.film = films.id
        INNER JOIN realisateur ON realisateur.id = film_realisateur.realisateur 
        INNER JOIN genre ON genre.id = film_genre.genre
        INNER JOIN film_acteur ON film_acteur.film = films.id 
        INNER JOIN acteur ON acteur.id = film_acteur.acteur
        GROUP BY films.titre";
        
        $requete = $basedonne->prepare($sql);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }

    function showFilmsByGenre($idgenre){
        global $basedonne;
        $sql = "SELECT films.titre, films.description, films.annee, films.image_film FROM (film_genre INNER JOIN films ON film_genre.film = films.id) INNER JOIN genre ON genre.id = film_genre.genre WHERE genre.id = :idgenre";
        
        
        $requete = $basedonne->prepare($sql);
        $requete -> bindParam(':idgenre', $idgenre, PDO::PARAM_INT);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }

    function showFilmsByOneRealisateur($idrealisateur){
        global $basedonne;
        $sql = "SELECT films.titre, films.description , films.annee ,films.image_film FROM (film_realisateur INNER JOIN films ON film_realisateur.film = films.id) INNER JOIN realisateur ON realisateur.id = film_realisateur.realisateur WHERE realisateur.id = :idrealisateur";
        
        
        $requete = $basedonne->prepare($sql);
        $requete -> bindParam(':idrealisateur', $idrealisateur, PDO::PARAM_INT);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }

    function showFilmsByOneActeur($idacteur){
        global $basedonne;
        $sql = "SELECT films.titre, films.description , films.annee ,films.image_film FROM (film_acteur INNER JOIN films ON film_acteur.film = films.id) INNER JOIN acteur ON acteur.id = film_acteur.acteur WHERE acteur.id = :idacteur";
        
        
        $requete = $basedonne->prepare($sql);
        $requete -> bindParam(':idacteur', $idacteur, PDO::PARAM_INT);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }

    function showAnnee($idannee){
        global $basedonne;
        $sql = "SELECT films.titre, films.description, films.image_film, films.annee FROM films WHERE annee = :idannee ORDER BY annee";
        
        
        $requete = $basedonne->prepare($sql);
        $requete -> bindParam(':idannee', $idannee, PDO::PARAM_INT);
        $requete->execute();    
        return $requete->fetchAll(PDO::FETCH_ASSOC);    
    }



