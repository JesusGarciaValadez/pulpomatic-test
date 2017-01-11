@extends( 'layouts.app' )

@section( 'content' )
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">&nbsp;</div>
        <div class="panel-body">
          {!! Form::open( [
              'url'     => action( 'RoutesController@update', [
                'id'      => ''
              ] ),
              'method'  => 'POST',
              'class'   => 'form-horizontal',
            ] ) !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              {!! Form::label( 'email', 'Cantidad de conductores y clientes', [
                'class' => 'col-md-4 control-label'
              ] ) !!}

              <div class="col-md-6">
                {!! Form::number( 'driver', old( 'driver' ), [
                  'id'        => 'driver',
                  'class'     => 'form-control',
                  'required'  => 'required',
                  'autofocus' => 'autofocus',
                  'min'       => '1',
                  'max'       => '100',
                  'step'      => '1',
                ] ) !!}

                @if ( $errors->has( 'email' ) )
                  <span class="help-block">
                    <strong>{{ $errors->first( 'email' ) }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                {!! Form::submit( 'Iniciar', [
                  'class' => 'btn btn-primary'
                ] ) !!}

                {!! Form::button( 'Pausar', [
                  'class' => 'btn btn-secondary'
                ] ) !!}
              </div>
            </div>
          {!! Form::close() !!}

          <table class="table table-striped">

          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="map" style="height: 500px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section( 'scripts' )
  @parent
  <script>
    //https://developers.google.com/maps/documentation/javascript/examples/distance-matrix
    function initMap() {
      // Create a map object and specify the DOM element for display.
      var map = new google.maps.Map( document.getElementById( 'map' ), {
        scrollwheel: false,
        zoom: 15
      } );

      var image = 'favicon.ico';
      // Create a marker and set its position.
      var marker = new google.maps.Marker( {
        map: map,
        title: 'Hello World!',
        draggable: false,
        animation: google.maps.Animation.DROP,
        icon: image
      } );

      var infoWindow = new google.maps.InfoWindow( { map: map } );

      // Try HTML5 geolocation.
      if ( navigator.geolocation ) {
        navigator.geolocation.getCurrentPosition( function( position ) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };

          // infoWindow.setPosition( pos );
          // infoWindow.setContent( 'Location found.' );
          map.setCenter( pos );
          marker.setPosition( pos );
        }, function() {
          handleLocationError( true, infoWindow, map.getCenter() );
        } );
      } else {
        // Browser doesn't support Geolocation
        handleLocationError( false, infoWindow, map.getCenter() );
      }

      function handleLocationError( browserHasGeolocation, infoWindow, pos ) {
        infoWindow.setPosition( pos );
        infoWindow.setContent( browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZbmVv82INOxWGI2uJjrcdzL2jeNwpG4U&callback=initMap"
  async defer></script>
@endsection