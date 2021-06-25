<div class="breadcrumb">
<div class="container">
    <div class="breadcrumb-inner">
    <ul class="list-inline list-unstyled">
        <li><a href="{{ route('home') }}">Home</a></li>
        @if (request()->routeIs('category'))
        <li class="request()->routeIs('category')? 'active': ''">Category</li>
        @elseif (request()->routeIs('login'))
        <li class="request()->routeIs('login')? 'active': ''">Login</li>
        @else
        {{-- <li class="request()->routeIs('')? 'active': ''">{{ request()->route() }}</li> --}}
        @endif
    </ul>
    </div>
    <!-- /.breadcrumb-inner -->
</div>
<!-- /.container -->
</div>
<!-- /.breadcrumb -->
