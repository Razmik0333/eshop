<?php 
	require_once ROOT.'/views/parts/header.php';
?>
<?php if(!User::isGuest()){?>
    <div class="container cabinet">
        <h5>Բարև <?php echo $user['name']?></h5>
        <?php if($user['role']=='admin'){?>
            <ul class="nav justify-content-start">
                <li class="nav-item">
                    <a class="nav-link" href="/cabinet/edit">ՓՈԽԵԼ ԱՆՁՆԱԿԱՆ ՏՎՅԱԼՆԵՐԸ</a>
                    <a class="nav-link" href="/admin">ՄՈՒՏՔ ԳՈՐԾԵԼ ԱԴՄԻՆ ԷՋ</a>
                </li>
            </ul>
        <?php }else{?>
            <ul class="nav justify-content-start">
                <li class="nav-item">
                    <a class="nav-link" href="/cabinet/edit">ՓՈԽԵԼ ԱՆՁՆԱԿԱՆ ՏՎՅԱԼՆԵՐԸ</a>
                </li>
            </ul>
        <?php }?>
    </div>
<?php } else{ ?>
    <div class="container cabinet">
        <h5>Դուք մուտք չեք գործել համակարգ</h5>
        <ul class="nav justify-content-start">
            <li class="nav-item">
                <a class="nav-link" href="login.php">ՄՈՒՏՔ</a>
            </li>
        </ul>
    </div>
<?php }?>
<?php 
   require_once ROOT.'/views/parts/footer.php';
?>