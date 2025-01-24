<?php

 class lesCours {
    private $cours_id;
    private $cours_image;
    private $cours_nom;
    private $cours_description;
    private $cours_type;
    private $cours_contenu;
    private $categorie_id;
    private $user_id;
    private $user_nom;

    private $tags;


    public function __construct($cours_id = null, $cours_image = null, $cours_nom = null, $cours_description = null, $cours_type = null, $cours_contenu = null, $categorie_id = null, $user_id = null,$user_nom=null, $tags = null) {
        $this->cours_id = $cours_id;
        $this->cours_image = $cours_image;
        $this->cours_nom = $cours_nom;
        $this->cours_description = $cours_description;
        $this->cours_type = $cours_type;
        $this->cours_contenu = $cours_contenu;
        $this->categorie_id = $categorie_id;
        $this->user_id = $user_id;
        $this->user_nom = $user_nom;

        $this->tags = $tags;
    }

    public function getId() { return $this->cours_id; }
    public function getImage() { return $this->cours_image; }
    public function getNom() { return $this->cours_nom; }
    public function getDescription() { return $this->cours_description; }
    public function getType() { return $this->cours_type; }
    public function getContenu() { return $this->cours_contenu; }
    public function getCategorieID() { return $this->categorie_id; }
    public function getUserID() { return $this->user_id; }
    public function getUsernom() { return $this->user_nom; }
    public function getTags() { return $this->tags; }


    public static function getAllElementsPaginé ($limit, $offset, $categorie_id) {

        $bd = database::getInstance()->getConnection();
        $sql = "SELECT cours.* ,users.* FROM cours 
                INNER JOIN users ON users.user_id = cours.user_id
                WHERE cours.categorie_id = :categorie_id 
                LIMIT $limit OFFSET $offset";
    
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cours = [];
        foreach ($results as $result) {
            $cours[] = new self(
                $result['cours_id'],
                $result['cours_image'],
                $result['cours_nom'],
                $result['cours_description'],
                $result['cours_type'],    
                $result['cours_contenu'], 
                $result['categorie_id'], 
                $result['user_id'],       
                $result['user_nom']      
            );
        }
        return $cours;
    }

    public static function getElementsPaginé ($limit, $offset, $categorie_id) {
        $bd = database::getInstance()->getConnection();
        $sql = "SELECT cours_id, cours_image, cours_nom, cours_description, categorie_id FROM cours 
                INNER JOIN users ON users.user_id = cours.user_id
                WHERE categorie_id = :categorie_id 
                LIMIT $limit OFFSET $offset";
    
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cours = [];
        foreach ($results as $result) {
            $cours[] = new self($result['cours_id'],$result['cours_nom'],$result['cours_description']) ; 
        }
        return $cours;
    }



}