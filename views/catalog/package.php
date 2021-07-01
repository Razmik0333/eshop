<?php 
    require_once ROOT.'/views/parts/header.php';


?>

<div class="container border border-warning rounded order-tabs">
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav ">
            <li class="nav-item nav-link active-tab">ԱՄԲՈՂՋ<span class="sr-only">(current)</span></li>
            <li class="nav-item nav-link" data-order="0">ԸՆԴՈՒՆՎԱԾ</li>
            <li class="nav-item nav-link"data-order="1">ՈՒՂԱՐԿՎԱԾ</li>
            <li class="nav-item nav-link"data-order="2">ԱՎԱՐՏՎԱԾ</li>
        </ul>
    </div>
    </nav>
    <div class="order-list">
    
    </div>

</div>

<?php 
   require_once ROOT.'/views/parts/footer.php';
?>