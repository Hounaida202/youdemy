<?php
class categories{
    private $categorie_id;
    private $categorie_image;
    private $categorie_nom;
    private $categorie_description;

    public function __construct($categorie_id=null,$categorie_image=null,$categorie_nom=null,$categorie_description=null)
    {
        $this->categorie_id=$categorie_id;
        $this->categorie_image=$categorie_image;
        $this->categorie_nom=$categorie_nom;
        $this->categorie_description=$categorie_description;

    }

public function getcategorieId(){
    return $this->categorie_id;
}
public function getimage(){
    return $this->categorie_image;
}
public function getnom(){
    return $this->categorie_nom;
}
public function getdescription(){
    return $this->categorie_description;
}


public static function getAllCategories(){
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT * FROM categories";
    $stmt = $bd->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $categories = [];
    foreach($result as $row){
        $obj = new self($row['categorie_id'], $row['categorie_image'], $row['categorie_nom'], $row['categorie_description']);
        $categories[] = $obj; 
    }
    return $categories; 
}

public static function inserCtegorie($categorie_image, $categorie_nom, $categorie_description){
    $bd = database::getInstance()->getConnection();
    $sql = "INSERT INTO categories(categorie_image,categorie_nom,categorie_description)
    VALUES(:categorie_image,:categorie_nom,:categorie_description)";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(":categorie_image",$categorie_image);
    $stmt->bindParam(":categorie_nom",$categorie_nom);
    $stmt->bindParam(":categorie_description",$categorie_description);
        $stmt->execute();
}
public static function deleteByIdcategorie($categorie_id){
    $bd = database::getInstance()->getConnection();
    $sql="DELETE FROM categories WHERE categories.categorie_id=:categorie_id";
    $stmt=$bd->prepare($sql);
    $stmt->bindParam(":categorie_id",$categorie_id);
    $stmt->execute();
}
public static function UpdateCategorie( $categorie_image, $categorie_nom, $categorie_description,$categorie_id){

    $bd = database::getInstance()->getConnection();
    $sql = "UPDATE categories 
    SET categorie_image = :categorie_image, 
        categorie_nom = :categorie_nom, 
        categorie_description = :categorie_description
        
    WHERE categorie_id = :categorie_id";
$stmt=$bd->prepare($sql);
$stmt->bindParam(':categorie_image', $categorie_image);
$stmt->bindParam(':categorie_nom', $categorie_nom);
$stmt->bindParam(':categorie_description', $categorie_description);
$stmt->bindParam(':categorie_id', $categorie_id);
$stmt->execute();
}
}