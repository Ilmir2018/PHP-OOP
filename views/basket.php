<h1>Корзина</h1>
<a href="/main">
    Главная
</a>
<style>
    * {
        font-size: 20px;
    }
    .product{
        display: flex;
        width: 1200px;
        height: 200px;
        margin-right: 20px;
        border: solid 1px black;
    }
    h1{
        margin: 0 20px 0 20px;
    }
    h2{
        margin: 0 20px 0 20px;
    }
    p{
        margin: 0 20px;
    }
</style>
<div class="container">
    <?php foreach ($baskets as $basket):  if ($session[$basket->id]['qty'] == 0) {continue;}?>
        <div class="product">
            <h1><?=$basket->id?></h1>
            <img width="300" height="200" src="images/small/<?= $basket->img . '.png'?>" alt="Фото">
            <h2><?=$basket->name?></h2>
            <p><?=$basket->description?></p>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?=$basket->id?>"/>
                <input type="submit" value="Удалить из корзины" name = 'submitDellBasket'>
            </form>
            <p>Количество: <?=$session[$basket->id]['qty']?></p>
            <p>Сумма:<?=$basket->price*$session[$basket->id]['qty']?></p>
        </div>
    <?php endforeach; ?>
    <p>Общая сумма заказа: <?=$_SESSION['allSum']?></p>
    <form action="order" method="post">
        <input type="submit" value="Оформить заказ" name = 'placeYourOrder'>
    </form>
</div>
