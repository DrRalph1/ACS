<?php

namespace App\Http\Controllers;

use App\Models\JobOfferDetails;
use Illuminate\Http\Request;

class JobOfferDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Job Offer Details
      $JobOfferDetails = JobOfferDetails::all();

      if (count($JobOfferDetails) < 1) {
        // Return an error message if no record is found
        return response()->json(['responseMessage' => 'No records founds !!','responseCode' => 404]);
      } else {
        // Return Job Offer Details in JSON format
        return response()->json(['responseMessage' => $JobOfferDetails,'responseCode' => 200]);
      }
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
        // Request Input from young lady
        $input = $request->input();

        // Get Net Salary from the young lady
        $net_salary = @$input['net_salary'];

        // Get Allowance from the young lady
        $allowances = @$input['allowances'];

        // check if the user entered the net salary and / or allowances
        if(isset($net_salary) && isset($allowances)){

            // check if user entered a numeric value for the net salary and / or allowances
            if((preg_match('/^-?(?:\d+|\d*\.\d+)$/', $net_salary)) && (preg_match('/^-?(?:\d+|\d*\.\d+)$/', $allowances))){

                // Basic Salary Computation 
                $basic_salary = 0;

                // Taxable Income Computation
                $taxableINCOME = $basic_salary + $allowances;

                // Employee Pension Contribution Amount Computation
                $emp_pension_cont_amt = 0;

                // Total Payee Tax Computation
                $total_paye_tax = 0;
                $taxableAMNT = $taxableINCOME - $emp_pension_cont_amt;

                // Net Salary Computation
                $net_salary = $net_salary;

                // Gross Salary Computation
                $gross_salary = 0;

                // Employee Pension Amount Computation
                $emp_pension_amt = 0;

                // Total Allowance Amounts Computation
                $total_allowance_amounts = 0;

                // Store the young lady's desired net salary and allowances
                $jobOfferDetails = new JobOfferDetails();
                $jobOfferDetails->basic_salary = $basic_salary;
                $jobOfferDetails->net_salary = $net_salary;
                $jobOfferDetails->allowances = $allowances;
                $jobOfferDetails->total_paye_tax = $total_paye_tax;
                $jobOfferDetails->gross_salary = $gross_salary;
                $jobOfferDetails->emp_pension_cont_amt = $emp_pension_cont_amt;
                $jobOfferDetails->emp_pension_amt = $emp_pension_amt;

                // Check if the data has been stored successfully
                if ($jobOfferDetails->save()) {
                    return response()->json(['responseMessage' => 'Your desired net salary and allowances has been submitted successfully','responseCode' => 200]);
                } else {
                    // If for some reason the young lady's data isn't stored return an error message.
                    return response()->json(['responseMessage' => "Something went wrong. Your data wasn't stored",'responseCode' => 404]);
                }

            } else {
                // Return an error msg if user does not enter a number
                return response()->json(['responseMessage' => 'Please enter a numeric value ONLY for the net salary and / or the allowances','responseCode' => 200]);
            }

        } else {
            // Return an error msg if the user does not enter the net salary and/or the allowances
            return response()->json(['responseMessage' => 'Please enter a value for the net salary and / or allowances.','responseCode' => 200]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobOfferDetails  $jobOfferDetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
     {
         // Get JobOfferDetails by ID
         $JobOfferDetails = JobOfferDetails::findOrFail($id);

         // Return JobOfferDetails in json format
         return response()->json(['responseMessage' => $JobOfferDetails,'responseCode' => 200]);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobOfferDetails  $jobOfferDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(JobOfferDetails $jobOfferDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobOfferDetails  $jobOfferDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobOfferDetails $jobOfferDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobOfferDetails  $jobOfferDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobOfferDetails $jobOfferDetails)
    {
        //
    }
}
