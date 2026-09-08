@extends('admin.layouts.master')

@section('title', 'Products')


@section('content')
    {{-- @php
    echo "
    <pre>";
                        print_r($products);
                        echo "</pre>";
    @endphp --}}
    <x-admin.phead title="Products" subtitle="Manage your products from this page.">
        <a href="{{ route('products.create') }}" class="btn-custom btn-custom-secondary fw-bold" type="button">
            <i class="bi bi-plus"></i> Add Product
        </a>
    </x-admin.phead>
    @if (session('success'))
        <div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- START: Basic Table Card Container -->
    <div class="table-card-custom">
        <!-- Header Controls -->
        <div class="table-header-control">
            <!-- Search bar -->
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" class="table-search-input" placeholder="Search orders or products...">
            </div>
            <!-- Action buttons / Filter options -->
            <div class="table-filter-group">
                <div class="dropdown">
                    <button class="btn-table-action dropdown-toggle" type="button" id="dropdownFilterStatus"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel"></i> Status Filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownFilterStatus">
                        <li><a class="dropdown-item" href="#">All Statuses</a></li>
                        <li><a class="dropdown-item" href="#">Paid / Success</a></li>
                        <li><a class="dropdown-item" href="#">Processing</a></li>
                        <li><a class="dropdown-item" href="#">Cancelled / Failed</a></li>
                    </ul>
                </div>
                <button class="btn-table-action" type="button">
                    <i class="bi bi-file-earmark-arrow-down"></i> Export
                </button>
            </div>
        </div>

        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td class="table-id">{{ $item->id }}</td>
                            <td>
                                <div class="table-user-cell">
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" alt="Eleanor Pena" class="table-user-avatar">
                                    @else
                                    <img src="https://placehold.net/product-400x400.png"
                                        alt="Eleanor Pena" class="table-user-avatar"
                                        onerror="this.src = 'assets/images/avatar.png'">
                                    @endif
                                    
                                    <div>
                                        <div class="table-user-name">{{ $item->name }}</div>
                                        {{-- <div class="table-user-sub">eleanor.pena@example.com</div> --}}
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($item->category)
                                    {{ $item->category->name }}
                                @endif
                            </td>
                            <td><span class="table-user-role">{{ $item->brand->name }}</span></td>
                            <td><span class="table-user-role">{{ $item->price }}</span></td>
                            <td><span class="table-user-role">{{ $item->quantity }}</span></td>
                            <td class="text-center badge border {{ $item->active == 1 ? 'border-success text-success' : 'border-danger text-danger' }}">
                                <span class="table-user-role">{{ $item->active == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('products.show', ['product' => $item->id]) }}" class="table-btn-action"
                                        title="View details"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('products.edit', ['product' => $item->id]) }}" class="table-btn-action"
                                        title="Edit"><i class="bi bi-pencil"></i></a>
                                    {{-- <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="table-btn-action btn-delete" title="Delete"
                                            data-bs-toggle="modal" data-bs-target="#modalDelete" data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form> --}}
                                    <button type="button" class="table-btn-action delete" title="Delete" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete" data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    @endforeach


                </tbody>
            </table>
        </div>

        <!-- Footer Controls / Pagination -->
        <div class="table-footer-control">
            {{-- {{ $products->links() }} --}}
        </div>
    </div>
    <!-- END: Basic Table Card Container -->
    <x-admin.modal id="modalDelete" title="Delete Product">
        <div class="text-center">
            <i class="bi bi-trash fs-1 text-danger"></i>
            <p class="mt-2">Are you sure you want to delete this product?</p>
            <span class="name fw-bold badge border border-danger text-danger py-2 px-3">Mina</span>
            <hr>
            <form method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-outline-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </x-admin.modal>
@endsection
@section('style')
    <style>
        .table-footer-control nav {
            width: 100%;
        }

        .table-footer-control nav div:last-child {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>
@endsection

@section('script')
    <script>
        document.querySelectorAll('.delete').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.dataset.id;
                let name = this.dataset.name;
                document.querySelector('#modalDelete .name').innerText = name;
                // document.querySelector('#modalDelete form').action = `/users/${id};
                document.querySelector('#modalDelete form').action = `{{ route('users.destroy', ['user' => ':id']) }}`.replace(':id', id);
            })
        })
    </script>
@endsection