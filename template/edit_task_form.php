<div class="modal fade modal_editTask" id="modal_editTask" tabindex="-1" role="dialog" aria-labelledby="editTask_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editTask_label">Новая задача</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" class="form-row form-editTask">
                    <div class="col editTask">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" name="name_userInp" id="name_userInp" class="form-control name_userInp" placeholder="Иван" readonly>
                        </div>
    
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email_userInp" id="email_userInp" class="form-control email_userInp" placeholder="test@mail.ru" aria-describedby="emailHelp" readonly>
                        </div>
                    </div>
    
                    <div class="col editTask">
                        <label for="task">Задача</label>
                        <textarea name="task_userInp" id="task_userInp" cols="30" rows="4" class="form-control task_userInp"></textarea>
                    </div>
    
                    <div class="form-group btnWrap">
                        <button type="button" class="btn btn-success">Сохранить задачу</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>