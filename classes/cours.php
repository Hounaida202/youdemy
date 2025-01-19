<?php
class cours{
    private $cours_id;
    private $cours_image;
    private $cours_nom;
    private $cours_description;
    private $categorie_id;
    private $user_id;



    public function __construct($cours_id=null,$cours_image=null,$cours_nom=null,$cours_description=null,$categorie_id=null,$user_id=null)
    {
        $this->cours_id=$cours_id;
        $this->cours_image=$cours_image;
        $this->cours_nom=$cours_nom;
        $this->cours_description=$cours_description;
        $this->categorie_id=$categorie_id;
        $this->user_id=$user_id;


    }

public function getId(){
    return $this->cours_id;
}
public function getimage(){
    return $this->cours_image;
}
public function getnom(){
    return $this->cours_nom;
}
public function getdescription(){
    return $this->cours_description;
}
public function getcategorieID(){
    return $this->categorie_id;
}
public function getuserID(){
    return $this->user_id;
}

public static function CountCours($categorie_id){
    $bd=database::getInstance()->getConnection();
    $sql="SELECT count(*) FROM cours WHERE categorie_id = :categorie_id";
    $stmt=$bd->prepare($sql);
    $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $stmt->execute();
    $result=$stmt->fetchColumn();
    return $result;
}
public static function getElementsPaginé($limit, $offset, $categorie_id) {
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT * FROM cours 
            INNER JOIN users ON users.user_id = cours.user_id
            WHERE categorie_id = :categorie_id 
            LIMIT :limit OFFSET :offset"; 
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cours = [];
    foreach ($results as $result) {
        $obj = new self(
            $result['cours_id'],
            $result['cours_image'],
            $result['cours_nom'],
            $result['cours_description'],
            $result['categorie_id'],
            $result['user_id']
        );
        $cours[] = $obj;
    }
    return $cours;
}


}