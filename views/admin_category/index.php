<?php 
    require_once ROOT.'/views/parts/header-admin.php';
?>



    <div class="container category-list">
        <div class="col-2 mt-3"><a href="/admin/category/create" class="create-category"><i class='fa fa-plus'></i>ԱՎԵԼԱՑՆԵԼ</a></div>
        <div class="row mt-3">
            <div class="col-2">Id</div>
            <div class="col-2">ՀԵՐԹԱԿԱՆ ՀԱՄԱՐ</div>
            <div class="col-2">ԱՆՎԱՆՈՒՄ</div>
            <div class="col-2">ԹԱՐՄԱՑՆԵԼ</div>
            <div class="col-2">ՎԵՐԱՑՆԵԼ</div>
            <div class="col-2"></div>
        <?php foreach($categoryList as $item){?>
            <div class="col-2"><?php echo $item['id'];?></div>
            <div class="col-2"><?php echo $item['alias'];?></div>
            <div class="col-2"><?php echo $item['arm_name'];?></div>
            <div class="col-2"><a href="/admin/category/update/<?php echo $item['id'] ?>" class="fa fa-edit update-category" data-update="<?php echo $item['id']?>"></a></div>
            <div class="col-2"><a href="/admin/category/delete/<?php echo $item['id'] ?>" class="fa fa-close delete-category" data-delete="<?php echo $item['id'] ?>"></a></div>
            <div class="col-2"></div>
        <?php }?>
        </div>

    </div>
    <div class="modal">
				
    </div>
<?php 
   require_once ROOT.'/views/parts/footer-admin.php';
?>