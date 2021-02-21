<?php 
  require ROOT. '/views/parts/header.php';
?>
    <div class="container welcome">
        <?php if(isset($errors) && is_array($errors)){?>
            <ul>
                <?php foreach ($errors as $error) {?>
                    <li>
                        <?php echo $error; ?>
                    </li>
                <?php } ?>

            </ul>
            <?php } ?>
        <!-- <form class="form text-dark"  method="POST" action="#">
            <div class="form-group col-sm-6">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="<?php// echo $email; ?>">
            </div>
            <div class="form-group col-sm-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password" value="<?php //echo $password; ?>">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary position-relative" style="left:15px">Sign Up</button>
        </form> -->
    </div>
<?php 
  require ROOT. '/views/parts/footer.php';
?>