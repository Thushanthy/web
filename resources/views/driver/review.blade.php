<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#FFE87C;">
  <a class="navbar-brand" href="#">Parking Driver Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="driverDashboard">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('drivervehicle.index') }}">Manage My-Vehicles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/notification">Notifications</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/review">Reviews</a>
      </li>
    </ul>
  </div>
</nav>
<hr>
<div class="container">
<form action = "/driverRequest" method="POST">
    @csrf
  <div class="form-group">
    <label for="parkingspace">Parking Space ID :</label>
    <select class="form-control" name="parkingspace" id="parkingspace">
    @foreach($parkingslots as $parking)
      <option>{{$parking->name}}</option>
    @endforeach
    </select>
    <small id="parkingspace" class="form-text text-muted">You should provide the parking id you decided to review.</small>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Enter review :</label>
    <input type="textarea" class="form-control" name="" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter parking space review">
  </div>

  <button type="submit" class="btn btn-primary btn-sm" style="background-color:blueviolet;border-color:blueviolet;">place review</button>
</form>
</div>


<hr>
<div class="container">
@foreach($reviews as $review)
    <div class="card">
      <div class="card-body">
      <div class="row">
      <div class="col-md-2">
      <img src="{{ URL::asset('assets/img/avatar.png')}}" style="border-radius:100%;border:1px solid grey" width="50px" height="45px">
      </div>
      </div>
      {{review->created_at}}<br/>
      {{review->driver_id}}<br/>
      {{review->}}
      </div>
    </div> 
    <hr>
@endforeach
</div>
