@extends('layouts.app')

@section('title', 'Category')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Category</h1>
                <div class="section-header-button">
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Category</div>
                    <div class="breadcrumb-item active">All Category</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alerts')
                    </div>
                </div>
                <h2 class="section-title">Category</h2>
                <p class="section-lead">
                    You can manage all Category
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Category Table</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div> --}}
                                <div class="float-right">
                                    <form method="GET" action="{{ route('category.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>#</th>
                                            <th>Name</th>
                                            <th>DESCRIPTION</th>
                                            <th>IMAGE</th>
                                            <th>Created At</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                        @php $no=1; @endphp
                                        @foreach ($category as $cat)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $cat->name }}</td>
                                                <td>{{ $cat->description }}</td>
                                                <td><img src="{{ $cat->image }}" style="width:100px;"></td>
                                                <td>{{ $cat->created_at }}</td>
                                                <td>{{ $cat->active }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('category.edit', $cat->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        {{-- <form action="{{ route('category.destroy', $cat->id) }}" method="POST"
                                                            class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form> --}}
                                                        <form action="{{ route('category.update', [$cat->id, 'type'=>'activate']) }}" method="POST"
                                                            class="ml-2">
                                                            @csrf
                                                            @method('PUT')
                                                            @if ($cat->active == 'OFF')
                                                                <button class="btn btn-sm btn-success btn-icon confirm-delete">
                                                                    <i class="fas fa-check"></i> Act
                                                                </button>
                                                            @else
                                                                <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                    <i class="fas fa-times"></i> Off
                                                                </button>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $no++; @endphp
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $category->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
