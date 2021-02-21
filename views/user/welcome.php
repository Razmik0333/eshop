<?php 
  require ROOT. '/views/parts/header.php';
?>
<div class="container ">
  <?php 
    if (isset($errors) && is_array($errors)) { ?>

    <ul>
      <?php 
        foreach ($errors as $error) { ?>
          <li><?php echo $error;?></li>    
        <?php }?>
    </ul>

        <?php }?>
  
  <form class="text-dark form"  method="POST" action="#">
        <div class="form-col" >
          <div class="form-group col-sm-6">
            <label for="inputEmail4">Name</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Enter Your Name" name="name" value="<?php echo $name;?>">
          </div>
          <div class="form-group col-sm-6">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" value="<?php echo $email;?>">
          </div>
          <div class="form-group col-sm-6">
            <label for="inputPassword4">Password</label>
            <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password" value="<?php echo $password;?>">
          </div>
          <div class="form-group col-sm-6">
            <label for="inputPassword3">Confirm Password</label>
            <input type="password" class="form-control" id="inputPassword3" placeholder="Confirm Password" name="confirm">
          </div>
        </div>
        <div class="form-group col-sm-6">
          <label for="inputAddress">Address</label>
          <input type="text" class="form-control address position-relative"  id="inputAddress" placeholder="Enter Your address" name="address" value="">
        </div>
          <div class="form-group col-sm-6">
            <label for="inputCity">Enter Your City</label>
            <input type="text" class="form-control" style="width:100%" id="inputCity" placeholder="Enter Your city" name="city" value="">
          </div>
          <div class="form-row">

          <div class="form-group col-sm-4" style="width:45%; left:15px">
            <label for="inputState">Enter Your Country</label>
            <select id="inputState" class="form-control" style="width:90%;" name="country" >
              <option>Select country</option>
              <option>Armenia</option>
              <option>Russia</option>
              <option>USA</option>
            </select>
          </div>
          <div class="form-group col-sm-2" >
            <label for="inputZip">Zip</label>
            <input type="text" class="form-control" id="inputZip"style="width:90%; left:15px" name="zip" value="">
          </div>
        </div>
        <div class="form-group position-relative " style="left:15px">
          <div class="form-check">
            <p class="form-check-label">Select Your Gender</p>
            <input type="radio" id="male" name="gender" value="male"  style="width:5%; left:15px" >
            <label for="male">Male</label> 
            <input type="radio" id="female" name="gender" value="female" style="width:5%; left:15px" >
            <label for="female">Female</label>
          </div>
        </div>
        <input type="submit" class="btn btn-primary position-relative" value="Sign in" name="submit"  style="left:15px">
      </form>  
  </div>
  

<?php 
  require ROOT. '/views/parts/footer.php';
?>