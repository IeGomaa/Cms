<?php

session_start();
require_once ('../../lib/MysqlDriver.php');
require_once ('../../lib/Helper.php');
if (empty($_SESSION['admin'])) {
    Helper::redirect('../index');
}

use Ibrahim\MysqliDatabaseWrapper\MysqlDriver;
$connection = new MysqlDriver('localhost','root','','cms');

$data = $connection
    ->select()
    ->columns('`category`.`id`,`category`.`name`,`admins`.`name` as `admin_name`')
    ->table('category')
    ->join('admins')
    ->on('category','admin_id','admins','id')
    ->execute()
    ->fetchAll();


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
                <h3 style="padding: 7px 20px 0 0" class="card-title">Category Table</h3>

                <a href="add.php">
                    <button class="btn btn-light">
                        Add New Category
                    </button>
                </a>


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


                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>name</th>
                                    <th>Admin Name</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $category): ; ?>
                                    <tr>
                                        <td><?= $category['id'] ;?></td>
                                        <td><?= $category['name'] ;?></td>
                                        <td><?= $category['admin_name'] ;?></td>
                                        <td>
                                            <a href="update.php?id=<?= $category['id']; ?>">
                                                <button>Update</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="delete.php?id=<?= $category['id']; ?>">
                                                <button>Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>



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