@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <h2>Budget Categories</h2>
      <div class="card">
        <div class="card-body">
          <x-modal >
            <x-slot name="title">
              Create Budget Category
            </x-slot>
            <p>Hello World</p>
          </x-modal>
          <a href="{{ route('budget_category.create') }}" class="btn btn-primary">Create Budget Category</a>
        </div>
      </div>

      @foreach($budgetCategories as $budgetCategory)
      <div class="card mt-4">
        <div class="card-header d-flex">
          <span class="flex-fill">{{$budgetCategory->name}}</span>
          <a href="{{ route('budget_category.edit', [ 'budget_category'  => $budgetCategory->id ]) }}">
            <x-icon-pencil-alt-solid class="icon" />
          </a>
        </div>
        <div class="card-body">
          @if($budgetCategory->spendCategories->count() > 0)
          <ul class="list-group pb-3">
            @foreach($budgetCategory->spendCategories as $spendCategory)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{$spendCategory->name}}
              <a href="{{ route('spend_category.edit', [ 'budget_category'  => $budgetCategory->id , 'spend_category'  => $spendCategory->id ]) }}">
                <x-icon-pencil-alt-solid class="icon" />
              </a>
            </li>
            @endforeach
          </ul>
          @endif
          <a href="{{ route('budget_category.spend_category.create', [ 'budget_category'  => $budgetCategory->id ]) }}"
            class="btn btn-secondary">
            Add Spend Category
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection