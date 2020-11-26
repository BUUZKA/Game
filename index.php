<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
    <?php
        session_start();
        require('./class/village.class.php');




        if(!isset($_SESSION['v']))
        {
            echo "Tworze nowa wioske";
            $v = new Village();
            $_SESSION['v'] = $v;

            $deltaTime = time();
        }
        else
        {
            $v = $_SESSION['v'];
            $deltaTime = time() - $_SESSION['time'];
        }
        $v->gain($deltaTime);
        $_SESSION['time'] = time();

        var_dump($v)
    ?>
    </pre>
</body>
</html>