<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
	// protected $table = 'categories';
    protected $fillable = ['expense_category','amount','entry_date'];
}
