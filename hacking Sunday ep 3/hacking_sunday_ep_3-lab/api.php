<?php 

	class Api extends Rest {
		
		public function __construct() {
			parent::__construct();
		}
        

		public function generateToken() {
			$email = $this->validateParameter('email', $this->param['email'], STRING);
			$pass = $this->validateParameter('pass', $this->param['pass'], STRING);
			try {
				$stmt = $this->dbConn->prepare("SELECT * FROM users WHERE email = :email AND password = :pass");
				$stmt->bindParam(":email", $email);
				$stmt->bindParam(":pass", $pass);
				$stmt->execute();
				$user = $stmt->fetch(PDO::FETCH_ASSOC);
				if(!is_array($user)) {
					echo "Email or Password is incorrect.";
                    exit();
				}

				
                $email = $user['email'];
                $stmt = $this->dbConn->prepare("SELECT * FROM users WHERE email = '$email' ");
				$stmt->execute();
				$user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                
				$paylod = [
					'iat' => time(),
					'iss' => 'localhost',
					'exp' => time() + (60*60),
					'userId' => $user['id'],
                    'email' => $user['email'],
                    'is_admin' => $user['is_admin']
				];
               // echo $user['is_admin'];
				$token = JWT::encode($paylod, SECRETE_KEY);
                $_SESSION['is_admin'] = $user['is_admin'];
				$data = ['token' => $token];
                $_SESSION['jwt'] = $token;
                
				//$this->returnResponse(SUCCESS_RESPONSE, $data);
			} catch (Exception $e) {
				$this->throwError(JWT_PROCESSING_ERROR, $e->getMessage());
			}
		}

    
		public function getCustomerDetails() {
            $is_admin = $this->is_admin();
            if($is_admin == false){
                exit;
            }
			$customerId = $this->validateParameter('customerId', $this->param['customerId'], INTEGER);
			$cust = new Customer;
			$cust->setId($customerId);
			$customer = $cust->getCustomerDetailsById();
			if(!is_array($customer)) {
				$this->returnResponse(SUCCESS_RESPONSE, ['message' => 'Customer details not found.']);
			}

			$response['customerId'] 	= $customer['id'];
			$response['cutomerName'] 	= $customer['name'];
			$response['email'] 			= $customer['email'];
			$response['mobile'] 		= $customer['mobile'];
			$response['address'] 		= $customer['address'];
			$response['createdBy'] 		= $customer['created_user'];
			$response['lastUpdatedBy'] 	= $customer['updated_user'];
            
			$customerDetails = $this->returnResponse(SUCCESS_RESPONSE, $response);
		}

	}

	
 ?>
