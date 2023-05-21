<?php
session_start();
include_once '../config/Database.php';
include_once '../config/User.php';

$user = new User(Database::getDB());

print_r($user->getCourseForUser($_SESSION['user_id']));

?>

<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>
    <div class="container">
      <div class="row p-5">
        <div class="col-12 mx-auto d-flex justify-content-around flex-column align-items-center">
          <img src="https://www.pngall.com/wp-content/uploads/8/Green-Check-Mark-PNG-Free-Download.png" alt="right"
               width="50" height="50">
          <p class="fw-bold">Certificate Successfully Verified</p>
        </div>
        <div class="col-12 mx-auto">
          <p class="fw-bold text-center">Personal informations</p>
        </div>
        <div class="col-10 mx-auto">
          <table class="table-responsive w-100 text-center">
            <tbody>
              <tr>
                <td>Name</td>
                <td>Name</td>
              </tr>
              <tr>
                <td>Name</td>
                <td>Name</td>
              </tr>
              <tr>
                <td>Name</td>
                <td>Name</td>
              </tr>
              <tr>
                <td>Name</td>
                <td>Name</td>
              </tr>
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