<?php
// Tạo một interface "Resizable" (Có thể điều chỉnh kích thước) với một phương thức là "resize". 
// Tạo một lớp "Rectangle" (Hình chữ nhật) và triển khai interface Resizable để thay đổi kích thước của hình chữ nhật.
interface Resizable{
    public function resize($number);
}
class Rectangle implements Resizable{
    protected $width, $height;
    public function __construct($width, $height){
        $this->width = $width;
        $this->height = $height;
    }
    public function resize($number){
        return [$number, $this->width*$number, $this->height*$number];
    }
    public function width(){
        return $this->width;
    }
    public function height(){
        return $this->height;
    }
}
echo "Bài 1: <br>";
$rec = new Rectangle(2,3);
$rec->resize(2);
echo "Original Width: " . $rec->width() . "<br>";
echo "Original Height: " . $rec->height() . "<br>";
echo "Increase: " . $rec->resize(2)[0] . "<br>";
echo "New Width: " . $rec->resize(2)[1] . "<br>";
echo "New Height: " . $rec->resize(2)[2] . "<br>";

// Tạo một interface "Logger" với các phương thức "logInfo", "logWarning" và "logError". 
// Tạo một lớp "FileLogger" (Ghi log vào file) và một lớp "DatabaseLogger" (Ghi log vào cơ sở dữ liệu) và triển khai interface Logger cho cả hai lớp.
interface Logger{
    public function logInfo($message);
    public function logWarning($message);
    public function logError($message);
}
class FileLogger implements Logger {
    private $logFile;

    public function __construct($logFile) {
        $this->logFile = $logFile;
    }

    public function logInfo($message) {
        $this->writeToFile('INFO', $message);
    }

    public function logWarning($message) {
        $this->writeToFile('WARNING', $message);
    }

    public function logError($message) {
        $this->writeToFile('ERROR', $message);
    }

    private function writeToFile($level, $message) {
        $log = date('[Y-m-d H:i:s]') . " [$level] $message" . PHP_EOL;
        file_put_contents($this->logFile, $log, FILE_APPEND);
    }
}
// Triển khai lớp "DatabaseLogger" kế thừa từ interface "Logger"
class DatabaseLogger implements Logger {
    private $dbConnection;
    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }
    public function logInfo($message) {
        $this->writeLogToDatabase('INFO', $message);
    }
    public function logWarning($message) {
        $this->writeLogToDatabase('WARNING', $message);
    }
    public function logError($message) {
        $this->writeLogToDatabase('ERROR', $message);
    }
    private function writeLogToDatabase($level, $message) {
        $create = date('Y-m-d H:i:s');
        $query = "INSERT INTO filelog (level, message, created) VALUES (?, ?, ?)";
        $statement = $this->dbConnection->prepare($query);
        $statement->execute([$level, $message, $create]);
    }
}
echo "<br><br>Bài 2:<br> Tạo log vào file và database";
$file = new FileLogger('FileLog.txt');
$file->logInfo("Message info test");
$file->logWarning("Message warning test");
$file->logError("Message error test");

$dbConnection = new PDO("mysql:host=localhost;dbname=test", "root", "");
$databaseLogger = new DatabaseLogger($dbConnection);
$databaseLogger->logInfo("Message info test");
$databaseLogger->logWarning("Message warning test");
$databaseLogger->logError("Message error test");

// Tạo một interface "Drawable" (Có thể vẽ) với phương thức "draw". 
// Tạo một lớp "Circle" (Hình tròn) và một lớp "Square" (Hình vuông) kế thừa từ interface Drawable và triển khai phương thức draw cho mỗi hình.
interface Drawable{
    public function draw($length,$color);
}
class Circle implements Drawable{
    protected $radius, $color; 
    public function draw($radius, $color){ ?>
        <div
        style="height: <?= $radius*2?>px;
        width: <?= $radius*2?>px;
        background-color: <?= $color?>;
        border-radius: <?= $radius ?>px;
        margin: 20px;">
        </div>
    <?php 
    }
}
class Square implements Drawable{
    protected $radius, $color; 
    public function draw($length, $color){ ?>
        <div
        style="height: <?= $length?>px;
        width: <?= $length?>px;
        background-color: <?= $color?>;
        margin: 20px;">
        </div>
    <?php 
    }
}
echo "<br><br>Bài 3: <br>";
echo "<br>Circle:";
$circle = new Circle();
$circle->draw(50,'#22A5E8');
echo "<br>Square:";
$square = new Square();
$square->draw(100,'#22A5E8');

// Tạo một interface "Sortable" với phương thức "sort". Tạo một lớp "ArraySorter" (Sắp xếp mảng) và 
// một lớp "LinkedListSorter" (Sắp xếp danh sách liên kết) và triển khai interface Sortable cho cả hai lớp.
interface Sortable{
    public function sort($param);
}
class ArraySorter implements Sortable{
    protected $arr;
    public function __construct(){
        $this->arr = [];
    }
    public function insertElement($element){
        $this->arr[] = $element;
    }
    public function showArray(){
        return $this->arr;
    }
    public function sort($arr){
        $count = count($this->arr);
        for($i=0; $i<$count; $i++)
            for($j=$i+1; $j<$count; $j++)
                if($this->arr[$i]>$this->arr[$j]){
                    $temp = $this->arr[$i];
                    $this->arr[$i] = $this->arr[$j];
                    $this->arr[$j] = $temp;
            }
    return $this->arr;
    }
}
class LinkedListSorter {
    public function sort($message){
        return $message;
    }
}
echo "<br><br>Bài 4: <br>";
$arr = new ArraySorter();
$arr->insertElement(7);
$arr->insertElement(4);
$arr->insertElement(9);
$arr->insertElement(5);
echo "Orginal Array: ";
$arrs = $arr->showArray();
foreach($arrs as $value)
    echo $value . " ";
echo "<br> Array in ascending order: ";
$arrSort = $arr->sort($arr);
foreach($arrSort as $value)
        echo $value . " ";
$linkedList = new LinkedListSorter();
echo "<br>Result sort linked list: " . $linkedList->sort('Pass');

// Tạo một interface "Encryptable" (Có thể mã hóa) với phương thức "encrypt" và "decrypt". 
// Tạo một lớp "AES" và một lớp "DES" kế thừa từ interface Encryptable và triển khai các 
// phương thức theo thuật toán mã hóa tương ứng.
interface Encryptable{
    public function encrypt($message);
    public function decrypt($message);
}
class AES implements Encryptable {
    public function encrypt($message) {
        $encryptedMessage = "AES encrypted: " . $message;
        return $encryptedMessage;
    }
    public function decrypt($message) {
        $decryptedMessage = "AES encrypted: " . $message;
        return $decryptedMessage;
    }
}
class DES implements Encryptable {
    public function encrypt($message) {
        $encryptedMessage = "DES encrypted: " . $message;
        return $encryptedMessage;
    }
    public function decrypt($message) {
        $decryptedMessage = "DES encrypted: ". $message;
        return $decryptedMessage;
    }
}
echo "<br><br>Bài 5: <br>";
$message = "Pass";
$aesEncryptor = new AES();
echo "AES:<br>";
echo "Encrypted: " . $aesEncryptor->encrypt($message) . "<br>";
echo "Decrypted: " . $aesEncryptor->decrypt($message) . "<br>";
$desEncryptor = new DES();
echo "DES:<br>";
echo "Encrypted: " . $desEncryptor->encrypt($message) . "<br>";
echo "Decrypted: " . $desEncryptor->decrypt($message) . "<br>";

 ?>