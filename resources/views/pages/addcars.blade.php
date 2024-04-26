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

<h1 class="mb-3">CAR REGISTER</h1>
    <form class="mb-5" method="POST" action="{{ route('addnewcar') }}" enctype="multipart/form-data">

    @csrf
            <div class="mb-3">
                <label for="modelname" class="form-label">Model Name</label>
                <input type="text" name="model_name" class="form-control" id="modelname" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="body_type" class="form-label">Body Type</label>
                <input type="text" name="body_type" class="form-control" id="email">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Car Price</label>
                <input type="number" name="price" class="form-control" id="price">
            </div>

            <select name="brand_id" class="form-select mb-3 mt-2" aria-label="Default select example">
                <option selected>Select Brand</option>

                @foreach($brands as $brand)
                <option value="{{$brand->brand_id}}">{{$brand->name}}</option>
               
               @endforeach
            </select> 

            
            <select name="option_id" class="form-select mb-3 mt-2" aria-label="Default select example">
                <option selected>Select Color</option>

                @foreach($colors as $color)
                <option value="{{ $color->option_id}}">{{ $color->color}}</option>
               
                @endforeach
            </select>


            <select name="dealer_id" class="form-select mb-3 mt-2" aria-label="Default select example">
                
                <option selected>Select Dealer</option>
                
                @foreach($dealers as $dealer)
                <option value="{{ $dealer->id}}">{{ $dealer->name}}</option>
               
                @endforeach
               
            </select>

            <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input name="image" class="form-control" type="file" id="formFile">
            </div>
                        
            <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>
    
</body>
</html>