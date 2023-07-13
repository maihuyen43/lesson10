<?php
// Tạo một class trừu tượng "Shape" (Hình dạng) có một phương thức trừu tượng là "calculateArea". 
// Tạo các lớp con "Circle" (Hình tròn) và "Rectangle" (Hình chữ nhật) kế thừa từ lớp Shape và triển khai phương thức calculateArea cho từng hình.
abstract class Shape{
    abstract public function calculateArea();
}
class Circle extends Shape{
    protected $radius;
    public function setRadius($radius){
        $this->radius = $radius;
    }
    public function calculateArea(){
        return 3.14*pow($this->radius,2);
    }
}
class Rectangle extends Shape{
    protected $height, $width;
    public function __construct($height, $width){
        $this->height = $height;
        $this->width = $width;
    }
    public function calculateArea(){
        return $this->height*$this->width;
    }
}
echo "Bài 1: <br>";
$circle = new Circle();
$circle->setRadius(1);
echo "Circle Area: " . $circle->calculateArea();
echo "<br>";
$rec = new Rectangle(3,4);
echo "Rectangle Area: " . $circle->calculateArea();

// Tạo một abstract class "Animal" (Động vật) với một phương thức trừu tượng là "makeSound". 
// Tạo các lớp con "Dog" (Chó) và "Cat" (Mèo) kế thừa từ lớp Animal và triển khai phương thức makeSound theo cách riêng của từng loại động vật.
abstract class Animal{
    abstract public function makeSound();
}
class Dog extends Animal{
    public function makeSound(){
        return "Gow gow";
    }
}
class Cat extends Animal{
    public function makeSound(){
        return "Meow meow";
    }
}
echo "<br><br> Bài 2: <br>";
$dog = new Dog();
$cat = new Cat();
echo "Sound Dog: " . $dog->makeSound();
echo "<br>";
echo "Sound Dog: " . $cat->makeSound();
// Tạo một abstract class "Employee" (Nhân viên) với các thuộc tính trừu tượng như "name" (tên) và "salary" (mức lương). 
// Tạo các lớp con "Manager" (Quản lý) và "Staff" (Nhân viên) kế thừa từ lớp Employee và triển khai các thuộc tính và phương thức theo cách riêng của từng lớp.
abstract class Employee{
    protected $name, $salary;
}
class Manager extends Employee{
    protected $name, $salary, $day, $bonus;
    public function __construct($name, $salary, $day, $bonus){
        $this->name = $name;
        $this->salary = $salary;
        $this->day = $day;
        $this->bonus = $bonus;
    }
    public function calcSalary(){
        return $this->salary*$this->day + $this->bonus;
    }
}
class Staff extends Employee{
    protected $name, $salary, $day, $coefficients;
    public function __construct($name, $salary, $day, $coefficients){
        $this->name = $name;
        $this->salary = $salary;
        $this->day = $day;
        $this->coefficients = $coefficients;
    }
    public function calcSalary(){
        return $this->salary*$this->day*$this->coefficients;
    }
}
echo "<br><br> Bài 3: <br>";
$manager = new Manager("Huyen My", 10000, 30, 5000);
$staff = new Staff("Huyen My", 2000, 30, 2);
echo "Manager Salary: " . number_format($manager->calcSalary());
echo "<br>";
echo "Staff Salary: " . number_format($staff->calcSalary());
// Tạo một abstract class "Vehicle" (Phương tiện) với một phương thức trừu tượng là "start". 
// Tạo các lớp con "Car" (Xe hơi) và "Motorcycle" (Xe máy) kế thừa từ lớp Vehicle và triển khai phương thức start theo cách riêng của từng loại phương tiện.
abstract class Vehicle{
    abstract public function start();
}
class Car extends Vehicle{
    protected $brand, $year;
    public  function __construct($brand, $year){
        $this->brand = $brand;
        $this->year = $year;
    }
    public function start(){
        return [$this->brand, $this->year];
    }
}
class Motorcycle extends Vehicle{
    protected $brand, $owner;
    public  function __construct($brand, $owner){
        $this->brand = $brand;
        $this->owner = $owner;
    }
    public function start(){
        return [$this->brand, $this->owner];
    }
}
echo "<br><br> Bài 4: <br>";
$car = new Car("Toyota", 2021);
$motor = new Motorcycle("Yamaha", "Huyen My");
echo "Car<br>";
echo "Brand is: " . $car->start()[0] . "<br>";
echo "Year of manufacture: " . $car->start()[1];
echo "<br>";
echo "Motor<br>";
echo "Brand is: " . $motor->start()[0] . "<br>";
echo "Owner is: " . $motor->start()[1];
// Tạo một abstract class "Database" (Cơ sở dữ liệu) với các phương thức trừu tượng như "connect", "query" và "disconnect". 
// Tạo các lớp con "MySQLDatabase" và "PostgreSQLDatabase" kế thừa từ lớp Database và triển khai các phương thức theo cách riêng của từng loại cơ sở dữ liệu.
abstract class Database{
    abstract public function connect();
    abstract public function query($sql);
    abstract public function disconnect();
}
class MySQLDatabase extends Database{
    protected 
    $conn,
    $dbtype,
    $dbhost,
    $dbname,
    $username,
    $password;
    public function __construct($dbtype,$dbhost,$dbname,$username, $password){
        $this->dbtype = $dbtype;
        $this->dbhost = $dbhost;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }
    public function connect(){
        $this->conn = new PDO($this->dbtype.':host='.$this->dbhost.';dbname='.$this->dbname,$this->username, $this->password);
        if($this->conn){
            echo "Successfully connected";
        }
        else {
            echo "Failed to connect";
        }
    }
    public function query($sql){
        global $conn;
        $SQL = $this->conn->prepare($sql);
        $SQL->execute();
        return $SQL->fetchAll();
    }
    public function disconnect(){
        $this->conn = null;
    }
}
class PostgreSQLDatabase extends Database{
    protected $sql;
    public function connect(){
        return "Connect to PostgreSQL database.";
    }
    public function query($sql){
        echo "Execute: $sql";
    }
    public function disconnect(){
        return "Disconnect from PostgreSQL database.";
    }
}
echo "<br><br> Bài 5: <br>";
echo "MySQLDatabase: ";
$mySQL = new MySQLDatabase('mysql','localhost','test','root','');
$mySQL->connect();
echo "<br>Category List: <br>";
$result = $mySQL->query('SELECT * FROM category');
?>
    <table style = "border: 1px solid; margin: 10px">
        <tbody>
            <tr>
                <th style = "border: 1px solid; padding: 5px">ID</th>
                <th style = "border: 1px solid; padding: 5px">Name</th>
            </tr>
            <?php foreach ($result as $value){ ?>
                <tr>
                    <td style = "border: 1px solid; padding: 5px"> <?=$value['id']?></td>
                    <td style = "border: 1px solid; padding: 5px"> <?=$value['name']?></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
<?php
$mySQL->disconnect();
echo "<br>PostgreSQLDatabase<br>";
$postgre = new PostgreSQLDatabase();
echo $postgre->connect();
echo "<br>";
$postgre->query('SELECT * FROM category');
echo "<br>";
echo $postgre->disconnect();

?>