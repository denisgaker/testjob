<div class="modal fade modal_addNewTask" id="modal_addNewTask" tabindex="-1" role="dialog" aria-labelledby="addNewTask_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addNewTask_label">Новая задача</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>

            <div class="modal-body">
                <form action="" class="form-row form-addNewTask">
                    <div class="col addNewTask">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" name="name_userInp" id="name_userInp" class="form-control name_userInp" placeholder="Иван" required>
                        </div>
    
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email_userInp" id="email_userInp" class="form-control email_userInp" placeholder="test@mail.ru" aria-describedby="emailHelp" required>
                        </div>
                    </div>
    
                    <div class="col addNewTask">
                        <label for="task">Задача</label>
                        <textarea name="task_userInp" id="task_userInp" cols="30" rows="4" class="form-control task_userInp"></textarea>
                    </div>
    
                    <div class="form-group btnWrap">
                        <div class="form-check">
                            <input type="checkbox" name="success" id="success" class="form-check-input" checked>
                            <label for="success" class="form-check-label">Нажимая на кнопку "Сохранить задачу" Вы соглашаетесь с <a href="">правилами</a> обработки персональных данных и <a href="">политикой</a> конфидециальности</label>
                        </div>
    
                        <button type="button" class="btn btn-success" onclick="task.add();">Сохранить задачу</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>