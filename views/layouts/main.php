<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\LteAsset;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;

LteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode("Welcome to NDCH System") ?></title>
        <!--<title><?= Html::encode($this->title) ?></title>-->
        <?php $this->head() ?>
    </head>
    <!--    <body class="skin-blue sidebar-mini">-->
    <body class="skin-blue sidebar-mini">
        <?php $this->beginBody() ?>

        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                     <!--mini logo for sidebar mini 50x50 pixels--> 
                    <span class="logo-mini"><b>NDCH</b> System</span>
                     <!--logo for regular state and mobile devices--> 
                    <span class="logo-lg"><b>NDCH</b> System</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu"><div></div>
                        <ul class="nav navbar-nav">
                            <?php
                            if (Yii::$app->user->isGuest) {
                                echo '<li><a href="' . Url::to(['/site/login']) . '">Login</a></li>';
                            } else {
                                echo '<li><a href="' . Url::to(['/site/logout']) . '">Logout(' . Yii::$app->user->identity->username . ')</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li>
                            <a href="index.php">
                                <i class="fa fa-dashboard"></i> 
                                <span>Home</span>
                            </a>
                        </li>
                        <?php if (Yii::$app->user->can('/weather-data/index')) { ?>
                            <li>
                                <a href="<?php echo Url::to(['/weather-data/']); ?>">
                                    <i class="fa fa-bar-chart"></i>
                                    <span>Station Data</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (Yii::$app->user->can('/aws-vaisala/index') || Yii::$app->user->can('/aws-seba/index')) { ?>
                            <li>
                                <a href="<?php echo Url::to(['/aws-vaisala/']); ?>">
                                    <i class="fa fa-database"></i>
                                    <span>VAISALA Data</span>
                                </a>
                            </li>
                            <li><a href="<?php echo Url::to(['/aws-seba/']); ?>">
                                    <i class="fa fa-cube"></i>
                                    <span>SEBA Data</span>
                                </a>
                            </li>

                            <!--//DATA MANAGEMENT MENU-->
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-cog"></i>
                                    <span>Data Management</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="<?php echo Url::to(['/data-management/import-aws-data']); ?>">
                                            <i class="fa fa-circle-o"></i>Import AWS Data
                                        </a>
                                    </li>
<!--                                    <li>
                                        <a href="<?php // echo Url::to(['/weather-data/process']); ?>">
                                            <i class="fa fa-circle-o"></i> 
                                            Process Previous Data
                                        </a>
                                    </li> -->
                                </ul>
                            </li>
                        <?php } ?>


                        <?php
                        if (Yii::$app->user->can('Super Systems Admin')) {
                            echo '<li class="treeview">
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                <span>Setup</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?r=stakeholder"><i class="fa fa-circle-o"></i>
                                        Stakeholders</a></li>
                                <li><a href="index.php?r=station"><i class="fa fa-circle-o"></i> 
                                        Stations</a></li> <li><a href="index.php?r=data-sources"><i class="fa fa-circle-o"></i> 
                                        Data Sources</a></li><li><a href="index.php?r=weather-elements"><i class="fa fa-circle-o"></i> 
                                        Weather Elements</a></li>
                                <li><a href="index.php?r=region"><i class="fa fa-circle-o"></i>
                                        Regions</a></li>
                                <li><a href="index.php?r=district"><i class="fa fa-circle-o"></i>
                                        Districts</a></li> 
                                <li><a href="index.php?r=ward"><i class="fa fa-circle-o"></i>
                                        Wards</a></li>
                            </ul>
                        </li>';
                        }
                        ?>

                        <?php
                        if (Yii::$app->user->can('Super Systems Admin')) {
                            echo '<li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>System Security</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?r=user/index"><i class="fa fa-circle-o"></i>
                                        User Management</a></li>
                                <li><a href="index.php?r=logins/index"><i class="fa fa-circle-o"></i>
                                        Login History</a></li>
                                <li><a href="index.php?r=user-audit-trail/index"><i class="fa fa-circle-o"></i>
                                        Audit Trail</a></li>
                                <li><a href="index.php?r=logins-attempt/index"><i class="fa fa-circle-o"></i>
                                        Login Attempts</a></li>
                                <li><a href="index.php?r=admin/role"><i class="fa fa-circle-o"></i> 
                                        Roles</a></li>
                                <li><a href="index.php?r=admin/permission"><i class="fa fa-circle-o"></i>
                                        Permission</a></li>
                                <li><a href="index.php?r=admin/route"><i class="fa fa-circle-o"></i>
                                        Routes</a></li>
                            </ul>
                        </li>';
                        }
                        ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>

                    <?= $content ?>
                </section>
            </div>

            <footer class="main-footer"  >
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.1
                </div>
                <strong>Copyright &copy; <?= '2016 - ' . Date('Y') ?> &nbsp;&nbsp;
                    <a href="#">PMO - DMD</a>.
                </strong>
                All rights reserved.          
            </footer>   
        </div>  
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>