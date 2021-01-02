<?php
//namespace hail812\adminlte3\widgets;

use app\widgets\Menu;

?>
<aside class="main-sidebar">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Influencers</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block"><?= Yii::$app->user->identity->email ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo Menu::widget([
                'items' => [
                    ['label' => 'Panel', 'header' => true],
                    ['label' => 'Notificaciones',  'active'=>false,'icon' => 'file-code', 'url' => ['site/index']],
                    ['label' => 'Mis recursos', 'active'=>true, 'icon' => 'file-code', 'url' => ['site/index']],
                    ['label' => 'Propuestas', 'active'=>false, 'icon' => 'file-code', 'url' => ['site/index']],
                    ['label' => 'Compesar', 'active'=>false, 'icon' => 'file-code', 'url' => ['site/index']],
                    ['label' => 'Cuenta', 'active'=>false, 'icon' => 'file-code', 'url' => ['site/index']],                                                            
                ]]);                
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>