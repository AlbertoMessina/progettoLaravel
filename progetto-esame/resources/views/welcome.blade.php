
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content='{{csrf_token()}}'>
    <title>@yield('title','BigMuscle')</title>
    <script src="https://kit.fontawesome.com/267061b199.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--CSS IMPORT -->
    <link rel="stylesheet" href = '/css/main.css'>
    <link rel="stylesheet" href='/css/welcome.CSS'>
    <link rel="stylesheet" href='/css/social.CSS'>
    @yield('css' , "")
  </head>
  <body>
    <div class="page-wrap">

     <div class="nav-container">
       <nav class="navbar navbar-expand-md nav-row">
          <div class="home-link">
             <div id="image-background">
               <a class="navbar-brand text-bold  text-size-medium" href=@yield('home','/')><label class="hide-meta">Big Muscle </label></a>
            </div>
         </div>
          <div id="login-container" class="log-containers">
             <a class="btn btn-success" href="/profile"><label class="hide-meta text-size-small label-link text-white pr-2">Sign In</label><span class="fas fa-sign-in-alt label-link"></span></a>
          </div>
       </nav>
   </div>
   <!-- end nav -->

   <div class="welcome-content">
      <div class="welcome-card-presentation">
         <div class="img-container-presentation">
            <div class="positioning-presentation">
               <h1 class="presentation-title">BIG MUSCLE </h1>
            </div>
            <img src="/images/presentation.jpg" />
         </div>
      </div>
      <div class="welcome-card">
         <div class="card-info-container">
            <div class="card-text-container">
               <h2>WELCOME ATLETE<H2>
               <p>Start like a pro!</p>
               <p>Find your trusted coach and get started</p>
               <p>Get advice from the best experts in the sector</p>             
            </div>
         </div>
         <div class="img-container">
            <div class="positioning">
               <div class="sign-up-form">
               <!--Sign in form-->
                  <form id="sign-in"  method ="POST" href="">
                     <div class="form-group">
                       <label class="form-label" data-error="wrong" data-success="right" for="sign-name"><span >NAME</span></label>
                       <input type="text" id="sign-name" name='sign_name' class="form-control">
                     </div>
                     <div class="form-group">
                       <label class="form-label" data-error="wrong" data-success="right" for="sign-surname"><span>SURNAME</span></label>
                       <input type="text" id="sign-surname" name='sign_surname' class="form-control">
                     </div>
                     <div class="center-centered">
                     <input type='submit' id="sign-in"  class="btn btn-success btn-unique" value="JOIN NOW">
                     </div>
                  </form>
               </div>
            </div>
            <img src="/images/welcome1.jpg"/>
         </div>
      </div>
      <div class="welcome-card mt-2">
         <div class="img-container">
            <div class="positioning-2">
            <h2>WELCOME ATLETE<H2>
               <p>Start like a pro!</p>
               <p>Find your trusted coach and get started</p>
               <p>Get advice from the best experts in the sector</p>
            </div>
            <img src="/images/personaltrainer.jpg"/>
         </div>
         <div class="card-info-container">
            <div class="card-text-container">
                  <h2>WELCOME COACH<H2>
                  <p>Start like a pro!</p>
                  <p>Find your trusted atlete and get started</p>
                  <p>Menage your class and your work</p>
                  <p>See what you can do </p>
            </div>
            </div>
      </div>
   
   </div>
 
 
</div>
<div class='blanck-space'>
   </div>
<!-- Footer -->
@include('/partial/footer')

<!-- Bootstrap , Jquery e popper -->
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script src="{{asset('js/mainLayout.js')}}"> </script>
@section('script')
<!--Myscript -->
@show
</body>
</html>
