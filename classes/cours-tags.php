<?php

// require_once 'article-tag.php';


class cours_tags{
    private $cours_tag_id;
    private $tag_id;
    private $cours_id;


    

    public function __construct($cours_tag_id,$tag_id=null,$cours_id=''){
        $this->cours_tag_id=$cours_tag_id;
        $this->tag_id=$tag_id;
        $this->cours_id=$cours_id;
        }

        public function getarticletagId(){
            return $this->cours_tag_id;
        }
        public function gettagId(){
            return $this->tag_id;
        }
        public function getarticleid(){
            return $this->cours_id;
        }


public static function getAlltags(){
    $bd= database::getInstance()->getConnection();
    $sql = " SELECT * FROM tags"; 
    $stmt=$bd->prepare($sql);
    $stmt->execute();
    $arraytags=[];
    while ($data=$stmt->fetch(PDO::FETCH_ASSOC)){
        $arraytags[]= $data;
    }
    return $arraytags;
  }


  public static function insertCoursTag($cours_id, $tag_id) {
    if (!$cours_id || !$tag_id) {
        throw new Exception("Erreur : cours_id ou tag_id est nul.");
    }

    $db = database::getInstance()->getConnection();
    $sql = "INSERT INTO cours_tags (cours_id, tag_id) VALUES (:cours_id, :tag_id)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':cours_id' => $cours_id,
        ':tag_id' => $tag_id,
    ]);
}



public static function affichertagassocier($cours_id){
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT tags.tag_nom 
            FROM tags
            LEFT JOIN cours_id ON cours_tags.tag_id = tags.tag_id
            WHERE cours_tags.cours_id = :cours_id";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':cours_id', $cours_id, PDO::PARAM_INT);
    $stmt->execute();
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultats;
}


}