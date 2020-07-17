<div class="modal fade modal_auth" id="modal_auth" tabindex="-1" role="dialog" aria-labelledby="auth_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="bg-danger authDanger">
                <p class="text-white">Для совершения данного действия необходимо авторизоваться</p>
            </div>

            <div class="modal-header">
                <h5 class="modal-title" id="auth_label">Авторизация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" class="form-auth">
                    <div class="form-group">
                        <label for="authInp_login">Логин</label>
                        <input type="text" name="authInp_login" id="authInp_login" class="form-control authInp">
                    </div>

                    <div class="form-group">
                        <label for="authInp_password">Пароль</label>
                        <input type="text" name="authInp_password" id="authInp_password" class="form-control authInp">
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-success" onclick="auth();">Войти</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>