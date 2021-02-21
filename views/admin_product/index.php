<?php 
	require_once ROOT.'/views/parts/header-admin.php';
?>



    <div class="container product-list">
        <div class="col-2 mt-3"><a href="/admin/product/create"><i class='fa fa-plus'></i>ԱՎԵԼԱՑՆԵԼ</a></div>
        <div class="row mt-3">
            <div class="col-2">Id</div>
            <div class="col-2">ԱՐՏԻԿՈՒԼ</div>
            <div class="col-2">ԱՆՎԱՆՈՒՄ</div>
            <div class="col-2">ԳԻՆ</div>
            <div class="col-2">ԹԱՐՄԱՑՆԵԼ</div>
            <div class="col-2">ՎԵՐԱՑՆԵԼ</div>
        <?php foreach($productList as $item){?>
            <div class="col-2"><?php echo $item['id'];?></div>
            <div class="col-2"><?php echo $item['1c_articul'];?></div>
            <div class="col-2"><?php echo $item['description'];?></div>
            <div class="col-2"><?php echo $item['cost'].'&#1423;';?></div>
            <div class="col-2"><a href="/admin/product/update/<?php echo $item['id'] ?>"><i class='fa fa-edit'></i></a></div>
            <div class="col-2"><a href="/admin/product/delete/<?php echo $item['id'] ?>"><i class='fa fa-close'></i></a></div>
        <?php }?>
        </div>
    </div>

<?php 
   require_once ROOT.'/views/parts/footer-admin.php';
?>