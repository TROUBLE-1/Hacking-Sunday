<?php 
require_once('jwt.php');
require_once('DbConnect.php');
require_once('constants.php');

class tokenVerify {
    protected $dbConn;
    protected $userId;
   
    
     public function __construct() {
          $db = new DbConnect;
	       $this->dbConn = $db->connect();
         
         
        try {

            $token = $_SESSION['jwt'];
            $payload = JWT::decode($token, SECRETE_KEY, ['HS256']);

            $stmt = $this->dbConn->prepare("SELECT * FROM users WHERE id = :userId");
            $stmt->bindParam(":userId", $payload->userId);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!is_array($user)) {
                $this->returnResponse(INVALID_USER_PASS, "This user is not found in our database.");
            }

            if( $user['active'] == 0 ) {
                echo "This user may be decactived. Please contact to admin.";
            }
            $this->userId = $payload->userId;
        } catch (Exception $e) {
            echo $e->getMessage();
           // session_destroy();
        //    header("location: ./");
        }
		
    }
    
}
$obj = new tokenVerify();

?>