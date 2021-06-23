<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">{{ $name }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href='{{ route($url)}}'>{{ $name }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $section_name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
