<h1>Здравствуйте <?=$_SESSION['user_name']?>!</h1>
<p>Ваши заказы:</p>

<?php foreach ($orders as $order):
    if ($order->user_id == $_SESSION['user_id']) : ?>
        <div class="order">
            <p>Заказ №<?=$order->id?> на сумму <?=$order->price?></p>
            <div  class="form">
                <form action="order" method="post">
                    <input type="hidden" name="id" value="<?=$order->id?>"/>
                    <input type="submit" value="Отменить заказ" name = 'deleteYourOrder'>
                </form>
            </div>
        </div>
    <? endif; endforeach;?>
