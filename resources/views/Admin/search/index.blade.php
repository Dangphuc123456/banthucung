@extends('Admin.admin')
@section('title', 'List Pets')
@section('main')

<div class="container">
    <h2>Search Results for "{{ $query }}"</h2>

    <!-- Pets Table -->
    @if(count($pets) > 0)
    <h3>Pets</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Pet ID</th>
                <th>Species</th>
                <th>Breed</th>
                <th>Description</th>
                <th>Age</th>
                <th>Price</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
            <tr>
                <td>{{ $pet->pet_id }}</td>
                <td>{{ $pet->species }}</td>
                <td>{{ $pet->breed }}</td>
                <td>{{ $pet->description }}</td>
                <td>{{ $pet->age }}</td>
                <td>{{ number_format($pet->price, 0, ',', '.') }}đ</td>
                <td>{{ ucfirst($pet->gender) }}</td>
                <td>{{ $pet->status ? 'Available' : 'Not Available' }}</td>
                <td>
                    <a href="{{ route('admin.pets.edit', $pet->pet_id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('admin.pets.detail', $pet->pet_id) }}" class="btn btn-success">Show</a>
                    <form action="{{ route('pets.destroy', $pet->pet_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Orders Table -->
    @if(count($orders) > 0)
    <h3>Orders</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                <td>
                    @if($order->status == 'Đã hủy')
                    <span class="badge bg-danger">Đã hủy</span>
                    @elseif($order->status == 'Hoàn thành')
                    <span class="badge bg-success">Hoàn thành</span>
                    @else
                    {{ $order->status }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.order.detail', ['order_id' => $order->order_id]) }}" class="btn btn-info">Chi Tiết</a>

                    @if($order->status != 'Đã hủy' && $order->status != 'Hoàn thành')
                    <form action="{{ route('admin.order.confirm', ['order_id' => $order->order_id]) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary" {{ $order->status == 'Đã xác nhận' ? 'disabled' : '' }}>Xác nhận</button>
                    </form>

                    <form action="{{ route('admin.order.delivery', ['order_id' => $order->order_id]) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning" {{ $order->status == 'Đang giao hàng' || $order->status == 'Hoàn thành' ? 'disabled' : '' }}>Đang giao hàng</button>
                    </form>

                    <form action="{{ route('admin.order.delivered', ['order_id' => $order->order_id]) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success" {{ $order->status == 'Hoàn thành' ? 'disabled' : '' }}>Hoàn thành</button>
                    </form>

                    <form action="{{ route('admin.order.cancel', ['order_id' => $order->order_id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">Hủy</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Purchase Orders Table -->
    @if(count($purchaseOrders) > 0)
    <h3>Purchase Orders</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Purchase Order ID</th>
                <th>Supplier ID</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseOrders as $purchaseOrder)
            <tr>
                <td>{{ $purchaseOrder->purchase_order_id }}</td>
                <td>{{ $purchaseOrder->supplier_id }}</td>
                <td>{{ $purchaseOrder->order_date }}</td>
                <td>{{ number_format($purchaseOrder->total_amount, 0, ',', '.') }}đ</td>
                <td>
                    <a href="{{ route('admin.inputinvoi.detail', $purchaseOrder->purchase_order_id) }}" class="btn btn-success">Show</a>
                    <form action="{{ route('inputinvoi.destroy', $purchaseOrder->purchase_order_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @if(count($pets) == 0 && count($orders) == 0 && count($purchaseOrders) == 0)
    <p>Không tìm thấy kết quả nào cho "{{ $query }}"</p>
    @endif
    <!-- tìm phòng -->
    @if($room->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>RoomID</th>
                <th>PricePerNight</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($room as $rooms)
            <tr>
                <td>{{ $rooms->RoomID }}</td>
                <td>{{ number_format($rooms->PricePerNight, 0, ',', '.') }}đ</td>
                <td>{{ ucfirst($rooms->Status) }}</td>
                <td>
                    @if (!empty($rooms->Status))
                    <div style="display: flex; gap: 10px;">
                        <form action="{{ route('admin.room.available', ['RoomID' => $rooms->RoomID]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Available</button>
                        </form>
                        <form action="{{ route('admin.room.occupied', ['RoomID' => $rooms->RoomID]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">Occupied</button>
                        </form>
                        <form action="{{ route('admin.room.maintenance', ['RoomID' => $rooms->RoomID]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info">Maintenance</button>
                        </form>
                        <a href="{{ route('admin.room.detail', $rooms->RoomID) }}" class="btn-edit">
                            <button class="btn-delete" style="background-color:green;border:0px;padding:7px; border-radius: 5px;">Chi tiết</button>
                        </a>
                        <form action="{{ route('room.destroy', $rooms->RoomID) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" style="background-color:red;border:0px;padding:7px; border-radius: 5px;" onclick="return confirm('Bạn có chắc chắn muốn xóa phòng này?')">Delete</button>
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
   
    @endif
</div>

@endsection