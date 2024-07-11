@extends('Product/Layout')
@section('page_title', 'Product View')
@section('container')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>E-commerce </h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">

                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Product Details</h2>
                    <ul class="nav navbar-right panel_toolbox">

                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="product-image">
                            <img src="{{asset('storage/media/' . $result->image)}}" alt="..." height="482.4px"
                                width="437.09px" />
                        </div>
                        <div class="product_gallery" style="border:none;">
                            @foreach ($result->productImages as $images)
                                <a>
                                    <img src="{{asset('storage/media/' . $images->images)}}" alt="..." height="98.4px"
                                        width="76.66px" />
                                </a>
                            @endforeach

                        </div>
                    </div>

                    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                        <h3 class="prod_title">{{$result->name}}</h3>
                        @foreach ($result->productAttrs as $price)
                            <h4 style="color:black;"> Rs.{{$price->mrp}} <small style="color:red;">
                                    <del>Rs.{{$price->price}}</del></small></h4>
                        @endforeach
                        <p>{!!$result->short_desc!!}</p>
                        <div class="">
                            <h2 style="font-weight:bold;color:black;">Available Colors</h2>
                            <ul class="list-inline prod_color">
                                @foreach ($result->productAttrs as $colors)
                                    <li>
                                        <p>{{ $colors->color }}</p>
                                        <div class="color bg-{{ $colors->color }}"></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="">
                            <h2 style="font-weight:bold;color:black;">Size <small style="color:red;">Please select
                                    one</small></h2>
                            <ul class="list-inline prod_size">
                                @foreach ($result->productAttrs as $sizes)
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs">{{ $sizes->size }}</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <p class="aa-product-avilability" style="color:black;">Avilability: <span style="color:red;">In
                                stock</span></p>
                        <div class="product_price">
                            <h4 class="price">Tax : {{$result->tax}}</h4>
                        </div>

                        <div class="">
                            <button type="button" class="btn btn-success btn-sm">Add to Cart</button>
                            <button type="button" class="btn btn-dark btn-sm">Add to Wishlist</button>
                        </div>

                        <div class="product_social">
                            <ul class="list-inline">
                                <li><a href="#"><i class="fa fa-facebook-square"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-twitter-square"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-envelope-square"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-rss-square"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <br>

                    <div class="col-md-12">

                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab"
                                        data-toggle="tab" aria-expanded="true">Technical Specification</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab"
                                        data-toggle="tab" aria-expanded="false">Uses</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2"
                                        data-toggle="tab" aria-expanded="false">Keywords</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                    aria-labelledby="home-tab">
                                    <p>{!!$result->technical_specification!!}</p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2"
                                    aria-labelledby="profile-tab">
                                    <p>{!!$result->uses!!}</p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content3"
                                    aria-labelledby="profile-tab">
                                    <p>{{$result->keywords}}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    // Function to check if the pattern appears only once in the document
    function checkUniquePattern() {
        let pattern = "Rs.{{$price->mrp}} Rs.{{$price->price}}";
        let patternCount = 0;

        // Get all text content from the blade.php file
        let textContent = document.body.innerText;

        // Count occurrences of the pattern
        patternCount = (textContent.match(new RegExp(pattern, "g")) || []).length;

        // If pattern appears only once, return true; otherwise, false
        return patternCount === 1;
    }

    // Function to run when the window finishes loading
    window.onload = function () {
        if (checkUniquePattern()) {
            console.log("Pattern appears only once in blade.php");
        } else {
            console.log("Pattern appears more than once or not at all in blade.php");
        }
    };
</script>
@endsection