<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\LoginForm;
use app\models\User;

$identity=new LoginForm();
$identity->username='cgrillo';
$identity->password='cg*264213';
$identity->login();

AppAsset::register($this);

$assetDir = Yii::$app->assetManager->baseUrl.'/../dist/' ;

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>	
<div class="wrapper">

  <?= $this->render('parts/navbar', ['assetDir' => $assetDir]) ?>

  <?= $this->render('parts/sidebar', ['assetDir' => $assetDir]) ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?= $content ?>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="row">
        <div class="col-12 col-md-2 text-left">    
            www.wearecontent.com
            <p>Valor: 200 créditos</p>
        </div> 
        <div class="col-12 col-md-5">    
            <div class="wizard">
                    <ul class="step d-flex flex-nowrap">
                      <li class="step-item step-1 active">
                          <a href="#!" class="step-click"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                      </li>
                      <li class="step-item step-2">
                        <a href="#!" class="step-click"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                      </li>
                    </ul> 
            </div>
        </div>         
        <div class="col-12 col-md-5">    
            <!-- To the right -->
            <div class="text-right">
              <button type="button" class="btn btn-primary step-1">Siguiente</button>
            </div>
            <div class="text-right">
              <button type="button" class="btn btn-primary step-2 previus" style="display: none;">Anterior</button>        
              <button type="button" class="ml-5 btn btn-primary step-2 register" style="display: none;">Registrar</button>
            </div>

        </div>           
    </div>    
  </footer>
</div>
<!-- ./wrapper -->
<!-- Modal -->
<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <i class="check-modal far fa-check-circle"></i>
        <p>Gracias por registrar su red social</p>
      </div>
      <div class="modal-footer align-self-center">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>