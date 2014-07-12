<?php include_once('includes/header.php'); 


?>

    <body style='padding-top:25px;'>
        <div class="container-fluid">
            <section class='col-md-6'>
                <?php
                    if(isset($_GET['success'])){
                        $restaurantDecode = urldecode($_GET['restaurant']);
                        echo "<p class='bg-success' style='padding: 15px 5px;'>You have successfully added restaurant $restaurantDecode to the list!</p>"; 
                    }
                    if(isset($_GET['error'])){
                        $errorList = urldecode($_GET['error']);
                        echo "<p class='bg-danger' style='padding: 15px 5px;'>No restaurants were added because $errorList.</p>";
                    }
    
                ?>
                <form name="restaurants" id='restaurants' action="process.php" method="post">
                    <label for='restaurantName' class='col-md-6'>Restaurant Name:</label>
                    <input type='text' id='restaurantName' class='col-md-6'
                    required='required' name='restaurantName' placeholder='Restaurant name'
                    value=''
                    />
                    <label for='rating' class='col-md-6' >Rating:</label>
                    <input type='number' min='0' max='5' class='col-md-6' required='required'
                    name='rating' id='rating' placeholder='Numbers only' 
                    value=''
                    />
                    <label for='location' class='col-md-6'>Location:</label>
                    <input type='text' name='location' id='location' class='col-md-6'
                    required='required' placeholder='Restaurant location' 
                    value=''
                    />
                    <p>&nbsp;</p>
                    <span style='font-weight:bold;'>Describe your experience:</span><br/>
                    <textarea name='description' id='description' cols='5' row='4' class='col-md-12' placeholder='Describe the location'>
                    
                    </textarea>
                    <p>&nbsp;</p>
                    <input type='submit' class="btn btn-info" value='Submit your review' />
                </form>
            <pre style='margin-top:10px;'>
            <?php 
        isset($_POST) && !empty($_POST) ? print_r($_POST) : print("No variables have been set yet.");
         
        ?>
        </pre>
            </section>
        </div>
<?php include_once("includes/footer.php"); ?>