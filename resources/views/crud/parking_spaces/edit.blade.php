@extends('base')
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Request Parking Space Update</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br />
        @endif
        <form method="post" action="{{ route('parking_spaces.update', $parking_space->id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">

                <label for="first_name"> Name:</label>
                <input type="text" class="form-control" name="name" value={{ $parking_space->name }} />
            </div>

            <div class="form-group">
                <label for="last_name">Location:</label>
                <input type="text" class="form-control map-input" id="address-input" name="address" value={{ $parking_space->address }} />
            </div>
            <input type="hidden" name="latitude" id="address-latitude" value="{{ $parking_space->latitude }}" />
            <input type="hidden" name="longitude" id="address-longitude" value="{{ $parking_space->longitude }}" />
            <div id="address-map-container" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>
            <div class="form-group">
                <label for="email">Description:</label>
                <input type="text" class="form-control" name="description" value={{ $parking_space->description }} />
            </div>
            <div>
               <label for="city">Open on:</label><br>
              <input type="checkbox" name="opentime1" value="1" {{$parking_space->poya==1 ? 'checked' : ''}}> Poya days
              <input type="checkbox" name="opentime2" value="1" {{$parking_space->public==1 ? 'checked' : ''}}> Public Holidays
              <input type="checkbox" name="opentime3" value="1" {{$parking_space->bank==1 ? 'checked' : ''}} > Bank Holidays<br><small>Thesse will be displayed for the users of the application</small><br><br>
          </div>
            <div class="form-group">
               <label for="reservation">Is reservation allowed?</label></br>
              <input type="radio"  name="reservation_status" value="yes"> Allowed<br>
              <input type="radio"  name="reservation_status" value="no"> Not allowed<br>
          </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
  <script src="{{ asset('assets/js/mapInput.js') }}"></script>
@endsection
