@extends('Product/Layout')
@section('page_title', 'Manage Product Images')
@section('container')
<link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="">

    <div class="page-title">
        <div class="title_left">
            <h3>Manage Product Images</h3>
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
                    <h2>Product Images</h2>
                    <div class="clearfix"></div>
                </div>
                <form class="form-horizontal form-label-left" action="{{route('productImagesStore'.$pid)}}" method="post"
                    enctype="multipart/form-data" id="product-form-data">
                    @csrf
                    <div class="x_content">


                        @if(session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form-control-label col-md-12 col-sm-12 col-xs-3">Image</label>
                            <div class="col-md-12 col-sm-12 col-xs-9">
                                <input type="hidden" class="form-control" name="pid" value="{{$pid}}">

                                <input type="file" class="form-control" name="images">

                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-sm btn-success form-control" value="Submit">
                </form>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Product Images List</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped table-bordered productData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Images</th>
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
        axios.get('/api/productImages/{{$pid}}')
            .then(response => {
                const productImages = response.data;

                // Print the data to the console
                console.log('Products data:', productImages);

                // Populate the table with the products data
                productImages.forEach((productImage, index) => { // Use index for count
                    const row = document.createElement('tr');

                    // Add count cell
                    const countCell = document.createElement('td');
                    countCell.textContent = index + 1; // Index starts from 0, so add 1 for count
                    row.appendChild(countCell);


                    const imageCell = document.createElement('td');
                    const imageElement = document.createElement('img');

                    imageElement.src = `${baseUrl}/${productImage.images}`;
                    imageElement.alt = productImage.images; // Set an alt attribute for accessibility
                    imageElement.style.width = '100px'; // Set width for the image (adjust as needed)
                    imageElement.style.height = 'auto';

                    imageCell.appendChild(imageElement);
                    row.appendChild(imageCell);



                    // Add button cell
                    const buttonCell = document.createElement('td');



                    // Delete button
                    const deleteButton = document.createElement('button');
                    deleteButton.innerHTML = '<i class="fa fa-trash"></i> Delete';
                    deleteButton.classList.add('btn', 'btn-danger'); // Add Bootstrap classes
                    deleteButton.addEventListener('click', () => {
                        deleteProductImage(productImage.id);
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


    function deleteProductImage(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            // Get CSRF token from the meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            axios.delete(`/api/productImages/${id}`, {
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
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
@endsection