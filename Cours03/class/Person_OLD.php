
<?php
 class Person {
    public string $name;  
    public string $address;  
    public string $zipCode = 'H1H1H1';  
    public string $phone;  
    private string $email; 


    public function __construct(string $name, $email = '', $address = '', $phone = ''){
            $this->name = $name;
            $this->address = $address;
            $this->phone = $phone;
            $this->email = $email;
        }
    
    public function __destruct(){
        echo "Name: $this->name<br>Email: $this->email";
    } 

    private function magic() {
        echo "The class name is <strong>".__CLASS__ ."</strong><br>";
        echo "The line number is <strong>".__LINE__ ."</strong><br>";
        echo "The file is located at <strong>".__FILE__ ."</strong><br>";
        echo "The method name is <strong>".__METHOD__ ."</strong><br>";

    }

    public function showMagic(){
        return $this->magic();
    }
 }
?>
