<?php
// require_once '../classes/tags.php';
// require_once '../classes/cours_tags.php';

abstract class Cours {
    private $cours_id;
    private $cours_image;
    private $cours_nom;
    private $cours_description;
    private $cours_type;
    private $cours_contenu;
    private $categorie_id;
    private $user_id;

    private $tags;

    public function __construct($cours_id = null, $cours_image = null, $cours_nom = null, $cours_description = null, $cours_type = null, $cours_contenu = null, $categorie_id = null, $user_id = null, $tags = null) {
        $this->cours_id = $cours_id;
        $this->cours_image = $cours_image;
        $this->cours_nom = $cours_nom;
        $this->cours_description = $cours_description;
        $this->cours_type = $cours_type;
        $this->cours_contenu = $cours_contenu;
        $this->categorie_id = $categorie_id;
        $this->user_id = $user_id;
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
    public function getTags() { return $this->tags; }

    abstract public function afficherContenu();

    public static function createCours($data) {
        if ($data['cours_type'] === 'video') {
            return new VideoCours($data['cours_id'], $data['cours_image'], $data['cours_nom'], $data['cours_description'], $data['cours_type'], $data['cours_contenu'], $data['categorie_id'], $data['user_id'], $data["tags"] ?? null);
        } elseif ($data['cours_type'] === 'document') {
            return new DocumentCours($data['cours_id'], $data['cours_image'], $data['cours_nom'], $data['cours_description'], $data['cours_type'], $data['cours_contenu'], $data['categorie_id'], $data['user_id'], $data["tags"] ?? null);
        }
    }

    public static function CountCours($categorie_id) {
        $bd = database::getInstance()->getConnection();
        $sql = "SELECT count(*) FROM cours WHERE categorie_id = :categorie_id";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public static function getElementsPaginé ($limit, $offset, $categorie_id) {
        $bd = database::getInstance()->getConnection();
        // Construction sécurisée de la requête
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
            $cours[] = [
                'cours_id' => $result['cours_id'],
                'cours_image' => $result['cours_image'],
                'cours_nom' => $result['cours_nom'],
                'cours_description' => $result['cours_description'],
                'categorie_id' => $result['categorie_id']
            ];
        }
        return $cours;
    }
    


    public static function afficherMescours($categorie_id,$user_id) {
        $bd = database::getInstance()->getConnection();
        $sql="SELECT cours.*, users.*, GROUP_CONCAT(tags.tag_nom) as tags
        FROM cours
        INNER JOIN users 
            ON users.user_id = cours.user_id
        INNER JOIN cours_tags 
            ON cours.cours_id = cours_tags.cours_id
        INNER JOIN tags 
            ON cours_tags.tag_id = tags.tag_id
        WHERE cours.categorie_id = :categorie_id 
          AND cours.user_id = :user_id
        GROUP BY cours.cours_id;";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cours = [];


        foreach ($results as $result) {
            $cours[] = self::createCours($result); 
        }
        return $cours;
    }


    public static function AjouterTags($tag_nom, $cours_id){
        $bd = database::getInstance()->getConnection();
        $sql = "INSERT INTO tags (tag_nom, cours_id) VALUES
                (:tag_nom, :cours_id)";
    
        $stmt = $bd->prepare($sql);
        $stmt->execute([
            ':tag_nom' => $tag_nom,
            ':cours_id' => $cours_id
        ]);
    }

    public static function insertcours($cours_image, $cours_nom, $cours_description, $categorie_id, $user_id, $cours_type, $cours_lien) {
        $db = database::getInstance()->getConnection();
        $sql = "INSERT INTO cours (cours_image, cours_nom, cours_description, categorie_id, user_id, cours_type, cours_contenu) 
        VALUES (:cours_image, :cours_nom, :cours_description, :categorie_id, :user_id, :cours_type, :cours_lien)";
$stmt = $db->prepare($sql);
$stmt->execute([
    ':cours_image' => $cours_image,
    ':cours_nom' => $cours_nom,
    ':cours_description' => $cours_description,
    ':categorie_id' => $categorie_id,
    ':user_id' => $user_id,
    ':cours_type' => $cours_type,
    ':cours_lien' => $cours_lien,
]);

        // Retourner l'ID du cours inséré
        return $db->lastInsertId();
    }


    
    // public static function afficherPourUpdate($cours_id) {
    //     $bd = database::getInstance()->getConnection();
    //     $sql = "SELECT * FROM cours 
    //             WHERE cours.cours_id = :cours_id ";
    //     $stmt = $bd->prepare($sql);
    //     $stmt->bindParam(':cours_id', $cours_id, PDO::PARAM_INT);
    //     $stmt->execute();
    //     $results = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $results;
    // }
    public static function UpdateCours($cours_id, $cours_image, $cours_nom, $cours_description, $cours_type, $cours_contenu){
        $bd = database::getInstance()->getConnection();
        $sql = "UPDATE cours 
        SET cours_image = :cours_image, 
            cours_nom = :cours_nom, 
            cours_description = :cours_description, 
            cours_type = :cours_type, 
            cours_contenu = :cours_contenu 
        WHERE cours_id = :cours_id";
    $stmt=$bd->prepare($sql);
    $stmt->bindParam(':cours_image', $cours_image);
    $stmt->bindParam(':cours_nom', $cours_nom);
    $stmt->bindParam(':cours_description', $cours_description);
    $stmt->bindParam(':cours_type', $cours_type);
    $stmt->bindParam(':cours_contenu', $cours_contenu);
    $stmt->bindParam(':cours_id', $cours_id);
    $stmt->execute();

    }

    public static function deleteByIdcour($cours_id){
        $bd = database::getInstance()->getConnection();
        $sql="DELETE FROM cours WHERE cours.cours_id=:cours_id";
        $stmt=$bd->prepare($sql);
        $stmt->bindParam(":cours_id",$cours_id);
        $stmt->execute();
    }
    
// public static function TESTER($categorie_id){
// $bd=database::getInstance()->getConnection();
// $sql="SELECT * FROM cours WHERE cours.categorie_id=:categorie_id";
// $stmt=$bd->prepare($sql);
// $stmt->bindParam(":categorie_id",$categorie_id);
// $stmt->execute();
// $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

// $array=[];
// foreach($result as $objet){
// $newobjet=new self($objet['cours_id'], $objet['cours_image'],
//  $objet['cours_nom'], $objet['cours_description'],
//   $objet['categorie_id']);
// $array[]=$newobjet;
// }
//    return $array; 
// }


// ----------------------------


// public static function afficherCoursComplete($categorie_id) {
//     $bd = database::getInstance()->getConnection();
//     $sql="SELECT DISTINCT * FROM cours
//     inner join cours_tags
//     ON cours.cours_id= cours_tags.cours_id
//     inner join tags 
//     ON cours_tags.tag_id=tags.tag_id
//     WHERE cours.categorie_id = :categorie_id 
//      ";
//     $sql="SELECT DISTINCT cours.*, users.*, tags.*
// FROM cours
// INNER JOIN users 
//     ON users.user_id = cours.user_id
// INNER JOIN cours_tags 
//     ON cours.cours_id = cours_tags.cours_id
// INNER JOIN tags 
//     ON cours_tags.tag_id = tags.tag_id
// WHERE cours.categorie_id = :categorie_id 
//   AND cours.user_id = :user_id;";
//     $stmt = $bd->prepare($sql);
//     $stmt->bindParam(":categorie_id",$categorie_id);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

public static function getAllElementsPaginé ($limit, $offset, $categorie_id) {

    $bd = database::getInstance()->getConnection();
    $sql = "SELECT cours_id, cours_image, cours_nom, cours_description, categorie_id , user_nom FROM cours 
            INNER JOIN users ON users.user_id = cours.user_id
            WHERE categorie_id = :categorie_id 
            LIMIT $limit OFFSET $offset";

    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cours = [];
    foreach ($results as $result) {
        $cours[] = [
            'cours_id' => $result['cours_id'],
            'cours_image' => $result['cours_image'],
            'cours_nom' => $result['cours_nom'],
            'cours_description' => $result['cours_description'],
            'categorie_id' => $result['categorie_id'],
            'user_nom' => $result['user_nom']

        ];
    }
    return $cours;
}

public static function afficherMescoursStudent($user_id) {
    $bd = database::getInstance()->getConnection();
    
    $sql = "
    SELECT cours.*, GROUP_CONCAT(tags.tag_nom) as tags
FROM cours
INNER JOIN inscriptions 
    ON inscriptions.cours_id = cours.cours_id
INNER JOIN cours_tags 
    ON cours.cours_id = cours_tags.cours_id
INNER JOIN tags 
    ON cours_tags.tag_id = tags.tag_id
WHERE inscriptions.user_id = :user_id
GROUP BY cours.cours_id";
    
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cours = [];
    
    foreach ($results as $result) {
        $cours[] = self::createCours($result); 
    }

    return $cours;


}

    
}

class VideoCours extends Cours {
    public function afficherContenu() {
        echo "<iframe src='{$this->getContenu()}' frameborder='0' allowfullscreen></iframe>";
    }
}

class DocumentCours extends Cours {
    public function afficherContenu() {
        echo "<a href='{$this->getContenu()}' target='_blank'>Télécharger le document</a>";
    }
}



?>
