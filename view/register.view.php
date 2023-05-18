<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register here</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

  <body>

    <div class="container-fluid py-5" style="height: 100vh;">
      <div class="row my-2">
        <div class="col-3 offset-1">
          <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="btn btn-danger">Back</a>
        </div>
      </div>
      <div class="row mx-auto">
        <div class="col-10 mx-auto">
          <form action="../controllers/RegisterController.php" method="post" enctype="multipart/form-data">
            <div class="row mx-auto gap-2">
              <div class="col-12 col-md-3">
                <label for="" class="form-label text-capitalize ">student id</label>
                <input placeholder="Enter Student ID" type="number" name='stid' class="form-control" aria-label="">
              </div>
              <div class="col-12 col-md-4">
                <label for="" class="form-label text-capitalize">student Name</label>
                <input placeholder='Enter Student Name' name='stname' type="text" class="form-control">
              </div>
              <div class="col-12 col-md-4">
                <label for="" class="form-label text-capitalize">parent Name</label>
                <input placeholder='Enter Parent Name' name='pname' type="text" class="form-control">
              </div>
            </div>
            <br>
            <div class="row mx-auto gap-2">
              <!-- <div class="col-12 col-md-3">
                <label for="" class="form-label">Course</label>
                <select name="course" id="" class="form-select text-capitalize">
                  <option value="" selected>course</option>
                </select>
              </div> -->
              <div class="col-12 col-md-3">
                <label for="" class="form-label text-capitalize">student address</label>
                <input type="text" placeholder='Enter Student Address' name="staddress" id="" class="form-control">
              </div>
              <div class="col-12 col-md-4">
                <label for="" class="form-label text-capitalize">Date Of Birth</label>
                <input type="date" name="stdob" id="" class="form-control">
              </div>
              <div class="col-12 col-md-4">
                <label for="" class="form-label text-capitalize">profile photo</label>
                <input type="file" name="stimg" id="" class="form-control">
              </div>
              <!-- <div class="col-12 col-md-4">
                <label for="" class="form-label">Gender</label>
                <select name="gender" id="" class=" form-select">
                  <option value="male" selected>Male</option>
                  <option value="female">Female</option>
                </select>
              </div> -->
            </div>

            <br>
            <div class="row mx-auto gap-2">
              <div class="col-12 col-md-3">
                <label for="" class="form-label text-capitalize">Student Email</label>
                <input type="email" placeholder='Enter Student Email' name='stemail' class="form-control" aria-label="">
              </div>
              <div class="col-12 col-md-4">
                <label for="" class="form-label text-capitalize">Contact number</label>
                <input type="text" placeholder='Contact Number' name='stcontact' class="form-control">
              </div>
              <div class="col-12 col-md-4">
                <label for="" class="form-label text-capitalize">Student class</label>
                <input type="number" placeholder='1' name='stclass' class="form-control">
              </div>
            </div>
            <br>
            <div class="row mx-auto gap-2">
              <div class="col-12 col-md-3">
                <label for="" class="form-label text-capitalize">registration date</label>
                <input type="date" class="form-control" name='stregdate' aria-label="">
              </div>
              <div class="col-12 col-md-4">
                <label for="" class="form-label text-capitalize">registration fee</label>
                <input type="number" placeholder='Registration Fee' name='stregfee' class="form-control">
              </div>
              <div class="col-12 col-md-4">
                <label for="" class="form-label text-capitalize">Paid Amount</label>
                <input type="number" placeholder='Paind Amount' name='stpaid' class="form-control">
              </div>
            </div>
            <br>
            <div class="row mx-auto gap-2">
              <div class="col-12 col-md-4">
                <label for="" class="form-label text-capitalize">Balance</label>
                <input type="number" placeholder='Enter Balance' name='stbalance' class="form-control" aria-label="">
              </div>
              <div class="col-12 col-md-4">
                <label for="" class="form-label text-capitalize">student status</label>
                <select name="ststatus" class='form-select'>
                  <option value='active' selected>ACTIVE</option>
                  <option value='inactive'>INACTIVE</option>
                </select>
              </div>
              <div class="col-12">
                <label for="" class="form-label text-capitalize">Completed or discontinuedd date</label>
                <input type="date" class="form-control" name='stfinished' aria-label="">
              </div>

            </div>
            <br>
            <div class="from-group float-end">

              <input type="reset" value="Reset" class="btn btn-danger fw-bold">


              <input type="submit" name="register" value="Register" class="btn btn-success">

            </div>

          </form>
        </div>
      </div>
    </div>

  </body>

</html>