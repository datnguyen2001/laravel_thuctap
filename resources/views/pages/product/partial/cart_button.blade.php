<form class="form-inline" action="{{route('product.cart.store')}}" method="post">

@csrf

<input type="hidden" name="product_id" value="{{$product->id}}">

<!-- <button type="submit" class="btn btn-warning"> <i class="fas fa-plus" style="font-size: 13px;"></i><b style="font-size: 13px;"> Add to Cart</b></button> -->
	 

<button type="button" class="btn btn-warning" onclick="addTocart({{ $product->id }})"> <i class="fas fa-plus" style="font-size: 13px;"></i><b style="font-size: 13px;"> Add to Cart</b></button>

</form>