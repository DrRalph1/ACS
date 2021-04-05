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
        return response()->json('No records founds !!', 404);
      } else {
        // Return Job Offer Details in JSON format
        return response()->json($JobOfferDetails, 200);
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
        $net_salary = $input['net_salary'];

        // Get Allowance from the young lady
        $allowances = $input['allowances'];

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
        $net_salary = ($net_salary + $allowances) - $total_paye_tax;

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
            return response()->json('Your desired net salary and allowances has been submitted successfully', 200);
        } else {
        // If for some reason the young lady's data isn't stored return an error message.
        return response()->json("Something went wrong. Your data wasn't stored", 404);
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
         return response()->json($JobOfferDetails, 200);
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
