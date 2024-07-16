<?php 
  include "libri_dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="adminstyle.css">

</head>
<body>

    <div class="header">
        
    </div>

    <div class="wholebody">


        <div class="side-nav">
            <div class="user">
                <img src="images/Untitled2.png" class="user-img">
                <div>
                    <h2>Random</h2>
                    <p>ADMIN</p>
                </div>
                <img src="images/star.png" class="star-img">
            </div>
            <ul>
               <li><img src="images/dashboard.png"><a href="Admins-page.php">Home</li>
                <li><img src="images/reports.png"><a href="#">Profile</a></li>
                <li><img src="images/messages.png"><a href="tempfeedback/mainpage.php">Feedback</a></li>
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

            
        </div>

        <div class="upper">
            <div class="words">
            <h6>LIBRI</h6>
            <h4>Explore, Learn, Succeed.</h4>
            <input type="text" placeholder="Enter book title" class="searchbar" size="70px">

        </div>
         </div>


        <div class="lower">
            <div class="books">
               
            <div class="des-test">
              <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file"  name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload File" name="submit"> 
                <div class="upload-pdf">
            
                <!-- need butangan class, leave nalang ni sa mga ga css -->
                <select id="subject" name="subject" class="" required>
                  <option value="math">Mathematics</option>
                  <option value="phys">Physics</option>
                  <option value="elex">Electrical/Electronics</option>
                  <option value="comp">Computer Studies</option>
                  <option value="chem">Chemistry</option>
                  <option value="gec">General Education</option>
                  <option value="ent">Entertainment/Literatures</option>
                  <option value="misc">Miscellaneous</option>
                </select>
                <input type="text" placeholder="PDF Code" id="pdf-code" name="pdf-code" class="" required>
                <input type="text" placeholder="Please put the file description here." id="pdf-desc" name="pdf-desc" class="" maxlength="200"> <!-- padakuan ni dapat -->
          </div>
              </form>
          </div>
              <table width = "100%" border = "1" align = "center">
                <thead>
                    <th>File Name</th>
                    <th>Subject</th>
                    <th>Description</th>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM `pdf-files` ORDER BY `pdf-sub` ";
                  $result = $conn->query($sql);

                  if($result->num_rows > 0){
                  while($row=$result->fetch_assoc())
                  {
                  ?>
                  <tr>
                    <td><?php echo $row['pdf-name']  ?></td>
                    <td><?php echo $row['pdf-sub'] ?></td>
                    <td><?php echo $row['pdf-code'] ?></td>
                    <?php } ?>
                  </tr> 
                  <?php } ?>
                </tbody>
              </table>
            </div>
    
            <!-- <div class="category">
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
            </div> -->

            </div>
        </div>
    </div> 
    
    


</body>
</html>