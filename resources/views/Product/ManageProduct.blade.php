@extends('Product/Layout')
@section('page_title', 'Manage Product')
@section('container')

@if($id > 0)
    @php
        $image_required = "";
        $url = route('update', ['product' => $id]);
    @endphp
@else
    @php
        $image_required = "required";
        $url = route('store');
    @endphp
@endif


<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Manage Product</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <form class="form-horizontal form-label-left" action="{{$url}}" method="post" enctype="multipart/form-data"
        id="product-form-data">
        @csrf
        @if($id > 0)
            @method('PUT') <!-- Use PUT method for update -->
        @endif
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add New Product</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="form-control-label col-md-12 col-sm-12 col-xs-3 ms-2">Name</label>
                            <div class="col-md-12 col-sm-12 col-xs-9">
                                <input type="text" class="form-control border-0 shadow" value="{{$name}}" name="name">
                                @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label col-md-12 col-sm-12 col-xs-3">Slug</label>
                            <div class="col-md-12 col-sm-12 col-xs-9">
                                <input type="text" class="form-control" value="{{$slug}}" name="slug">
                                @error('slug')
                                    <div style="color:red;font-weight:bold;">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label col-md-12 col-sm-12 col-xs-3">Image(250px *
                                300px)</label>
                            <div class="col-md-12 col-sm-12 col-xs-9">
                                <input type="file" class="form-control" name="image" {{ $image_required }}>
                                @if($image != '')
                                    <a href="{{asset('storage/media/' . $image)}}" target="_blank"><img height="50px"
                                            width="50px" src="{{asset('storage/media/' . $image)}}" /></a>
                                @endif
                                @error('image')
                                    <div style="color:red;font-weight:bold;">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label col-md-12 col-sm-12 col-xs-3">Category</label>
                                    <div class="col-md-12 col-sm-12 col-xs-9">
                                        <select name="category" id="" class="form-control">
                                            <option value="">Select Category</option>
                                            @php
                                                $categories = ['Boys', 'Girls', 'Child', 'Mens', 'Womens'];
                                            @endphp

                                            @foreach($categories as $cat)
                                                <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>
                                                    {{ $cat }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label col-md-12 col-sm-12 col-xs-3">Brand</label>
                                    <div class="col-md-12 col-sm-12 col-xs-9">
                                        <select name="brand" id="" class="form-control">
                                            <option value="">Select Brand</option>
                                            @php
                                                $brands = [
                                                    'adidas' => 'Adidas',
                                                    'burberry' => 'Burberry',
                                                    'calvin_klein' => 'Calvin Klein',
                                                    'nike' => 'Nike',
                                                    'zara' => 'Zara'
                                                ];
                                            @endphp

                                            @foreach($brands as $key => $value)
                                                <option value="{{ $key }}" {{ $brand == $key ? 'selected' : '' }}>{{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label col-md-12 col-sm-12 col-xs-3">Model</label>
                                    <div class="col-md-12 col-sm-12 col-xs-9">
                                        <select name="model" id="" class="form-control">
                                            <option value="">Select Model</option>
                                            @php
                                                $models = [
                                                    'organic_cotton' => 'Organic Cotton',
                                                    'recycled_wood' => 'Recycled Wood',
                                                    'tencel' => 'Tencel'
                                                ];
                                            @endphp

                                            @foreach($models as $key => $value)
                                                <option value="{{ $key }}" {{ $model == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label col-md-12 col-sm-12 col-xs-3" for="short_desc">Short
                                Desc</label>
                            <div class="col-md-12 col-sm-12 col-xs-9">
                                <textarea name="short_desc" id="short_desc"
                                    class="form-control">{{$short_desc}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label col-md-12 col-sm-12 col-xs-3" for="desc">Desc</label>
                            <div class="col-md-12 col-sm-12 col-xs-9">
                                <textarea name="desc" id="desc" class="form-control">{{$desc}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label col-md-12 col-sm-12 col-xs-3">Keywords</label>
                            <div class="col-md-12 col-sm-12 col-xs-9">
                                <input type="text" class="form-control" value="{{$keywords}}" name="keywords">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label col-md-12 col-sm-12 col-xs-3"
                                for="technical_specification">Technical
                                Specification</label>
                            <div class="col-md-12 col-sm-12 col-xs-9">
                                <textarea name="technical_specification" id="technical_specification"
                                    class="form-control">{{$technical_specification}}</textarea>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="form-control-label col-md-12 col-sm-12 col-xs-3">Uses</label>
                            <div class="col-md-12 col-sm-12 col-xs-9">
                                <textarea name="uses" id="uses" class="form-control">{{$uses}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="form-control-label col-md-12 col-sm-12 col-xs-3">Lead Time</label>
                                    <div class="col-md-12 col-sm-12 col-xs-9">
                                        <input type="text" class="form-control" value="{{$lead_time}}" name="lead_time">
                                        @error('leadTime')
                                            <div style="color:red;font-weight:bold;">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label col-md-12 col-sm-12 col-xs-3">Tax</label>
                                    <div class="col-md-12 col-sm-12 col-xs-9">
                                        <select name="tax" id="" class="form-control">
                                            <option value="">Select Tax</option>
                                            @php
                                                $taxes = [
                                                    'gst_12' => 'GST 12%',
                                                ];
                                            @endphp

                                            @foreach($taxes as $key => $value)
                                                <option value="{{ $key }}" {{ $tax == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label col-md-12 col-sm-12 col-xs-3">IS Promo</label>
                                    <div class="col-md-12 col-sm-12 col-xs-9">
                                        <select name="is_promo" id="" class="form-control">
                                            @if($is_promo == '1')
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label col-md-12 col-sm-12 col-xs-3">IS Featured</label>
                                    <div class="col-md-12 col-sm-12 col-xs-9">
                                        <select name="is_featured" id="" class="form-control">
                                            @if($is_featured == '1')
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label col-md-12 col-sm-12 col-xs-3">IS Trending</label>
                                    <div class="col-md-12 col-sm-12 col-xs-9">
                                        <select name="is_tranding" id="" class="form-control">
                                            @if($is_tranding == '1')
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-control-label col-md-12 col-sm-12 col-xs-3">IS Discounted</label>
                                    <div class="col-md-12 col-sm-12 col-xs-9">
                                        <select name="is_discounted" id="" class="form-control">
                                            @if($is_discounted == '1')
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end Product Attributes select  -->
        <input type="submit" class="btn btn-sm btn-success form-control" value="Submit">
        <input type="hidden" name="id" value="{{$id}}" />
    </form>
</div>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('uses');
    CKEDITOR.replace('short_desc');
    CKEDITOR.replace('desc');
    CKEDITOR.replace('technical_specification');
</script>

@endsection