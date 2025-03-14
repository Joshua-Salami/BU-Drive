<?php
    include 'connect.php';
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
        <div class="logo"><a href="#">BU-Drive <img src="Icons/externaldrive.fill.badge.icloud.png" alt="logo"></a></div>
        <div class="notifications"><a href="#"><img src="Icons/bell.png" alt="Notifications icon"></a></div>
    </header>

    <div class="container">
       <div id="search-container">
            <img src="Images/magnifying-glass.png" alt="Search" class="search-icon" onclick="expandSearch()">
            <input type="text" id="search" placeholder="Explore..." onclick="expandSearch()">
        </div>

        <section>
            <h2 class="section-title">Weekly Poll</h2>
            <div class="weekly-polls">
<<<<<<< Updated upstream
                <?php
                    $getPolls = "SELECT * FROM polls ORDER BY creationDate DESC LIMIT 6";
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
                                
                            echo '<div class="poll-card">
                                    <div class="poll-header">
                                        <div class="poll-icon">📊</div>
                                        <div>
                                            <h3>'.$pollTitle.'</h3>
                                            <p class="poll-stats">' . $formattedDate . '</p>
                                        </div>
                                    </div>
                                    <a href="ViewPoll.php?pollId=' . $pollId . '"><button class="btn">View Poll</button></a></br>
                                </div>';
                        }
                    }else {
                        echo "<p style='color: white; font-weight: bold; background-color: #007bff;'>No Polls available.</p>";
                    }
                ?>
=======
                <div class="poll-card">
                    <div class="poll-header">
                        <div class="poll-icon"><img src="../Icons/poll.png" alt="Poll icon"></div>
                        <div>
                            <h3>What's your favorite way to study?</h3>
                            <p class="poll-stats">2d left</p>
                        </div>
                    </div>
                    <button class="btn">View Poll</button>
                </div>
                <div class="poll-card">
                    <div class="poll-header">
                    <div class="poll-icon"><img src="/Icons/poll.png" alt="Poll icon"></div>
                        <div>
                            <h3>What's your favorite course this semester?</h3>
                            <p class="poll-stats">2d left</p>
                        </div>
                    </div>
                    <button class="btn">View Poll</button>
                </div>
>>>>>>> Stashed changes
            </div>
        </section>

        <section>
            <h2 class="section-title">Resource Highlight of the Week</h2>
            <div class="resources">
                <?php
                    $startOfWeek = date('Y-m-d', strtotime('monday this week'));

                    $getPosts = "SELECT * FROM posts WHERE creationDate >= '$startOfWeek' ORDER BY creationDate DESC LIMIT 2";
                    $getPostsResult = mysqli_query($conn, $getPosts);

                    if ($getPostsResult && mysqli_num_rows($getPostsResult) > 0) {
                        while ($row = mysqli_fetch_assoc($getPostsResult)) {
                            $postId = $row['postId'];
                            $postTitle = htmlspecialchars($row['postTitle']);
                            $image = 'data:image/jpeg;base64,' . base64_encode($row['image']);

                            echo '<div class="resource-card">
                                    <img src="'.$image.'" alt="Resource Image" class="resource-image">
                                    <div class="resource-content">
                                        <h3>' . $postTitle . '</h3>
                                        <a href="ReadPost.php?postId=' . $postId . '"><button class="btn">Read More</button></a>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo "<p style='color: white; font-weight: bold; background-color: #007bff;'>No new posts this week.</p>";
                    }
                ?>
            </div>
        </section>

        <h2 class="section-title">Blogs</h2>
        <a href="Blog.php"><button style="padding: 10px; border-radius: 5px; background-color: #007bff; outline: none; border: none; color: white; margin-bottom: 20px">Read More Blogs</button></a>
        <section>
            <div class="blog-posts">
            <?php
                $getPosts = "SELECT * FROM posts ORDER BY creationDate DESC LIMIT 6";
                $getPostsResult = mysqli_query($conn, $getPosts);
            
                if ($getPostsResult && mysqli_num_rows($getPostsResult) > 0) {
                    while ($row = mysqli_fetch_assoc($getPostsResult)) {
                        $studentId = $row['studentId'];
                        $postId = $row['postId'];
                        $postTitle = htmlspecialchars($row['postTitle']);
                        $post = htmlspecialchars($row['post']);
            
                        $creationDate = new DateTime($row['creationDate']);
                        $formattedDate = htmlspecialchars($creationDate->format('Y-m-d'));
                        $formattedDate = htmlspecialchars(date('Y-m-d', strtotime($row['creationDate'])));
                        $image = 'data:image/jpeg;base64,' . base64_encode($row['image']);
            
                        $getStudentDetails = "SELECT * FROM students WHERE studentId = $studentId";
                        $getStudentDetailsResult = mysqli_query($conn, $getStudentDetails);
                        if ($getStudentDetailsResult && mysqli_num_rows($getStudentDetailsResult) > 0) {
                            $student = mysqli_fetch_assoc($getStudentDetailsResult);
                            $studentFullName = htmlspecialchars($student['fullName']);
                            $studentEmail = htmlspecialchars($student['email']);
                        }

                        echo '
                                <div class="blog-card">
                                    <img src="'.$image.'" alt="Remote learning" class="blog-image">
                                    <div class="blog-content">
                                        <h3>' . $postTitle . '</h3>
                                        <div class="blog-meta">
                                            <p>By '.$studentFullName.' on ' . $formattedDate . '</p>
                                        </div>
                                    </div>
                                </div>';
                    }
                }else {
                    echo "<p style='color: white; font-weight: bold; background-color: #007bff;'>No Posts available.</p>";
                }
            ?>
            </div>
        </section>
            
    </div>
    
    <nav class="navigation">
        <a href="Homepage.php" class="nav-item">
            <img src="Icons/house.fill.png" alt="Profile icon">
            <span>Home</span>
        <a href="Resources.html" class="nav-item">
            <img src="Icons/folder.png" alt="Profile icon">
            <span>Resources</span>
        </a>
        <a href="Semester.html" class="nav-item">
            <img src="Icons/my courses.png" alt="Profile icon">
            <span>My Courses</span>
        </a>
        <a href="Profile.php" class="nav-item">
            <img src="Icons/profile.png" alt="Profile icon">
            <span>Profile</span>
        </a>
    </nav>
</body>
</html>
    <script src="JS/function.js"> </script>

</body>
</html>