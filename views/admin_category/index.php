<?php 
    require_once ROOT.'/views/parts/header-admin.php';
?>



    <div class="container product-list">
        <div class="col-2 mt-3"><a href="/admin/category/create"><i class='fa fa-plus'></i>ԱՎԵԼԱՑՆԵԼ</a></div>
        <div class="row mt-3">
            <div class="col-2">Id</div>
            <div class="col-2">ՀԵՐԹԱԿԱՆ ՀԱՄԱՐ</div>
            <div class="col-2">ԱՆՎԱՆՈՒՄ</div>
            <div class="col-2">ԹԱՐՄԱՑՆԵԼ</div>
            <div class="col-2">ՎԵՐԱՑՆԵԼ</div>
            <div class="col-2"></div>
        <?php foreach($categoryList as $item){?>
            <div class="col-2"><?php echo $item['id'];?></div>
            <div class="col-2"><?php echo $item['name'];?></div>
            <div class="col-2"><?php echo $item['arm_name'];?></div>
            <div class="col-2"><a href="/admin/category/update/<?php echo $item['id'] ?>"><i class='fa fa-edit'></i></a></div>
            <div class="col-2"><a href="/admin/category/delete/<?php echo $item['id'] ?>"><i class='fa fa-close'></i></a></div>
            <div class="col-2"></div>
        <?php }?>
        </div>

    </div>

<?php 
   require_once ROOT.'/views/parts/footer-admin.php';
?>