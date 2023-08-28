<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    // Company list
    public function index()
    {
        $company = Company::all();
        return view('company.index', compact('company'));
    }

    // Company view
    public function create()
    {
        return view('company.create');
    }

    // Validate data and add into company table
    public function store(CreateCompanyRequest $request)
    {
        $validatedData = $request->validated();

        $company = new Company();
        $company->user_id = Auth::user()->id;
        $company->name = $validatedData['name'];
        $company->email = $validatedData['email'];
        $company->website = $validatedData['website'];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('logos','public'); // Store in storage/app/public/logos
            $company->logo = $logoPath;
        }

        $company->save();

        return redirect()->route('companies')->with('success', 'Company created successfully!');
    }

    // Display edit view
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    // Update company data
    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('logos','public'); // Store in storage/app/public/logos
            $data['logo'] = $logoPath;
        }

        $company->update($data);

        return redirect()->route('companies')
            ->with('success', 'Company updated successfully');
    }

    // Delete company data
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies')
            ->with('success', 'Company deleted successfully');
    }
}
