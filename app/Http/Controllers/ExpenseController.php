<?php

namespace App\Http\Controllers;

use App\User;
use App\Expense;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $expenses = Expense::where('user_id', $user->id)->get();
        $category = Category::all();
        $category_edit = Category::all();
        return view('expense.index')->with('user', $user)->with('expenses', $expenses)->with('category', $category)->with('category_edit', $category_edit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expense =  new Expense;

        $expense->expense_category = $request->input('expense_category');
        $expense->amount = $request->input('amount');
        $expense->entry_date = $request->input('entry_date');
        $expense->user_id = $request->input('user_id');
        $expense->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expense =  Expense::find($id);
        $expense->expense_category = $request->input('expense_category');
        $expense->amount = $request->input('amount');
        $expense->entry_date = $request->input('entry_date');
        $expense->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Expense::find($id);
        $role->delete();
        return redirect("/expense");
    }
}
