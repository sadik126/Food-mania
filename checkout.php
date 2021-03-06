
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
	header("location:loginpage.php");
	exit();
}
?>


<?php

require'insert.php';

$grand_total = 0;
$allItems = '';
$items = [ ];

$sql = "SELECT CONCAT (name,'(',qty,')') AS ItemQty,total FROM cart";

$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()){
	$grand_total+=$row['total'];
	$items[]=$row['ItemQty'];
}
$allItems = implode(",",$items);
// echo $allItems;
?>


<?php

include 'header.php';
?>
<?php
include'sidebar.html';
?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-6 px-4 pb-4" id="order">
			<h4 class="text-center text-info p-2">Complete your order</h4>
			<div class="jumbotron p-3 mb-2 text-center">
				<h6 class="lead"><b>product(s): </b> <?=$allItems; ?> </h6>
				<h6 class="lead"><b>Delivery charge: </b> Free </h6>
				<h5><b>Amount payable:</b><?=number_format( $grand_total,2 )?> ৳</h5>
				<form action="" method="post" id="placeorder"   >
					<input type="hidden" name="products" value="<?=$allItems; ?>">
					<input type="hidden" name="grand_total" value="<?=$grand_total; ?>">
					<div class="form-grup">
						<input type="name" name="name" class="form-control"  placeholder="Enter your name" required="1" >
					</div>

					<div class="form-grup">
						<input type="email" name="email" class="form-control"  placeholder="Enter your email" required="1">
					</div>
					<div class="form-grup">
						<input type="tel" name="phone" class="form-control" placeholder="Enter your phone" required="1">
					</div>
					<div class="form-grup">
						<textarea name="address"  class="form-control" rows="3" cols="12" placeholder="Enter your address" required="1" >
					    </textarea>
					    <h6 class="text-center lead">Select payment mode</h6>
					    <div class="form-grup">
					    	<select name="pmode" class="form-control" required="1">
					    		<option value="" selected disabled>
					    			-Select payment mode-
					    		</option>
					    		<option value="cod">
					    			Cash on delivery
					    		</option>
					    		<option value="netbanking">
					    			Online banking
					    		</option>
					    		<option value="cards">
					    			debit/credit
					    		</option>

					    	</select>
					    </div>

					    <div class="form-grup">
					    	<input type="submit" name="submit" value="place Order" class="btn btn-danger btn-block">
					    	
					    </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

  	$("#placeorder").submit(function(e){
     e.preventDefault();
     $.ajax({
       url:'action.php',
       method:'post',
       data: $('form').serialize()+"&action=order",

        success:function(response){
              $("#order").html(response);
          }
     });
     	
  	});



  		
    
    load_number();
        
function load_number(){
        $.ajax({
          url:'action.php',
          method:'get',
          data:{cartItem:"cart_item"},
          success:function(response){
              $("#cart-item").html(response);
          }
        });




          
       }

  });


        </script>

<!--         <script>
	function clearErrors(){
		errors=document.getElementsByClassName('formerror');
		for(let item of errors)
		{
			item.innerHTML="";
		}
	}
	function seterror(id,error) {
		element = document.getElementById(id);
		element.getElementsByClassName('formerror')[0].innerHTML = error;
		
	}

	function validateForm(){
		var returnval = true;
		clearErrors();
		var name = document.forms['myform']['name'].value;
		if(name.length<5){
			seterror("name","*Length of name is too short");
			returnval= false;
		}
		if(name.length==0){
			seterror("name","*Please fill up the name");
			returnval= false;
		}
		var email = document.forms['myform']['email'].value;
    
    var pattern =   /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
		
    
      if(email.match(pattern))
      {
      // seterror("email","*valid email");
      returnval= true;
      }
      else
      {
      seterror("email","*invalid email");
      returnval= false;
      }
    if(email.length<3){
      seterror("email","*Length of email is too short");
      returnval= false;
    }
		if(email.length==0){
			seterror("email","*Please fill up the email");
			returnval= false;
		}
	
		
		var address = document.forms['myform']['address'].value;
		
		
        
        if (address.length < 3)
        {

        
        seterror("address", "*address should be atleast 3 characters long!");
        returnval = false;
        }
		if(address.length==0)
		{
			seterror("address","*Please fill up the address");
			returnval= false;
		}

		

		return returnval;

	}
</script>
             -->    

  <?php include 'footerpro.php' ?>