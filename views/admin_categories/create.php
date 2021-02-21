<?php 
    include ROOT.'/views/parts/header-admin.php';

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
                        <input type="text" name="name" placeholder="" value="">
                        <p>ՀԵՐԹԱԿԱՆ ՀԱՄԱՐ</p>
                        <input type="text" name="category" placeholder="" value="">
                        <p>ԿԱՏԵԳՈՐԻԱՅԻ  ՀԱՄԱՐ</p>
                        <input type="text" name="category_id" placeholder="" value="">
                        <br/><br/>
                        
                        <!-- <p>ԿԱՏԵԳՈՐԻԱՆԵՐԻ ՔԱՆԱԿ</p>
                        <input type="text" name="category_count" placeholder="" value="" id="count">
             
                        <br/><br/>
                        <div id="category">
                                                
                        </div> -->
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