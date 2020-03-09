<?php //include('../config/config.php'); ?>
<?php require (dirname(__FILE__).'../config/config.php');?>


<?php
 class Database {

public $host = DB_HOST;
public $user = DB_USER;
public $pass = DB_PASS;
public $dbname = DB_NAME;

 public $link;
 public $error;


   public function __construct(){
   	$this->connectDB();
   }




 private function connectDB(){

   $this->link = new mysqli($this->host,$this->user, $this->pass, $this->dbname);

    if(!$this->link) {

     $this->error ="connection fail".$this->link->connect_error;
       return false;
    }
 }

  /**
   * function to accept sql select statement
   *
   * @param [type] $query
   * @return void
   */
  public function select ($query){
    $result = $this->link->query($query) or die ($this->link->error.__LINE__);
    if($result->num_rows > 0){
    	return $result;
    	    } else {

    	    	return false;
    	    }

     }


  /**
   * function to accept sql insert statement
   *
   * @param [type] $query
   * @return void
   */
  public function insert($query){
      $insert_row = $this->link->query($query) or die ($this->link->error.__LINE__);
      if($insert_row){
        return $insert_row;
        exit();
          } else {

            return false;

          }

   }

   /**
    * function to accpet update query
    *
    * @param [type] $query
    * @return void
    */
   public function update($query){
   $update_row = $this->link->query($query) or die ($this->link->error.__LINE__);
   if($update_row){
    return $update_row;
    exit();
   	   } else {

        return false;
   	   }

   }


   /**
    * function to accept delete sql query
    *
    * @param [sql query] $query
    * @return void
    */
   public function delete($query){
   $delete_row = $this->link->query($query) or die ($this->link->error.__LINE__);
   if($delete_row){
    return $delete_row;
       	exit();
   	   } else {

        return false;
   	   }

   }





 }


?>