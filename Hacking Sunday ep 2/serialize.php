<?php 
session_start();
$filename = './uploads/'.rand().'.txt';


class Fruit {
  // Properties
  public $name;
  public $color;

  // Methods
  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }
  function set_color($color) {
    $this->color = $color;
  }
  function get_color() {
    return $this->color;
  }
}

class CalcService{
    public static function calculator($operator,$calc){
     switch ($operator) {
         case 'add':
            $result = $calc->num1 + $calc->num2;
            return $result;             
            break;
        case 'sub':
            $result = $calc->num1 - $calc->num2;
            return $result;             
            break;
        case 'div':    
             $result = $calc->num1 / $calc->num2;
             return $result;             
             break;
        case 'mul':    
             $result = $calc->num1 * $calc->num2;
             return $result;             
             break;

     }
    }
}

class Animal
{
    private $family;
    private $food;
    public function __construct($family, $food)
    {
        $this->family = $family;
        $this->food   = $food;
    }
    public function get_family()
    {
        return $this->family;
    }
    public function set_family($family)
    {
        $this->family = $family;
    }
    public function get_food()
    {
        return $this->food;
    }
    public function set_food($food)
    {
        $this->food = $food;
    }
}

class read {
    public $filename = '';
    
    public function __construct(){
        $this->filename = '';
        
    }
    
    public function __destruct(){
         $myfile = fopen($this->filename, "r");
         echo fread($myfile,filesize($this->filename));
         fclose($myfile);
    }
}

class Employee
{
  private $first_name;
  private $last_name;
  private $age;
  
  public function __construct($first_name, $last_name, $age)
  {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->age = $age;
  }
 
  public function getFirstName()
  {
    return $this->first_name;
  }
 
  public function getLastName()
  {
    return $this->last_name;
  }
 
  public function getAge()
  {
    return $this->age;
  }
}

class Cow extends Animal {
    private $owner;
    public function __construct($family, $food)
    {
        parent::__construct($family, $food);
    }
    public function set_owner($owner)
    {
        $this->owner = $owner;
    }
    public function get_owner()
    {
        return $this->owner;
    }
}

class save {
        public $name = '';
        public $birthday = '';
        public $gender = '';
        public $email = '';
        public $phone = '';
        
        public function __construct(){
            $this->name = $_POST['name'];
            $this->birthday = $_POST['birthday'];
            $this->gender = $_POST['gender'];
            $this->email = $_POST['email'];
            $this->phone = $_POST['phone'];

        }
    
        public function __destruct(){

            echo "<script>alert('Name: $this->name \\r\\n Birthday: $this->birthday \\r\\n Gender: $this->gender \\r\\n Email: $this->email \\r\\n Phone: $this->phone')</script>"; 
        }
        
    }

class Calc{
    public $operator;
    public $num1;
    public $num2;


    public function __construct(string $one, int $two, int $three){
        $this->operator = $one;
        $this->num1 = $two;
        $this->num2 = $three;
    }    

    public function calculator(){
     switch ($this->operator) {
         case 'add':
            $result = $this->num1 + $this->num2;
            return $result;             
            break;
        case 'sub':
            $result = $this->num1 - $this->num2;
            return $result;             
            break;
        case 'div':    
             $result = $this->num1 / $this->num2;
             return $result;             
             break;
        case 'mul':    
             $result = $this->num1 * $this->num2;
             return $result;             
             break;

     }
    }

}

if(isset($_POST['name']) and isset($_POST['birthday']) and isset($_POST['gender']) and isset($_POST['email']) and isset($_POST['phone'])){
    
    $save = new save();
    $data1 = base64_encode(serialize($save));
    $myfile = fopen($filename, "w");
    fwrite($myfile, $data1);
    fclose($myfile);
    
     $_SESSION['data'] = $data1;
    
}

if(isset($_FILES["file"]["name"])){

   
        $extension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

    if($extension=='txt'){
        
        move_uploaded_file($_FILES["file"]["tmp_name"], $filename) ;
        
        
        $myfile = fopen($filename, "r") or die("Unable to open file!");
        $content = fread($myfile,filesize($filename));
        fclose($myfile);
         unserialize(base64_decode($content));
    }
    

    
}



?>