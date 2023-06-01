<?php
session_start();
include_once '../config/Database.php';
include_once '../config/User.php';
include_once '../config/Course.php';

$user = new User(Database::getDB());
// print_r($_SESSION);
// print_r($user->getCourseForUser($_SESSION['user_id'])==null);
$details = $user->getCourseForUser($_SESSION['user_id']);
$courses = GetEntroledCourse($_SESSION['user_id'], Database::getDB());

?>

<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
      td {
        padding: 6px;
      }
    </style>
  </head>


  <body>
    <div class="container py-5">
      <div class="row">
        <div class="col-3">
          <a href="../index.php" class='btn btn-sm btn-primary'>Back</a>
        </div>
      </div>
      <div class="row py-5">
        <div class="col-12 mx-auto d-flex justify-content-around flex-column align-items-center">
          <img src="https://www.pngall.com/wp-content/uploads/8/Green-Check-Mark-PNG-Free-Download.png" alt="right"
               width="50" height="50">
          <p class="fw-bold">Certificate Successfully Verified</p>
        </div>
        <div class="col-12 mx-auto d-flex align-items-center flex-column">
          <p class="fw-bold text-center">Personal informations</p>
          <img src='<?=$details['img_url']?>' class='rounded-circle my-2 border border-4' alt='profile' width='150'
               height='150' />
        </div>
        <div class="col-10 mx-auto border border-2 px-5">
          <table class="w-100 mx-auto">
            <tbody>
              <tr>
                <td>Name</td>
                <td><?= ucfirst($details['name'])?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><?= $details['email']?></td>
              </tr>
              <tr>
                <td>Date of birth</td>
                <td><?= $details['date_of_birth']?></td>
              </tr>
              <tr>
                <td>Contact</td>
                <td><?= ($details['contact'])?></td>
              </tr>
              <tr>
                <td>Address</td>
                <td><?= $details['address']?></td>
              </tr>
              <tr>
                <td>Register Date</td>
                <td><?= $details['reg_date']?></td>
              </tr>
              <tr>
                <td>NIC</td>
                <td><?= $details['NIC']?></td>
              </tr>


            </tbody>
          </table>
        </div>
        <div class="col-12 col-md-10 mx-auto mt-3">
          <table class="table table-striped table-hover">
            <thead>
              <tr class=''>
                <th>Name</th>
                <th class='d-none d-md-flex'>Fee</th>
                <th>Certificate No</th>
                <th>Completed</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($courses==null){
                echo "<tr><td colspan='4' class='text-center'>No Enrolled Courses</td></tr>";
              }else{
                foreach ($courses as $course) {?>
                <tr>
                  <td><?=ucfirst($course['name'])?></td>
                  <td class='d-none d-md-flex'><?=ucfirst($course['fee'])?></td>
                  <td><?=ucfirst($course['cetificate_no'])?></td>
                  <td><?=ucfirst($course['completed_date'])?></td>
                  
                    <?php
                    if((int)$course['completed']==1){
                      echo '<td class="text-success">Completed</td>';
                    }else{
                      echo '<td class="text-warning">On progress</td>';
                    }
                    ?>
                    </tr>
                  
               <?php }
               
              }

              ?>

            </tbody>
          </table>
        </div>

      </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

  </body>

</html>