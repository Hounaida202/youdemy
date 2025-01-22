<?php


class tags{
    private $tag_id;
    private $tag_nom;

    public function __construct($tag_id=null,$tag_nom=''){
        $this->tag_id=$tag_id;
        $this->tag_nom=$tag_nom;
        }
        
        public function gettagId(){
            return $this->tag_id;
        }
        public function gettagname(){
            return $this->tag_nom;
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
}