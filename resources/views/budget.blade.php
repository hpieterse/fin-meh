@extends('layouts.app')

@section('content')
@php
function getSpendAmount($spendCategory){
    return $spendCategory->amount ?? 0;
}

$maxAmount = max(array_map(static fn($budgetCategory) => 
    max(array_map('getSpendAmount',$budgetCategory->spendCategories)), $budgetCategories));

$previousMonth = clone $monthStart;
$previousMonth->sub(new DateInterval('P1M'));
$nextMonth = clone $monthStart;
$nextMonth->add(new DateInterval('P1M')); 
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class='d-flex align-items-center'> 
                <a href="{{ route('budget.show', ['date' => $previousMonth->format('Y-m-1')]) }}">
                    <x-icon-caret-left-solid class="icon" />
                </a>
                <h2 class="flex-fill text-center">{{ $monthStart->format('F Y') }}</h2> 
                <a href="{{ route('budget.show', ['date' => $nextMonth->format('Y-m-1')]) }}">
                    <x-icon-caret-right-solid class="icon" />
                </a>
            </div>
            @foreach ($budgetCategories as $budgetCategory)
                <div class="card mt-4">
                    <div class="card-header d-flex">
                        <span class="flex-fill">{{$budgetCategory->name}}</span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($budgetCategory->spendCategories as $spendCategory)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <span class="flex-fill">{{$spendCategory->name}}</span>
                                    <span class="h6 @if($spendCategory->amount < 0) text-danger @else text-success @endif font-weight-bold">@money($spendCategory->amount)</span>
                                </div>
                                <div class="progress">
                                    <div 
                                        class="progress-bar bg-info"
                                        role="progressbar"
                                        style="width: {{$maxAmount == 0 ? 0 : $spendCategory->amount / $maxAmount  * 100}}%"
                                        aria-valuenow="{{$spendCategory->amount}}"
                                        aria-valuemin="0"
                                        aria-valuemax="{{$maxAmount}}"></div>
                                    </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
