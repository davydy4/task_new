<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container theme-showcase" role="main">   
    <div class="page-header"><h1>Добавить задание</h1></div>
    <?php if ($errors) : ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <p>
        <a href='/task/add' class="btn btn-primary" role="button">Добавить задание</a>
    </p>
    <?php if ($result): ?>
        <div class="alert alert-success" role="alert">
            <p>Задание добавлено!</p>
        </div>
    <?php else : ?>  
        <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data" id="form1" runat="server">
            <div class="form-inline">
                <label>Имя:</label><br>
                <input type="text" placeholder="Имя" name="name" value="<?php echo $name ?>" class="form-control" id="name">
            </div>  
            <div class="form-inline">
                <label>Текст задания:</label><br>
                <textarea name="text" cols="40" rows="5" placeholder="Текст задания" class="form-control" id="text"><?php echo $text ?></textarea>
            </div>    
            <div class="form-inline">
                <label>E-mail:</label><br>
                <input type="email" placeholder="E-mail" name="email" value="<?php echo $email ?>" class="form-control" id="email">
            </div>
            <div class="form-inline">
                <input type="submit" name="submit" value="Сохранить" class="btn btn-default">
            </div>  
        </form>
    <?php endif; ?>
</div> 

<?php include ROOT . '/views/layouts/footer.php'; ?>