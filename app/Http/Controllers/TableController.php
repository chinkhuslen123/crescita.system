<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;


class TableController extends Controller
{

    public function index()
    {
        $tables = Table::all();

        return view(
            'tables.index',
            compact('tables')
        );
    }



    public function manage()
    {
        $tables = Table::all();

        return view(
            'tables.manage',
            compact('tables')
        );
    }



    public function create()
{
    $tables = Table::where('status','empty')
        ->orderBy('name')
        ->get();


    return view(
        'tables.create',
        compact('tables')
    );
}



    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|max:50'
        ]);


        Table::create([

            'name'=>$request->name,

            'status'=>'empty'

        ]);


        return redirect()
    ->route('dashboard')
    ->with(
        'success',
        'Шинэ ширээ нэмэгдлээ.'
    );

    }



    public function edit(Table $table)
    {
        return view(
            'tables.edit',
            compact('table')
        );
    }




    public function update(
        Request $request,
        Table $table
    )
    {

        $request->validate([
            'name'=>'required|max:50'
        ]);


        $table->update([

            'name'=>$request->name

        ]);


        return redirect('/tables');

    }





   public function destroy(Table $table)
{

    if($table->status == 'busy'){

        return redirect()
            ->route('dashboard')
            ->with(
                'error',
                'Ашиглагдаж байгаа ширээг устгах боломжгүй.'
            );

    }


    $table->delete();


    return redirect()
        ->route('dashboard')
        ->with(
            'success',
            'Ширээ устгагдлаа.'
        );

}


}