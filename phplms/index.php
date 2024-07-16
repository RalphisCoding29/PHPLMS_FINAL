<?php 
    include "libri_dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Libri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel ="Stylesheet" href ="indexstyle.css">
    <link rel = "icon" href = "images/logoL.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
        <div class="black-fill">
            <div class="container">
              <div class="title">
                <a class="navbar-brand" href="#welcome">
                            <!-- <img src="images/logoL.png" width="60" alt="Logo"> -->
                            <div class="header-title no-highlight">LIBRI</div>
                          </a>
              </div>
                <nav class="navbar navbar-expand-lg" id="homeNav">
                    <div class="container-fluid">
                         
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                                <!-- <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="index.php">Home</a>
                                </li> -->
                                <li class="nav-feed">
                                    <a class="nav-link" aria-current="page" href="tempfeedback/feedbackmainpage.php">Feedback</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#about">About</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav me-right mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="#login">Login</a>
                                </li>
                            </ul>    
                        </div>
                    </div>
                </nav>
            </div>
        
            <div class="body-home">

    <section id="welcome"
        class = "welcome-text" >
        <h4>UNLOCK KNOWLEDGE</h4>
        <p>Explore, Learn, Succeed</p>
        <img src="images/logo-brown.png">
    </section>
         
    <section id = "login"
         class="container">
  <div class="login-container">
    <h2>Login</h2>
    <?php
            if(isset($_GET['notif'])){
                $message = $_GET['notif'];
                echo '<h6 id="notif" style="color:blue;">' . $message . '</h3>';

                 echo '
                     <script>
                         setTimeout(function(){
                             document.getElementById("notif").style.display = "none";
                         }, 3000);
                     </script>
                 ';
            }
        ?>
    <form method="post" action="authenticate.php" novalidate>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user"></i></span>
          <input type="text" name="uname" class="form-control" id="username" placeholder="Enter username">

        </div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" name="pwd" class="form-control" id="password" placeholder="Enter password">
        </div>
      </div>
      <a href="Register.php">Don't have an account? Click here</a><br><br>
      <input type="submit" class="btn btn-primary" name="login" value="Login">
    </form>
  </div>
    </section>


    <br><br><br>

    <section id = "about" 
            class = "d-flex justify-content-center
            align-items-center flex-column" >
    <div class="card mb-3 card-1">
			  <div class="row g-0">
			    <div class="col-md-4">
			      <img src="images/logo-brown.png"  width = "220" >
			    </div>
			    <div class="col-md-8">
			      <div class="card-body">
			        <h5 class="card-title">About Us</h5>
			         
			        <p class="card-text"><small class="text-muted">LIBRI is a Learning Management System (LMS) designed to facilitate, manage, and track activities and educational content in an online learning environment. Its purpose is to have a centralised platform where students and educators could have a structured environment specifically tailored for learning, therefore enhancing the learning experience and making it simpler to navigate and manage certain content. This system also allows certain users to manage their accounts, and have access to  course materials and resources provided by instructors. Overall, LIBRI is aimed towards enhancing accessibility and effectiveness of education delivery with room for improvements as time progresses.</small></p>
			      </div>
			    </div>
			  </div>
			</div>
            <div class = "copyright-text">
                <p>Copyright &copy; 2024 LIBRI. All Rights Reserved.</p>
              </div>
          </section>


        </div>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
  </body>
</html>