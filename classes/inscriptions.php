<?php
class inscriptions{
    private $inscription_id;
    private $cours_id;
    private $user_id;
    private $nom;
    private $prenom;


    public function __construct($inscription_id=null,$cours_id=null,$user_id=null,$nom=null,$prenom=null)
    {
        $this->inscription_id=$inscription_id;
        $this->cours_id=$cours_id;
        $this->user_id=$user_id;
        $this->nom=$nom;
        $this->prenom=$prenom;

    }

public function getinscriptionId(){
    return $this->inscription_id;
}
public function getcoursid(){
    return $this->cours_id;
}
public function getuserid(){
    return $this->user_id;
}
public function getnom(){
    return $this->nom;
}
public function getprenom(){
        return $this->prenom;
}


public static function insertinscription($nom,$prenom,$cours_id,$user_id){
    $bd = database::getInstance()->getConnection();
    $sql = "INSERT INTO inscriptions (nom,prenom,cours_id,user_id)
    VALUES(:nom,:prenom,:cours_id,:user_id)";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(":nom",$nom);
    $stmt->bindParam(":prenom",$prenom);
    $stmt->bindParam(":cours_id",$cours_id);
    $stmt->bindParam(":user_id",$user_id);
    $stmt->execute();
}

public static function dejaInscré($cours_id,$user_id) {
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT COUNT(*) FROM inscriptions WHERE cours_id = :cours_id
    AND user_id = :user_id";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(":cours_id", $cours_id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result > 0;
}

public static function inscréAmescours($user_id) {
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT * FROM cours
    INNER JOIN inscriptions 
    ON inscriptions.cours_id=cours.cours_id
    INNER JOIN users 
    ON users.user_id=inscriptions.user_id
    WHERE cours.user_id = :user_id";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

public static function CountinscriptionsEnseignant($user_id) {
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT count(*) FROM inscriptions
    INNER JOIN cours on cours.cours_id=inscriptions.cours_id
     WHERE cours.user_id = :user_id";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}

}