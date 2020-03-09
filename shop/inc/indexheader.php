<?php
	include (dirname(__FILE__).'/../lib/session.php');

    Session::init();
    include (dirname(__FILE__).'/../lib/database.php');
	include (dirname(__FILE__).'/../helper/format.php');

      spl_autoload_register(function($class){
       include_once "classes/".$class.".php";
      });

      $db = new Database();
      $fm = new Format();
      $product = new Product();
      $cart = new shopCart();
	 ?>
     <?php
           if (isset($_GET['sid'])) {
			   Session::destroy1();
			   $delDate = $cart->deleteCustomerCartDetails();
		   }
    ?>
	<?php ?>


<!DOCTYPE php>
<head>
<title>Polista Stores</title>
<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/poli_logo.jpg" style="width: 200px; height:80px" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				<form action="pages/search.php" method="get">
						<input type="text" placeholder="Search for Products" name="search">
						<input type="submit" value="SEARCH">
				    </form>
				</div>
  				<div>
				<div class="cart1"><a href="pages/cart.php"><img src="images/orange-shopping-cart-md.png" style="width: 120px; height:35px" alt="" /></a></div>
				</div>
				<div class="login"><?php $login =  Session::get("userlogin");
									if ($login == false) { ?>
									<a href="pages/login.php"><img src="images/login1.png" style="width: 120px; height:35px" alt="" /></a>
									<?php   }else { ?>
									<a href="?sid=<?php Session::get('userID')?>"><img src="images/logout.png" style="width: 120px; height:35px" alt="" /></a>
									<?php } ?>
								</div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="pages/products.php">Products</a> </li>
	  <?Php
	  	 $cartcheck =  $cart->displayCartData();
		  if($cartcheck){ ?>
			<li><a href="pages/cart.php">Cart</a></li>
			<li><a href="pages/payment.php">Payment</a></li>
	  <?php }?>

	  <?Php
		  $login =  Session::get("userlogin");
		  if($login == true){ ?>
			<li><a href="pages/profile.php">Profile</a></li>
	 <?php }?>


	 <?php
           $userId =  Session::get("userId");
            $chkOrder = $cart->checkOrder($userId);
            if ($chkOrder) { ?>
            <li><a href="pages/order.php">Orders</a></li>
     <?php  }  ?>
	  <li><a href="pages/contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>