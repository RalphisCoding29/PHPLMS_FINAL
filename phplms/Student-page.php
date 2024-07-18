<?php 
  include "libri_dbcon.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER</title>
    <link rel="stylesheet" href="userstyle.css">

</head>
<body>

    <div class="header">
        
    </div>

    <div class="wholebody">


        <div class="side-nav">
            <div class="user">
                <img src="images/Untitled1.png" class="user-img">
                <div>
                    <h2>Random</h2>
                    <p>USER</p>
                </div>
                <img src="images/star.png" class="star-img">
            </div>
            <ul>
                <li><img src="images/dashboard.png"><a href="Student-page.php">Home</li>
                <li><img src="images/reports.png"><a href="profindex.php">Profile</a></li>
                <li><img src="images/messages.png"><a href="tempfeedback/feedbackmainpage.php">Feedback</a></li>
                <li><img src="images/projects.png"><a href="#">About</a></li>
                <li><img src="images/members.png"><a href="Discussions-page.php">Discussions</a></li>
                <li><img src="images/setting.png"><a href="#">Settings</a></li>
            </ul>

            <ul>
                <li><img src="images/logout.png">
                
                    <div class="logoutbtn">
                        <script>
                           function confirmLogout() {
                             if (confirm("Tapos nani sir? Ilog out nani?")) {
                               window.location = "index.php";
                             }
                           }
                         </script>
                     
                         <button onclick="confirmLogout()" class="btn">Log Out</button>
                         </div>
                
                </li>
            </ul>

            
            <!--
            <div id = "main" class="main">
                <script src ="hiddencategories.js"></script>
                <div class="subfeatures">

                    <div id="comments-container">
                    <h2>Discussion</h2>
                    <div id="discussions"></div>
                    <textarea id="discussion-text" placeholder="Start a discussion..."></textarea>
                    <button onclick="postDiscussion()">Post</button>
                    </div>
                    <script src="libri_comments.js"></script>
                
                    </div>
                
            
            </div> 
                        -->
            
        </div>

        <div class="upper">
            <div class="words">
            <h6>LIBRI</h6>
            <h4>explore, learn, succeed.</h4>
            <input type="text" placeholder="Enter book title" class="searchbar" size="70px">

        </div>
         </div>


        <div class="lower">
            <div class="books">
                <h4>"Welcome to LIBRI. Click on the categories to get started." </h4>
            </div>
    
            <div class="category">
                SHELVES
                <div class="space"></div>
                <div>
                    <a href="Student-page-math.php"><h4 class="btn">Mathematics</h4></a>
                </div>
                <div class="space"></div>
                <div>
                    <a href="Student-page-phys.php"><h4 class="btn">Physics</h4></a>
                </div>
                <div class="space"></div>
                <div>
                    <a href="Student-page-elex.php"><h4 class = "btn">Electrical/Electronics</h4></a>
                </div>
                <div class="space"></div>
                <div>
                    <a href="Student-page-comp.php"><h4 class = "btn" >Computer Studies</h4></a>
                </div>
                <div class="space"></div>
                <div>
                    <a href="Student-page-chem.php"><h4 class = "btn" >Chemistry</h4></a>
                </div>
                <div class="space"></div>
                <div>
                    <a href="Student-page-gec.php"><h4 class = "btn" >General Education</h4></a>
                </div>
                <div class="space"></div>
                <div>
                    <a href="Student-page-ent.php"><h4 class = "btn" >Entertainment/Literature</h4></a>
                </div>
                <div class="space"></div>
                <div>
                    <a href="Student-page-misc.php"><h4 class = "btn" >Miscellaneous</h4></a>
                </div>
            </div>

            </div>
        </div>
    </div> 


    <div class="notifications">
            <h4>Notifications</h4>
            <ul>
                <?php
                $sql = "SELECT * FROM notifications ORDER BY created_at DESC";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($row['message']) . " <span class='timestamp'>" . $row['created_at'] . "</span></li>";
                    }
                } else {
                    echo "<li>No notifications</li>";
                }
                ?>
            </ul>
        </div>
    </div>  









    <!-- <div class="subfeatures">
      <div class="discussion-container" id="discussion-container">
        <h2>Discussion</h2>
        <div class="disc-txtarea">
          <textarea id="discussion-text" placeholder="Start a discussion..." rows="8" cols="82"></textarea>
        </div>

        <div class="btn-post-container">
          <button class="btn-post" onclick="postDiscussion()">Post</button>
        </div>

        <ul id="discussion" style="overflow-y: scroll; overflow-x: hidden; max-height: 300px;">
          <li class="discussion-content" id="discussions"></li>
        </ul>
      </div>

      <script src="libri_comments.js"></script>
    </div> -->

</body>
</html>
