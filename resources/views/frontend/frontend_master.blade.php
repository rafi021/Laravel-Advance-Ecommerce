
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>Flipmart premium HTML5 & CSS3 Template</title>

@include('frontend.frontend_layout.body.style')

</head>
<body class="cnt-home">
<!--  HEADER  -->
@include('frontend.frontend_layout.body.header')
<!--  HEADER : END  -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 
      <!--  SIDEBAR  -->
      @include('frontend.frontend_layout.body.sidebar')
      <!--  SIDEBAR : END  --> 
      @yield('frontend_content')
  </div>
<!-- /.row --> 
  </div>
  <!-- /.container --> 
</div>
<!-- /#top-banner-and-menu --> 

<!--  FOOTER  -->
@include('frontend.frontend_layout.body.footer')
<!--  FOOTER : END --> 

@include('frontend.frontend_layout.body.script')

</body>
</html>