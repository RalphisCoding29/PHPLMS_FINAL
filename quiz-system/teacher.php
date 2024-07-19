<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'teacher') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['create_quiz'])) {
    $title = $_POST['title'];
    $deadline = $_POST['deadline'];
    $attempts = $_POST['attempts'];
    $teacher_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO quizzes (teacher_id, title, deadline, attempts) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $teacher_id, $title, $deadline, $attempts);

    if ($stmt->execute()) {
        $quiz_id = $stmt->insert_id;

        foreach ($_POST['questions'] as $index => $question) {
            $question_text = $question['text'];
            $correct_answer = $question['correct_answer'];

            $stmt = $conn->prepare("INSERT INTO questions (quiz_id, question_text, correct_answer) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $quiz_id, $question_text, $correct_answer);
            $stmt->execute();
            $question_id = $stmt->insert_id;

            foreach ($question['options'] as $option_label => $option_text) {
                $stmt = $conn->prepare("INSERT INTO options (question_id, option_text, option_label) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $question_id, $option_text, $option_label);
                $stmt->execute();
            }
        }

        echo "Quiz created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

if (isset($_POST['delete_quiz'])) {
    $quiz_id = $_POST['quiz_id'];

    // Delete attempts first
    $stmt = $conn->prepare("DELETE FROM attempts WHERE quiz_id = ?");
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $stmt->close();

    // Delete options next
    $stmt = $conn->prepare("DELETE FROM options WHERE question_id IN (SELECT id FROM questions WHERE quiz_id = ?)");
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $stmt->close();

    // Delete questions next
    $stmt = $conn->prepare("DELETE FROM questions WHERE quiz_id = ?");
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $stmt->close();

    // Delete results
    $stmt = $conn->prepare("DELETE FROM results WHERE quiz_id = ?");
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $stmt->close();

    // Finally, delete the quiz
    $stmt = $conn->prepare("DELETE FROM quizzes WHERE id = ?");
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $stmt->close();

    echo "Quiz deleted successfully!";
}

$results = $conn->query("
    SELECT r.id, u.fullname, q.title, r.score, r.total_items, r.submission_time 
    FROM results r 
    JOIN users u ON r.student_id = u.id 
    JOIN quizzes q ON r.quiz_id = q.id 
    WHERE q.teacher_id = " . $_SESSION['user_id']
);
$quizzes = $conn->query("SELECT * FROM quizzes WHERE teacher_id = " . $_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
</head>
<body>
    <h2>Create Quiz</h2>
    <form method="post" action="">
        <input type="text" name="title" placeholder="Quiz Title" required><br>
        <input type="datetime-local" name="deadline" required><br>
        <input type="number" name="attempts" placeholder="Number of Attempts" required><br>

        <h3>Questions</h3>
        <div id="questions">
            <div class="question">
                <input type="text" name="questions[0][text]" placeholder="Question text" required><br>
                <input type="radio" name="questions[0][correct_answer]" value="A" required> A: <input type="text" name="questions[0][options][A]" required><br>
                <input type="radio" name="questions[0][correct_answer]" value="B" required> B: <input type="text" name="questions[0][options][B]" required><br>
                <input type="radio" name="questions[0][correct_answer]" value="C" required> C: <input type="text" name="questions[0][options][C]" required><br>
                <input type="radio" name="questions[0][correct_answer]" value="D" required> D: <input type="text" name="questions[0][options][D]" required><br>
                <button type="button" onclick="removeQuestion(this)">Delete Question</button><br>
            </div>
        </div>
        <button type="button" onclick="addQuestion()">Add Question</button><br>
        <button type="submit" name="create_quiz">Create Quiz</button>
    </form>

    <h2>Manage Quizzes</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Attempts</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $quizzes->fetch_assoc()): ?>
            <tr>
                <td><?= $row['title'] ?></td>
                <td><?= $row['attempts'] ?></td>
                <td>
                    <form method="post" action="" style="display:inline;">
                        <input type="hidden" name="quiz_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete_quiz">Delete Quiz</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Manage Questions</h2>
    <table>
        <tr>
            <th>Quiz</th>
            <th>Question</th>
            <th>Actions</th>
        </tr>
        <?php 
        $questions = $conn->query("
            SELECT q.title, qs.id, qs.question_text 
            FROM questions qs 
            JOIN quizzes q ON qs.quiz_id = q.id 
            WHERE q.teacher_id = " . $_SESSION['user_id']
        );
        while ($row = $questions->fetch_assoc()): 
        ?>
            <tr>
                <td><?= $row['title'] ?></td>
                <td><?= $row['question_text'] ?></td>
                <td>
                    <form method="post" action="" style="display:inline;">
                        <input type="hidden" name="question_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete_question">Delete Question</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Results</h2>
    <table>
        <tr>
            <th>Student</th>
            <th>Quiz</th>
            <th>Score</th>
            <th>Total Items</th>
            <th>Date/Time Submitted</th>
        </tr>
        <?php while ($row = $results->fetch_assoc()): ?>
            <tr>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['score'] ?></td>
                <td><?= $row['total_items'] ?></td>
                <td><?= $row['submission_time'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <script>
        let questionCount = 1;

        function addQuestion() {
            const questionDiv = document.createElement('div');
            questionDiv.className = 'question';
            questionDiv.innerHTML = `
                <input type="text" name="questions[${questionCount}][text]" placeholder="Question text" required><br>
                <input type="radio" name="questions[${questionCount}][correct_answer]" value="A" required> A: <input type="text" name="questions[${questionCount}][options][A]" required><br>
                <input type="radio" name="questions[${questionCount}][correct_answer]" value="B" required> B: <input type="text" name="questions[${questionCount}][options][B]" required><br>
                <input type="radio" name="questions[${questionCount}][correct_answer]" value="C" required> C: <input type="text" name="questions[${questionCount}][options][C]" required><br>
                <input type="radio" name="questions[${questionCount}][correct_answer]" value="D" required> D: <input type="text" name="questions[${questionCount}][options][D]" required><br>
                <button type="button" onclick="removeQuestion(this)">Delete Question</button><br>
            `;
            document.getElementById('questions').appendChild(questionDiv);
            questionCount++;
        }

        function removeQuestion(button) {
            button.parentElement.remove();
        }
    </script>
</body>
</html>
