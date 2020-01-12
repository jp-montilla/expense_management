<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Category;
use App\Expense;
use Illuminate\Support\Facades\Auth;


use App\Charts\PieChart;

class DashboardController extends Controller
{


    public function index()
    {
    	$expenses = Expense::where('user_id', Auth::id())->get();
    	$category = Category::all();

    	$category_list = [];
		foreach($category as $categ)
		{
			$category_list[] = $categ->name;
		}
		
		$expenses_list = [];
		foreach ($category_list as $category) 
		{
			$total = 0;
			foreach ($expenses as $expense) 
			{
				if ($category == $expense->expense_category){
					$total += $expense->amount;
				}
			}
			$expenses_list[] = $total;
		}

		// return $expenses_list;
    	$chart = new PieChart;
    	$chart->labels($category_list);
    	$chart->dataset('My Expenses', 'pie', $expenses_list);

    	return view('dashboard.index')->with('expenses_list', $expenses_list)->with('category_list', $category_list)->with('chart', $chart);
    }
    

}
