<h1>Manage Users</h1>

{{-- @php
    echo "<pre>"; 
        print_r($users);
        echo "</pre>"; 
        @endphp --}}

        <table border="1" style=" background-color:cadetblue" width="100%" class="table">
            <thead style="background-color:aqua">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User Name</th>
                    {{-- <th scope="col">User Description</th> --}}
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    {{-- <td>{{ $user['description'] }}</td> --}}
                    <td>
                        <a href="{{ route('users.details', ['id' => $user['id']]) }}" class="btn btn-primary">Details</a>
                        <a href="{{ route('users.edit', ['id' => $user['id']]) }}" class="btn btn-warning">Update</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>