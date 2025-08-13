<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\lea;
use App\Models\Lead;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PgSql\Lob;

class LeadController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phon' => 'required|string|max:20',
        'email' => 'required|email|max:255',
    ]);

    Lead::create($validated);

    return redirect()->route('leads.index')->with('success', 'Lead created successfully');
}

        public function index()
    {
        return Inertia::render('Leads/Index',[  
        'leads'=>Lead::all(),]);
    }
     public function create()
    {
        return Inertia::render('Leads/creat');  
    }
    
     public function destroy(Lead $lead){
         $lead->delete();
        return redirect()->route('leads.index');            

    }
      
    public function update(Request $request, Lead $lead){

    $request->validate([
        'name'  => 'required|string|max:255',
        'phone'  => 'required|string|max:20',
        'email' => 'required|email|max:255',
    ]);

    $lead->update([
        'name'  => $request->name,
        'phone'  => $request->phon,
        'email' => $request->email,
    ]);
    return redirect()->route('leads.index')->with('success', 'Lead updated successfully');
}
     public function edit(Lead $lead)
    {

        return Inertia::render('Leads/Edit', [
    'lead' => $lead,
]);
    }


}
