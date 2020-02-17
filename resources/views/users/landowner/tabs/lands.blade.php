<div class="container" style="background:black">
  <a href="{{ route('parking_spaces.create')}}" ><button class="btn btn-outline-success" >Create new Parking Space</button></a>

  @foreach($landowner_parking_spaces as $parking_space)
  <div class="row">
    <div class="col">
      <div class="app">
        <header>
         
        </header>
        <main>
          <h1 style="color:blue;">{{$parking_space->name}}</h1>
          <p style="color:black; font-size:15px;"> {{$parking_space->description}}</p><p style="color:black; font-size:15px;"> {{$parking_space->address}} </p>
          <button class="button button2" href="#">
            <?php
          $status = $parking_space->reservation_status_on;
          if ($status == 0) {
            echo "CLOSE";
          }
          else {
            echo "OPEN";
          }
           ?></button>
           <br><br><br>
            <a href="/images">Read full article</a>
          </main>
          <nav>
            <!-- <button class="button button2" href="#">View</button> -->
            <!-- <button class="button button2" href="#">Request Update</button> -->
            <!-- <button type="button" href="#">Request Delete</button> -->
            {{-- <form action="/landDetails" method="GET" role="search">
              <input type="hidden" value="{{$parking_space->id}}" name="landDetails_id">
              <button class="btn btn-outline-success" type="submit">View</button>
            </form> --}}
              @if($parking_space->latitude && $parking_space->longitude)
              <a href="http://maps.google.com/maps?q={{ $parking_space->latitude}},{{ $parking_space->longitude }}&ll={{ $parking_space->latitude}},{{ $parking_space->longitude }}&z=17" target="_blank">
                <button class="btn btn-outline-success">View</button>
              </a>
              @endif
            <!-- <button type="button" class="btn btn-outline-success">Request Update</button> -->
            <form action="/landEdit" method="GET" role="search">
              <input type="hidden" value="{{$parking_space->id}}" name="landEdit_id">
              <button class="btn btn-outline-success" type="submit">Request Update</button>
            </form>
            <form action="/landDelete" method="GET" role="search">
              <input type="hidden" value="{{$parking_space->id}}" name="landDelete_id">
              <button class="btn btn-outline-danger" type="submit">Request Delete</button>
            </form>

          </nav>
        </div>
      </div>

    </div>
@endforeach
  </div>
