<?php

include_once (dirname(__FILE__).'../../lib/database.php');
include_once (dirname(__FILE__).'../../helper/format.php');
?>



<?php

class ShopCart{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    /**
     * add to cart
     *
     * @param [int] $qty
     * @param [int] $product_id
     * @return void
     */
    public function cartadd($qty, $product_id){

        $session_id = session_id();
        $squery = "SELECT * FROM shop_product WHERE productID = '$product_id'";
        $result = $this->db->select($squery);
        $result2 = $result->fetch_assoc();

        $product_name = $result2['product_name'];
        $price = $result2['price'];
        $image = $result2['img'];

        $query2 = "SELECT * FROM shop_cart WHERE productID = '$product_id' AND sessionID ='$session_id'";
        $ifexist = $this->db->select($query2);
        if($ifexist) {
            $msg =  "<span style='color: red; font-size: 18px;'>In Cart Already!</span>";
            return $msg;
        }else {
              $query = "INSERT INTO shop_cart(sessionID, productID, product_name, price, qty, img)
              VALUES ('$session_id','$product_id','$product_name','$price','$qty','$image')";
              $inserted_row = $this->db->insert($query);
              if ($inserted_row) {
                     header("Location:cart.php");
                }else {
                    header("Location:404.php");
                }
            }
    }

    /**
     * update cart quantity function
     *
     * @param [id] $cart_ID
     * @param [int] $quant
     * @return void
     */
    public function cartquantupdat($cart_ID, $quant){
        $query = "UPDATE shop_cart
                   SET
                   qty = '$quant'
                   WHERE cartID = '$cart_ID' ";
                   $update  = $this->db->update($query);
                   if ($update) {
                        header("Location:cart.php");
                   }else {
                       $msg = "<span style='color: red; font-size: 18px;'>Not updated</span>";
                       return $msg;
                   }
            }

    /**
     * display cart data
     *
     * @return void
     */
    public function displayCartData(){
        $sessionId = session_id();
        $query = "SELECT * FROM shop_cart WHERE sessionID ='$sessionId' ";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteCartItem($id){
        $deletequery = "DELETE FROM shop_cart WHERE cartID = '$id' ";
        $deletedata = $this->db->delete($deletequery);
        if ($deletedata) {
            $msg = "<span style='color: green; font-size: 18px;'>Delete Success</span>";
        return $msg;

        }else {
            $msg = "<span style='color: red; font-size: 18px;'>Product Not Deleted .</span> ";
                return $msg;
            }
    }

    /**
     * display products by category
     *
     * @param [int] $cart_id
     * @return void
     */
    public function displayProductstByCat($cart_id){
        $query = "SELECT * FROM shop_product WHERE catID ='$cart_id' ";
        $result = $this->db->select($query);
        return $result;
    }



    public function deleteCustomerCartDetails() {
        $sId = session_id();
        $query = "DELETE FROM shop_cart WHERE sessionID ='$sId'";
        $this->db->delete($query);
        }


    public function add_order($customer_Id){
        $sId = session_id();
        $query = "SELECT * FROM shop_cart WHERE sessionID ='$sId' ";
        $getProduct = $this->db->select($query);
            if ($getProduct) {
            while ($result = $getProduct->fetch_assoc()) {
            $productId     = $result['productID'];
            $productName   = $result['product_name'];
            $quantity      = $result['qty'];
            $price         = $result['price'];
            $image         = $result['img'];

            $query = "INSERT INTO shop_orders(userID, productID, product_name, qty, price, img)
                VALUES ('$customer_Id','$productId','$productName','$quantity','$price','$image')";

            $inserted_row = $this->db->insert($query);
        }
    }

    }



    public function customer_order_details($Id){
        $query = "SELECT * FROM shop_orders WHERE userID ='$Id' ORDER BY productID DESC ";
        $result = $this->db->select($query);
        return $result;
        }


    public function checkOrder($userId){
        $query = "SELECT * FROM shop_orders WHERE userID ='$userId' ";
        $result = $this->db->select($query);
        return $result;
    }



    public function getAllOrderProduct(){
        $query = "SELECT * FROM shop_orderS ORDER BY time ";
        $result = $this->db->select($query);
        return $result;
    }



    public function shipProduct($id,$time,$price){

        $id =  mysqli_real_escape_string($this->db->link, $id );
        $date =  mysqli_real_escape_string($this->db->link, $time );
        $price =  mysqli_real_escape_string($this->db->link, $price );
        $query = "UPDATE shop_orders
                      SET
                      status = '1'
                      WHERE userID = '$id' AND time='$date' AND price='$price'";
        $this->db->update($query);

    }


    public function deleteShippedProduct($id,$time,$price){
        $id =  mysqli_real_escape_string($this->db->link, $id );
        $date =  mysqli_real_escape_string($this->db->link, $time );
        $price =  mysqli_real_escape_string($this->db->link, $price );
        $query = "DELETE FROM shop_orders WHERE userID = '$id' AND time='$date' AND price='$price'";
        $this->db->delete($query);

    }



    public function processPayment($customer_Id,$total_amount, $vendor){

        $query = "SELECT * FROM shop_users WHERE userID ='$customer_Id' ";
        $getProduct = $this->db->select($query);
            if ($getProduct) {
            $result = $getProduct->fetch_assoc();
            $number = $result['phone'];
             }

        //API URL
        $url = "https://pay.npontu.com/api/pay";

        //create a new cURL resource
        $ch = curl_init();

        //randomly generated transactionID
        $transaID = rand(8, 12);


        //setup request to send json via POST
        if($vendor == 'Vodafone'){
        $data = array(
            'number' => $number,
            'vendor' => $vendor,
            'uid'    => 'polista',
            'pass'   => 'polistapass',
            'tp'     => $transaID,
            'cbk'    => '154.160.23.145',
            'amt'    => $total_amount,
            'msg'    => 'Payment to Polista for purchase made',
            'vou'   =>'422572322',
            'trans_type'=>'debit'

        );}

        else{
            $data = array(
                'number' => $number,
                'vendor' => $vendor,
                'uid'    => 'polista',
                'pass'   => 'polistapass',
                'tp'     => $transaID,
                'cbk'    => '',
                'amt'    => $total_amount,
                'msg'    => 'Payment to Polista for purchase made',
                'trans_type'=>'debit'
            );
        }

        $payload = json_encode($data);
        curl_setopt($ch, CURLOPT_URL,$url);

        //attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        //set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        //return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute the POST request
        $result = curl_exec($ch);
        //return $result;
        //close cURL resource
        curl_close($ch);
    }




}
?>