@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')

<div class="container">
    <div class="row mb-3 justify-content-between">
        <div class="col-5">
            <form action="{{ route('admin.categories.store') }}" method="post">
                @csrf
                <input type="text" name="name" id="name" class="form-control" placeholder="Add a Category..." autofocus>
        </div>
        
        <div class="col-sm">
                <button type="submit" class="btn small text-light bg-primary">
                    <i class="fa-solid fa-plus"></i>
                </button>

            </form>
        </div>

        @auth
            @if(request()->is('admin/*'))
 
                <div class="col-3">
                    <form action="{{ route('admin.categories') }}">
                        <input type="search" name="search" class="form-control form-control-sm" placeholder="Search for categories" value="{{ $search }}">
                    </form>
                </div>

            <br>

            @endif
        @endauth
        
    </div>
    
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('new_name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
@if(!empty($all_categories))
    <div class="row pt-3 pb-1 text-secondary text-center border-bottom border-2 border-secondary align-middle header-row">
        
        <div class="col-1">
            <h6 class="fw-bolder">#</h6>
        </div>

        <div class="col-4">
            <h6 class="fw-bolder">NAME</h6>
        </div>

        <div class="col-1">
            <h6 class="fw-bolder">COUNT</h6>
        </div>

        <div class="col-4">
            <h6 class="fw-bolder">LAST UPDATED</h6>
        </div>

        <div class="col-2">

        </div>
    </div>

    @foreach($all_categories as $category)
    <div class="row text-center text-secondary border-bottom align-items-center">
        <div class="col-1">
            {{ $category->id }}
        </div>

        <div class="col-4">
            <span class="text-dark">{{ $category->name }}</span>
        </div>

        <div class="col-1">
            {{ $category->categoryPost->count() }}
        </div>

        <div class="col-4">
            {{ $category->updated_at }}
        </div>

        <div class="col-2 mb-auto">
                <button type="submit" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}" title="Edit">
                    <i class="fa-solid fa-pencil"></i>
                </button>

                <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" title="Delete">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
        </div>
    </div>

    <!-- Modal -->
    @include('admin.categories.modal.actions')
    @endforeach

    @if(!($search))
    <div class="row text-center border-bottom align-items-center py-2">
        <div class="col-1"></div>

        <div class="col-4">
            <span><strong>Uncategorized</strong></span>
        </div>

        <div class="col-1">
            <strong>{{ $uncategorized }}</strong>
        </div>

        <div class="col-4"></div>
        <div class="col-2"></div>
    </div>
    @endif
    

@endif
    
    
@if($all_categories->isEmpty())
    <div class="row py-2 ">
        <div colspan="6" class="text-center fw-lighter lead text-muted">
            No categories match your search.
        </div>
    </div>
@endif

    

    <div class="d-flex justify-content-center mt-2">
        {{ $all_categories->appends(request()->query())->links() }}
    </div>

</div>
@endsection