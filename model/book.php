<?php 
class Book {
    #properties
    var $id;
    var $price;
    var $title;
    var $author;
    var $year;
    #endProperties
    #Construct function
    function __construct ($id, $title, $price, $author, $year) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
        $this->year = $year;
    }
    #Member function
    function display() {
        echo "Price: " . $this->title . "<br>";
        echo "Title: " . $this->price . "<br>";
        echo "Author: " . $this->author . "<br>";
        echo "Year: " . $this->year . "<br>";
    }
    static function getList() {
        $listBook = array();
        array_push($listBook, new Book(1,5, "Java", "nghiaJava", 2019)); //Thêm 1 phần tử vào mảng
        array_push($listBook, new Book(2,6, "OOP", "nghiaOOP", 2018));
        array_push($listBook, new Book(3,7, "Ruby", "nghiaRuby", 2017));
        array_push($listBook, new Book(4,8, "Rails", "nghiaRails", 2016));
        array_push($listBook, new Book(5,9, "Tomcat", "nghiaTomcat", 2015));
        return $listBook;
    }
    static function getListFromFile(){
  
        $arrData = file("data/book.txt", FILE_SKIP_EMPTY_LINES);
        $lsBook = array();
        foreach ($arrData as $key => $value) {
            $arrItem = explode("#", $value);
            if (count($arrItem) == 5) {
                $book = new Book($arrItem[0], $arrItem[1], $arrItem[2], $arrItem[3], $arrItem[4]);
                array_push($lsBook, $book);
            }
        };
        return $lsBook;
    }
    static function getListCuaQuy($search = null)
    {
        $data = file("data/book.txt");
        $arrBook = [];
        foreach ($data as $key => $value) {
            $row = explode("#", $value);
            if (
                strlen(strstr($row[0], $search)) || strlen(strstr($row[3], $search)) ||
                strlen(strstr($row[1], $search)) || strlen(strstr($row[4], $search)) ||
                strlen(strstr($row[2], $search)) || $search == null
            )
                $arrBook[] = new Book($row[0], $row[2], $row[1], $row[3], $row[4]);
        }
        return $arrBook;
    }
    static function addToFile($content){
        
        $myfile = fopen("data/book.txt", "a") or die("Unable to open file!");
        if(Book::checkLineFeedLastText())
            fwrite($myfile, "". $content);
        else
            fwrite($myfile, "\n". $content);
        fclose($myfile);
    }
    static function delete($id){
        $data = Book::getListFromFile();
        $data_res = [];
        foreach($data as $key => $value){
            if($value->id != $id){
                $data_res[] = $value;
            }
        }    
        $text_write = "";
        $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
        foreach($data_res as $key => $value){
            $text_write.= $value->id."#".$value->price."#".$value->title."#".$value->author."#".$value->year;            
        }
      
        fwrite($myfile, $text_write);
        fclose($myfile);
    }
    static function edit(Book $content){
        $data = Book::getListFromFile();
        $text_write = "";
        $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
        foreach($data as $key => $value){          
            if( $content->id == $value->id){
                $text_write.= $content->id."#".$content->price."#".$content->title."#".$content->author."#".$content->year."\n";
            }  
            else $text_write.= $value->id."#".$value->price."#".$value->title."#".$value->author."#".$value->year;
        }       
        fwrite($myfile, $text_write);
        fclose($myfile);
    }
    static function getSTT(){
        $max = 0;
        $data = Book::getListFromFile();
        foreach($data as $key => $value){
            $max =  max($value->id,$max);
        }  
        return $max+1;
    }
    static function checkLineFeedLastText(){
        $data="data/book.txt";
        $linecount = 0;
        $handle = fopen($data, "r");
        while(!feof($handle)){
            $line = fgets($handle);
            $linecount++;
        }      
        fclose($handle); 
        $count = sizeof(Book::getListFromFile());
        if($linecount > $count) return true;
        return false;
    }

    static function connect(){
        $con = new mysqli("localhost","root","","bookmanager");
        $con->set_charset("utf8");
        if ($con->connect_error)
            die("Kết nối thất bại. Chi tiết". $con->connect_error);
        return $con;
    }
    static function getListFromDB(){
        //Bước 1: Tạo  kết nối
        $con = Book::connect();
        //echo "<h1>Kết nối thành công</h1>";
        //Bước 2: Thao tác với cơ sở dữ liệu: CRUD
        $sql = "SELECT * FROM `book`";
        $result = $con->query($sql);
        $lsBook = array();
        if ($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $book = new Book($row["ID"], $row["Title"], $row["Price"], $row["Author"], $row["Year"]);
                array_push($lsBook, $book);
            }
        }
        //Bước 3: Đóng kết nối
        $con->close();
        return $lsBook;
    }
}