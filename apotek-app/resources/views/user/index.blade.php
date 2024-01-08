@extends('layouts.template')

@section('content')
<div id="msg-success"></div>

@if (Session::get('success'))
<div class="alert alert-success"> {{ Session::get('success') }}</div>
@endif
@if (Session::get('deleted'))
<div class="alert alert-warning"> {{ Session::get('deleted') }}</div>
@endif

<div style="margin-bottom: 20px; justify-content: flex-end; display: flex;">
    <a style="padding: 8px; border-radius: 10px; background-color: black; color: white; text-decoration: none;" href="{{ route('user.create') }}">Tambah Data</a>
</div>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th class="text-center">
                Aksi
            </th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($user as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['email'] }}</td>
            <td>{{ $item['role'] }}</td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus</button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
                                <button class="btn btn-danger" onclick="openDeleteConfirmation({{ $item['id'] }})">Hapus</button>
                                <form id="delete-form-{{ $item['id'] }}" action="{{ route('user.delete', $item['id']) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
            </td>

        </tr>
        @endforeach
    </tbody>

</table>

@endsection

@push('script')

<script>
    function openDeleteConfirmation(userId) {
        var modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'), {
            backdrop: 'static',
            keyboard: false
        });

        modal.show();

        document.getElementById('confirmDeleteButton').onclick = function() {
            modal.hide();
            document.getElementById('delete-form-' + userId).submit();
        };
    }
</script>

@endpush