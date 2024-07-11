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
ECOMMER-LARAVEL-API PROJECT DOCUMENTATION
•	composer 
•	composer create-project laravel/laravel ECOMMER-LARAVEL-API 
•	php artisan install:API
•	some changes on user.php model :
		use Laravel\Sanctum\HasAPITokens;
		use HasFactory, Notifiable, HasAPITokens;
•	create product model : 
		php artisan make:model Product -m		
•	some changes in product.php file in model :
                        protected $table = 'products';
		protected $fillable = [
			'category',
			'name',
			'image',
			'slug',
			'brand',
			'model',
			'short_desc',
			'desc',
			'keywords',
			'technical_specification',
			'uses',
			'lead_time',
			'tax',
			'is_promo',
			'is_featured',
			'is_discounted',
			'is_tranding',
			'status',
		];
		public function productAttrs()
		{
			return $this->hasMany(ProductAttr::class, 'products_id');
		}
		public function productImages()
		{
			return $this->hasMany(ProductImages::class, 'products_id');
		}		
•	product migration file(2024_07_08_091615_create_products_table.php)
        		$table->id();
       		 $table->string('category');
        		$table->string('name');
        		$table->string('image')->default("NULL");
        		$table->string('slug');
       		 $table->string('brand');
        		$table->string('model');
        		$table->text('short_desc')->default("NULL");
        		$table->text('desc')->default("NULL");
        		$table->text('keywords')->default("NULL");
        		$table->text('technical_specification')->default("NULL");
        		$table->text('uses')->default("NULL");
        		$table->string("lead_time")->default("NULL");
        		$table->string("tax")->default("NULL");
        		$table->integer("is_promo");
        		$table->integer("is_featured");
       		$table->integer("is_discounted");
        		$table->integer("is_tranding");
       		 $table->integer('status');
       		 $table->timestamps();		
•	create controller ProductController : 
        		php artisan make:controller API/ProductController		
•	create API in route(API.php) for product :
		Route::APIResource('products', ProductController::class);
	Or 
		Route::get('products', [ProductController::class, 'Index']);
		Route::post('products', [ProductController::class, 'store'])->name('store');
		Route::get('products/{product}', [ProductController::class, 'show']);
		Route::put('products/{product}', [ProductController::class, 'update'])->name('update');
		Route::delete('products/{product}', [ProductController::class, 'destroy']);
•	check all the API list for this product :
		php artisan route:list		
•	create the resource for product : 
		php artisan make:resource ProductResource		
•	create ProductAttr model : 
		php artisan make:model ProductAttr -m		
•	some changes in ProductAttr.php file in model :
        		protected $table = 'product_attrs';
		protected $fillable = [
			'products_id',
			'sku',
			'attr_image',
			'mrp',
			'price',
			'qty',
			'size',
			'color',
		];
		public function product(){
		    return $this->belongsTo(Product::class, 'products_id');
	    	}		
•	productAttr migration file(2024_07_08_091624_create_product_attrs_table.php)
        		$table->id();
       		$table->foreignId("products_id")->references('id')->on('products');
        		$table->string("sku");
        		$table->string("attr_image")->default("NULL");
        		$table->integer("mrp");
        		$table->integer("price");
        		$table->integer("qty");
        		$table->string("size");
        		$table->string("color");
        		$table->timestamps();		
•	create controller ProductAttrController: 
		php artisan make:controller API/ProductAttrController		
•	create API in route(API.php) for productAttr :		
		Route::get('productAttr/{pro_id}', [ProductAttrController::class, 'productAttrIndex']);
		Route::post('productAttr/{pro_id}', [ProductAttrController::class, 'productAttrStore'])->name('productAttrStore');
		Route::get('productAttr/{pro_id}/{id}', [ProductAttrController::class, 'productAttrShow']);
		Route::put('productAttr/{pro_id}/{id}', [ProductAttrController::class, 'productAttrUpdate'])->name('productAttrUpdate');
		Route::delete('productAttr/{id}', [ProductAttrController::class, 'productAttrDestroy']);		
•	create ProductImages model  :
        		php artisan make:model ProductImages -m		
•	some changes in ProductImages.php file in model :
        		protected $table = 'product_images';
			protected $fillable = [
			'products_id',
			'images',
		];

		public function product()
		{
			return $this->belongsTo(Product::class, 'products_id');
		}		
•	productImages migration file(2024_07_08_091631_create_product_images_table.php)
        		$table->id();
        		$table->foreignId("products_id")->references('id')->on('products');
        		$table->string('images')->default("NULL");
        		$table->timestamps();		
•	create controller ProductImagesCOntroller : 
    		php artisan make:controller API/ProductImagesCOntroller		
•	create API in route(API.php) for productImages :
		Route::get('productImages/{pro_id}', [ProductImagesCOntroller::class, 'ProductImages']);
		Route::post('productImages/{pro_id}', [ProductImagesCOntroller::class, "productImagesStore"])->name('productImagesStore');
		Route::get('productImages/{pro_id}/{id}', [ProductImagesCOntroller::class, "productImagesShow"]);
		Route::delete('productImages/{id}', [ProductImagesCOntroller::class, 'productImagesDestroy']);
•	go to controller then perform work
•	all API error handling, then go to bootstrap->app.php and some changes : 
		use Illuminate\Http\Request;
            		use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
            		$exceptions->render(function (NotFoundHttpException $e, Request $request) {
           			 if ($request->is('API/*')) {
               			 return response()->json([
                    			'message' => 'Record not found.'
                			], 404);}
       			 });
•	After all previously performed action then we will check API is working or not using POSTMAN app for API checking, All API url  :
For product API : 
1.	http://127.0.0.1:8000/api/products (GET)
2.	http://127.0.0.1:8000/api/products (POST)
3.	http://127.0.0.1:8000/api/products/{product}  (GET)
4.	http://127.0.0.1:8000/api/products/{product}?_method=PUT (POST)
5.	http://127.0.0.1:8000/api/products/{product} (DELETE)
           For produstAttr API:
1.	http://127.0.0.1:8000/api/productAttr/{pro_id} (GET)
2.	http://127.0.0.1:8000/api/productAttr/{pro_id} (POST)
3.	http://127.0.0.1:8000/api/productAttr/{pro_id}/{id} (GET)
4.	http://127.0.0.1:8000/api/productAttr/{pro_id}/{id}?_metthod=PUT (POST)
5.	http://127.0.0.1:8000/api/productAttr/{id} (DELETE)
   	For productImages API:
1.	http://127.0.0.1:8000/api/productImages/{pro_id} (GET)
2.	http://127.0.0.1:8000/api/productImages/{pro_id} (POST)
3.	http://127.0.0.1:8000/api/productImages/{pro_id}/{id} (GET)
4.	http://127.0.0.1:8000/api/productImages/{id} (DELETE)
 
	

