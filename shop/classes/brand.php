<?php

include_once (dirname(__FILE__).'../../lib/database.php');
include_once (dirname(__FILE__).'../../helper/format.php');
?>



<?php

class Brand{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    /**
     * add Brand item
     *
     * @param [text] $brandName
     * @return void
     */
    public function addBrabd($brandName){

        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link,$brandName);
        if(empty($brandName)){
            $msg = "Must Not be Empty";
            return $msg;
        }else{

            $query = "INSERT INTO shop_brand(brand_name) VALUES('$brandName')";
            $insert = $this->db->insert($query);

            if($insert){
                $msg = "<span style='color:green; font:18px;'>Added Successfully</span>";
                return $msg ;
            }else{
                $msg ="<span style='color:red; font:18px;'>Not Inserted</span>";
                return $msg;}
         }
    }

    /**
     * get all brand items from database
     */

    public function brandDisplay(){
        $query = "SELECT * FROM shop_brand";
        $result = $this->db->select($query);
        return $result;
    }


    /**
     * get brand by id
     *
     * @param [int] $brand_id
     * @return void
     */
    public function getBrandbyId($brand_id){
        $query = "SELECT * FROM shop_brand WHERE brandID = '$brand_id'";
        $result = $this->db->select($query);

        return $result;
    }

    /**
     * update brand item
     *
     * @param [int] $brand_id
     * @param [text] $brandName
     * @return void
     */
    public function updateBrand($brand_id, $brandName){

        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link,$brandName);
        if(empty($brandName)){
            $msg = "Must Not be Empty";
            return $msg;
        }else{

            $query = "UPDATE shop_brand SET brand_name='$brandName' WHERE brandID='$brand_id'";
            $insert = $this->db->update($query);

            if($insert){
                $msg = "<span style='color:green; font:18px;'>Updated Successfully</span>";
                return $msg ;
            }else{
                $catmsg ="<span style='color:red; font:18px;'>Not Updated</span>";
                return $msg;}
         }
    }


    public function deletbyID($id){
        $query = "DELETE FROM shop_brand WHERE brandID='$id'";
        $result = $this->db->delete($query);

        if($result){
        $msg = "<span style='color:green; font:18px;'>Deleted Successfully</span>";
        return $msg ;
            }else{
                $msg ="<span style='color:red; font:18px;'>Not Deleted</span>";
                return $msg;}
     }



}

?>