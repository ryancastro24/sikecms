<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
</head>
<body>


<div class="container pt-5">

<h1 class="mb-3">USER REGISTER</h1>
    <form class="mb-5" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">

    @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address">
            </div>


            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone">
            </div>

            <div class="mb-3">
                <label for="annual_income" class="form-label">Annual Income</label>
                <input type="number" name="annual_income" class="form-control" id="annual_income">
            </div>


            <select name="gender" class="form-select mb-3 mt-2" aria-label="Default select example">
                <option selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
               
            </select>


            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>



            <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input name="image" class="form-control" type="file" id="formFile">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>
    
</body>
</html>