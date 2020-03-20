<style>
    .container{
        display: flex;
        flex-wrap: wrap;
    }
    .product{
        display: inline-block;
        width: 300px;
        height: 300px;
        margin: 0 10px;
        border: solid 1px black;
    }
    .form{
        display: inline-block;
        width: 300px;
        height: 50px;
    }
    h1{
        margin: 0 50px 0 50px;
    }
    p {
        margin: 0 50px 0 50px;
    }
</style>
<div class="container">
    <?php foreach ($products as $product):?>
        <div class="product">
            <a href="product/card?id=<?=$product->id?>">
                <h1><?=$product->name?></h1>
                <p><?=$product->name?></p>
                <img width="300" height="200" src="images/small/<?= $product->img . ".png"?>" alt="Фото">
            </a>
        </div>
        <div class="form">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?=$product->id?>"/>
                <input type="submit" value="Добавить в корзину" name="submitAddBasket">
            </form>
        </div>
    <?php endforeach;?>
</div>