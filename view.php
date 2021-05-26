<!-- <?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
	header("location:loginpage.php");
	exit();
}
?>

<?php include 'header.php' ?>
<?php 
include'insert.php';
?>
<?php
include'sidebar.html';
?>







   

 
  <!-- include'insert.php'; -->

  

    
      
    
      

      
    


  


  <div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div style="display:<?php if(isset($_SESSION['showAlert'])){echo $_SESSION['showAlert'];}else {echo'none';}unset($_SESSION['showAlert']);?>" class="alert alert-success alert-dismissible mt-3">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];}unset($_SESSION['message']);?></strong> 
      </div>
      <div class="table-responsive mt-2">
        <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
            <td colspan="7">
              <h4 class="text-center text-info m-0">Food in your cart</h4>
            </td>
          </tr>
          <tr>
            <th>NAME</th>
            <th>IMAGE</th>
            <th>PRICE</th>
           

            <th>
              <!-- <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure to clear your cart?');"><i class="fas fa-trash"></i>Clear cart</a> -->
            </th>


              
           
          </tr>
        </thead>
        <tbody>
          
          
        <?php
        require'insert.php';
         if(isset($_GET['id'])){
         $view = $_GET['id'];

         $stmt=$con->prepare("SELECT * FROM `shopping cart` WHERE id=?");
         $stmt->bind_param("i",$view);
         $stmt->execute();
         $result=$stmt->get_result();
         while($row = $result->fetch_assoc()){

           
         }

  // $_SESSION['showAlert']='block';
  // $_SESSION['message']='Item has been removed from cart!';
         // header('location:view.php');
        
         }
          ?>

           <?php
          // require'insert.php';
          // $stmt=$con->prepare("SELECT * FROM `shopping cart` WHERE id=?");
          // $stmt->execute();
          // $result=$stmt->get_result();
          // $grand_total = 0;
          // while($row = $result->fetch_assoc()){

           
          // }
          ?>

          <tr>
            <td><?=$row['name']?></td>
            <input type="hidden" class="pid" value="<?=$row['id']?>">
            <td><img src="<?=$row['image']?>" width="50"></td>
            <td><?=number_format( $row['price'],2 )?> ৳</td>
            <<!-- td><input type="number" class="form-control  itemQty" value="<?=$row['qty']?>" style="width:75px;"></td> -->
            <td>
               
              
               
           <!--  </td> -->  
           <!--  <td> -->
              <!-- <input type="hidden" class="pprice" value="<?=$row['price']?>">
              <a href="action.php?remove=<?=$row['id']?>" class="text-danger lead"onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a> -->
           <!--  </td> -->
          </tr>
          <?php 
          // $grand_total+=$row['total'];
           ?>
        <?php 
      // endwhile; 
      ?>
        <tr>
          <td colspan="2">
            <a href="food.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>Continue Shopping</a>
            
          </td>
          <!-- <td colspan="2"><b>Grand Total</b></td> -->
          <!-- <td><b><?=number_format( $grand_total,2 )?> ৳</b></td> -->
          <td>
            <!-- <a href="checkout.php" class="btn btn-info <?=($grand_total>1)?"":"disabled";?>"><i class="far fa-credit-card"> Checkout</i></a> -->
          </td>
        </tr>
        </tbody>
        </table>
      </div>
    </div>     

    
  </div>
  
</div>


<?php include 'footerpro.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript">
  $(document).ready(function(){
  
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


        </script> -->
</body>
</html> -->