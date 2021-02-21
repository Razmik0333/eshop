<?php 	require_once ROOT.'/views/parts/header.php';?> 

    <div class="container">
    <?php if($result){ ?>
            <p>Ձեր գնումը կատարված է </p>
        <?php } else{
                    if(isset($errors) && is_array($errors)){?>
                    <ul>
                        <?php foreach ($errors as $error) {?>
                            <li>
                                <?php echo $error; ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            <form class="text-dark  justify-content-center"  method="POST" action="#">
                <div class="form-col" >
                    <div class="form-group col-sm-6">
                        <label for="inputName4">Անուն</label>
                        <input type="text" class="form-control" id="inputName4" placeholder="Name" name="userName" value="<?php if(!$userId){echo '';}else{echo $userName;}?>">
                        <p class="warning"></p>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="inputPhone4">Հեռախոս</label>
                        <input type="phone" class="form-control" id="inputPhone4" placeholder="Մուտքագրեք ձեր հեռախոսահամարը" name="userPhone" value="">
                        <p class="warning"></p>
                        <div class="form-group">
                        <label for="exampleFormControlTextarea1">Կատարել առաջարկություն(ոչ պարտադիր)</label>
                        <textarea class="form-control" name="userComment" id="exampleFormControlTextarea1" rows="3" placeholder="Ձեր առաջարկություն"></textarea>
                    </div>
                    </div>
                </div>
                <button class="btn btn-outline-dark close-item mx-auto" name="send">Ուղարկել Տվյալները</button>

            </form>
        <?php }?>
    </div>
    




<?php require_once '/views/parts/footer.php';?> 
