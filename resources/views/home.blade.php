@extends( 'layouts.app' )

@section( 'content' )
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">&nbsp;</div>
        <div class="panel-body">
          {!! Form::open( [
              'url'     => route( 'drivers', [ 'quantity' => '1' ] ),
              'method'  => 'get',
              'class'   => 'form-horizontal',
            ] ) !!}

            <div class="form-group{{ $errors->has( 'driver' ) ? ' has-error' : '' }}">
              {!! Form::label( 'quantity', 'Cantidad de conductores/clientes', [
                'class' => 'col-md-4 control-label'
              ] ) !!}

              <div class="col-md-6">
                {!! Form::number( 'quantity', old( 'quantity' ), [
                  'id'        => 'quantity',
                  'class'     => 'form-control',
                  'required'  => 'required',
                  'autofocus' => 'autofocus',
                  'min'       => '1',
                  'max'       => '100',
                  'step'      => '1',
                ] ) !!}

                @if ( $errors->has( 'quantity' ) )
                  <span class="help-block">
                    <strong>{{ $errors->first( 'quantity' ) }}</strong>
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
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="map" style="height: 500px;"></div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Conductor</th>
                <th>Cliente</th>
                <th>Distancia</th>
                <th>Tiempo estimado de llegada</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tfoot>
            <tbody id="output">
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section( 'scripts' )
  <script>
    function initMap() {
      // Try HTML5 geolocation.
      if ( navigator.geolocation ) {
        navigator.geolocation.getCurrentPosition( function( position ) {
          var pos             = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };

          var bounds          = new google.maps.LatLngBounds;
          var markersArray    = [];

          var origin1         = { lat: 19.4239979, lng: -99.1695064 };
          var destination1    = "Calle Liverpool 158, Juarez, Juárez, 06600 Ciudad de México, CDMX";

          // Set icons for drivers and clients
          var originIcon      = 'https://chart.googleapis.com/chart?' +
                                'chst=d_map_pin_letter&chld=P|387BBA|FFFFFF';
          var destinationIcon = 'https://chart.googleapis.com/chart?' +
                                'chst=d_map_pin_letter&chld=C|00ACBC|FFFFFF';

          // Make a new maps instance
          var map = new google.maps.Map( document.getElementById( 'map' ), {
            center: pos,
            zoom: 18
          } );

          // Make a geocoder service instance
          var geocoder = new google.maps.Geocoder;

          var service = new google.maps.DistanceMatrixService;
            service.getDistanceMatrix( {
              origins:        [ origin1 ],
              destinations:   [ destination1 ],
              travelMode:     google.maps.TravelMode.WALKING,
              unitSystem:     google.maps.UnitSystem.METRIC,
              avoidHighways:  false,
              avoidTolls:   false
            }, function( response, status ) {
              if ( status !== google.maps.DistanceMatrixStatus.OK ) {
                alert( 'Error was: ' + status );
              } else {
                var originList      = response.originAddresses;
                var destinationList = response.destinationAddresses;
                var outputDiv       = document.getElementById( 'output' );
                outputDiv.innerHTML = '';
                deleteMarkers( markersArray );

                var showGeocodedAddressOnMap = function( asDestination ) {
                  var icon = asDestination ? destinationIcon : originIcon;
                  return function( results, status ) {
                    if ( status === google.maps.GeocoderStatus.OK ) {
                      map.fitBounds( bounds.extend( results[ 0 ].geometry.location ) );
                      markersArray.push( new google.maps.Marker( {
                        map:      map,
                        position: results[ 0 ].geometry.location,
                        icon:     icon
                      } ) );
                    } else {
                      alert( 'Geocode was not successful due to: ' + status );
                    }
                  };
                };

                for ( var i = 0; i < originList.length; i++ ) {
                  var results = response.rows[ i ].elements;
                  geocoder.geocode( { 'address': originList[ i ] },
                      showGeocodedAddressOnMap( false ) );
                  for ( var j = 0; j < results.length; j++ ) {
                    geocoder.geocode( { 'address': destinationList[ j ] },
                        showGeocodedAddressOnMap( true ) );
                    outputDiv.innerHTML += "<tr><td>" + originList[ i ] + "</td><td>" + destinationList[ j ] + "</td><td>" + results[j].distance.text + "</td><td>" + results[j].duration.text + "</td></tr>";
                  }
                }
              }
            });

          function deleteMarkers( markersArray ) {
            for ( var i = 0; i < markersArray.length; i++ ) {
              markersArray[ i ].setMap( null );
            }
            markersArray = [];
          }
        } );
      }
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZbmVv82INOxWGI2uJjrcdzL2jeNwpG4U&callback=initMap"
    async defer></script>

  @parent
@endsection