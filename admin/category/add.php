<?php
session_start();

require_once ('../../lib/Helper.php');
require_once ('../../lib/Validation.php');
require_once ('../../lib/MysqlDriver.php');

if (empty($_SESSION['admin'])) {
    Helper::redirect('../index');
}



use Ibrahim\MysqliDatabaseWrapper\MysqlDriver;
use Validation\Validation;
$success = '';
if (isset($_POST['name']) && !empty($_POST['name'])) {

    $valid = new Validation();
    $successful = $valid->value($_POST['name'])->string()->required()->successful();

    if ($successful === true) {

        $connection = new MysqlDriver('localhost','root','','cms');
        $data = [
            'name' => $_POST['name'],
            'admin_id' => $_POST['adminId']
        ];

        $connection
            ->insUp('INSERT INTO','category',$data)
            ->execute();

        $success = 'Data Is Inserted Successfully';

        Helper::redirect('index',1);
    }

}

include '../header.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blank Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <?php if (strlen($success) > 0) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= $success; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>

                        <input type="hidden" name="adminId" value="<?= $_SESSION['admin']; ?>">
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<?php include '../footer.php'; ?>