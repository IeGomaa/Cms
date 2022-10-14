<?php

session_start();
require_once ('../../lib/MysqlDriver.php');
require_once ('../../lib/Helper.php');
if (empty($_SESSION['admin'])) {
    Helper::redirect('../index');
}



use Ibrahim\MysqliDatabaseWrapper\MysqlDriver;

$connection = new MysqlDriver('localhost','root','','cms');

if (isset($_GET['id'])) {
    $data = $connection
        ->select()
        ->columns('*')
        ->table('content')
        ->where()
        ->operations('id','=',$_GET['id'])
        ->execute()
        ->fetch();

    $category = $connection
        ->select()
        ->columns('*')
        ->table('category')
        ->execute()
        ->fetchAll();
}

if (isset($_POST['name']) && !empty(isset($_POST['name']))) {

    $cover_name = $_FILES['cover']['name'];
    $cover_tmp = $_FILES['cover']['tmp_name'];

    unlink('../../assets/upload/' . $_POST['oldImage']);
    move_uploaded_file($cover_tmp, '../../assets/upload/' . $cover_name);

    $data = [
        'name' => $_POST['name'],
        'main_content' => $_POST['main_content'],
        'description' => addslashes($_POST['description']),
        'cover' => $cover_name,
        'category_id' => $_POST['category']
    ];

    $connection
        ->insUp('UPDATE','content',$data)
        ->where()
        ->operations('id','=',$_POST['id'])
        ->execute();

    Helper::redirect('index');

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
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Content Name</label>
                                <input type="text" value="<?= $data['name']; ?>" name="name" class="form-control">
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>Content Name</label>
                                <input type="text" value="<?= $data['main_content']; ?>" name="main_content" class="form-control">
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="summernote" name="description">
                                    <?= $data['description']; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="cover">
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select name="category">
                                    <?php foreach ($category as $val) : ?>
                                        <option value="<?= $val['id']; ?>">
                                            <?= $val['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <input type="hidden" name="oldImage" value="<?= $data['cover']; ?>">
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