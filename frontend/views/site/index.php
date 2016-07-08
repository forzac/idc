<h1>HOME PAGE</h1>
<?php if (Yii::$app->session->hasFlash('success')) { ?>
    <div class="alert alert-success">
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php } elseif (Yii::$app->session->hasFlash('error')) {?>
    <div class="alert alert-danger">
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php } ?>
    <?php echo Yii::$app->user->identity['id'];  ?>


<?php


$steve = [
    'name' => 'Denis',
    'age' => 24,
    'languages' => [
        'english',
        'french'
    ],
    'company' => [
        'name' => 'Apple',
        'year' => 1976
    ]
];

$con = new MongoClient();
$list = $con->test->user;
$list->insert($steve);
$con->close();


?>