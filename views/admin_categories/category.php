<?php 
    require_once ROOT.'/views/parts/header-admin.php';
?>



    <div class="container product-list">
        <div class="col-2 mt-3"><a href="/admin/categories/create"><i class='fa fa-plus'></i>ԱՎԵԼԱՑՆԵԼ</a></div>
        <div class="row mt-3">
            <div class="col-2">Id</div>
            <div class="col-2">ԿԱՏԵԳՈՐԻԱՅԻ ՀԱՄԱՐ</div>
            <div class="col-2">ՀԵՐԹԱԿԱՆ ՀԱՄԱՐ</div>
            <div class="col-2">ԱՆՎԱՆՈՒՄ</div>
            <div class="col-2">ԹԱՐՄԱՑՆԵԼ</div>
            <div class="col-2">ՎԵՐԱՑՆԵԼ</div>
        <?php foreach($categoryListById as $item){?>
            <div class="col-2"><?php echo $item['id'];?></div>
            <div class="col-2"><?php echo $item['category'];?></div>
            <div class="col-2"><?php echo $item['category_id'];?></div>
            <div class="col-2"><?php echo $item['category_arm_name'];?></div>
            <div class="col-2"><a href="/admin/categories/update/<?php echo $item['id']?>/<?php echo $item['category']?>/<?php echo $item['category_id']?>"><i class='fa fa-edit'></i></a></div>
            <div class="col-2"><a href="/admin/categories/delete/<?php echo $item['id']?>"><i class='fa fa-close'></i></a></div>
        <?php }?>
        </div>

    </div>

<?php 
   require_once ROOT.'/views/parts/footer-admin.php';
?>