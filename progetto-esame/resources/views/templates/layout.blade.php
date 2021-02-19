<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="csrf-token" content='{{csrf_token()}}'>
   <title>@yield('title','BigMuscle')</title>
   <script src="https://kit.fontawesome.com/267061b199.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <!--CSS IMPORT -->
   <link rel="stylesheet" href='/css/main.css'>
   <link rel="stylesheet" href="{{asset('css/mobileMenu.css')}}">
   <link rel="stylesheet" href="{{asset('/css/social.CSS')}}">
   @yield('css' , "")

   <!-- Bootstrap , Jquery e popper -->
   <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   <!--javascript-->
   <script src="{{asset('js/mainLayout.js')}}" defer> </script>
</head>

<body>
   <div style="overflow: hidden;">
      <div>
         <nav class="navbar navbar-expand-md navbar-dark  nav-row">
            <div id="mobile-menu-btn" class="mobile-menu-button collapsed" onclick="showMobileMenu()">
               <button class="btn btn-small "><span class="fas fa-bars text-white"> </span> </button>
            </div>
            <div class="home-link">
               <div id="image-background">
                  <a class="navbar-brand text-bold  text-size-medium" href=@yield('home','/')> <label class="hide-meta">Big Muscle </label></a>
               </div>
            </div>
            <div id="logout-container" class="log-containers">
               <a class="btn btn-danger" href="/"><label class="hide-meta  text-size-small text-white label-link  pr-2">Log Out</label><span class="fas fa-sign-out-alt label-link"></span></a>
            </div>
         </nav>
      </div>
      <div class="row view">
         <div id="side" class="hide-meta">
            <div id="side-menu" class="j-c-between pb-2">
               <h3 class="hide-meta collapseElement">Menu</h3>
               <div id="menu-collapse-btn" class="menu-collapse" onclick="collapseMenu(this)">
                  <div class="menu-btn_burger">
                  </div>
               </div>
            </div>
            <div id="navigation-menu">
               <div class="side-menu-item">
                  <a href="/profile/" class="side-menu-link"><i class="fas fa-user icon pt-1"> </i><span class="hide-meta ml-2 collapseElement text-size-small">PROFILE</span></a>
               </div>
               <div class="side-menu-item">
                  <a href="/exercise/" class="side-menu-link"><i class="fas fa-dumbbell icon pt-1"> </i><span class="hide-meta ml-1 collapseElement text-size-small">EXERCISE</span></a>
               </div>
               <div class="side-menu-item">
                  <a href="#" class="side-menu-link"><i class="fas fa-chalkboard-teacher icon pt-1 "> </i><span class="hide-meta ml-2 collapseElement text-size-small">CLASSES</span></a>
               </div>
            </div>

         </div>
         <!-- MOBILE MENU-->

         <div id="mobile-menu" class="mobile-menu">
            <div class="menu-header">
               <h5>Big Muscle </h5>
            </div>
            <div class="menu-mobile-item">
               <a href="/profile/" class="start-centered"><span class="fas fa-user icon"> </span><span class="menu-selection">PROFILE</span></a>
            </div>
            <div class="menu-mobile-item">
               <a href="/exercise/" class="start-centered"><span class="fas fa-dumbbell icon"> </span><span class="menu-selection">EXERCISE</span></a>
            </div>
            <div class="menu-mobile-item">
               <a href="#" class="start-centered"><span class="fas fa-chalkboard-teacher icon"> </span><span class="menu-selection">CLASSES</span></a>
            </div>

         </div>

         <!--END MOBILE MENU-->
         <div id="main">
            <!-- content su cio verranno inettati i contenuti della pagina. -->
            <div class="main-content-container">
               <div id="section-header">
                  <div id="pageSectionName" class="py-1 pl-4 text-bold text-white">
                     <span class="text-uppercase text-size-medium"> @yield('user','UserName') @yield('arrow' , '->') @yield('webSection','Dashboard') </span>
                  </div>
               </div>
               @yield('content')
            </div>
         </div>

      </div>


      <!-- Footer -->
      @include('/partial/footer')

   
   </div>
</body>

</html>