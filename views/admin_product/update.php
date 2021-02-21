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
                    <form action="#" method="post" enctype="multipart/form-data">

                        
                        <p>Название товара</p>
                        <input type="text" name="item_name" placeholder="" value="<?php echo $product['description']?>">

                        <p>Артикул</p>
                        <input type="text" name="code" placeholder="" value="<?php echo $product['1c_articul']?>">

                        <p>ԳԻՆ, ֏</p>
                        <input type="text" name="cost" placeholder="" value="<?php echo $product['cost']?>">
                        <p>ԶԵՂՉ, %</p>
                        <input type="text" name="discount" placeholder="մուտքագրեք զեղչը " value="">

                        <p>ԿԱՏԵԳՈՐԻԱ</p>
                        <select name="category" id="category">
                        <option value="">Ընտրեք կատեգորիան</option>
                            <?php if (is_array($categoryList)): ?>
                                <?php foreach ($categoryList as $category): ?>
                                    <option value="<?php echo $category['id'];?>" <?php if($category['id'] == $product['category']) echo 'selected=selected';?>>
                                        <?php echo $category['arm_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <br/><br/>
                        <p>ԿԱՏԵԳՈՐԻԱ</p>
                        <select name="category_id" id="category-item">
                            <option>Ընտրեք կատեգորիան</option>
                        </select>
                        <br/><br/>
                        <p>ՆԿԱՐ</p>
                        <img src="<?php echo Product::getImage($product['id']); ?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="" value="<?php echo $product['id']; ?>">
                        <p>ՄԱՆՐԱՄԱՍՆ</p>
                        <textarea name="main"><?php echo $product['main']?></textarea>
                        <br/><br/>
                        <p>ԱՌԿԱՅՈՒԹՅՈՒՆ</p>
                        <select name="availabile">
                            <option value="1" <?php if($product['availability'] == 1)  echo 'selected=selected';?>>ԱՅՈ</option>
                            <option value="0" <?php if($product['availability'] == 0)  echo 'selected=selected';?>>ՈՉ</option>
                        </select>
                        <br/><br/>
                        <p>Рекомендуемые</p>
                        <select name="is_recommended">
                        <option value="1" <?php if($product['is_recomended'] == 1)  echo 'selected=selected';?>>ԱՅՈ</option>
                            <option value="0" <?php if($product['is_recomended'] == 0)  echo 'selected=selected';?>>ՈՉ</option>
                        </select>
                        <br/><br/>

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