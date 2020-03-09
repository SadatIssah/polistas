<?php

//include_once('../lib/database.php');
include_once (dirname(__FILE__).'../../lib/database.php');
include_once (dirname(__FILE__).'../../helper/format.php');

?>



<?php

class Category{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    /**
     * add category item
     *
     * @param [text] $catName
     * @return void
     */
    public function addCat($catName){

        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link,$catName);
        if(empty($catName)){
            $catmsg = "Must Not be Empty";
            return $catmsg;
        }else{

            $query = "INSERT INTO shop_category(catName) VALUES('$catName')";
            $catInsert = $this->db->insert($query);

            if($catInsert){
                $catmsg = "<span style='color:green; font:18px;'>Added Successfully</span>";
                return $catmsg ;
            }else{
                $catmsg ="<span style='color:red; font:18px;'>Not Inserted</span>";
                return $catmsg;}
         }
    }

    /**
     * get all category items from database
     */

    public function catDisplay(){
        $query = "SELECT * FROM shop_category";
        $result = $this->db->select($query);

        return $result;
    }


    /**
     * get category by id
     *
     * @param [int] $cat_id
     * @return void
     */
    public function getCatbyId($cat_id){
        $query = "SELECT * FROM shop_category WHERE catID = '$cat_id'";
        $result = $this->db->select($query);

        return $result;
    }

    /**
     * update category item
     *
     * @param [int] $cat_id
     * @param [text] $catName
     * @return void
     */
    public function updateCat($cat_id, $catName){

        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link,$catName);
        if(empty($catName)){
            $catmsg = "Must Not be Empty";
            return $catmsg;
        }else{

            $query = "UPDATE shop_category SET catName='$catName' WHERE catID='$cat_id'";
            $catInsert = $this->db->update($query);

            if($catInsert){
                $catmsg = "<span style='color:green; font:18px;'>Updated Successfully</span>";
                return $catmsg ;
            }else{
                $catmsg ="<span style='color:red; font:18px;'>Not Updated</span>";
                return $catmsg;}
         }
    }


    public function deletbyID($id){
        $query = "DELETE FROM shop_category WHERE catID='$id'";
        $result = $this->db->delete($query);

        if($result){
        $catmsg = "<span style='color:green; font:18px;'>Deleted Successfully</span>";
        return $catmsg ;
            }else{
                $catmsg ="<span style='color:red; font:18px;'>Not Deleted</span>";
                return $catmsg;}
     }





}

?>