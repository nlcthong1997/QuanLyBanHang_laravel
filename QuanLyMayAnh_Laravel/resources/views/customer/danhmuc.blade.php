@extends('customer.layoutsPage.index')

@section('content')
<section class="header_text sub">
<!-- <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" > -->
	<h4><span>Sản phẩm {{ $danhmuc->TenLoai }}</span></h4>
</section>
<section class="main-content">
	<div class="row">						
		<div class="span9">
			@if($sanpham_Danhmuc->count())
				<ul class="thumbnails listing-products">
					@foreach($sanpham_Danhmuc as $sp_dm)
						<li class="span3">
							<div class="product-box">
								<span class="sale_tag"></span>												
								<a href="websales/chitiet/{{ $sp_dm->id }}"><img alt="" src="upload/sanpham/{{ $sp_dm->id }}/small.jpg"></a><br/>
								<a href="websales/chitiet/{{ $sp_dm->id }}" class="title">{{ $sp_dm->TenSP }}</a><br/>
								<a href="websales/chitiet/{{ $sp_dm->id }}" class="category">Số lượng: {{ $sp_dm->SoLuong }}</a>
								<p class="price">{{ number_format($sp_dm->Gia) }} VND</p>
							</div>
						</li>
					@endforeach   
				</ul>								
				<hr>
				<div class="pagination pagination-small pagination-centered">
					{{ $sanpham_Danhmuc->links() }}
				</div>
			@else
				Chưa có sản phẩm.
			@endif
		</div>
		@include('customer.layoutsPage.menu_right_page')
	</div>
</section>
@endsection