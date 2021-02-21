<?php 
	include ROOT.'/views/parts/header-admin.php';
?>

    <div class="container cabinet">
        
        <h4>Удалит товар #<?php echo $id;?></h4>
        <p>Вы действительно хотите удалить этот товар?</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить" />
        </form>
    </div>
    
    

<?php 
   require_once ROOT.'/views/parts/footer-admin.php';
?>