<!DOCTYPE html>
<html lang ="en">
<head>
<meta charset="utf-8">
<title>Rizza’s Pizzas</title>
<base href="/rizzan/final/">
<link rel="stylesheet" href="style.css" type="text/css">
<script type="text/javascript" src="scripts/scripts.js"></script>
</head>

<body>

<div id="top">
        <img src="imgs/pizzaLogo.png" alt="Rizza's Pizzas">
</div>

<div id="top">
         <a href="index.html"> Home </a>
         &nbsp;
         &nbsp;
         <a href="pages/order.html"> Order </a>
         &nbsp;
         &nbsp;
         <a href="pages/pictures.html"> Pictures </a>
         &nbsp;
         &nbsp;
         <a href="pages/reviews.html"> Reviews </a>
         &nbsp;
         &nbsp;
         <a href="pages/history.html"> History </a>
</div>


<div id="container">
<div id="centerdiv">
<br>
<?php

$servername = "localhost";
$username = "rizzan";
$password = "wHy42bEnth";
$dbname = "rizzan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Failed to connect to Database: " . $conn->connect_error);
}

$pizzaCheck = False;
$CustomerNum = NULL;
$badData = FALSE;
$pizzaNum = 0;
$bill = 0;

	

			if(isset($_POST['pizzaNum']))//collect database data
				{
					$pizzaCheck = TRUE;
					$pizzaNum = $_POST["pizzaNum"];
			
					$result = $conn->query("SELECT Price FROM Product");						
					if ($result->num_rows > 0) 
					{
  						$row = $result->fetch_assoc();	
						$pizzaBase = $row["Price"];
						$row = $result->fetch_assoc();	
						$sizeSmall = $row["Price"];
						$row = $result->fetch_assoc();	
						$sizeMedium = $row["Price"];
						$row = $result->fetch_assoc();	
						$sizeLarge = $row["Price"];
						$row = $result->fetch_assoc();	
						$thinCrust = $row["Price"];
						$row = $result->fetch_assoc();	
						$thickCrust = $row["Price"];
						$row = $result->fetch_assoc();	
						$stuffedCrust = $row["Price"];
						$row = $result->fetch_assoc();	
						$plain = $row["Price"];
						$row = $result->fetch_assoc();	
						$pepperonie = $row["Price"];
						$row = $result->fetch_assoc();	
						$pineapple = $row["Price"];

					}
				
					if(!$pineapple)
					{
						echo"<br>";
						echo "Error getting pice data cost from database.";
						echo"<br>";
						$badData ==TRUE;
					}
				}	

			//colect user input data
			if(isset($_POST["name"]))
			{
				$name = $_POST["name"];
			}
			else
			{
				echo "Name not supplied";
				echo"<br>";
				$badData = TRUE;
			}

			if(isset($_POST["email"]))
			{
				$email = $_POST["email"];
			}
			else
			{
				echo "Email not supplied";
				echo"<br>";
				$badData = TRUE;
			}

			
			if(isset($_POST["phone"]))
			{
				$phone = $_POST["phone"];
			}
			else
			{
				echo "Phone number not supplied";
				echo"<br>";
				$badData = TRUE;
			}
		
			if(isset($_POST["address"]))
			{
				$address = $_POST["address"];
			}
			else
			{
				echo "Address not supplied";
				echo"<br>";
				$badData = TRUE;
			}
			
			if(isset($_POST["pizzaSize"]))
			{
				$pizzaSize = $_POST["pizzaSize"];
			}
			else
			{
				echo "Error getting pizza size";
				echo"<br>";
				$badData = TRUE;
			}
				
			if(isset($_POST["pizzaCrust"]))
			{
				$pizzaCrust = $_POST["pizzaCrust"];
			}
			else
			{
				echo "Error getting pizza crust";
				echo"<br>";
				$badData = TRUE;
			}
			
			if(isset($_POST["toppingLeft"]))
			{
				$toppingLeft = $_POST["toppingLeft"];
			}
			else
			{
				echo "Error getting left topping";
				echo"<br>";
				$badData = TRUE;
			}
			
			if(isset($_POST["toppingRight"]))
			{
				$toppingRight = $_POST["toppingRight"];
			}
			else
			{
				echo "Error getting right topping";
				echo"<br>";
				$badData = TRUE;
			}
		
		if($badData ==False)//validate user input data
			{
			if (! preg_match("/^[A-Z][a-z]+, ?[A-Z][a-z]+ ?[A-Z]\.?$/", $name)) 
            			{
				$badData = TRUE;
				echo "Name data error." . "<br>";
				}
			if (! preg_match("/^\d{3}-\d{3}-\d{4}$/", $phone))
                               	{
				$badData = TRUE;
				echo "Phone data error." . "<br>";
				};
			if (! preg_match("/^[a-zA-Z0-9.!#$%&]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $email))
                               	{
				$badData = TRUE;
				echo "Email data error." . "<br>";
				}
                        if (! preg_match("/^[0-9]+ ?[A-Za-z]+ ?[A-Za-z]+, ?[A-Za-z]+$/", $address))
                               	{
				$badData = TRUE;
				echo "Address data error." . "<br>";
				}
			if ($pizzaNum > 5)
				{
				echo "Cannot order more than 5 Pizzas" . "<br>";
				$badData = TRUE;	
				}
			if ($pizzaSize !== "small" && $pizzaSize !== "medium" && $pizzaSize !== "large")
				{
				echo "Pizza Size Data Error" . "<br>";
				$badData =True;
				}
			
			if ($pizzaCrust !== "thin" && $pizzaCrust !== "thick" && $pizzaCrust !== "stuffed")
				{
				echo "Pizza Crust Data Error" . "<br>";
				$badData =True;
				}

			
			if ($toppingLeft !== "plain" && $toppingLeft !== "pepperonie" && $toppingLeft !== "pineapple")
				{
				echo "Left Topping Data Error" . "<br>";
				$badData =True;
				}
			
			if ($toppingRight !== "plain" && $toppingRight !== "pepperonie" && $toppingRight !== "pineapple")
				{
				echo "Right Topping Data Error" . "<br>";
				$badData =True;
				}
			}

			if($badData == FALSE) //send customer data to database
			{

				$customer_Query = "INSERT INTO rizzan.Customer (Name, Address, Phone, Email) VALUES('$name','$address','$phone','$email');";

				$customer_result = mysqli_query($conn,$customer_Query);					
				
			if($customer_result)	
			{
				//echo "Customer added to database." . "<br>";
				$CustomerNum = mysqli_insert_id($conn);
				echo "Customer Number: " .$CustomerNum . "<br>";
			}
			else
			{
				echo "Error adding Customer to Database <br>";
			}	

			//write customer data to screen
			echo "Name: " . $name;
			echo "<br>";	
			echo "Email: " .$email;
			echo "<br>";
			echo "Phone Number: " .$phone;
			echo "<br>";
			echo "Address: " . $address;
			echo "<br>";
			echo "------Item(s)------";
			echo "<br>";
		
				if($pizzaCheck && ($pizzaNum > 0))//Writing out bill
				{
					echo "Pizza(s): " .$pizzaNum ."<br>";
					echo "Size: " .$pizzaSize . " ";
					
					
		
								
						if($pizzaSize == "small")
						{
							$additionToBill = (($sizeSmall+$pizzaBase)*$pizzaNum);
							echo "$".($sizeSmall+$pizzaBase) . " X " . $pizzaNum . " = $". $additionToBill . "<br>";

							$bill = $bill +$additionToBill; 
						}	
	
						else if($pizzaSize == "medium")
						{
							$additionToBill = (($sizeMedium+$pizzaBase)*$pizzaNum);
							echo  "$".($sizeMedium+$pizzaBase) . " X " . $pizzaNum . " = $". $additionToBill . "<br>";
							$bill = $bill +$additionToBill; 
						}	
							
						else if($pizzaSize == "large")
						{
							$additionToBill = (($sizeLarge+$pizzaBase)*$pizzaNum);
							echo  "$".($sizeSmall+$pizzaBase) . " X " . $pizzaNum . " = $". $additionToBill . "<br>";
							$bill = $bill +$additionToBill; 
						}	

					echo "Crust: " .$pizzaCrust . " ";

						if($pizzaCrust == "thin")
						{
							$additionToBill = ($thinCrust * $pizzaNum);
							echo "$". $thinCrust . " X " . $pizzaNum . " = $". $additionToBill . "<br>";

							$bill = $bill +$additionToBill; 
						}	
	
						else if($pizzaCrust == "thick")
						{
							$additionToBill = ($thickCrust * $pizzaNum);
							echo  "$". $thickCrust . " X " . $pizzaNum . " = $". $additionToBill . "<br>";
							$bill = $bill +$additionToBill; 
						}	
							
						else if($pizzaCrust == "stuffed")
						{
							$additionToBill = ($stuffedCrust*$pizzaNum);
							echo  "$". $stuffedCrust . " X " . $pizzaNum . " = $". $additionToBill . "<br>";
							$bill = $bill +$additionToBill; 
						}
	
					echo "Left Topping: " . $toppingLeft . " ";
						
						if($toppingLeft == "plain")
						{
							$additionToBill = ($plain * $pizzaNum);
							echo "$". $plain . " X " . $pizzaNum . " = $". $additionToBill . "<br>";

							$bill = $bill +$additionToBill; 
						}	
	
						else if($toppingLeft == "pepperonie")
						{
							$additionToBill = ($pepperonie * $pizzaNum);
							echo  "$". $pepperonie . " X " . $pizzaNum . " = $". $additionToBill . "<br>";
							$bill = $bill +$additionToBill; 
						}	
							
						else if($toppingLeft == "pineapple")
						{
							$additionToBill = ($pineapple*$pizzaNum);
							echo  "$". $pineapple . " X " . $pizzaNum . " = $". $additionToBill . "<br>";
							$bill = $bill +$additionToBill; 
						}


                                        echo "Right Topping: " . $toppingRight . " ";
                                                
                                                if($toppingRight == "plain")
                                                {       
                                                        $additionToBill = ($plain * $pizzaNum);
                                                        echo "$". $plain . " X " . $pizzaNum . " = $". $additionToBill . "<br>";
                                        
                                                        $bill = $bill +$additionToBill;
                                                }

                                                else if($toppingRight == "pepperonie")
                                                {
                                                        $additionToBill = ($pepperonie * $pizzaNum);
                                                        echo  "$". $pepperonie . " X " . $pizzaNum . " = $". $additionToBill . "<br>";
                                                        $bill = $bill +$additionToBill;
                                                }

                                                else if($toppingRight == "pineapple")
                                                {
                                                        $additionToBill = ($pineapple*$pizzaNum);
                                                        echo  "$". $pineapple . " X " . $pizzaNum . " = $". $additionToBill . "<br>";
                                                        $bill = $bill +$additionToBill;
                                                }
				}
					
				if($bill == 0)
				{
					echo "Nothing was ordered.";
					echo "<br>";
				}
			
			echo "-------------------";
			echo "<br>";
			echo "Total: $" . $bill . "<br>";
				
	
				if($bill >0 && $CustomerNum != NULL)//send order to database
				{	
					$order_Query = "INSERT INTO rizzan.Order (OrderNum, CustomerNum, customerName, Date, pizzaNum, pizzaSize, pizzaCrust, toppingLeft, toppingRight) VALUES(NULL,'$CustomerNum', '$name', NULL, '$pizzaNum', '$pizzaSize', '$pizzaCrust', '$toppingLeft', '$toppingRight');";

					$result = mysqli_query($conn,$order_Query);					
					
					if(!$result)
					{
						echo "Error Submitting Order." . "<br>";
					}
				}
				
			}
			else
			{
				echo "The data entered was invalid."; 
			}
			$conn->close();

?>
<br>
</div>
</div>

<div id="footer"> 
        <h4> &copy; Rizza’s Pizzas 1968-2021 Nathan Rizza</h4>
</div>

</body>
</html>
