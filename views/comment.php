<form action="" enctype="multipart/form-data" method="post">
    <h3>Ваше имя</h3>
    <input type="text" name="name">
    <h3>Введите свой отзыв пожалуйста:</h3>
    <textarea name="content" id="" cols="30" rows="10"></textarea>
    <input type="submit" name="submitAddComment">
</form>

<?php
foreach ($comments as $comment){
?>
<p>Имя: <?=$comment->name?></p>
    <p>Коментарий: <?=$comment->content?></p>
<?php }?>