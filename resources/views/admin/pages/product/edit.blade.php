@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Edit Product
        </div>
        <div class="card-body">
          <form action="{{ route('admin.product.update',$product->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

        @include('admin.partial.messages')

            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" id="title"  placeholder="" value="{{$product->title}}">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea name="description" rows="8" cols="80" class="form-control">{{$product->description}}</textarea>

            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class="form-control" name="price" id="price"  placeholder="" value="{{$product->price}}">
            </div>
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" name="quantity" id="quantity"  placeholder="" value="{{$product->quantity}}">
            </div>

              <div class="form-group">
              <label for="quantity">Select Category</label>
              <select class="form-control" name="category_id">

                <option value="">Please Select a Category for the Product</option>

              @foreach(App\Models\Category::orderBy('name','asc')->where('parent_id',NULL)->get() as $pa_category)

                <option value="{{$pa_category->id}}" {{ $pa_category->id == $product->category->id ? 'selected' : '' }} > {{$pa_category->name}}  </option>


               @foreach(App\Models\Category::orderBy('name','asc')->where('parent_id',$pa_category->id)->get() as $sub_category)
                  <option value="{{$sub_category->id}}" {{ $sub_category->id == $product->category->id ? 'selected' : '' }}  >----->{{$sub_category->name}}  </option>

                @endforeach

                @endforeach
                
              </select>
            </div>


            <div class="form-group">
              <label for="quantity">Select Brand</label>
              <select class="form-control" name="brand_id">
                <option value="">Please Select a Brand for the Product</option>

              @foreach(App\Models\Brand::orderBy('name','asc')->get() as $br)

                <option value="{{$br->id}}" {{ $br->id == $product->brand->id ? 'selected' : '' }} > {{$br->name}}  </option>
  
                @endforeach
                
              </select>
            </div>

             <div class="form-group">
              <label for="product_image">Product Old Image</label><br>
             
             
               @foreach($product->images as $image)

                <img src="{{asset('images/product/'.$image->image)}}" width="100">
                
                @endforeach
                <br>
                <br>

              <label for="product_image">Product New Image</label>
              <div class="row">
                <div class="col-md-4">
                   <input type="file" class="form-control" name="productimage[]" id="productimage"  placeholder="Select product image">
                </div>
                 <div class="col-md-4">
                   <input type="file" class="form-control" name="productimage[]" id="productimage"  placeholder="Select product image">
                </div>
                 <div class="col-md-4">
                   <input type="file" class="form-control" name="productimage[]" id="productimage"  placeholder="Select product image">
                </div>
                 <div class="col-md-4">
                   <input type="file" class="form-control" name="productimage[]" id="productimage"  placeholder="Select product image">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
