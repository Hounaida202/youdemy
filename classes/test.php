<?php
//  class Cours {
//     private $cours_id;
//     private $cours_image;
//     private $cours_nom;
//     private $cours_description;
//     private $cours_type;
//     private $cours_contenu;
//     private $categorie_id;
//     private $user_id;

//     public function __construct($cours_id = null, $cours_image = null, $cours_nom = null, $cours_description = null, $cours_type = null, $cours_contenu = null, $categorie_id = null, $user_id = null) {
//         $this->cours_id = $cours_id;
//         $this->cours_image = $cours_image;
//         $this->cours_nom = $cours_nom;
//         $this->cours_description = $cours_description;
//         $this->cours_type = $cours_type;
//         $this->cours_contenu = $cours_contenu;
//         $this->categorie_id = $categorie_id;
//         $this->user_id = $user_id;
//     }

//     public function getId() { return $this->cours_id; }
//     public function getImage() { return $this->cours_image; }
//     public function getNom() { return $this->cours_nom; }
//     public function getDescription() { return $this->cours_description; }
//     public function getType() { return $this->cours_type; }
//     public function getContenu() { return $this->cours_contenu; }
//     public function getCategorieID() { return $this->categorie_id; }
//     public function getUserID() { return $this->user_id; }

//     public static function TESTER($categorie_id){
//         $bd=database::getInstance()->getConnection();
//         $sql="SELECT * FROM cours WHERE cours.categorie_id=:categorie_id";
//         $stmt=$bd->prepare($sql);
//         $stmt->bindParam(":categorie_id",$categorie_id);
//         $stmt->execute();
//         $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
//         $array=[];
//         foreach($result as $objet){
//         $newobjet=new self($objet['cours_id'], $objet['cours_image'],
//          $objet['cours_nom'], $objet['cours_description'],
//           $objet['categorie_id']);
//         $array[]=$newobjet;
//         }
//            return $array; 
//         }


//         public static function afficherCoursComplete() {
//             $bd = database::getInstance()->getConnection();
//             $sql = " 
//             SELECT a.cours_id, a.couurs_nom, a.cours_description, 
//                    GROUP_CONCAT(t.tag_nom SEPARATOR ', ') AS tags
//             FROM cours a
//              JOIN cours_tags at ON a.cours_id = at.cours_id
//             JOIN tags t ON at.tag_id = t.tag_id
//             GROUP BY a.cours_id 
//         ";
//             $stmt = $bd->prepare($sql);
//             $stmt->execute();
//             return $stmt->fetchAll(PDO::FETCH_ASSOC);
//         }
// }