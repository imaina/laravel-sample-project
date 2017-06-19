<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Admin Area</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('src/css/admin.css') }}">

	 @yield('styles')

    <script type="text/javascript">

          var baseUrl = " {{ URL::to('/')}} " ;

    </script>

        @yield('scripts')

</head>
<body>
      @include('includes.admin-header')

      	@yield('content')

      
</body>
</html>