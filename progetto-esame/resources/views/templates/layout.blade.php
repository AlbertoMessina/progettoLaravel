
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content='{{csrf_token()}}'>
    <title>@yield('title','BigMuscle')</title>
    <script src="https://kit.fontawesome.com/267061b199.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href = '/css/app.css'>
  </head>
  <body>
     <div>
       <nav class="navbar navbar-expand-md navbar-dark bg-dark nav-row">
         <div id="image-background">
            <a class="navbar-brand text-bold" href="/">Big Muscle</a>
         </div>
         <div id="section-header">
            <label id="pageSectionName" class= "text-bold text-white">
            @yield('user','UserName') @yield('arrow' , '->') @yield('webSection','Dashboard')
            <label>
         </div>
         <div id="logoutContainer">
            <button class="btn btn-danger">LogOut </button>
         </div>
       </nav>
   </div>
<div class="row">
   <div class="side">
       <h2>Menu</h2>
       <div class="list-group list-group-menu">
        <a href="/profile/" class="list-group-item list-group-item-action mb-1 navigation">Profile</a>
        <a href="/exercise/" class="list-group-item list-group-item-action mb-1 navigation">Exercise</a>
        <a href="#" class="list-group-item list-group-item-action navigation">Classes</a>
      </div>
   </div>
<div class="main">

<!-- content su cio verranno inettati i contenuti della pagina. -->
 @yield('content')

</div><!-- /.container -->
</div>
<!-- Footer -->
<div class="footer">
  <h2>Footer</h2>
  @section('footer')
</div>

<!-- Bootstrap , Jquery e popper -->
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

@section('script')
<!--Myscript -->
@show
</body>
</html>
