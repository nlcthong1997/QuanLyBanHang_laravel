@extends('customer.layoutsPage.index')

@section('content')
<section class="header_text sub">
<!-- <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" > -->
	<h4><span>Sản phẩm {{ $nsx->TenNSX }}</span></h4>
</section>
<section class="main-content">
	<div class="row">						
		<div class="span9">
			@if($sanpham_NSX->count())
				<ul class="thumbnails listing-products">
					@foreach($sanpham_NSX as $sp_nsx)
						<li class="span3">
							<div class="product-box">
								<span class="sale_tag"></span>												
								<a href="websales/chitiet/{{ $sp_nsx->id }}"><img alt="" src="upload/sanpham/{{ $sp_nsx->id }}/small.jpg"></a><br/>
								<a href="websales/chitiet/{{ $sp_nsx->id }}" class="title">{{ $sp_nsx->TenSP }}</a><br/>
								<a href="websales/chitiet/{{ $sp_nsx->id }}" class="category">Số lượng: {{ $sp_nsx->SoLuong }}</a>
								<p class="price">{{ number_format($sp_nsx->Gia) }} VND</p>
							</div>
						</li>
					@endforeach   
				</ul>								
				<hr>
				<div class="pagination pagination-small pagination-centered">
					{{ $sanpham_NSX->links() }}
				</div>
			@else
				Chưa có sản phẩm.
			@endif
		</div>
		@include('customer.layoutsPage.menu_right_page')
	</div>
</section>
@endsection