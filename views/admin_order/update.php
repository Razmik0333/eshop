<?php 
    require_once ROOT.'/views/parts/header-admin.php';

?>
<section>
    <div class="container">
        <div class="row">
            <?php if (isset($errors) && is_array($errors)){ ?>
                <ul>
                    <?php foreach ($errors as $error){ ?>
                        <li> - <?php echo $error; ?></li>
                    <?php } ?>
                </ul>
            <?php }?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>ԱՆՎԱՆՈՒՄ</p>
                        <!-- <input type="text" name="category" placeholder="" value="<?php //echo $orderById['arm_name']?>"> -->
                        <p  name="name" ><?php echo $orderById['user_name'];?></p>
             
                        <br/><br/>
                        <p>ՀԵՌԱԽՈՍ</p>
                        <!-- <input type="text" name="category_id" placeholder="" value="<?php// echo $orderById['name']?>"> -->
                        <p  name="name" ><?php echo $orderById['user_phone'];?></p>
                        <p>ՊԱՏՎԵՐԻ ՆԿԱՐՆԵՐԸ</p>
                        <?php foreach ($orders as $key => $order) { ?>
                            <p>ԱՊՐԱՆՔԻ ՔԱՆԱԿ`<b> <?php echo $orderCounts[$key];?></b></p>
                            <img src="<?php echo Product::getImage($order['id']); ?>" width="200" alt="" />
                            
                        <?php } ?>
                        <p>ԱՌԱՋԱՐԿՈՒԹՅՈՒՆ</p>
                        <!-- <input type="text" name="category_id" placeholder="" value="<?php// echo $orderById['name']?>"> -->
                        <p  name="comment" ><?php echo $orderById['user_comment'];?></p>

                        <br/><br/>
                        <p>ՍՏԱՏՈՒՍ</p>
                        <select name="status" id="">
                            <option ></option>
                            <option value="0" <?php if($orderById['status'] == 0){echo 'selected';}?>>Պատվերն ընդունված է</option>
                            <option value="1"<?php if($orderById['status'] == 1){echo 'selected';}?>>Պատվերն ուղարկվել է</option>
                            <option value="2"<?php if($orderById['status'] == 2){echo 'selected';}?>>Պատվերն հասել է պատվիրատուին</option>
                        
                        </select>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php 
   require_once ROOT.'/views/parts/footer-admin.php';
?>