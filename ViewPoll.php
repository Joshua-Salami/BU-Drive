<?php
    include 'connect.php';

    $pollId = $_GET['pollId'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud-Based E-Learning Platform for Babcock Students </title>
    <link rel="stylesheet" href="CSS/homepage.css">

</head>
<body>
    <header class="header">
        <div class="logo"> BU-Drive 🚗 </div>
        <div class="notifications"> 🔔 </div>
    </header>

    <div class="container">
        <section>
            <div class="weekly-polls" style="display: flex; flex-direction: column; margin-top: 100px">
                <?php
                    $getPolls = "SELECT * FROM polls WHERE pollId = $pollId";
                    $getPollsResult = mysqli_query($conn, $getPolls);
                
                    if ($getPollsResult && mysqli_num_rows($getPollsResult) > 0) {
                        while ($row = mysqli_fetch_assoc($getPollsResult)) {
                            $studentId = $row['studentId'];
                            $pollId = $row['pollId'];
                            $pollTitle = htmlspecialchars($row['pollTitle']);
                            $option1 = htmlspecialchars($row['option1']);
                            $option2 = htmlspecialchars($row['option2']);

                            $creationDate = new DateTime($row['creationDate']);
                            $formattedDate = htmlspecialchars($creationDate->format('Y-m-d'));
                            $formattedDate = htmlspecialchars(date('Y-m-d', strtotime($row['creationDate'])));

                            $option1Vote = "SELECT COUNT(*) as count FROM votes WHERE pollId = $pollId AND option1 = 1";
                            $option1VoteResult = mysqli_query($conn, $option1Vote);
                            $amountOfOption1Vote = 0;
                            if ($option1VoteResult) {
                                $row = mysqli_fetch_assoc($option1VoteResult);
                                $amountOfOption1Vote = $row['count'];
                            }
                            else{
                                $amountOfOption1Vote = 0;
                            }

                            $option2Vote = "SELECT COUNT(*) as count FROM votes WHERE pollId = $pollId AND option2 = 1";
                            $option2VoteResult = mysqli_query($conn, $option2Vote);
                            $amountOfOption2Vote = 0;
                            if ($option2VoteResult) {
                                $row = mysqli_fetch_assoc($option2VoteResult);
                                $amountOfOption2Vote = $row['count'];
                            }
                            else{
                                $amountOfOption2Vote = 0;
                            }
                                
                            echo '<h2 class="section-title">'.$pollTitle.'</h2>
                                    <div class="poll-card" style="width: 100%">
                                        <div class="poll-header">
                                            <div class="poll-icon">📊</div>
                                            <div>
                                                <div style="display: flex; margin-bottom: 40px; justify-content: space-between; width: 100%">
                                                    <div style="display: flex; flex-direction: column; margin-right: 300px">
                                                        <p>' . $option1 . '</p>
                                                        <a href="PollVotingOption1.php?pollId=' . $pollId . '"><button class="btn">Vote</button></a></br>
                                                        <p>Votes: ' . $amountOfOption1Vote . '</p>
                                                    </div>
                                                    <div style="display: flex; flex-direction: column">
                                                        <p>' . $option2 . '</p>
                                                        <a href="PollVotingOption2.php?pollId=' . $pollId . '"><button class="btn">Vote</button></a></br>
                                                        <p>Votes: ' . $amountOfOption2Vote . '</p>
                                                    </div>
                                                </div>
                                                <p class="poll-stats">Created on: ' . $formattedDate . '</p>
                                            </div>
                                        </div>
                                    </div>';
                        }
                    }else {
                        echo "<p style='color: white; font-weight: bold; background-color: #007bff;'>No Polls available.</p>";
                    }
                ?>
            </div>
        </section>
    </div>

    <nav class="navigation">
        <a href="Homepage.php" class="nav-item">
            🏠
            <span>Home</span>
        <a href="Resources.html" class="nav-item">
            📚
            <span>Resources</span>
        </a>
        <a href="SelectSem.html" class="nav-item">
            🎓
            <span>My Courses</span>
        </a>
        <a href="Profile.php" class="nav-item">
            👤
            <span>Profile</span>
        </a>
    </nav>
</body>
</html>
    <script src="JS/function.js"> </script>

</body>
</html>