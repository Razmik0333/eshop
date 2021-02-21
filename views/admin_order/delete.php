<?php 
	include ROOT.'/views/parts/header-admin.php';
?>

    <div class="container cabinet">
        
        <h4>ՋՆՋԵԼ #<?php echo $id;?></h4>
        <p>ԴՈՒՔ ՑԱՆԿԱՆՈՒՄ ԵՔ ՋՆՋԵԼ ԱՅՍ ԿԱՏԵԳՈՐԻԱՆ</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить" />
        </form>
    </div>
    
    

<?php 
   require_once ROOT.'/views/parts/footer-admin.php';
?>