<?php
session_start();
// include 'userclasses.php';
include 'locationclass.php';
// $obj = new userclasses();
?> 
<!doctype html>
<html lang="en">
  <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="gui.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <title>Fare Calculatore</title>
  </head>
  <body>
    <div class="container-fluid">       
            <div class="back-img">
            <header>
            <!-- data-toggle="slide-collapse" data-target="#navbarCollapse" -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light  sticky">
                    <a class="navbar-brand " href="#" ><span class = "text-warning span-1">Ced</span><span class="span-2 mr-5"><b>Cab</b></span></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-uppercase font-weight-bold" href="#">Welcome to the world best Cab  SERVICE<span class="sr-only">(current)</span></a>
                        </li> 
                        <?php 
                        if(isset($_SESSION['user'])){                          
                            echo '<a href="user_dashboard.php?flag=1" class="btn btn-outline-danger">DASHBOARD</a>';
                        } else {
                            echo '<li class="nav-item active">
                                        <a class="btn btn-outline-danger" href="login.php?flag=1" role="button">LOGIN</a>
                                  </li>';
                                  //send the flag variable to unset and destroy the session
                                
                        }
                            ?>                        
                      </ul>                    
                    </div>
                </nav>
            </header>
        <div class="mini-head-content container-fluid">
            Choose From a Range Of Categories And Prices
        </div>
        <div class="row">
            <div class="col-lg-4 col-xl-4 col-md-6 col-sm-12 col-xs-12">
            <div class="fare-content">
                <div class="form">
                    <div class="city-taxi"> <span class = "bg-warning">CITY TAXI</span></div>
                     <div class="form-content">
                       <p> <b>Your every Day Travel Patner</b></p>
                        AC Cabs for point to point tarvel
                    </div>
                    <div class="form-table">
                        <form action="" id="form">                     
                        <table class="table">
                        <tr>
                            <td class="td-design"> <span>PICK-UP</span></td>
                            <td>
                            <?php $obj = new locationclass();
                            $pickup_option  = $obj->for_pickup_location();?>
                                <select id="pickup" name="pickup" class="form-control">
                                    <?php echo $pickup_option;?>
                                </select> 
                            </td>                                  
                            </tr>                              
                            <tr>                             
                                <td class="td-design"><span>DROP</span></td>
                                <td>
                                <?php $obj = new locationclass();
                                $drop_option  = $obj->for_drop_location();?>
                                <select id="destination" name="destination" class="form-control">
                                    <?php echo $drop_option;?>
                                    </select>
                                </td>                                  
                            </tr>
                            <tr>                               
                                <td class="td-design"><span>CAB TYPE</span></td>
                                <td><select id="cab" name="cab" class="form-control">
                                        <option value="">CAB TYPE</option>
                                        <option value="CedMicro">CedMicro</option>
                                        <option value="CedMini">CedMini</option>
                                        <option value="CedRoyal">CedRoyal</option>
                                        <option value="CedSUV">CedSUV</option>
                                    </select></td>                                 
                            </tr>
                            <tr>
                                <td class="td-design"><span>LUGGAGE</span></td>
                                <td><input type="number" class="form-control" min="1" id='luggage' placeholder="ENTER YOUR LUGGAGE AMAOUNT IN KG."></td>
                            </tr>
                            <tr>
                                <td colspan="2"> <input type="submit" class="form-control btn-warning submitt" id="submit" value="CALCULATE FARE" ></td>
                            </tr>                          
                        </table>    
                        </form>
                    </div>                    
                </div>                              
            </div>           
        </div>  
        <?php  if(!empty($_SESSION['cart'])) :
            ?>    
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 result-field" id="result-col">
            <div class="fare-content">
                <div class="formm">
                    <div class="city-taxi"> <span class="bg-warning">INVOICE</span></div>
                     <div class="form-content">
                       <p> You will see your amount of services here</p>                      
                    </div>
                    <div class="form-table">
                        <table class="table output-table">
                            <tr>
                                <th>Reason</th>
                                <th>Amount</th>
                            </tr>                            
                            <tbody id="result">
                                <?php
                                // if(isset($_SESSION['cart'])) {
                                    echo  '<tr><td>cab-service</td><td >'. $_SESSION['cart']['cabdata']. '</td></tr>';
                                    echo  '<tr><td>Total-Distance</td><td >'. $_SESSION['cart']['calculated_distance'] . '.km </td></tr>';
                                    echo  '<tr><td>Fare-Amout</td><td >'. $_SESSION['cart']['fare'] .'.Rs </td></tr>';
                                    echo '<tr><td>Fare for Luggage</td><td >'. $_SESSION['cart']['luggage_amount']. '. Rs </td></tr>';
                                    echo '<tr><td>Total-Fare(fare+luggage) </td><td >'.$_SESSION['cart']['ftotal_amount'] . '. Rs </td></tr>';
                                // }                                                         
                                ?>
                            </tbody>
                            <tr>
                                <td><a id="book_now" class="btn-design bg-warning pt-2 pl-3 pr-3 pb-2" href="user_dashboard.php">BOOK NOW</a></td>
                                <!-- <td><button onClick="location.reload(true)" class="btn-design bg-warning pt-1 pl-2 pr-2 pb-1">Cancel</button></td> -->
                                <td><a href="cart_unset.php"><button class="btn-design bg-warning pt-1 pl-2 pr-2 pb-1">Cancel</button></a></td>
                            </tr>
                        </table>                        
                    </div>                 
                 </div>
            </div>
        </div>
                                <?php endif;?>
<footer>
    <div class="container-fluid bg-light pt-2">
      <div class="row">
        <div class="col-sm-12  col-md-4 col-lg-4 col-xl-4 text-center">
          <i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i>
          <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
          <i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i>
          <i class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i>
        </div>
        <div class="col-sm-12  col-md-4 col-lg-4 col-xl-4 text-center">
        <span class = "text-warning span-1 ml-4">Ced</span><span class="span-2 mr-5"><b>Cab</b></span>
          <!-- <p> <i class="fa fa-heart" aria-hidden="true"></i>thanks for Visisting and glad to see you -->
          </p>
        </div>
        <div class="col-sm-12  col-md-4 col-lg-4 col-xl-4 text-center">
          <nav>
            <a href="#" >FEATURES</a>
            <a href="#">REVIEW</a>
            <a href="#">SIGNUP</a>
          </nav>
        </div>
      </div>
    </div>
</footer>
<!-- performing ajax  -->
    <script>
        $(document).ready(function(){ 
         
            $('#cab').change(function(){              
                if( $('#cab').val()=='CedMicro') {
                    $('#luggage').prop('disabled', true);
                    $('#luggage').val('');
                } else {
                    $('#luggage').prop('disabled', false);
                }
            });
           
            // $('#result-col').hide();
            $('#luggage').keyup(function () { 
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });
            $('#submit').on("click", function(e) {  
              e.preventDefault();
              var pickup = $('#pickup').val();
              var destination = $('#destination').val();
              var cab = $('#cab').val();
              var number = $('#luggage').val();
              if(pickup =="" || destination =="" || cab == "") {
                  alert("Please select atleast pickup , destination and cab option");
              } 
              else if(pickup == destination){
                  alert('you can"t eneter destination same as pickup');
              } else {
                $.ajax({
                    url : "calculate-updated.php",
                    type : "POST",
                     data : {pick:pickup,dest:destination,cab:cab,luggage:number},
                    success : function(data) {
                        window.location.href='index.php';
                    }
                   });
              }                                                  
            });             
            $('#book_now').click(function(){
            });
         });
    </script>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>