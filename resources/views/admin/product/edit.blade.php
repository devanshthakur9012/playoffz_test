@extends('master')

@section('content')
    <section class="section">
        @include('admin.layout.breadcrumbs', [
            'title' => __('Edit Product'),
        ])

        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="section-title"> {{ __('Edit Product') }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('products.update', [$product->id]) }}" id="category_form" name="category_form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group center">
                                            <label>{{ __('Image') }} <span class="text-danger">*</span></label>
                                            <div id="image-preview" class="image-preview" style="background-image:url('{{asset('images/upload/'.$product->image)}}')">
                                                <label for="image-upload" id="image-label"> <i
                                                        class="fas fa-plus"></i></label>
                                                <input type="file" name="image" id="image-upload"/>
                                            </div>
                                            @error('image')
                                                <div class="invalid-feedback block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label>{{ __('Product Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="product_name" placeholder="{{ __('Product Name') }}"  class="form-control @error('product_name')? is-invalid @enderror" value="{{$product->product_name}}" required>
                                            @error('product_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Product Price') }} <span class="text-danger">*</span></label>
                                            <input type="number" name="product_price" placeholder="{{ __('Product Price') }}" class="form-control @error('product_price')? is-invalid @enderror" min="1" value="{{$product->product_price}}" required>
                                            @error('product_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('Product Description') }} <span class="text-danger">*</span></label>
                                            <textarea name="description" Placeholder="Description"
                                                class="textarea_editor @error('description')? is-invalid @enderror">
                                                {!!$product->description!!}
                                            </textarea>
                                            @error('description')
                                                <div class="invalid-feedback block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Ratings') }} <span class="text-danger">*</span></label>
                                            <select name="rating" class="form-control select2" required>
                                                <option value="1" {{$product->rating==1 ? 'selected':''}}>1</option>
                                                <option value="2" {{$product->rating==2 ? 'selected':''}}>2</option>
                                                <option value="3" {{$product->rating==3 ? 'selected':''}}>3</option>
                                                <option value="4" {{$product->rating==4 ? 'selected':''}}>4</option>
                                                <option value="5" {{$product->rating==5 ? 'selected':''}}>5</option>
                                            </select>
                                            @error('rating')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Quantity') }} <span class="text-danger">*</span></label>
                                            <input type="number" name="quantity" placeholder="{{ __('Product Quantity') }}"  min="1" value="{{$product->quantity}}" class="form-control @error('quantity')? is-invalid @enderror" required>
                                            @error('quantity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('status') }} <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control select2" required>
                                                <option value="1" {{$product->status==1 ? 'selected':''}}>{{ __('Active') }}</option>
                                                <option value="0" {{$product->status==0 ? 'selected':''}}>{{ __('Inactive') }}</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="continue_btn" class="btn btn-primary demo-button">{{ __('Submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script> 
        $("#category_form").validate({
            rules: {
                // image:{required:true},
                // name:{required:true},
            },
            messages: {
                // image:{required:"* Image is required"},
                // name:{required:"* Name is required"}
            },
            errorElement: 'div',
            highlight: function(element, errorClass) {
                $(element).css({ border: '1px solid #f00' });
            },
            unhighlight: function(element, errorClass) {
                $(element).css({ border: '1px solid #c1c1c1' });
            },
            submitHandler: function(form) {
                document.category_form.submit();
                $("#continue_btn").attr('disabled','disabled').text('Processing...');
            }
        });
    </script>
@endpush
