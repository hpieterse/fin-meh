@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Spend Item') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('spend_item.update', ['spend_item' => $spendItem->id]) }}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="budget_category_id" class="col-md-4 col-form-label text-md-right">{{ __('Budget Category') }}</label>
                            <div class="col-md-6">
                                <select id="budget_category_id"  name="budget_category_id" class="form-control @error('budget_category_id') is-invalid @enderror" required>
                                    <option value="" @if((old('budget_category_id') ?? $spendItem->spendCategory->budget_category_id) == null) selected="selected" @endif>-- Select a budget category --</option>
                                    @foreach($budgetCategories as $budgetCategory)
                                        <option value="{{$budgetCategory->id}}" @if((old('budget_category_id') ?? $spendItem->spendCategory->budget_category_id) == $budgetCategory->id) selected="selected" @endif>{{$budgetCategory->name}}</option>
                                    @endforeach
                                </select>
                                @error('budget_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="spend_category_id" class="col-md-4 col-form-label text-md-right">{{ __('Spend Category') }}</label>
                            <div class="col-md-6">
                                <select id="spend_category_id"  name="spend_category_id" class="form-control @error('spend_category_id') is-invalid @enderror" required>
                                    <option value="" @if((old('spend_category_id') ?? $spendItem->spend_category_id)  == null) selected="selected" @endif>-- Select a spend category --</option>
                                    @foreach($budgetCategories as $budgetCategory)
                                        @foreach($budgetCategory->spendCategories as $spendCategory)
                                            <option data-parent-id="{{$budgetCategory->id}}" value="{{$spendCategory->id}}" @if((old('spend_category_id') ?? $spendItem->spend_category_id) == $spendCategory->id) selected="selected" @endif>{{$spendCategory->name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('spend_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="date" class="form-control @error('description') is-invalid @enderror" name="date" value="{{ old('date') ?? $spendItem->date }}" required autofocus>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $spendItem->description }}" required autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">R</span>
                                    </div>
                                    <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') ?? $spendItem->amount }}" required autofocus>
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 d-flex justify-content-between">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                {{ __('Delete') }}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
   let setChildElements = (budgetCategoryId) => {
        // skip placeholder option
        for(let i =  1; i < spend_category_id.children.length; i += 1){
            let option = spend_category_id.children[i];
            if(option.dataset.parentId === budgetCategoryId){
                option.removeAttribute("hidden");
            } else {
                option.setAttribute("hidden","");
            }
            
        }
   }
   budget_category_id.addEventListener('change', () => { 
       spend_category_id.value = "";
       setChildElements(budget_category_id.value);
    });

   if({{old('budget_category_id') ?? $spendItem->spendCategory->budget_category_id != null ? 'true' : 'false'}}){
        setChildElements("{{old('budget_category_id') ?? $spendItem->spendCategory->budget_category_id}}");
   }
</script>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          This will delete the budget category, spend category and spend items.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <form method="POST" action="{{ route('spend_item.destroy', $spendItem->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>

@endsection