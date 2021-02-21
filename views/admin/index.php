<?php 
	require_once ROOT.'/views/parts/header-admin.php';
?>
    <div class="container cabinet">
        <h5>ԲԱՐև ԱԴՄԻՆԻՍՏՐԱՏՈՐ</h5>
        ԴՈՒՔ ՈՒՆԵՔ ՀԵՏևՅԱԼ ՀՆԱՐԱՎՈՐՈՒԹՅՈՒՆՆԵՐԸ
        <ul class="nav justify-content-start">
            <li class="nav-item">
                <a class="nav-link" href="/admin/product">ՓՈԽԵԼ ԱՊՐԱՆՔՆԵՐԸ</a>
                <a class="nav-link" href="/admin/category">ՓՈԽԵԼ ԿԱՏԵԳՈՐԻԱՆԵՐԸ</a>
                <a class="nav-link" href="/admin/categories">ՓՈԽԵԼ ԿԱՏԵԳՈՐԻԱՆԵՐԻ ԽՄԲԵՐԸ</a>
                <a class="nav-link" href="/admin/order">ՓՈԽԵԼ ՊԱՏՎԵՐՆԵՐԸ</a>
            </li>
        </ul>
    </div>

<?php 
   require_once ROOT.'/views/parts/footer-admin.php';
?>