@extends('admin.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col">
                    <div class="card radius-10 mb-0">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-3">Edit Product</h5>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Products</a>
                                </div>
                            </div>

                            <form action="{{ route('variable.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Name <small style="color: red; font-size: 18px;">*</small></label>
                                                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Product name"><br>
                                                    <span style="color: red"> {{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Category Name <small style="color: red; font-size: 18px;">*</small></label>
                                                    <select class="form-control" name="cat_id" id="cat_id" onchange="categoryWiseSubcategory(this.value)">
                                                        <option selected disabled>Select a category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $product->cat_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span style="color: red"> {{ $errors->has('cat_id') ? $errors->first('cat_id') : ' ' }}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Subcategory Name</label>
                                                    <select class="form-control" name="sub_cat_id" id="sub_cat_id">
                                                        <option selected disabled>Select a Subcategory</option>
                                                        @foreach ($subcategories as $subcategory)
                                                            <option value="{{ $subcategory->id }}" {{ $product->sub_cat_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span style="color: red"> {{ $errors->has('sub_cat_id') ? $errors->first('sub_cat_id') : ' ' }}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Qty <small style="color: red; font-size: 18px;">*</small></label>
                                                    <input type="number" name="qty" value="{{ $product->qty }}" class="form-control" placeholder="Product qty"><br>
                                                    <span style="color: red"> {{ $errors->has('qty') ? $errors->first('qty') : ' ' }}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Buy Price</label>
                                                    <input type="number" name="buy_price" value="{{ $product->buy_price }}" class="form-control" placeholder="Product buy price">
                                                    <span style="color: red"> {{ $errors->has('buy_price') ? $errors->first('buy_price') : ' ' }}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Common Price <small style="color: red; font-size: 18px;">*</small></label>
                                                    <input type="number" name="regular_price" value="{{ $product->regular_price }}" class="form-control" placeholder="Product regular price"><br>
                                                    <span style="color: red"> {{ $errors->has('regular_price') ? $errors->first('regular_price') : ' ' }}</span>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Discount Price (Optional)</label>
                                                    <input type="text" name="discount_price" value="{{ old('discount_price') }}"
                                                    class="form-control" placeholder="Product discount price"><br>
                                                </div> --}}
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Product Code ( Optional )</label>
                                                    <input type="text" name="product_code " value="{{ $product->product_code }}" class="form-control" placeholder="Product code"><br>
                                                    <span style="color: red"> {{ $errors->has('product_code ') ? $errors->first('product_code ') : ' ' }}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Main image <small style="color: red; font-size: 18px;">*</small></label>
                                                    <input type="file" name="image" id="image" class="form-control">
                                                    <img src="{{ asset('/product/images/'.$product->image) }}" height="100" width="100" />
                                                    <span style="color: red"> {{ $errors->has('image') ? $errors->first('image') : ' ' }}</span>
                                                </div>
                                                <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Gallery Image, Price, Color, and Size <small style="color: red; font-size: 18px;">*</small></label><br>
                                                @foreach ($product->productImages as $image)
                                                    <div style="display: inline-block; text-align: center; margin: 10px;">
                                                        <img src="{{ asset('galleryImage/'.$image->gallery_image) }}" height="100" width="100" alt="Product Image">
                                                        <div>
                                                            <span>Price: {{$image->price ?? "N/A"}}</span><br>
                                                            <span>Color: {{$image->color ?? "N/A"}}</span><br>
                                                            <span>Size: {{$image->size ?? "N/A"}}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="input-group mb-3">
                                                    <input type="file" name="gallery_image[]" id="gallery_image" class="form-control">
                                                    <input type="text" name="price[]" id="price" class="form-control" placeholder="Price">
                                                    <input type="text" name="color[]" id="color" class="form-control" placeholder="Product color">
                                                    <input type="text" name="size[]" id="size" class="form-control" placeholder="Product size">
                                                    <button class="btn btn-sm btn-primary" type="button" id="addMore">
                                                        <i class="bx bx-plus-circle" aria-hidden="true" style="margin-left: 7px;"></i>
                                                    </button>
                                                </div>
                                                <span style="color: red"> {{ $errors->has('gallery_image') ? $errors->first('gallery_image') : ' ' }}</span>
                                                <span style="color: red"> {{ $errors->has('price') ? $errors->first('price') : ' ' }}</span>
                                                <span style="color: red"> {{ $errors->has('color') ? $errors->first('color') : ' ' }}</span>
                                                <span style="color: red"> {{ $errors->has('size') ? $errors->first('size') : ' ' }}</span>
                                                <div id="newRow"></div>

                                                <div id="newRowForColor"></div>

                                                <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Related Product ( Optional )</label>
                                                <select class="multiple-related-product form-control mb-3" name="related_product_id[]" multiple="multiple">
                                                  <option value="AL">Select A Related Product</option>
                                                    @foreach(\App\Models\Product::orderBy('created_at', 'desc')->get() as $relatedproduct)
                                                        <option value="{{ $relatedproduct->id }}">{{ $relatedproduct->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Short description</label>
                                                <textarea class="form-control" rows="5" name="short_description" placeholder="Enter product short description">{{ $product->short_description }}</textarea><br>
                                                <span style="color: red"> {{ $errors->has('short_description') ? $errors->first('short_description') : ' ' }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Long description <small style="color: red; font-size: 18px;">*</small></label>
                                                <textarea class="ckeditor" name="long_description">{{ $product->long_description }}</textarea><br>
                                                <span style="color: red"> {{ $errors->has('long_description') ? $errors->first('long_description') : ' ' }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Product Policy <small style="color: red; font-size: 18px;"></small></label>
                                                <textarea class="ckeditor" name="policy">{{ $product->policy }}</textarea><br>
                                                <span style="color: red"> {{ $errors->has('policy') ? $errors->first('policy') : ' ' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">Product type <small style="color: red; font-size: 18px;">*</small></label>
                                                <select class="form-control" name="product_type" id="product_type">
                                                    <option selected disabled>Select a product type</option>
                                                    <option value="feature" {{ $product->product_type == 'feature' ? 'selected' : '' }}>Regular Product</option>
                                                    <option value="hot" {{ $product->product_type == 'hot' ? 'selected' : '' }}>Hot Product</option>
                                                    <option value="discount" {{ $product->product_type == 'discount' ? 'selected' : '' }}>Discount Product</option>
                                                    <option value="new" {{ $product->product_type == 'new' ? 'selected' : '' }}>New Arrival Product</option>
                                                </select><br>
                                                <span style="color: red"> {{ $errors->has('product_type') ? $errors->first('product_type') : ' ' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 additional-info-form">
                                        <div class="additional-info-wrapper">
                                            <div class="additional-info-title">
                                                <h6 class="info-title">
                                                    SEO Information
                                                </h6>
                                            </div>
                                            <hr>
                                            <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">SEO Title ( Optional )</label><br>
                                            <input type="text" name="seo_title" class="form-control" value="" placeholder="Seo title"><br>
                                            <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">SEO Description ( Optional )</label><br>
                                            <textarea rows="4" name="seo_description" class="form-control" placeholder="Seo description"></textarea><br>
                                            <label style="padding-bottom: 5px;font-weight: 600;font-size: 15px;letter-spacing: 1px;">SEO Keyword ( Optional )</label><br>
                                            <select type="text" class="form-control" id="multipleTag" name="seo_keyword" multiple="multiple" value=""></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-2 float-right">Submit</button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script>
        $('#addMore').click(function(){
            let html = '';
            html += '<div class="input-group mb-3" id="removeRow">';
            html += '<input type="file" name="gallery_image[]" id="gallery_image" class="form-control">';
            html += '<input type="text" name="price[]" id="price" class="form-control" placeholder="Price">';
            html += '<input type="text" name="color[]" id="color" class="form-control" placeholder="Product color">';
            html += '<input type="text" name="size[]" id="size" class="form-control" placeholder="Product size">';
            html += '<button class="btn btn-sm btn-danger" type="button" id="remove">';
            html += '<i class="bx bx-minus" aria-hidden="true" style="margin-left: 7px;"></i>';
            html += '</button>';
            html += '</div>';
    
            $('#newRow').append(html);
        });
    
        // remove row
        $(document).on('click', '#remove', function () {
            $(this).closest('#removeRow').remove();
        });
    </script>
@endpush
