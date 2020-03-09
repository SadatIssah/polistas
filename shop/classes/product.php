<?php
include_once (dirname(__FILE__).'../../lib/database.php');
include_once (dirname(__FILE__).'../../helper/format.php');
?>



<?php

class Product{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    /**
     * add product with image link to database
     *
     * @param [data] $data
     * @param [file] $file
     * @return void
     */
    public function addproduct($data, $file){
        $product_name = mysqli_real_escape_string($this->db->link,$data['product_name']);
        $catID = mysqli_real_escape_string($this->db->link,$data['catID']);
        $brandID = mysqli_real_escape_string($this->db->link,$data['brandID']);
        $descr = mysqli_real_escape_string($this->db->link,$data['descr']);
        $price = mysqli_real_escape_string($this->db->link,$data['price']);
        $type = mysqli_real_escape_string($this->db->link,$data['typ']);



        $permited = array('jpg','png','jpeg','gif');
        $file_name = $file['img']['name'];
        $file_size = $file['img']['size'];
        $file_temp = $file['img']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "../upload/".$unique_image;
        $image_name = "upload/".$unique_image;




        if ($product_name == "" || $catID == "" || $brandID == "" || $descr == "" || $price == "" || $type == "" ) {
            $msg = "<span class='error'>Field Must Not be empty .</span> ";
                   return $msg;
        }else{

            if (!empty($file_name)) {
            if ($file_size > 1054589) {
            echo "<span class='error'>Image Size should be less then 1MB .</span>";
            }elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'> You can Upload Only".implode(',', $permited)."</span>";
            } else{

             move_uploaded_file($file_temp, $uploaded_image);
             $query = "INSERT INTO shop_product(product_name,catID,brandID,descr,price,img,typ) VALUES('$product_name','$catID','$brandID','$descr','$price','$image_name','$type')";
             $insert = $this->db->insert($query);
             if($insert){
                $msg = "<span style='color:green; font:18px;'>Added Successfully</span>";
                return $msg ;
            }else{
                $msg ="<span style='color:red; font:18px;'>Not Inserted</span>";
                return $msg;}
             }
            }
        }
    }


    /**
     * get all products from database
     */

    public function productDisplay(){
        $query = "SELECT shop_product.*, shop_category.catName, shop_brand.brand_name
        FROM shop_product
        INNER JOIN shop_category
        ON shop_product.catID = shop_category.catID
        INNER JOIN shop_brand
        ON shop_product.brandID = shop_brand.brandID";
        $result = $this->db->select($query);
        return $result;
    }


    public function getProductbyID($product_id){
        $query = "SELECT * FROM shop_product WHERE productID = '$product_id'";
        $result = $this->db->select($query);
        return $result;

    }


    /**
     * function to update product product
     *
     * @param [data] $data
     * @param [file] $file
     * @param [id] $id
     * @return void
     */
    public function updateproduct($data, $file, $id){

        $productName     =  mysqli_real_escape_string($this->db->link, $data['product_name'] );
        $catId 	     =  mysqli_real_escape_string($this->db->link, $data['catID'] );
        $brandId 	     =  mysqli_real_escape_string($this->db->link, $data['brandID'] );
        $body 	     =  mysqli_real_escape_string($this->db->link, $data['descr'] );
        $price  	     =  mysqli_real_escape_string($this->db->link, $data['price'] );
        $type 	     =  mysqli_real_escape_string($this->db->link, $data['typ'] );

         $permited = array('jpg','png','jpeg','gif');
         $file_name = $file['img']['name'];
         $file_size = $file['img']['size'];
         $file_temp = $file['img']['tmp_name'];

         $div = explode('.', $file_name);
         $file_ext = strtolower(end($div));
         $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
         $uploaded_image = "../upload/".$unique_image;
         $image_name = "upload/".$unique_image;
         if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" ) {
             $msg = "<span class='error'>Field Must Not be empty .</span> ";
                    return $msg;
         }else {

         if (!empty($file_name)) {
         if ($file_size > 1054589) {
             echo "<span class='error'>Image Size should be less then 1MB .</span>";
         }elseif (in_array($file_ext, $permited) === false) {
             echo "<span class='error'> You can Upload Only".implode(',', $permited)."</span>";
          } else{
              move_uploaded_file($file_temp, $uploaded_image);
              $query = "UPDATE shop_product
              SET
              product_name 	= '$productName',
              catID 		= '$catId',
              brandID 		= '$brandId',
              descr 		= '$body',
              price 		= '$price',
              img 		    = '$image_name',
              typ 			= '$type'
              WHERE productID = '$id' ";

              $updated_row = $this->db->update($query);
              if ($updated_row) {
                    $msg = "<span style='color:green; font:18px;'>Updated Successfully</span>";
                    return $msg;
                }else {
                    $msg = "<span style='color:red; font:18px;'>Product Not Updated .</span> ";
                    return $msg;
                }
         }

          } else{
               $query = "UPDATE shop_product
              SET
              product_name 	= '$productName',
              catID 		= '$catId',
              brandID 		= '$brandId',
              descr 			= '$body',
              price 		= '$price',
              typ			= '$type'
              WHERE productID = '$id' ";

              $updated_row = $this->db->update($query);
              if ($updated_row) {
                    $msg = "<span style='color:green; font:18px;'>Updated Successfully.</span> ";
                    return $msg;
                }else {
                    $msg = "<span style='color:red; font:18px;'>Product Not Updated .</span> ";
                    return $msg;
                }

                 }
            }

         }


    /**
     * delete a product from admin dashboard
     *
     * @param [int] $cdelete
     * @return void
     */
    public function deletbyID($cdelete){
        $query = "SELECT * FROM shop_product WHERE productID = '$cdelete' ";
        $getinfo = $this->db->select($query);
            if ($getinfo) {
                while ($delImg = $getinfo->fetch_assoc()) {
                $dellink = $delImg['img'];
                     unlink($dellink);
                   }
               }

                $deletequery = "DELETE FROM shop_product WHERE productID = '$cdelete' ";
                   $deletedata = $this->db->delete($deletequery);
                 if ($deletedata) {
                     $msg = "<span class='success'>Product Deleted Successfully.</span> ";
                 return $msg;
                 }else {
                     $msg = "<span class='error'>Product Not Deleted .</span> ";
                        return $msg;
                     }
    }


    /**
     * display featured products from database
     *
     * @return void
     */
    public function displayFeaturedProducts(){
        $query = "SELECT * FROM shop_product WHERE typ='0' ORDER BY productId DESC LIMIT 6 ";
        $result = $this->db->select($query);
        return $result;
    }


    /**
     * display new products in home
     *
     * @return void
     */
    public function displayNewProducts(){
        $query = "SELECT * FROM shop_product ORDER BY productID DESC LIMIT 4 ";
            $result = $this->db->select($query);
            return $result;
    }

    /**
     * Undocumented function
     *
     * @param [int] $product_id
     * @return void
     */
    public function displaySingleProduct($product_id){

        $query = "SELECT shop_product.*, shop_category.catName, shop_brand.brand_name
        FROM shop_product
        INNER JOIN shop_category
        ON shop_product.catID = shop_category.catID
        INNER JOIN shop_brand
        ON shop_product.brandID = shop_brand.brandID
        AND shop_product.productID = $product_id
        ORDER BY shop_product.productID DESC";
        $result =  $this->db->select($query);
        return $result;
    }


    public function searchProduct($search){
        $query = "SELECT * FROM shop_product WHERE product_name LIKE '%$search%' OR descr LIKE '%$search%' ";
        $result = $this->db->select($query);
        return $result;

       }



       public function displayAllProducts(){
        $query = "SELECT * FROM shop_product LIMIT 20 ";
        $result = $this->db->select($query);
        return $result;
    }







}


?>