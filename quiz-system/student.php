<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'student') {
    header("Location: index.php");
    exit();
}

$student_id = $_SESSION['user_id'];

// Fetch quizzes and attempts left for each quiz
$quizzes = $conn->query("
    SELECT q.*, 
    COALESCE(a.attempts_left, q.attempts) AS attempts_left 
    FROM quizzes q 
    LEFT JOIN attempts a 
    ON q.id = a.quiz_id 
    AND a.student_id = $student_id 
    WHERE q.deadline >= NOW()
");

if (isset($_POST['start_quiz'])) {
    $quiz_id = $_POST['quiz_id'];

    // Check if the student already has attempts recorded for the quiz
    $stmt = $conn->prepare("
        SELECT attempts_left 
        FROM attempts 
        WHERE quiz_id = ? 
        AND student_id = ?
    ");
    $stmt->bind_param("ii", $quiz_id, $student_id);
    $stmt->execute();
    $stmt->bind_result($attempts_left);
    $stmt->fetch();
    $stmt->close();

    if ($attempts_left === null) {
        // Initialize attempts for the first time
        $stmt = $conn->prepare("
            SELECT attempts 
            FROM quizzes 
            WHERE id = ?
        ");
        $stmt->bind_param("i", $quiz_id);
        $stmt->execute();
        $stmt->bind_result($attempts);
        $stmt->fetch();
        $stmt->close();

        $attempts_left = $attempts;
        $stmt = $conn->prepare("
            INSERT INTO attempts (student_id, quiz_id, attempts_left) 
            VALUES (?, ?, ?)
        ");
        $stmt->bind_param("iii", $student_id, $quiz_id, $attempts_left);
        $stmt->execute();
        $stmt->close();
    }

    // Check if attempts are available
    if ($attempts_left > 0) {
        $questions = $conn->query("SELECT * FROM questions WHERE quiz_id = $quiz_id");
    } else {
        echo "No attempts left for this quiz.";
    }
}

if (isset($_POST['take_quiz'])) {
    $quiz_id = $_POST['quiz_id'];

    // Check attempts left before processing the quiz
    $stmt = $conn->prepare("
        SELECT attempts_left 
        FROM attempts 
        WHERE quiz_id = ? 
        AND student_id = ?
    ");
    $stmt->bind_param("ii", $quiz_id, $student_id);
    $stmt->execute();
    $stmt->bind_result($attempts_left);
    $stmt->fetch();
    $stmt->close();

    if ($attempts_left > 0) {
        // Process the quiz
        $score = 0;
        foreach ($_POST['answers'] as $question_id => $answer) {
            $stmt = $conn->prepare("
                SELECT correct_answer 
                FROM questions 
                WHERE id = ?
            ");
            $stmt->bind_param("i", $question_id);
            $stmt->execute();
            $stmt->bind_result($correct_answer);
            $stmt->fetch();
            $stmt->close();

            if ($correct_answer == $answer) {
                $score++;
            }
        }

        $total_items = count($_POST['answers']);
        $stmt = $conn->prepare("
            INSERT INTO results (student_id, quiz_id, score, total_items, submission_time) 
            VALUES (?, ?, ?, ?, NOW())
        ");
        $stmt->bind_param("iiii", $student_id, $quiz_id, $score, $total_items);
        $stmt->execute();
        $stmt->close();

        // Decrement the attempts left
        $stmt = $conn->prepare("
            UPDATE attempts 
            SET attempts_left = attempts_left - 1 
            WHERE student_id = ? 
            AND quiz_id = ?
        ");
        $stmt->bind_param("ii", $student_id, $quiz_id);
        $stmt->execute();
        $stmt->close();

        echo "Quiz completed! Your score: " . $score . "/" . $total_items;
    } else {
        echo "No attempts left for this quiz.";
    }
}

$results = $conn->query("
    SELECT q.title, r.score, r.total_items, r.submission_time 
    FROM results r 
    JOIN quizzes q ON r.quiz_id = q.id 
    WHERE r.student_id = $student_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body>
    <h2>Take Quiz</h2>
    <form method="post" action="">
        <select name="quiz_id">
            <?php while ($row = $quizzes->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['title'] ?> (Attempts left: <?= $row['attempts_left'] ?>, Deadline: <?= $row['deadline'] ?>)</option>
            <?php endwhile; ?>
        </select><br>
        <button type="submit" name="start_quiz">Start Quiz</button>
    </form>

    <?php if (isset($questions)): ?>
        <form method="post" action="">
            <input type="hidden" name="quiz_id" value="<?= $_POST['quiz_id'] ?>">
            <?php while ($row = $questions->fetch_assoc()): ?>
                <p><?= $row['question_text'] ?></p>
                <?php
                $options = $conn->query("SELECT * FROM options WHERE question_id = " . $row['id']);
                while ($option = $options->fetch_assoc()):
                ?>
                    <input type="radio" name="answers[<?= $row['id'] ?>]" value="<?= $option['option_label'] ?>" required> <?= $option['option_label'] ?>: <?= $option['option_text'] ?><br>
                <?php endwhile; ?>
            <?php endwhile; ?>
            <button type="submit" name="take_quiz">Submit Quiz</button>
        </form>
    <?php endif; ?>

    <h2>My Results</h2>
    <table>
        <tr>
            <th>Quiz</th>
            <th>Score</th>
            <th>Total Items</th>
            <th>Date/Time Submitted</th>
        </tr>
        <?php while ($row = $results->fetch_assoc()): ?>
            <tr>
                <td><?= $row['title'] ?></td>
                <td><?= $row['score'] ?></td>
                <td><?= $row['total_items'] ?></td>
                <td><?= $row['submission_time'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
