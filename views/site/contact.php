<?php 
  require ROOT. '/views/parts/header.php';
?>
    <div class="container welcome">
                <form class="form text-dark" id="form"  method="POST" action="#">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="userEmail" value="Raz@nck.ru">
                    </div>
                
                    <div class="form-group col-sm-6">
                        <label for="inputPassword4">Введите сообщения </label>
                        <input type="text" class="form-control" id="inputPassword4" placeholder="Текст" name="userText" value="Hello">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary position-relative" style="left:15px">Sign Up</button>
                </form>
       </div>
<?php 
  require ROOT. '/views/parts/footer.php';
?>