<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Some project information
<h2>ECOMMER-LARAVEL-API PROJECT DOCUMENTATION</h2>
    <ul>
        <li>Install composer</li>
        <li>Create Project:
            <ul>
                <li>composer create-project laravel/laravel ECOMMER-LARAVEL-API</li>
            </ul>
        </li>
        <li>Install API for the projects
            <ul>
                <li>php artisan install:API</li>
            </ul>
        </li>
        <li>Some changes on user.php model:
            <ul>
                <li>use Laravel\Sanctum\HasAPITokens;</li>
                <li>use HasFactory, Notifiable, HasAPITokens;</li>
            </ul>
        </li>
        <li>Create product model:
            <ul>
                <li>php artisan make:model Product -m</li>
            </ul>
        </li>
        <li>Some changes in product.php file in model:
            <ul>
                <li>protected $table = 'products';</li>
                <li>protected $fillable = [
                    'category', 'name', 'image', 'slug', 'brand', 'model', 'short_desc', 
                    'desc', 'keywords', 'technical_specification', 'uses', 'lead_time', 
                    'tax', 'is_promo', 'is_featured', 'is_discounted', 'is_tranding', 'status'
                ];</li>
                <li>public function productAttrs() {
                    return $this->hasMany(ProductAttr::class, 'products_id');
                }</li>
                <li>public function productImages() {
                    return $this->hasMany(ProductImages::class, 'products_id');
                }</li>
            </ul>
        </li>
        <li>Product migration file (2024_07_08_091615_create_products_table.php):
            <ul>
                <li>$table->id();</li>
                <li>$table->string('category');</li>
                <li>$table->string('name');</li>
                <li>$table->string('image')->default("NULL");</li>
                <li>$table->string('slug');</li>
                <li>$table->string('brand');</li>
                <li>$table->string('model');</li>
                <li>$table->text('short_desc')->default("NULL");</li>
                <li>$table->text('desc')->default("NULL");</li>
                <li>$table->text('keywords')->default("NULL");</li>
                <li>$table->text('technical_specification')->default("NULL");</li>
                <li>$table->text('uses')->default("NULL");</li>
                <li>$table->string("lead_time")->default("NULL");</li>
                <li>$table->string("tax")->default("NULL");</li>
                <li>$table->integer("is_promo");</li>
                <li>$table->integer("is_featured");</li>
                <li>$table->integer("is_discounted");</li>
                <li>$table->integer("is_tranding");</li>
                <li>$table->integer('status');</li>
                <li>$table->timestamps();</li>
            </ul>
        </li>
        <li>Create controller ProductController:
            <ul>
                <li>php artisan make:controller API/ProductController</li>
            </ul>
        </li>
        <li>Create API in route(API.php) for product:
            <ul>
                <li>Route::APIResource('products', ProductController::class);</li>
                <li>Or</li>
                <li>Route::get('products', [ProductController::class, 'Index']);</li>
                <li>Route::post('products', [ProductController::class, 'store'])->name('store');</li>
                <li>Route::get('products/{product}', [ProductController::class, 'show']);</li>
                <li>Route::put('products/{product}', [ProductController::class, 'update'])->name('update');</li>
                <li>Route::delete('products/{product}', [ProductController::class, 'destroy']);</li>
            </ul>
        </li>
        <li>Check all the API list for this product:
            <ul>
                <li>php artisan route:list</li>
            </ul>
        </li>
        <li>Create the resource for product:
            <ul>
                <li>php artisan make:resource ProductResource</li>
            </ul>
        </li>
        <li>Create ProductAttr model:
            <ul>
                <li>php artisan make:model ProductAttr -m</li>
            </ul>
        </li>
        <li>Some changes in ProductAttr.php file in model:
            <ul>
                <li>protected $table = 'product_attrs';</li>
                <li>protected $fillable = [
                    'products_id', 'sku', 'attr_image', 'mrp', 'price', 'qty', 'size', 'color'
                ];</li>
                <li>public function product() {
                    return $this->belongsTo(Product::class, 'products_id');
                }</li>
            </ul>
        </li>
        <li>ProductAttr migration file (2024_07_08_091624_create_product_attrs_table.php):
            <ul>
                <li>$table->id();</li>
                <li>$table->foreignId("products_id")->references('id')->on('products');</li>
                <li>$table->string("sku");</li>
                <li>$table->string("attr_image")->default("NULL");</li>
                <li>$table->integer("mrp");</li>
                <li>$table->integer("price");</li>
                <li>$table->integer("qty");</li>
                <li>$table->string("size");</li>
                <li>$table->string("color");</li>
                <li>$table->timestamps();</li>
            </ul>
        </li>
        <li>Create controller ProductAttrController:
            <ul>
                <li>php artisan make:controller API/ProductAttrController</li>
            </ul>
        </li>
        <li>Create API in route(API.php) for productAttr:
            <ul>
                <li>Route::get('productAttr/{pro_id}', [ProductAttrController::class, 'productAttrIndex']);</li>
                <li>Route::post('productAttr/{pro_id}', [ProductAttrController::class, 'productAttrStore'])->name('productAttrStore');</li>
                <li>Route::get('productAttr/{pro_id}/{id}', [ProductAttrController::class, 'productAttrShow']);</li>
                <li>Route::put('productAttr/{pro_id}/{id}', [ProductAttrController::class, 'productAttrUpdate'])->name('productAttrUpdate');</li>
                <li>Route::delete('productAttr/{id}', [ProductAttrController::class, 'productAttrDestroy']);</li>
            </ul>
        </li>
        <li>Create ProductImages model:
            <ul>
                <li>php artisan make:model ProductImages -m</li>
            </ul>
        </li>
        <li>Some changes in ProductImages.php file in model:
            <ul>
                <li>protected $table = 'product_images';</li>
                <li>protected $fillable = ['products_id', 'images'];</li>
                <li>public function product() {
                    return $this->belongsTo(Product::class, 'products_id');
                }</li>
            </ul>
        </li>
        <li>ProductImages migration file (2024_07_08_091631_create_product_images_table.php):
            <ul>
                <li>$table->id();</li>
                <li>$table->foreignId("products_id")->references('id')->on('products');</li>
                <li>$table->string('images')->default("NULL");</li>
                <li>$table->timestamps();</li>
            </ul>
        </li>
        <li>Create controller ProductImagesController:
            <ul>
                <li>php artisan make:controller API/ProductImagesController</li>
            </ul>
        </li>
        <li>Create API in route(API.php) for productImages:
            <ul>
                <li>Route::get('productImages/{pro_id}', [ProductImagesController::class, 'ProductImages']);</li>
                <li>Route::post('productImages/{pro_id}', [ProductImagesController::class, 'productImagesStore'])->name('productImagesStore');</li>
                <li>Route::get('productImages/{pro_id}/{id}', [ProductImagesController::class, 'productImagesShow']);</li>
                <li>Route::delete('productImages/{id}', [ProductImagesController::class, 'productImagesDestroy']);</li>
            </ul>
        </li>
        <li>Go to controller then perform work</li>
        <li>All API error handling, then go to bootstrap->app.php and some changes:
            <ul>
                <li>use Illuminate\Http\Request;</li>
                <li>use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;</li>
                <li>$exceptions->render(function (NotFoundHttpException $e, Request $request) {
                    if ($request->is('API/*')) {
                        return response()->json([
                            'message' => 'Record not found.'
                        ], 404);
                    }
                });</li>
            </ul>
        </li>
    </ul>
    <h1>After all previously performed actions, check API is working or not using POSTMAN app for API checking. All API URLs:</h1>
    <h2>Product API</h2>
    <ol>
        <li>http://127.0.0.1:8000/api/products (GET)</li>
        <li>http://127.0.0.1:8000/api/products (POST)</li>
        <li>http://127.0.0.1:8000/api/products/{product} (GET)</li>
        <li>http://127.0.0.1:8000/api/products/{product}?_method=PUT (POST)</li>
        <li>http://127.0.0.1:8000/api/products/{product} (DELETE)</li>
    </ol>
    <h2>ProductAttr API</h2>
    <ol>
        <li>http://127.0.0.1:8000/api/productAttr/{pro_id} (GET)</li>
        <li>http://127.0.0.1:8000/api/productAttr/{pro_id} (POST)</li>
        <li>http://127.0.0.1:8000/api/productAttr/{pro_id}/{id} (GET)</li>
        <li>http://127.0.0.1:8000/api/productAttr/{pro_id}/{id}?_method=PUT (POST)</li>
        <li>http://127.0.0.1:8000/api/productAttr/{id} (DELETE)</li>
    </ol>
    <h2>ProductImages API</h2>
    <ol>
        <li>http://127.0.0.1:8000/api/productImages/{pro_id} (GET)</li>
        <li>http://127.0.0.1:8000/api/productImages/{pro_id} (POST)</li>
        <li>http://127.0.0.1:8000/api/productImages/{pro_id}/{id} (GET)</li>
        <li>http://127.0.0.1:8000/api/productImages/{id} (DELETE)</li>
    </ol>
   
