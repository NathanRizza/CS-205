function chkName()
{
var name = document.getElementById("name");

var pos = name.value.search(/^[A-Z][a-z]+, ?[A-Z][a-z]+ ?[A-Z]\.?$/);

	if(pos !=0)	
	{
		alert("The name you entered (" + name.value + 
          	") is not in the correct form.\n" +
          	"The correct form is: " +
          	"first-name, last-name middle-initial\n" +
       		"Please go back and fix your name.");
	
	return false;

	}
	else
	{
		return true;		
	}
}

function chkPhone()
{
var phone = document.getElementById("phone");

var pos = phone.value.search(/^\d{3}-\d{3}-\d{4}$/);
   
	if (pos != 0)
	{
	alert("The phone number you entered (" + phone.value +
	") is not in the correct form.\n" +
	"The correct form is: ddd-ddd-dddd\n" +
	"Please go back and fix your phone number.");
	return false;
	}
	else
	{
	return true;
	}
}

function chkEmail()
{
var email = document.getElementById("email");

var pos = email.value.search(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/);

	if(pos !=0)	
	{
		alert("The email you entered (" + email.value + 
          	") is not in the correct form.\n" +
          	"The correct form is: " +
          	"example@server.com \n" +
       		"Please go back and fix your email.");
	
	return false;

	}
	else
	{
		return true;		
	}
}

function chkAddress()
{
var address = document.getElementById("address");

var pos = address.value.search(/^[0-9]+ ?[A-Za-z]+ ?[A-Za-z]+, ?[A-Za-z]+$/);

	if(pos !=0)	
	{
		alert("Please enter a valid  address.\n"+
		"#### Street Name, CityName"); 
	return false;

	}
	else
	{
		return true;		
	}
}

//will be expanded upon with every new Item
//not needed for current version of project
function somethingOrdered() 
{	
	if(pizzaOrder)
	{	
		return false;
	}
	else
	{
		alert("You must add food to your order.");
		return true;
	}
		
}

//Will return true if pizza was ordered
function pizzaOrder()
{
	var x = document.getElementById("pizzaNum").value;
	
		if(x < 1)
		{
			alert("You must specify how many pizza's you will order.");
			return false;
		}
		else if (x > 5)
		{
			alert("You cannot order more than 5 pizzas in one order");
			return false;
		}
		else
		{
		return true;
		}
}
