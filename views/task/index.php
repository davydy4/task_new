<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container theme-showcase" role="main">   
    <div class="page-header"><h1>Список заданий</h1></div>
    <p><a href='/task/add' class="btn btn-primary" role="button">Добавить задание</a></p>
    <form class="form-inline" action="/" method="post">
        <div class="form-group">
            <label>Сортировка по:</label>
            <select class="form-control" name="sortField">
                <option value="1" <?php if ($_SESSION['sort_field'] == 1) echo 'selected="selected"'; ?>>Имя</option>
                <option value="2" <?php if ($_SESSION['sort_field'] == 2) echo 'selected="selected"'; ?>>E-mail</option>
                <option value="3" <?php if ($_SESSION['sort_field'] == 3) echo 'selected="selected"'; ?>>Статус</option>
            </select>
        </div>
        <div class="form-group">
            <label>Тип:</label>
            <select class="form-control" name="sortOrganize">
                <option value="1" <?php if ($_SESSION['sort_organize'] == 1) echo 'selected="selected"'; ?>>По возрастанию</option>
                <option value="2" <?php if ($_SESSION['sort_organize'] == 2) echo 'selected="selected"'; ?>>По убыванию</option>
            </select> 
            <input class="btn btn-default" type="submit" name="submit" value="Сортировать">
        </div>
    </form>        
    <table class="table table-striped">
        <thead>       
            <tr>
                <td>Имя пользователя</td>
                <td>E-mail</td>
                <td>Текс</td>
                <td>Статус</td>
                <td></td>
                <?php if (!User::isGuest()) : ?>
                    <td></td>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($taskList as $taskItem) : ?>
                <tr class="<?php if ($taskItem['task_status']) echo 'success'; ?>">
                    <td><?php echo $taskItem['task_user_name'] ?></td>
                    <td><?php echo $taskItem['task_email'] ?></td>
                    <td><?php echo $taskItem['task_text'] ?></td>
                    <td>
                        <?php
                        if ($taskItem['task_status'])
                            echo "Выполнено";
                        else
                            echo "Новое";
                        ?>
                    </td>

                    <?php if (!User::isGuest()) : ?>
                        <td>
                            <a href="/task/edit/<?php echo $taskItem['task_id'] ?>" class="btn btn-warning" role="button">Редактировать</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>  
        </tbody>
    </table>
    <p><?php echo $pagination->get(); ?></p>
</div>   

<?php include ROOT . '/views/layouts/footer.php'; ?>