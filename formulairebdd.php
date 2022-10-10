<?php 

// AFFICHAGE DES ERREURS ini_set — Modifie la valeur d'une option de configuration
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// ON SE CONNECTE A LA BDD
$host="localhost";
$dbname="ipecom";
$user="root";
$pass="";

        try{
            $bddm=new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $user, $pass);
            $bddm->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $bddm->setattribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            echo'Merci, vos informations ont bien été transmises.';
        }
        catch(PDOException $e)
        {
            die("Une erreur a été trouvée: " . $e->getMessage());
        }
 
                if (isset($_POST['submit']))
                // si la variable $_POST['truc'] existe, alors $truc=$_POST['truc'] sinon elle vaut NULL
                {
                // si le champ nom n'est pas vide alors la variable nom prend la valeur du champ sinon 
                // la variable nom prend la valeur NULL
                    $nom = !empty($_POST["nom"]) ? $_POST["nom"] : NULL;
                    $prenom = !empty($_POST["prenom"]) ? $_POST["prenom"] : NULL;
                    $email = !empty($_POST["email"]) ? $_POST["email"] : NULL;
                    $messages = !empty($_POST["messages"]) ? $_POST["messages"] : NULL;

                    // on prépare la requête et on insère les données reçues dans la table
                    $insertion=$bddm->prepare("INSERT INTO formulairephp (nom, prenom, email, messages)
                                      VALUES (:nom, :prenom, :email, :messages)")
                                      or die(print_r($bddm->errorInfo()));
                    
                // On insert les valeurs des input dans les champs de la table 
                // bindParam->Lie un paramètre à un espace réservé nommé dans l’instruction SQL et s'execute apres 
                // l'instruction execute();
                    $insertion->bindParam(':nom',$nom);
                    $insertion->bindParam(':prenom',$prenom);
                    $insertion->bindParam(':email',$email);
                    $insertion->bindParam(':messages',$messages);
                    $insertion->execute();
                }


    
?>