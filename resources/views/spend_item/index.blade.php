@extends('layouts.app')

<!-- calculate date groups -->
@php
$dates = array_map(static fn($spendItem) => $spendItem->date, $spendItems->items());
$uniqueDates = array_unique($dates);
@endphp

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <h2>Spend Items</h2>
      <div class="card">
        <div class="card-body">
          <a href="{{ route('spend_item.create') }}" class="btn btn-primary">Add Spend Item</a>
        </div>
      </div>
      @foreach($uniqueDates as $date)
      <div class="pt-5">
        <h5>{{$date}}</h4>
          <!-- get spend items -->
          @php
          $spendItemsOnDate = array_filter($spendItems->items(), function($spendItem) use($date){
            return $spendItem->date == $date;
          });
          @endphp
          <div class="list-group">
            @foreach($spendItemsOnDate as $spendItem)
            <div class="list-group-item d-flex align-items-center">
              <a href="{{ route('spend_item.edit', [ 'spend_item'  => $spendItem->id ]) }}">
                <x-icon-pencil-alt-solid class="icon" />
              </a>
              <div class="flex-fill mx-3">
                <div>{{$spendItem->description}}</div>
                <div>
                  <small class="text-muted">{{$spendItem->spendCategory->budgetCategory->name}} |
                    {{$spendItem->spendCategory->name}}</small>
                </div>
              </div>
              <div class="h6 @if($spendItem->amount < 0) text-danger @else text-success @endif font-weight-bold">@money($spendItem->amount)</div>
            </div>
            @endforeach
          </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="row">
    <div class="col-md-10 d-flex justify-content-center">
      {{ $spendItems->links() }}
    </div>
  </div>
</div>
@endsection