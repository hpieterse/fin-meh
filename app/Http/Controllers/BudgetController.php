<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Models\SpendItem;

class BudgetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return redirect(route('budget.show',date('Y-m-1'))); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($date)
    {
        if (($inputDate = strtotime($date)) === false) {
            abort(404);
        }
        $monthStart = new DateTime();
        $monthStart->setDate(date('Y',$inputDate),date('m',$inputDate),1);
        $monthStart->setTime(0,0,0,0);
        $monthEnd = clone $monthStart;
        $monthEnd->add(new DateInterval('P1M'))->sub(new DateInterval('P1D'));
        
        $userId = auth()->user()->id;

        $budgetItems = auth()->user()->budgetCategories()
            ->leftJoin('spend_categories', 'spend_categories.budget_category_id', '=', 'budget_categories.id')
            ->leftJoin('spend_items', function ($join) use($monthStart, $monthEnd) {
                $join->on('spend_items.spend_category_id', '=', 'spend_categories.id')
                     ->where('spend_items.date', '>=',$monthStart)
                     ->where('spend_items.date','<=',$monthEnd);
            })
            ->groupBy(
                'budget_categories.id',
                'budget_categories.name',
                'spend_categories.id',
                'spend_categories.name'
            )
            ->select(
                'budget_categories.id as budget_category_id',
                'budget_categories.name as budget_category_name',
                'spend_categories.id as spend_category_id',
                'spend_categories.name as spend_category_name',
            )
            ->selectRaw("SUM(amount) as amount")
            ->get();
        $budgetCategories = $this->unflattenBudgetItems($budgetItems);

        return view('budget', compact('monthStart','budgetCategories'));
    }


    private function unflattenBudgetItems($budgetItems) {
        $budgetCategories = [];

        foreach ($budgetItems as $budgetItem) {
            $spendCategory = (object)[
                "name" => $budgetItem->spend_category_name,
                "id" => $budgetItem->spend_category_id,
                "amount" => (float)$budgetItem->amount,
            ];

            if(!isset($budgetCategories[$budgetItem->budget_category_id])){
                $budgetCategories = $budgetCategories
                    + [
                        $budgetItem->budget_category_id => $budgetCategory = (object)[
                            "name" => $budgetItem->budget_category_name,
                            "id" => $budgetItem->budget_category_id,
                            "spendCategories" => [
                                $budgetItem->spend_category_id => $spendCategory
                            ],
                        ]
                    ];
            } else {
                $budgetCategories = array_replace(
                    $budgetCategories,
                    [
                        $budgetItem->budget_category_id => 
                        (object) array_merge(
                            (array) $budgetCategories[$budgetItem->budget_category_id],
                            [
                                "spendCategories" => (
                                    (array)$budgetCategories[$budgetItem->budget_category_id]->spendCategories
                                    + [
                                        $budgetItem->spend_category_id  => $spendCategory
                                    ]
                                )
                            ]
                        )
                    ]
                );
            }
        }
        return $budgetCategories;
      }
}