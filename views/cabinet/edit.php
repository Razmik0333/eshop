<?php 
  require ROOT. '/views/parts/header.php';
?>
    <div class="container">
    <?php 
    if($result){
        echo 'Данные изменены';
    }else { 
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
                    <input type="text" class="form-control" id="inputEmail4" placeholder="Name" name="name" value="<?php echo $user['name'];?>">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputPassword4"> Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password" value="<?php echo $user['password'];?>" >
                  </div>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary position-relative"  style="left:15px">Sign in</button>
              </form>  
        <?php }?>
    
  </div>
<?php 
  require ROOT. '/views/parts/footer.php';
?>