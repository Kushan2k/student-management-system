<?php
if(session_status()!=PHP_SESSION_ACTIVE){
  session_start();
}
include_once '../config/Database.php';
include_once '../config/Course.php';
include_once '../config/User.php';

if(!isset($_SESSION['isadmin']) || $_SESSION['isadmin']!=1){
  header("Location:../index.php", true, 301);
  return;
}
$courses = getAllCourse(Database::getDB());
?>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin- Dashboard</title>
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
    <div class="container p-5">
      <h4 class="display-6 text-center">Available Courses</h4>
      <div class="row">
        <div class="col-3">
          <a href="./admin.dashboard.php" class="btn btn-sm btn-warning">Back</a>
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
      <div class="col-12 mt-4">
        <table class="table table-striped" id="myTable">
          <thead>
            <tr>
              <th>Name</th>
              <th>Course Fee</th>
              <th></th>

            </tr>
          </thead>
          <tbody>
            <?php

            if($courses==null){
              echo "<tr><td colspan='3' class='text-center'>No courses Found!</td></tr>";
            }else{
              foreach ($courses as $course) {?>
            <tr>
              <td><?= ucfirst($course['name'])?></td>
              <td><?= ucfirst($course['fee'])?></td>
              <td>

                <button type="button" class="border-0 text-success bg-transparent" data-bs-toggle="modal"
                        data-bs-target="#exampleModal<?=$course['id']?>">
                  <i class="fa-solid fa-pen"></i>
                </button>
                <div class="modal fade" id="exampleModal<?=$course['id']?>" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Course Info</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="../controllers/editCourseController.php" method="POST">
                        <div class="modal-body">

                          <div class="form-group">
                            <label for="" class="form-label">Course Name</label>
                            <input type="text" name="cname" value="<?=$course['name'] ?>" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="" class="form-label">Course Fee(LKR)</label>
                            <input type="number" name="cfee" value="<?=$course['fee'] ?>" class="form-control">
                          </div>


                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <input type="hidden" name="cid" value="<?= $course['id']?>">
                          <button type="submit" name="edit-course" class="btn btn-success">Save</button>

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
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        clear()

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