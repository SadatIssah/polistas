<?php include('../inc/header.php'); ?>

<?php
  $login =  Session::get("userlogin");
  if ($login == true) {
  	header("Location:payment.php");
  }
  ?>


<?php
	   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reg']) ) {
		  $customer1 = $customer->userRegistration($_POST);
	   }
   ?>

<?php
	 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) ) {
    		$Login = $customer->userLogin($_POST);
        }
?>



 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>
			<?php
        if (isset($Login)) {
            echo $Login;
    	  }
	?>

        	<form  method="post" id="member">
                	<input name="email" type="email" placeholder="email" class="field" style="font-size: 12px;
								color:B3B1B1;
								padding: 8px;
								outline: none;
								margin: 5px 0;
								width: 230px">
					<input name="pass" type="password" placeholder="password" class="field" >
					<div class="buttons"><div><button class="grey" name="login" >Sign In</button></div></div>

            </form>
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>

                    </div>
    	<div class="register_account">
			<h3>Register New Account</h3>
			<?php
        if (isset($customer1)) {
            echo $customer1;
    	  }
    ?>
    		<form method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name = "fname" placeholder="First Name">
							</div>
							<div>
							<input type="text" name="lname" placeholder="Last Name">
							</div>
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							<div>
								<input type="text" name = "zip" placeholder="Zip">
							</div>
							<div>
								<input type="email" name = "email" placeholder="email"
								style="font-size: 12px;
								color:B3B1B1;
								padding: 8px;
								outline: none;
								margin: 5px 0;
								width: 340px">

							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="addr"  placeholder="Address">
						</div>
		    		<div>
					<input type="text" name="country" placeholder="Country">
		           <div>
		          <input type="text" name="phone" placeholder="Phone Number">
		          </div>

				  <div>
					<input type="password" name="pass" placeholder="Password" style="font-size: 12px;
								color:B3B1B1;
								padding: 8px;
								outline: none;
								margin: 5px 0;
								width: 340px" >
					</div>
		    	</td>
		    </tr>
		    </tbody></table>
		   <div class="search"><div><button class="grey" type="submit" name="reg">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>
       <div class="clear"></div>
    </div>
 </div>
</div>
   <div class="footer">
   	  <div class="wrapper">
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Customer Service</a></li>
						<li><a href="#"><span>Advanced Search</span></a></li>
						<li><a href="#">Orders and Returns</a></li>
						<li><a href="#"><span>Contact Us</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Why buy from us</h4>
						<ul>
						<li><a href="about.html">About Us</a></li>
						<li><a href="faq.html">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="contact.html"><span>Site Map</span></a></li>
						<li><a href="preview-2.html"><span>Search Terms</span></a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>My account</h4>
						<ul>
							<li><a href="contact.html">Sign In</a></li>
							<li><a href="index.html">View Cart</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="faq.html">Help</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
			<h4>Contact</h4>
						<ul>
							<li><span>support@easylearningbd.com</span></li>
							<li><span>www.easylearningbd.com</span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>easy Learning project &amp; All rights Reseverd </p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
	 		};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
</body>
</html>

