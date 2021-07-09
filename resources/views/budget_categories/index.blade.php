@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <h2>Budget Categories</h2>
      <div class="card">
        <div class="card-body">
          <a href="{{ route('budget_category.create') }}" class="btn btn-primary">Create Budget Category</a>
        </div>
      </div>

      @foreach(Auth::user()->budgetCategories as $category)
      <div class="card mt-4">
        <div class="card-header d-flex">
          <span class="flex-fill">{{$category->name}}</span>
          <a href="#">Edit</a>
        </div>

        <div class="card-body">
          <p>Content TODO</p>
          <a href="#" class="btn btn-secondary">Add Spend Category</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection