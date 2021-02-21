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
                        <input type="text" name="item_name" placeholder="" value="">

                        <p>Артикул</p>
                        <input type="text" name="code" placeholder="" value="">

                        <p>Стоимость, $</p>
                        <input type="text" name="cost" placeholder="" value="">

                        <p>Категория</p>
                        <select name="category" id="category">
                            <?php if (is_array($categoryList)): ?>
                                <option value="">
                                Ընտրեք կատեգորիան
                                    </option>
                                <?php foreach ($categoryList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['arm_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <br/><br/>
                        <p>Категория</p>
                        <select name="category_id" id="category-item">
                            <option>Ընտրեք կատեգորիան</option>
                        </select>
                        <br/><br/>

                        <p>Изображение товара</p>
                        <input type="file" name="image" placeholder="" value="">
                        <p>Детальное описание</p>
                        <textarea name="main"></textarea>
                        <br/><br/>
                        <p>Наличие на складе</p>
                        <select name="availabile">
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>
                        <br/><br/>
                        <p>Рекомендуемые</p>
                        <select name="is_recommended">
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
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