
var loop_count = 1;

function add_more() {
    loop_count++;
    var html = '<input id="paid" type="hidden" name="paid[]" ><div class="x_content" id="product_attr_' + loop_count + '">';

    html += '<div class="col-md-2"><label for="sku" class="control-label"> SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

    html += '<div class="col-md-2"><label for="mrp" class="control-label"> MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

    html += '<div class="col-md-2"><label for="price" class="control-label"> Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';


    html += '<div class="col-md-3"><label for="size" class="control-label">Size</label><select id="size" name="size[]" class="form-control"> <option value="">Select Size</option>< option value = "L" > L</option><option value="M">M</option><option value="S">S</option><option value="XL">XL</option><option value="XXL">XXL</option> </select ></div>';


    html += '<div class="col-md-3"><label for="color" class="control-label"> Color</label><select id="color" name="color[]" class="form-control" ><option value="red">Red</option>option value="yellow">Yellow</option><option value="green">Green</option><option value="blue">Blue</option></select></div>';

    html += '<div class="col-md-2"><label for="qty" class="control-label"> Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

    html += '<div class="col-md-4"><label for="attr_image" class="control-label"> Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control"></div>';

    html += '<div class="col-md-2"><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-sm" style="margin-top:28px;" onclick=remove_more("' + loop_count + '")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>';

    html += '</div>';

    jQuery('#product_attr_box').append(html)
}

function remove_more(loop_count) {
    jQuery('#product_attr_' + loop_count).remove();
}

var loop_image_count = 1;

function add_image_more() {
    loop_image_count++;
    var html = '<input id="piid" type="hidden" name="piid[]" value=""><div class="col-md-4 product_images_' + loop_image_count + '"><label for="images" class="control-label"> Image</label><input id="images" type="file" name="images[]" class="form-control" required></div>';
    //product_images_box
    html += '<div class="col-sm-2 product_images_' + loop_image_count + '""><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-sm" style="margin-top:28px;" onclick=remove_image_more("' + loop_image_count + '")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>';
    jQuery('#product_images_box').append(html)
}

function remove_image_more(loop_image_count) {
    jQuery('.product_images_' + loop_image_count).remove();
}
