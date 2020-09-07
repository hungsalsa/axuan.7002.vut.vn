<?php
/* @var $this yii\web\View */
?>
<?php 
      	$user =  Yii::$app->user->identity->username;
      	$auth_key =  Yii::$app->user->identity->auth_key;
      	?>
        <iframe  width="90%" height="450" frameborder="0"
            src="../../../filemanager/dialog.php?type=1&field_id=imageFile&akey=<?= md5($user.$auth_key) ?>">
        </iframe>