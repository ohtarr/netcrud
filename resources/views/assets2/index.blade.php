<!-- index.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Serial</th>
        <th>Manufacturer</th>
        <th>Model</th>
        <th>Location</th>
        <th>Vendor_Name</th>

        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($assets as $asset)
      <tr>
        <td>{{$asset['id']}}</td>
        <td>{{$asset['serial']}}</td>
        <td>{{$asset['manufacturer']}}</td>
        <td>{{$asset['model']}}</td>
		@if ($asset->getLocation())
	        <td>{{$asset->getLocation()->name}}</td>
		@else
	        <td></td>
		@endif
        <td>{{$asset['vendor_name']}}</td>
        <td><a href="{{action('AssetWebController@edit', $asset['id'])}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('AssetWebController@destroy', $asset['id'])}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  </body>
</html>
