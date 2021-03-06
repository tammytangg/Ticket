<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="plugin/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php
$logged_flag=false;
session_start();
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(isset($_SESSION['user_id'])){
    $logged_flag=true;
}

require_once "DBManager.php";
/**
 * Created by PhpStorm.
 * User: tammy
 * Date: 17/2/21
 * Time: 22:53
 */
$con = DBManager::getInstance()->getConnection();

$flag_success=false;
$msg='';

$sql="SELECT * FROM `Event` LIMIT 5";

$result=mysqli_query($con,$sql);
$html_str="";




?>



<body>
<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php
                    if ($logged_flag){
                        echo '<a href="#" >My Page</a>';
                    }else{
                        echo '<a href="#" data-toggle="modal" data-target="#modal-login">Log In</a>';
                    }
                    ?>
                </li>
                <li>
                    <?php
                    if ($logged_flag){
                        echo '<a href="logout.php">Log Out</a>';
                    }else{
                        echo '<a href="register.php">Sign Up</a>';
                    }
                    ?>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="header">
        <div id="myCarousel" class="carousel slide">
            <!-- 轮播（Carousel）指标 -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- 轮播（Carousel）项目 -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="img/fullimage1.jpg" alt="First slide">
                </div>
                <div class="item">
                    <img src="img/fullimage2.jpg" alt="Second slide">
                </div>
                <div class="item">
                    <img src="img/fullimage3.jpg" alt="Third slide">
                </div>
            </div>

        </div>
    </div>
    <div class="main-container">
        <h1 class="title">Events</h1>
        <hr/>
        <?php
        $count=1;
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
       ?>
                <div class="event-container">
                    <?php
                    echo '<input name="event_id" type="hidden" value="'.$row['id'].'"/>'
                    ?>
                    <div class="media">
                        <div class="media-body">
                            <h2 class="media-heading"><?php
                    echo $row['title'];?></h2>
                    <p><?php
                        echo $row['introduction'];?>
                        </p>
                </div>
                <div class="media-right">
                    <a href="#">
                        <img class="media-object" src="img/small<?php
                        echo $count;
                        ?>.jpg" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <hr/>
        <?php
                $count++;
            }
        }
        ?>
    </div>
</div>

<footer>
    <ul class="share-group">
        <li>item1</li>
        <li>item2</li>
        <li>item3</li>
        <li>item4</li>
        <li>item5</li>
    </ul>
    <div class="copy">
        &copy;Contact Information: <a href="mailto:tammytangg@gmail.com">tammytangg@gmail.com</a>
    </div>
</footer>

<!-- 模态框（Modal） -->
<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Log In</h4>
            </div>
            <div class="modal-body">
                <p>Please enter your email and password.</p>
                <form id="form-login" action="login.php" method="post">
                    <div class="form-group">
                        <label for="inputEmail">Email:</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="user@email.com">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password:</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-modal-login" type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Log In</button>
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugin/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script>
    $(function(){
        $('#btn-modal-login').click(function(){
            $('#form-login').submit();
        });

        $('.event-container').click(function(){
            var event_id=$(this).find('input[name="event_id"]').val();
            alert(event_id);
            location.href="booking.php?event_id="+event_id;
        });
    });

</script>
</body>
</html>