    <!-- ================================== TOP NAVIGATION ================================== -->
    <div class="side-menu animate-dropdown outer-bottom-xs">
        <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
        <nav class="yamm megamenu-horizontal">
            <ul class="nav">

                @foreach ($categories as $category)
                    <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon {{ $category->category_icon }}" aria-hidden="true"></i>
                            @if (session()->get('language') == 'bangla')
                                {{ $category->category_name_bn }}
                            @else
                                {{ $category->category_name_en }}
                            @endif
                        </a>
                        <ul class="dropdown-menu mega-menu">
                            <li class="yamm-content">
                                <div class="row">
                                    @foreach ($category->subcategory as $subcategory)
                                        <div class="col-sm-12 col-md-3">
                                            <h2 class="title">
                                                <a
                                                    href="{{ route('subcategory.products', ['id' => $subcategory->id, 'slug' => $subcategory->subcategory_slug_en]) }}">
                                                    @if (session()->get('language') == 'bangla')
                                                        {{ $subcategory->subcategory_name_bn }}
                                                    @else
                                                        {{ $subcategory->subcategory_name_en }}
                                                    @endif
                                                </a>
                                            </h2>
                                            <ul class="links list-unstyled">
                                                @foreach ($subcategory->subsubcategory as $subsubcategory)
                                                    <li>
                                                        <a
                                                            href="{{ route('subsubcategory.products', ['id' => $subsubcategory->id, 'slug' => $subsubcategory->subsubcategory_slug_en]) }}">
                                                            @if (session()->get('language') == 'bangla')
                                                                {{ $subsubcategory->subsubcategory_name_bn }}
                                                            @else
                                                                {{ $subsubcategory->subsubcategory_name_en }}
                                                            @endif
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- /.yamm-content -->
                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                    <!-- /.menu-item -->
                @endforeach
            </ul>
            <!-- /.nav -->
        </nav>
        <!-- /.megamenu-horizontal -->
    </div>
    <!-- /.side-menu -->
    <!-- ================================== TOP NAVIGATION : END ================================== -->
