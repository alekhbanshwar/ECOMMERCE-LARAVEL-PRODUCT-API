@extends('Product/Layout')
@section('page_title', 'Manage Product Attributes')
@section('container')
<meta name="csrf-token" content="{{ csrf_token() }}">
@if($id > 0)
    @php
        $image_required = "";
        $url = route('productAttrUpdate', ['pro_id' => $products_id, 'id' => $id]);
    @endphp
@else
    @php
        $image_required = "required";
        $url = route('productAttrStore', ['pro_id' => $products_id]);
    @endphp
@endif

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Manage Product Attributes</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            </div>
        </div>
    </div>
    <div class="clearfix"></div>


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Product Attributes</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="row" id="product_attr_box"></div>

                <div class="x_content">
                    @if(isset($data['message']))
                        <div class="alert alert-success">
                            {{ $data['message'] }}
                        </div>
                    @endif
                    <form class="form-horizontal form-label-left" action="{{$url.}}" method="post"
                        enctype="multipart/form-data" id="product-form-data">
                        @csrf
                        @if($id > 0)
                            @method('PUT') <!-- Use PUT method for update -->
                        @endif
                        <input type="hidden" name="pid" value="{{$products_id}}">
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="sku" class="control-label">SKU</label>
                                <input id="sku" type="text" value="{{$sku}}" name="sku" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="mrp" class="control-label">MRP</label>
                                <input id="mrp" type="text" value="{{$mrp}}" name="mrp" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="price" class="control-label">Price</label>
                                <input id="price" type="text" value="{{$price}}" name="price" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="size" class="control-label">Size</label>
                                <select class="form-control" name="size">
                                    <option value="">Select Size</option>
                                    @php
                                        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
                                    @endphp

                                    @foreach($sizes as $s)
                                        <option value="{{ $s }}" {{ $size == $s ? 'selected' : '' }}>
                                            {{ $s }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="color" class="control-label">Color</label>
                                <select id="color_" name="color" class="form-control">
                                    <option value="">Select Color</option>
                                    @php
                                        $colors = [
                                            'red' => 'Red',
                                            'yellow' => 'Yellow',
                                            'green' => 'Green',
                                            'blue' => 'Blue',
                                            'white' => "White",
                                            'navy_blue' => "Navy Blue",
                                            'maroon' => "Maroon"
                                        ];
                                    @endphp

                                    @foreach($colors as $key => $value)
                                        <option value="{{ $key }}" {{ $color == $key ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="qty" class="control-label">Qty</label>
                                <input id="qty" type="text" value="{{$qty}}" name="qty" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="attr_image" class="control-label">Image</label>
                            <input id="attr_image" type="file" value="" name="attr_image" class="form-control">
                            @if($attr_image != '')
                                <a href="{{asset('storage/media/' . $attr_image)}}" target="_blank"><img height="50px"
                                        width="50px" src="{{asset('storage/media/' . $attr_image)}}" /></a>
                            @endif
                        </div>
                        <input type="submit" class="btn btn-sm btn-success form-control" value="Submit">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Product Attributes</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="row" id="product_attr_box"></div>

                <div class="x_content">
                    <table class="table table-striped table-bordered productData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sku</th>
                                <th>Product Images</th>
                                <th>Mrp</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productsTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Product Attributes select  -->

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM fully loaded and parsed');

        const productsTableBody = document.querySelector('.productData tbody');
        const baseUrl = '{{ url('storage/media') }}';
        // Check if the element is correctly selected
        if (!productsTableBody) {
            console.error('productsTableBody element not found');
            return;
        }

        // Fetch the data from the API using Axios
        axios.get('/api/productAttr/{{$products_id}}')
            .then(response => {
                const productAttrs = response.data;

                // Print the data to the console
                console.log('Products data:', productAttrs);

                // Populate the table with the products data
                productAttrs.forEach((productAttr, index) => { // Use index for count
                    const row = document.createElement('tr');

                    // Add count cell
                    const countCell = document.createElement('td');
                    countCell.textContent = index + 1; // Index starts from 0, so add 1 for count
                    row.appendChild(countCell);

                    const skuCell = document.createElement('td');
                    skuCell.textContent = productAttr.sku;
                    row.appendChild(skuCell);

                    const imageCell = document.createElement('td');
                    const imageElement = document.createElement('img');

                    imageElement.src = `${baseUrl}/${productAttr.attr_image}`;
                    imageElement.alt = productAttr.attr_image; // Set an alt attribute for accessibility
                    imageElement.style.width = '100px'; // Set width for the image (adjust as needed)
                    imageElement.style.height = 'auto';

                    imageCell.appendChild(imageElement);
                    row.appendChild(imageCell);

                    const mrpCell = document.createElement('td');
                    mrpCell.textContent = productAttr.mrp;
                    row.appendChild(mrpCell);

                    const priceCell = document.createElement('td');
                    priceCell.textContent = productAttr.price;
                    row.appendChild(priceCell);

                    const qtyCell = document.createElement('td');
                    qtyCell.textContent = productAttr.qty;
                    row.appendChild(qtyCell);

                    const sizeCell = document.createElement('td');
                    sizeCell.textContent = productAttr.size;
                    row.appendChild(sizeCell);

                    const colorCell = document.createElement('td');
                    colorCell.textContent = productAttr.color;
                    row.appendChild(colorCell);



                    // Add button cell


                    const buttonCell = document.createElement('td');
                    // Edit button
                    const editButton = document.createElement('button');
                    editButton.innerHTML = '<i class="fa fa-edit"></i> Edit';
                    editButton.classList.add('btn', 'btn-primary'); // Add Bootstrap classes
                    editButton.addEventListener('click', () => {
                        window.location.href = `/ManageProductAttr/{{$products_id}}/${productAttr.id}`;
                    });
                    buttonCell.appendChild(editButton);
                    // Delete button
                    const deleteButton = document.createElement('button');
                    deleteButton.innerHTML = '<i class="fa fa-trash"></i> Delete';
                    deleteButton.classList.add('btn', 'btn-danger'); // Add Bootstrap classes
                    deleteButton.addEventListener('click', () => {
                        deleteproductAttr(productAttr.id);
                    });
                    buttonCell.appendChild(deleteButton);

                    row.appendChild(buttonCell);
                    productsTableBody.appendChild(row);
                });



                // Initialize DataTable after data is loaded
                $('.productData').DataTable();
            })
            .catch(error => {
                console.error('There was an error fetching the products!', error);
            });
    });


    function deleteproductAttr(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            // Get CSRF token from the meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            axios.delete(`/api/productAttr/${id}`, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
                .then(response => {

                    const elementToRemove = document.getElementById(`${id}`);
                    if (elementToRemove) {
                        elementToRemove.remove();
                        window.location.reload();
                    } else {
                        console.error(`Element with ID ${id} not found.`);
                    }
                })

        }
    }

</script>

</div>
@endsection