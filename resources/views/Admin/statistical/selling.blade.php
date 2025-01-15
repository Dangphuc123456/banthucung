@extends('Admin.admin')
@section('title', 'List Pets')
@section('main')
<div class="container">
    <h1 class="text-center my-4">Thống kê bán hàng</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    <h2>Thống kê theo tháng</h2>
                </div>
                <div class="card-body">
                    <p>Tổng số sản phẩm được bán: {{ $monthlyStatistics->total_products ?? '0' }}</p>
                    <p>Tổng doanh thu: {{ number_format($monthlyStatistics->total_revenue ?? 0, 0, '.', '.') }}tr</p>
                    <p>Tổng số đơn hàng đã bán: {{ $monthlyOrderCount->total_orders ?? '0' }}</p>   
                    <a href="{{ route('statistical.export') }}" class="btn btn-success mb-4">Export Excel</a> 
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    <h2>Thống kê theo quý</h2>
                </div>
                <div class="card-body">
                    <p>Tổng số sản phẩm được bán: {{ $quarterlyStatistics->total_products ?? '0' }}</p>
                    <p>Tổng doanh thu: {{ number_format($quarterlyStatistics->total_revenue ?? 0, 0, '.', '.') }}tr</p>
                    <p>Tổng số đơn hàng đã bán: {{ $quarterlyOrderCount->total_orders ?? '0' }}</p> 
                    <a href="{{ route('statistical.export') }}" class="btn btn-success mb-4">Export Excel</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">
                    <h2>Thống kê theo năm</h2>
                </div>
                <div class="card-body">
                    <p>Tổng số sản phẩm được bán: {{ $yearlyStatistics->total_products ?? '0' }}</p>
                    <p>Tổng doanh thu: {{ number_format($yearlyStatistics->total_revenue ?? 0, 0, '.', '.') }}tr</p>
                    <p>Tổng số đơn hàng đã bán: {{ $yearlyOrderCount->total_orders ?? '0' }}</p>
                    <a href="{{ route('statistical.export') }}" class="btn btn-success mb-4">Export Excel</a>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('admin.statistical.detail', ['period' => 'monthly']) }}" class="btn btn-success mb-4" style="margin-top: 15px;margin-left:500px">Xem Chi Tiết Thống Kê</a>  
</div>
@endsection