<?php 
require_once 'config/app_config.php';
require_once 'includes/header.php';

$questions=[
    ['questions' => 'What does PHP stands for?', 'answer' => 'Hypertext Processor'],
    ['questions' => '', 'answer' => 'Hypertext Processor'],
    ['questions' => 'What does PHP stands for?', 'answer' => 'Hypertext Processor']
];

if(!isset ($_SESSION['soalanSemanasa'])){
    $_SESSION['soalanSemasa'] = 0;
    $_SESSION['score'] = 0;

}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userAnswer = $_POST['answer'];
    $currentQ = $_SESSION['soalansemasa'];

    $correctAnswer = $questions[$currentQuestion['answer']];

    if(strcasecmp($userAnswer,$correctAnswer) === 0){
    $_SESSION['score']++;
}
    $_SESSION['soalanSemasa']++;

    if($_SESSION['soalanSemasa']>= count($questions)){
        header('Location: finish.php');
        exit;
    }
header('Location: Q1.php');
exit;
}

$currentIndex = $_SESSION['soalanSemasa'];

$currentQuestion = $questions[$currentIndex];
?>
User:<?php echo htmlspecialchars($_SESSION['username']);?><br>
Score: <?php echo $_SESSION['score'] ?>

<h1>Question 1: </h1>
<p>What does PHP stand for? </p>
<form action="finish.php" method="POST">
    <p></p>
    <input type="text" name="" id=""> <br><br>
    <input type="text" name="" id=""> <br><br>
    <input type="text" name="" id=""> <br><br>

    <input type="submit" value="Finish Attempt">

<?php 
require_once 'includes/footer.php'
?>