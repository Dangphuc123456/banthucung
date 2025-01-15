@extends('Admin.admin')
@section('title', 'List Pets')
@section('main')
<div class="table-container">
    <h2 class="table-title">List of Pets and accessory</h2>
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
                <td>{{ $rooms->Status }}</td>
                <td>
                    @if ($rooms->Status != '')
                    <div style="display: flex; gap: 10px;">
                        <form action="{{ route('admin.room.available', ['RoomID' => $rooms->RoomID]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Available</button>
                        </form>
                        <form action="{{ route('admin.room.occupied', ['RoomID' => $rooms->RoomID]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Occupied</button>
                        </form>
                        <form action="{{ route('admin.room.maintenance', ['RoomID' => $rooms->RoomID]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Maintenance</button>
                        </form>
                        <a href="{{ route('admin.room.detail', $rooms->RoomID) }}" class="btn-edit">
                            <button class="btn-delete" style="background-color:green;border:0px;padding:7px; border-radius: 5px;">Chi tiết</button>
                        </a>
                        <form action="{{ route('room.destroy', $rooms->RoomID) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" style="background-color:red;border:0px;padding:7px; border-radius: 5px;">Delete</button>
                        </form>
                    </div>
                    @endif
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
@endsection