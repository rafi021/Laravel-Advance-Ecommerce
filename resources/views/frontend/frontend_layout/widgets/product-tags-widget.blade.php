@php
    $tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
    $tags_bn = App\Models\Product::groupBy('product_tags_bn')->select('product_tags_bn')->get();
@endphp
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @if (session()->get('langiage') == 'bangla')
            @foreach ($tags_en as $item)
            <a class="item active" title="Phone" href="{{ route('product.tag',['tag' => $item->product_tags_en]) }}">{{ str_replace(',',' ',$item->product_tags_en) }}</a>
            @endforeach
            @else
            @foreach ($tags_bn as $item)
                <a class="item active" title="Phone" href="{{ route('product.tag',['tag' => $item->product_tags_bn]) }}">{{ str_replace(',',' ',$item->product_tags_bn) }}</a>
            @endforeach
            @endif

        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->
