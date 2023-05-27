<?php
if(session_status()!=PHP_SESSION_ACTIVE){
  session_start();
}

if(!isset($_GET['stid'])){
  $_SESSION['error'] = 'invalid student id!';
  header("Location:{$_SERVER['HTTP_REFERE']}");
}

if(!isset($_SESSION['isadmin']) || $_SESSION['isadmin']!=1){
  header("Location:../index.php", true, 301);
  return;
}
include_once '../config/Database.php';
include_once '../config/Course.php';
include_once '../config/User.php';

$user = new User(Database::getDB());
$student = $user->getStudentByID($_GET['stid']);
$courses = GetEntroledCourse($_GET['stid'], Database::getDB());



?>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin- Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

  </head>

  <body>
    <div class="container py-5">
      <div class="row my-3">
        <div class="col-3">
          <a href="./admin.dashboard.php" class='btn btn-sm btn-warning'>Back</a>
        </div>
      </div>
      <?php
        if(isset($_SESSION['error'])){?>
      <div class="row">
        <p class="alert alert-danger text-center"><?= $_SESSION['error']?></p>
      </div>
      <?php $_SESSION['error']=null; }else if(isset($_SESSION['msg'])){?>
      <div class="row">
        <p class="alert alert-success text-center"><?= $_SESSION['msg']?></p>
      </div>
      <?php $_SESSION['msg']=null;}

      ?>
      <div class="row">
        <p>Name: <?= ucfirst($student['name'])?></p>
        <p>Email: <?= ucfirst($student['email'])?></p>
        <p>Contact: <?= ucfirst($student['contact'])?></p>
        <p>NIC: <?= ucfirst($student['NIC'])?></p>
      </div>
      <hr>
      <p class="text-center fw-bold">Enrolled Courses</p>
      <div class="row">
        <div class="col-12 col-md-10 mx-auto">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Title</th>
                <th>Fee</th>
                <th>Completed Date</th>
                <th>Certificate No</th>
                <th></th>
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
                <td><?=ucfirst($course['fee'])?></td>
                <td class='<?= $course['completed']==1?'text-success fw-bold':'text-danger'?>'>
                  <?=ucfirst($course['completed_date'])?></td>
                <td><?=ucfirst($course['cetificate_no'])?></td>
                <td>

                  <button type="button" class="border-0 text-success" data-bs-toggle="modal"
                          data-bs-target="#exampleModal<?=$student['id']?>">
                    <i class="fa-solid fa-eye"></i>
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal<?=$student['id']?>" tabindex="-1"
                       aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../controllers/editCourseController.php" method="POST">
                          <div class="modal-body">
                            <div class="form-group my-2">
                              <label for="" class="form-label">Student ID</label>
                              <input type="text" id='id' required value="<?=$student['student_id']?>"
                                     placeholder='Student ID' name="stid" class="form-control">
                            </div>


                            <div class="form-group my-2">
                              <label for="" class="form-label">Student Name</label>
                              <input type="text" id='id' required value="<?=$student['name']?>"
                                     placeholder='Student Name' name="name" class="form-control">
                            </div>
                            <div class="form-group my-2">
                              <label for="" class="form-label">Student Address</label>
                              <input type="text" id='id' required value="<?=$student['address']?>" placeholder='Address'
                                     name="address" class="form-control">
                            </div>
                            <div class="form-group my-2">
                              <label for="" class="form-label">Contact</label>
                              <input type="text" id='id' required value="<?=$student['contact']?>" placeholder='Contact'
                                     name="contact" class="form-control">
                            </div>
                            <div class="row mx-auto">
                              <div class="col-8 my-2">
                                <label for="" class="form-label">Email</label>
                                <input type="text" id='id' required value="<?=$student['email']?>" placeholder='Email'
                                       name="email" class="form-control">
                              </div>
                              <div class="col-4 my-2">
                                <label for="" class="form-label">NIC</label>
                                <input type="text" id='id' required value="<?=$student['NIC']?>" placeholder='NIC'
                                       name="nic" class="form-control">
                              </div>
                            </div>
                            <div class="row mx-auto">
                              <div class="col-12 col-md-6 my-2">
                                <label for="" class="form-label">Date of Birth</label>
                                <input type="date" id='id' required value="<?=$student['date_of_birth']?>"
                                       placeholder='Birth date' name="dob" class="form-control">
                              </div>
                              <div class="col-12 col-md-6 my-2">
                                <label for="" class="form-label">Registration Date</label>
                                <input type="date" id='id' required value="<?=$student['reg_date']?>"
                                       placeholder='Student Registration date' name="regdate" class="form-control">
                              </div>
                            </div>
                            <div class="row mx-auto">
                              <div class="col-12 col-md-4 my-2">
                                <label for="" class="form-label">Paid Amount(LKR)</label>
                                <input type="number" id='id' required value="<?=$student['paid_amount']?>"
                                       placeholder='Paid amount' name="paid" class="form-control">
                              </div>
                              <div class="col-6 col-md-4 my-2">
                                <label for="" class="form-label">Fees(LKR)</label>
                                <input type="number" id='id' required value="<?=$student['fees']?>" placeholder='Fees'
                                       name="fee" class="form-control">
                              </div>
                              <div class="col-6 col-md-4 my-2">
                                <label for="" class="form-label">Balance(LKR)</label>
                                <input type="number" id='id' required value="<?=$student['balance']?>"
                                       placeholder='Balance' name="balance" class="form-control">
                              </div>
                            </div>


                            <div class="form-group my-2">
                              <label for="" class="form-label">Completed</label>
                              <input type="checkbox" id='status' name="completed" class="">
                            </div>
                            <div id='inputs' class='d-none'>
                              <div class="form-group my-2">
                                <label for="" class="form-label">Complete Date</label>
                                <input type="date" id='c-date' value='<?=$course['completed_date']?>'
                                       name="completed_date" class=" form-control">
                              </div>
                              <div class="form-group my-2">
                                <label for="" class="form-label">Certificate Number</label>
                                <input type="number" id='cid' value='<?=$course['cetificate_no']?>' name="CertificateID"
                                       class=" form-control">
                              </div>
                            </div>


                          </div>
                          <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="hidden" name="courseID" value="<?= $course['reg_id']?>">
                            <input type="hidden" name="id" value="<?= $student['id']?>">

                            <button type="submit" name="save" class="btn btn-success">Save</button>

                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <?php }
                }
                
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <script>
      document.addEventListener("DOMContentLoaded", () => {
        clear()
        const status = document.getElementById('status')
        var fields = document.getElementById('inputs')
        var cdate = document.getElementById('c-date')
        var cid = document.getElementById('cid')
        status.addEventListener('change', (e) => {
          if (e.target.checked) {
            fields.classList.remove('d-none')
            cdate.setAttribute('required', '')
            cid.setAttribute('required', '')
          } else {
            fields.classList.add('d-none')
          }
        })
      })

      function clear() {
        setTimeout(() => {
          let error = document.querySelector('.alert')
          if (error) {
            error.remove()
          }
        }, 2000)
      }
    </script>
  </body>

</html>