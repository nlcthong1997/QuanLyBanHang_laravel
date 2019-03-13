@extends('customer.layoutsPage.index')

@section('content')
<section class="header_text sub">
<!-- <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" > -->
	<h4><span>Lịch sử mua</span></h4>
</section>
<section class="main-content">
	<div class="row">						
		<div class="span9">
            <table class="table table-striped shop_attributes">	
                <tbody>
                    <tr class="">
                        <th>Mã đơn hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá sản phẩm</th>
                        <th>Thành tiền</th>
                    </tr>
                    @if(isset($ct_donhang_arr))
                        @foreach($ct_donhang_arr as $ctdh)
                            <tr>
                                <td>{{ $ctdh->id_DH }}</td>
                                <td>{{ $ctdh->TenSP }}</td>
                                <td>{{ $ctdh->Soluong }}</td>
                                <td>{{ number_format($ctdh->GiaSP) }} VND</td>
                                <td>{{ number_format($ctdh->ThanhTien) }} VND</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="row">
                <div class="span3"></div>
                <div class="span4">
                    <span style="color:green" id="notification_s"></span>
                    <span style="color:red" id="notification_l"></span>
                </div>
            </div>
        </div>
		@include('customer.layoutsPage.menu_right_page')
	</div>
</section>
    
        
    
@endsection