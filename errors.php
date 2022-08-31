<?php if(count($errors)>0): ?>
<div>
    <?php foreach($error as $errors): ?>
        <p><?php echo $error ?></p>
    <?php endforeach ?>
</div>
<?php endif ?>