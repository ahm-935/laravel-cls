<h1>Manage Roles</h1>

{{-- @php
    echo "<pre>"; 
        print_r($roles);
        echo "</pre>"; 
        @endphp --}}

        <table border="1" style=" background-color:#33ac6f" width="100%" class="table">
            <thead style="background-color:aqua">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Role Name</th>
                    {{-- <th scope="col">Role Description</th> --}}
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role['id'] }}</td>
                    <td>{{ $role['name'] }}</td>
                    {{-- <td>{{ $role['description'] }}</td> --}}
                    <td>
                        <a href="{{ route('roles.details', ['id' => $role['id']]) }}" class="btn btn-primary">Details</a>
                        <a href="{{ route('roles.edit', ['id' => $role['id']]) }}" class="btn btn-warning">Update</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>