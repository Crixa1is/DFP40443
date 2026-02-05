<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <header><h1>Quiz Complete!</h1></header>
        <form action="login.php" method= "POST"> 
        <p>Final score: </p>
        <h2>Review incorrect Answer: </h2>
        <div>
            <table >
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Your Answer</th>
                        <th>Correct Answer<th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>What does PHP stand for?</td>
                        <td>b</td>
                        <td>c</td>
                    </tr>
                    <tr>
                        <td>Which function start a session?</td>
                        <td>e</td>
                        <td>f</td>
                    </tr>
                    <tr>
                        <td>How do you define constant?</td>
                        <td>h</td>
                        <td>i</td>
                    </tr>
                </tbody>
            </table>
        <div>
            <br>
        <input type="submit" value="Restart quiz">
</form>
    </body>
</html>
