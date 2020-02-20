<?php
	$connection = new PDO( "mysql:host=localhost; 
    dbname=forum; charset=utf8", 'root', '' );
	$data = $connection->query( "SELECT * FROM `comments` WHERE moderation='ok' ORDER BY  date DESC" );
	if ( $_POST[ 'text' ] ) {
		$username = htmlspecialchars( $_POST[ 'username' ] );
		$text = htmlspecialchars( $_POST[ 'text' ] );
		$time = date( 'Y-m-d H:i:s' );
		$connection->query( "INSERT into `comments` (`username` , `comment` ,`date` ) values ('$username','$text','$time')" );
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форум любителей форумов</title>
</head>
<body>
<style>
    body {
        margin: 50px;
        font-family: Arial, sans-serif;
    }

    input, textarea, button {
        margin: 15px;
        display: block;
        font-size: 30px;

    }
    .container{
        display: flex;
        align-items: center;
        border: 1px solid black;
    }
    .container .comment{
        margin-left: 30px;
    }
    .container .namedate{
       padding-right: 20px;
        border-right: 1px solid black;
    }
</style>
<h1>Форум любителей форумов</h1>
<form method="post">
    <input type="text" name="username" placeholder="Ваше имя" required>
    <textarea name="text" cols="30" rows="10"></textarea>
    <input type="submit" value="Отправить">
</form>
</body>

<?php
	foreach ( $data as $item ) {?>
    <div class="container">
        <h3 class="namedate"><?=$item['username']. ": " . $item['date']?></h3>
        <p class="comment"><?=$item['comment']?></p>
    </div>

	<?php } ?>
</html>
