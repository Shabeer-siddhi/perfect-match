@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">        
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <h1>All Customers</h1>
                    <div class="text-zero top-right-button-container">
                        <a href="{{ route('admin.customer.create') }}"
                            class="btn btn-primary btn-lg top-right-button mr-1">ADD NEW</a>
                    </div>
                </div>

                <div class="mb-2">
                    <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                        role="button" aria-expanded="true" aria-controls="displayOptions">
                        Display Options
                        <i class="simple-icon-arrow-down align-middle"></i>
                    </a>
                    <div class="collapse d-md-block" id="displayOptions">
                        <form action="#" method="GET">
                            <div class="d-block d-md-inline-block">
                                <div class="btn-group float-md-left mr-1 mb-1">
                                    <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Order By
                                    </button>
                                    <div class="dropdown-menu order_by_selector">
                                        <button class="dropdown-item {{ $order_by == 'latest' ? 'active' : '' }}"
                                            data-value="latest" href="#">Latest</button>
                                        <button class="dropdown-item {{ $order_by == 'oldest' ? 'active' : '' }}"
                                            data-value="oldest" href="#">Oldest</button>
                                        <button class="dropdown-item {{ $order_by == 'name_asc' ? 'active' : '' }}"
                                            data-value="name_asc" href="#">Name Ascending</button>
                                        <button class="dropdown-item {{ $order_by == 'name_desc' ? 'active' : '' }}"
                                            data-value="name_desc" href="#">Name Descending</button>
                                        <button class="dropdown-item {{ $order_by == 'active' ? 'active' : '' }}"
                                            data-value="active" href="#">Active</button>
                                        <button class="dropdown-item {{ $order_by == 'inactive' ? 'active' : '' }}"
                                            data-value="inactive" href="#">Inactive</button>
                                    </div>
                                </div>
                                <input type="hidden" name="order_by" id="order_by">
                                <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                    <input name="search" placeholder="Search..." value="{{ $search }}">
                                </div>
                            </div>
                            <div class="float-md-right">
                                <span class="text-muted text-small">Displaying
                                    {{ $customers->firstItem() }}-{{ $customers->lastItem() }} of
                                    {{ $customers->total() }}
                                    items </span>
                                <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $paginate !== '0' ? $paginate : 'All' }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" id="paginate_selector">
                                    <button data-value="15" class="dropdown-item {{ $paginate == 15 ? 'active' : '' }}"
                                        href="#">15</button>
                                    <button data-value="25" class="dropdown-item {{ $paginate == 25 ? 'active' : '' }}"
                                        href="#">25</button>
                                    <button data-value="50" class="dropdown-item {{ $paginate == 50 ? 'active' : '' }}"
                                        href="#">50</button>
                                    <button data-value="100" class="dropdown-item {{ $paginate == 100 ? 'active' : '' }}"
                                        href="#">100</button>
                                    <button data-value="0" class="dropdown-item {{ $paginate == 0 ? 'active' : '' }}"
                                        href="#">All</button>
                                </div>
                                <input type="hidden" name="paginate" id="paginate">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="separator mb-5"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($customers->count())
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone_number }}</td>
                                            <td>
                                                @if ($customer->status)
                                                    <span class="badge badge-pill badge-success fz14">Active</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger fz14">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.customer.show', $customer) }}"
                                                    class="btn btn-primary d-inline-flex fz18" data-toggle="tooltip"
                                                    data-placement="top" title=""
                                                    data-original-title="View Customer">
                                                    <i class="simple-icon-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.customer.edit', $customer) }}"
                                                    class="btn btn-secondary d-inline-flex fz18" data-toggle="tooltip"
                                                    data-placement="top" title=""
                                                    data-original-title="Edit Customer">
                                                    <i class="simple-icon-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $customers->links() }}

            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('.order_by_selector button').on('click', function(e) {
            e.preventDefault();
            $('#order_by').val($(this).data('value'))
            $('#displayOptions form').submit();
        })
        $('#paginate_selector button').on('click', function(e) {
            e.preventDefault();
            $('#paginate').val($(this).data('value'))
            $('#displayOptions form').submit();
        })
    </script>
@endsection
