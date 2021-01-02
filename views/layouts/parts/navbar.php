<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\web\Controller;
use yii\helpers\ArrayHelper;

use app\models\Influencers;

$model = Influencers::findOne(1);
?>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
	<div class="wrapper-header">
		<div class="row">
			<div class="col-6 mt-2">
				<label>Créditos ganados:</label> <?= $model->credits_earned; ?>
			</div>
			<div class="col-6 mt-2">
				<label>Créditos disponibles:</label> <?= $model->available_credits; ?>
			</div>		
		</div>
	</div>    
  </nav>

