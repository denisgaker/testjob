<?
header("Content-Type: text/html; charset: utf-8");
?>
<? include 'template/header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Тестовое задание | Список задач | Денис Гакер</h1>
            </div>
        </div>

        <? include 'template/template.php'; ?>
    </div>

<?
include 'template/add_new_task_form.php';
include 'template/edit_task_form.php';
include 'template/auth_form.php';
include 'template/footer.php';
?>