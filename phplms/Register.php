<?php 
    include "libri_dbcon.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
      <link rel="Stylesheet" href="register.css">
</head>
<body>
    <div class="body">
    

        <div class="body-1">
            <div class="group">
            <div class="blue-streak">
        </div>
        <div class="quote">
            
            <p>&#8706;&#8706;</p>
            <p>Explore, Learn, <br>Succeed</p>
            <img src="images/logo-white.png" width="210">
        </div>
        </div>

        <div class="sign">
        <div class="back mt-4 ">
  <div class="rowback">
    <div class="colback">
      <a href="index.php" class="btn btn-primary"><i class="fas fa-arrow-left me-1"></i> Back</a> <!--temporary back button--> 

        <div class="container mt-5 ">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title text-center mb-4">Register</h3>
          <form action="SaveFunction.php" method="post">
            <div class="mb-3">
              <label for="idno" class="form-label">ID Number</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" placeholder="ID Number" id="idnumber" name="idnumber" class="form-control" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="fn" class="form-label">First Name</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" placeholder="First Name" id="first" name="first" class="form-control" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="mi" class="form-label">Middle Initial</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" placeholder="Middle Initial" id="mi" name="mi" class="form-control" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="ln" class="form-label">Last Name</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" placeholder="Last Name" id="last" name="last" class="form-control" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="dob" class="form-label">Date of Birth</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                <input type="date" id="dirth" name="birth" class="form-control" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" placeholder="Username" id="username" name="username" class="form-control" required>
              </div>
            </div>

            
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" id="pass" name="pass" class="form-control" required>
              </div>
            </div>

            <!-- Added confirm pass design -->
            <!-- <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
              </div>
            </div> -->
            <div class="mb-3">
              <label for="User_Level" class="form-label">Role</label>
              <select id="User_Level" name="User_Level" class="form-select" required>
                <option value="" disabled selected>Select Role</option>
                <option value= "Teacher">Teacher</option>
                <option value = "Student">Student</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="Section" class="form-label">Section</label>
              <select id="Section" name="Section" class="form-select" required>
                        <option value="" disabled selected>Select Section</option>
                        <option value="CpE1A">BSCpE-1A</option>
                        <option value="CpE2A">BSCpE-2A</option>
                        <option value="CpE3A">BSCpE-3A</option>
                        <option value="Admin">Admin</option>
              </select>
            </div>
            <div class="reg d-grid gap-2">
              <input type="submit" value="Register" name="submit" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  
</div>

        </div>
        </div>
        
<!--code between is not necessary??? it should be automatically redirected to the login page-->
<div class="box mt-5">
    <div class="col-md-12">
      <table class="table d">
        <thead>
          <tr>
            <th>ID Number</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>MI</th>
            <th>Birth Date</th>
            <th>Role</th>
            <th>Year & Sec.</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql = "SELECT * FROM accounts ORDER BY lastname";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
          ?>
                <tr>
                  <td><?php echo $row['idno'] ?></td>
                  <td><?php echo $row['lastname'] ?></td>
                  <td><?php echo $row['firstname'] ?></td>
                  <td><?php echo $row['mi'] ?></td>
                  <td><?php echo $row['birthdate'] ?></td>
                  <td>
                    <?php if ($row['user_role'] == 'Teacher') : ?>
                      <i class="fas fa-chalkboard-teacher"></i> Teacher
                    <?php elseif ($row['user_role'] == 'Student') : ?>
                      <i class="fas fa-user-graduate"></i> Student
                    <?php endif; ?>
                  </td>
                  <td><?php echo $row['year_section'] ?></td>
                </tr>
          <?php
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>


        <!-- through here -->

        
    
    



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>