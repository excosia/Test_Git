<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Gene Storehouse</title>

	<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
	<script type='text/javascript' src='js/logging.js'></script>
	<script type="text/javascript">
	ddsmoothmenu.init({
		mainmenuid: "top_nav", //menu DIV id
		orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
		classname: 'ddsmoothmenu', //class added to menu's outer DIV
		//customtheme: ["#1c5a80", "#18374a"],
		contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
	})
	</script>
	
</head>



<body>
<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">
	
	
	<!-- header -->
	<div id="templatemo_header">
    	<div id="site_title">
			<h1><a href="index.php" rel="nofollow">Gene, DNA, RNA and Cell</a></h1>
		</div>
		<div id="header_right">
			<p>	
				<a href="manage.php">My Account</a> | <a href="logout.php">Log out</a>			
			</p>
            <p>&nbsp;</p>
		</div>
		<div class="cleaner"></div>
    </div> 
	<!-- END of header -->
    
	
	<!-- Menu -->
    <div id="templatemo_menubar">
		<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php" class="selected">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="faqs.html">FAQs</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
            <br style="clear: left" />
        </div>
			
		<div id="templatemo_search">
            <form action="search.php" method="post">
				<input type="text" name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
				<input name="Search" type="submit" class="sub_btn" id="searchbutton" formaction="search resault.html" title="Search" value=" " alt="Search"  />
			</form>
        </div>
		
		<span class="cleaner">
			<input name="imageField" type="image" class="float_r" id="imageField" src="images/Apple-App-Store.png" width="40" height="40" />
			<input name="imageField2" type="image" class="float_r" id="imageField2" src="images/640px-Google_Play_Store.svg.png" width="46" height="40" />
		</span>
	</div> 
	<!-- END of menu -->
    
	
	<!-- templatemo_main -->
    <div id="templatemo_main">
		<!-- Side Menu -->
    	<div id="sidebar" class="float_l">
        <div class="sidebar_box"><span class="bottom"></span>
			
			<!--	Categories menu-->
            <h3>Categories</h3>   
            <div class="content">
                <ul class="sidebar_list">
                    <li><a href="animalProduct.php">Animal Gene</a></li>
                    <li><a href="plantProduct.php">Plant Gene</a></li>
                    <li><a href="microProduct.php">Micro Organic</a></li>
					<li><a href="humanProduct.php">Human Gene</a></li></ul>
                </ul>
        </div>
        </div>
			
			
		<!--			Ranking menu			-->
        <div class="sidebar_box"><span class="bottom"></span>
			<h3><a class="sidebar_box_icon" href="#" target="_blank"><img src="images/templatemo_sidebar_header.png"/></a>New Avaliable</h3>   
            <div class="content"> 
				<div class="bs_box">
                    <a href="product.php?productName=01"><img src="images/rank/1.jpg" width="58" height="58" alt="image" /></a>
                    <br>
					<h4><a href="product.php?productName=01">Green Algae</a></h4>
                    <div class="cleaner"></div>
				</div>
                <div class="bs_box">
					<a href="product.php?productName=02"><img src="images/rank/2.jpg" width="58" height="58" alt="image" /></a>
                    <br>
					<h4><a href="product.php?productName=02">Virus CT5</a></h4>
                    <div class="cleaner"></div>
                </div>
                <div class="bs_box">
                    <a href="product.php?productName=03"><img src="images/rank/3.jpg" width="58" height="58" alt="image" /></a>
					<br>
                    <h4><a href="product.php?productName=02">Blood Cell</a></h4>
                    <div class="cleaner"></div>
                </div>
                <div class="bs_box">
					<a href="product.php?productName=04"><img src="images/rank/4.jpg" width="58" height="58" alt="image" /></a>
					<br>
                    <h4><a href="product.php?productName=04">Puppy4</a></h4>
                    <div class="cleaner"></div>
                </div>
            </div>
        </div>
		</div>
		<!-- END of sideMenu -->
	
	
	<!-- Content -->
    <div id="content" class="float_r">
		<?php
			if(isset($_SESSION['passport']))
			{
				include("config.php");
				
				$cususer = $_SESSION["sessionUsername"];
				$productid = $_REQUEST['productid'];
				$quantity = $_REQUEST['quantity'];
				$shipid = $_REQUEST['shipid'];
				
				
				// find CustomerID
				$sql1 	= 	"SELECT	*
							FROM	Customers
							WHERE	CUsername = '$cususer'";	
				$result1 = sqlsrv_query($conn, $sql1);
				while ($row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)) 
				{
					$cid = $row['CustomerID'];
				}
				
				
				
				// insert to order table
				$sql2 	= 	"INSERT INTO Orders(ShipID, CustomerID)
							VALUES('$shipid', '$cid')";							
				$result2 = sqlsrv_query($conn, $sql2);

				
				
				// find orderID
				$sql3 	= 	"SELECT	*
							FROM	Orders
							WHERE	ShipID = '$shipid'
							AND		CustomerID = '$cid'";
				$result3 = sqlsrv_query($conn, $sql3);			
				while ($row = sqlsrv_fetch_array($result3, SQLSRV_FETCH_ASSOC)) 
				{
					$orderid = $row['OrderID'];
				}
				

				
				// find product price
				$sql4 	= 	"SELECT	*
							FROM	Products
							WHERE	ProductID = '$productid'";
				$result4 = sqlsrv_query($conn, $sql4);			
				while ($row = sqlsrv_fetch_array($result4, SQLSRV_FETCH_ASSOC)) 
				{
					$price = $row['Price'];
				}
				
				
				// insert to order detail table
				$sql5 	= 	"INSERT INTO [Order Details](OrderID, ProductID, [Price per unit], Quantity)
							VALUES('$orderid', '$productid', '$price', '$quantity')";							
				$result5 = sqlsrv_query($conn, $sql5);
				
				
				
				if($result5)
				{
					echo "<script type=text/javascript>alert('Thank you, Your order is in our progress.');
								window.location='addOrder_form.php';</script>";			
				}
				else
				{
					die(print_r(sqlsrv_errors(), true));
				}
				
			}
			else
			{
				echo "<h1>Please login first !</h1>";
				echo "<h6><a href='login.html'>Log in</a></h6>";			
			}		
		?>
	</div> 
	<!-- END of content -->
	
	
    <div class="cleaner"></div>
    </div> 
	<!-- END of templatemo_main -->
    
	
	
	<!-- footer -->
    <div id="templatemo_footer">
    	<p>
		<a href="index.php">Home</a> | <a href="showProduct.php">Products</a> | <a href="about.html">About</a> | <a href="faq.html">FAQs</a> | <a href="contact.html">Contact Us</a>
		</p>
		
    	Copyright © 2013 <a href="#">Gene Storehouse</a> | <a rel="nofollow" href="http://www.templatemo.com/preview/templatemo_367_shoes">Shoes Theme</a> by <a href="http://www.templatemo.com" target="_parent" title="free css templates">templatemo</a>
    </div> 
	<!-- END of templatemo_footer -->
 

 
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->
</body>
</html>