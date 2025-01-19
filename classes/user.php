<?php
class user{
    private $user_id;
    private $user_nom;
    private $user_prenom;
    private $user_email;
    private $password;
    private $confirmpassword;
    private $user_type;
    private $status;

    public function __construct($user_id = null, $user_email = null, $password = null, $confirmpassword = null, $user_nom = null, $user_prenom = null, $user_type = null, $status = null) {
        $this->user_id = $user_id;
        $this->user_nom = $user_nom;
        $this->user_prenom = $user_prenom;
        $this->user_email = $user_email;
        $this->password = $password;
        $this->confirmpassword = $confirmpassword;
        $this->user_type = $user_type;
        $this->status = $status;
    }

    public function getUserId() {
        return $this->user_id;
    }
    public function getnom(){
        return $this->user_nom;
    }
    public function getprenom(){
        return $this->user_prenom;
    }
    public function getmail(){
        return $this->user_email;
    }
    public function getpass(){
        return $this->password;
    }
    public function getconfirmpass(){
        return $this->confirmpassword;
    }
    public function getrole(){
        return $this->user_type;
    }
    public function setid($user_id){
        $this->user_id=$user_id;
   }
    public function setnom($user_nom){
         $this->user_nom=$user_nom;
    }
    public function setprenom($user_prenom){
        $this->user_prenom=$user_prenom;
   }
   public function setemail($user_email){
    $this->user_email=$user_email;
}
public static function getEnattenteUsers() {
    $bd = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM users WHERE status='en attente'";
    $stmt = $bd->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $users = [];
    foreach ($result as $user) {
        $obj = new self();
        $obj->user_id = $user['user_id']; 
        $obj->setnom($user['user_nom']);
        $obj->setprenom($user['user_prenom']);
        $obj->setemail($user['user_email']);
        $users[] = $obj;
    }
    return $users;
}
public static function updateStatus($status, $id) {
    $bd = Database::getInstance()->getConnection();
    $sql = "UPDATE users SET status=:status WHERE user_id=:id";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
}
    // public static function getEnattenteUsers(){
    //     $bd= database::getInstance()->getConnection();
    //     $sql="SELECT * FROM users WHERE status='en attente'";
    //     $stmt=$bd->prepare($sql);
    //     $stmt->execute();
    //     $arrayUsers=[];
    //     while ($data=$stmt->fetch(PDO::FETCH_ASSOC)){
    //         $arrayCategories[]=new self (
    //             isset( $data['categorie_id'])? $data['categorie_id'] : '',
    //             isset( $data['categorie_name'])? $data['categorie_name'] : '',
        
    //         );
    //     }
    //     return $arrayCategories;
    //     }
    public static function GetUserinfos($email) { 
        $bd = Database::getInstance()->getConnection(); 
        $sql = "SELECT * FROM users WHERE user_email=:email";
         $stmt = $bd->prepare($sql); 
         $stmt->bindParam(":email", $email);
          $stmt->execute(); 
         $resultat = $stmt->fetch(PDO::FETCH_ASSOC); 
         return $resultat; 
        }
         

    public static function verfierData($email, $password) {
        //  $bd = Database::getInstance()->getConnection();
          $user = self::GetUserinfos($email); 
          if ($user) { 
            if (password_verify($password, $user['password'])) { 
                session_start(); 
                $_SESSION["user_id"] = $user['user_id']; 
                $_SESSION["user_nom"] = $user['user_nom']; 
                return true; 
            } else { 
                return "Mot de passe incorrect"; 
            } } else {
                 return "Email inexistant"; 
    }}

    public static function inscrireStudent($nom,$prenom,$email,$password,$confirme_password,$user_type){
        // $name=$this->nom;
        // $nom= user->getnom();
        $bd=Database::getInstance()->getConnection();
        $sql="INSERT INTO users(user_nom,user_prenom,user_email,password,confirme_password,user_type) VALUES 
        (:nom,:prenom,:email,:password,:confirme_password,:user_type)";
        $stmt=$bd->prepare($sql);
        $stmt->execute([
        ":nom"=>$nom,
        ":prenom"=>$prenom,
        ":email"=>$email,
        ":password"=>$password,
        ":confirme_password"=>$confirme_password,
        ":user_type"=>$user_type,
        ]);
    
    }
    public static function verifieremail($email) {
        $bd = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(*) FROM users WHERE user_email = :email";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(":email", $email);

        $stmt->execute();
        $count = $stmt->fetchColumn();
        if($count>0){
            return true;
        }
        else {
            return false;

        }
    } 
    



}