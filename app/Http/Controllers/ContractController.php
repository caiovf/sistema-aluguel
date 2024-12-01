<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Property;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Property $property)
    {
        return view('contracts.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $property_id)
    {                    
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price_contract' => 'required|decimal:2'
        ]);
        
        $validatedData['property_id'] = $property_id;
        $validatedData['active_contract'] = true;

        $contract = Contract::create($validatedData);

        return redirect()->route('properties.show', ['property' => $validatedData['property_id']])
                         ->with('success', 'Contrato criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        return view('contracts.edit',compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price_contract' => 'required|decimal:2'
        ]);
                
        $contract = Contract::findOrfail($id);
        $property = Property::findOrfail($contract->property_id);
        $contract->update($validatedData);

        return redirect()
                ->route('properties.show', $property)
                ->with('success', 'Contrato atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
