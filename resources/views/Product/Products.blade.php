@extends('Product/Layout')
@section('page_title', 'Products')
@section('container')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Products</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Product List </h2>
                    <ul class="nav navbar-right">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped table-bordered productData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Product Images / Product Attributes</th>
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM fully loaded and parsed');

        const productsTableBody = document.querySelector('.productData tbody');

        // Check if the element is correctly selected
        if (!productsTableBody) {
            console.error('productsTableBody element not found');
            return;
        }

        // Fetch the data from the API using Axios
        axios.get('/api/products')
            .then(response => {
                const products = response.data;

                // Print the data to the console
                console.log('Products data:', products);

                // Populate the table with the products data
                products.forEach((product, index) => { // Use index for count
                    const row = document.createElement('tr');

                    // Add count cell
                    const countCell = document.createElement('td');
                    countCell.textContent = index + 1; // Index starts from 0, so add 1 for count
                    row.appendChild(countCell);


                    const categoryCell = document.createElement('td');
                    categoryCell.textContent = product.category;
                    row.appendChild(categoryCell);

                    const nameCell = document.createElement('td');
                    nameCell.textContent = product.name;
                    row.appendChild(nameCell);



                    // Add button cell
                    const addButtonCell = document.createElement('td');

                    // View Details button
                    const addProductImagesButton = document.createElement('button');
                    addProductImagesButton.innerHTML = '<i class="fa fa-plus"></i> Add Product Images';
                    addProductImagesButton.classList.add('btn', 'btn-info'); // Add Bootstrap classes
                    addProductImagesButton.addEventListener('click', () => {
                        window.location.href = `/ManageProductImages/${product.id}`;
                    });
                    addButtonCell.appendChild(addProductImagesButton);

                    const addProductAttrButton = document.createElement('button');
                    addProductAttrButton.innerHTML = '<i class="fa fa-plus"></i> Add Product Attr';
                    addProductAttrButton.classList.add('btn', 'btn-info'); // Add Bootstrap classes
                    addProductAttrButton.addEventListener('click', () => {
                        window.location.href = `/ManageProductAttr/${product.id}`;
                    });
                    addButtonCell.appendChild(addProductAttrButton);


                    row.appendChild(addButtonCell);
                    // Add button cell
                    const buttonCell = document.createElement('td');

                    // View Details button
                    const viewButton = document.createElement('button');
                    viewButton.innerHTML = '<i class="fa fa-eye"></i> View';
                    viewButton.classList.add('btn', 'btn-info'); // Add Bootstrap classes
                    viewButton.addEventListener('click', () => {
                        window.location.href = `/ProductView/${product.id}`;
                    });
                    buttonCell.appendChild(viewButton);

                    // Edit button
                    const editButton = document.createElement('button');
                    editButton.innerHTML = '<i class="fa fa-edit"></i> Edit';
                    editButton.classList.add('btn', 'btn-primary'); // Add Bootstrap classes
                    editButton.addEventListener('click', () => {
                        window.location.href = `/ManageProduct/${product.id}`;
                    });
                    buttonCell.appendChild(editButton);

                    // Delete button
                    const deleteButton = document.createElement('button');
                    deleteButton.innerHTML = '<i class="fa fa-trash"></i> Delete';
                    deleteButton.classList.add('btn', 'btn-danger'); // Add Bootstrap classes
                    deleteButton.addEventListener('click', () => {
                        deleteProduct(product.id);
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


    function deleteProduct(product) {
        if (confirm('Are you sure you want to delete this product?')) {
            // Get CSRF token from the meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            axios.delete(`/api/products/${product}`, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
                .then(response => {

                    const elementToRemove = document.getElementById(`${product}`);
                    if (elementToRemove) {
                        elementToRemove.remove();
                        window.location.reload();
                    } else {
                        console.error(`Element with ID ${product} not found.`);
                    }
                })

        }
    }

</script>

@endsection