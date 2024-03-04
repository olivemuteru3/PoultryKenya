<?php

namespace App\Http\Controllers;

use App\Models\Chick;
use App\Models\Chicken;
use App\Models\Egg;
use App\Models\Feed;
use App\Models\Price;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use mysql_xdevapi\Exception;
use Brian2694\Toastr\Facades\Toastr;
use Barryvdh\DomPDF\Facade\Pdf;

class OperationController extends Controller
{
    public function RegisterChickens(Request $request)
    {
        try {
            $request->validate([
                'chicken_number' => 'required|integer',
                'comments' => 'required|string',
            ]);

            $chicken=new Chicken();

            $farmer=auth()->user();

            $chicken->farmerName=$farmer->name;
            $chicken->farmerPhone=$farmer->phone;
            $chicken->number=$request->chicken_number;
            $chicken->date= Carbon::now()->format('d M Y');
            $chicken->comments=$request->comments;

            //return response()->json($chicken);
            $chicken->save();

            Toastr::success('New chickens registered successfully', 'success',["positionClass" => "toast-bottom-right"]);
            return redirect()->back()->with('success', 'chicken registered successfully');

        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }


    public function RegisterEggs(Request $request)
    {
        try {
            $request->validate([
                'eggs_number' => 'required|integer',
                'comments' => 'required|string',
            ]);

            $eggs = new Egg();
            $user = auth()->user();

            // Assuming $user->phone is correct, change $eggs->farmerPhone to $eggs->farmerName
            $eggs->farmerName = $user->name;
            $eggs->farmerPhone = $user->phone;

            // Formatting the date using Carbon
            $eggs->date = Carbon::now()->format('d M Y');

            $eggs->eggs_number = $request->eggs_number;
            $eggs->comments = $request->comments;


           // return response()->json($eggs);
            $eggs->save();

            Toastr::success('New eggs registered successfully', 'success',["positionClass" => "toast-bottom-right"]);

            return redirect()->back()->with('success', 'eggs registered successfully');

        }catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }


    public function newPrice(Request $request)
    {

        try {
            $request->validate([
                'salesType' => 'required',
                'price' => 'required|integer',
            ]);
            $price = new Price();

            $price->salesType=$request->salesType;
            $price->price=$request->price;
            $price->date=now()->format('d-m-Y');

            $price->save();

            //return response()->json($price);


            Toastr::success('new price for this product registered successfully', 'success',["positionClass" => "toast-bottom-right"]);

            return  redirect()->back()->with('success', 'price entered successfully');
        }
        catch  (\Exception $e) {
            // Log the exception or handle it accordingly
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    public function sales(Request $request)
    {
        $sales = new Sales();
        $selected = $request->salesType; // Get the selected salesType

        if ($selected == 'eggs') {
            $eggs = Egg::sum('eggs_number');
            // Check if the quantity exceeds the available eggs count
            if ($request->quantity > $eggs) {
                Toastr::error('Error: Quantity exceeds available eggs count', 'Error', ["positionClass" => "toast-bottom-right"]);
                return redirect()->back()->with('error', 'Error: Quantity exceeds available eggs count.');
            } else {
                // Update the eggs count in the database
                Egg::decrement('eggs_number', $request->quantity);
            }
        } else {
            $chicken = Chicken::sum('number');
            // Check if the quantity exceeds the available chicken count
            if ($request->quantity > $chicken) {
                Toastr::error('Error: Quantity exceeds available chicken count', 'Error',["positionClass" => "toast-bottom-right"]);
                return redirect()->back()->with('error', 'Error: Quantity exceeds available chicken count.');
            } else {
                // Update the chicken count in the database
                Chicken::decrement('number', $request->quantity);
            }
        }

        $sales->salesType = $request->salesType;
        $sales->price = $request->price;
        $sales->quantity = $request->quantity;
        $sales->total = $request->total;
        $sales->buyerName = $request->buyerName;
        $sales->buyerPhone = $request->buyerPhone;
        $sales->seller=auth()->user()->name;
        $sales->sellerPhone=auth()->user()->phone;

        // Save the sales entry
        $sales->save();
        Toastr::success('sales registered successfully', 'success',["positionClass" => "toast-bottom-right"]);

        // Load the PDF view
        $pdf = Pdf::loadView('Admin.receipt', ['sales' => $sales]);

        // Return the PDF as a response
        return  $pdf->download('invoice' . $sales->id . '.pdf');

        // Redirect back after downloading the PDF
        //return redirect()->back()->with($pdf);
    }

    public function generateReceiptPdf(Request $request)
    {
        $production = Sales::find($request->id);

        // Check if the record exists
        if (!$production) {
            Toastr::error('Error: Record not found', 'Error', ["positionClass" => "toast-bottom-right"]);
            return redirect()->back();
        }

        // Pass data to the view
        $data = [
            'sales' => $production,
        ];

        // Generate PDF from the view
        $pdf = PDF::loadView('Admin.receipt', $data);

        // Return the PDF as a response
        return $pdf->download('invoice' . $production->id . '.pdf');
    }


    public function chicks(Request $request)
    {
        try {
            $request->validate([
                'chick_number' => 'required|integer',
                'comments' => 'required|string',
            ]);

            $chicken=new Chick();

            $farmer=auth()->user();

            $chicken->farmerName=$farmer->name;
            $chicken->farmerPhone=$farmer->phone;
            $chicken->chick_number=$request->chick_number;
            $chicken->date= Carbon::now()->format('d M Y');
            $chicken->comments=$request->comments;

            //return response()->json($chicken);
            $chicken->save();

            Toastr::success('New young chicks registered successfully', 'success',["positionClass" => "toast-bottom-right"]);
            return redirect()->back()->with('success', 'chicken registered successfully');

        } catch (\Exception $e) {
            // Log the exception or handle it accordingly

            Toastr::error($e->getMessage(), 'error',["positionClass" => "toast-bottom-right"]);
           // return response()->json(['error' => $e->getMessage()], 500);
            return redirect()->back()->with('error', $e->getMessage());
        }

    }


    public function Feeding(Request $request)
    {
        try {

            $this->validate($request, [
                'feedName' => 'required',
                'quantity' => 'required|numeric',
                'supplier' => 'required',
                'purchaseDate' => 'required',
                'comments' => 'nullable|string',
            ]);


            $feed = new Feed();

            $feed->feedName=$request->feedName;
            $feed->quantity=$request->quantity;
            $feed->supplier=$request->supplier;
            $feed->purchaseDate=$request->purchaseDate;
            $feed->comments=$request->comments;
            $feed->enteredBy=auth()->user()->name;
            $feed->cashierPhone=auth()->user()->phone;

            //return response()->json($feed);

            $feed->save();

            Toastr::success('Chicken Feeds added successfully', 'success',["positionClass" => "toast-bottom-right"]);
            return redirect()->back()->with('success', 'Chicken Feeds added successfully');

        }
        catch (\Exception $e)
        {
            Toastr::error($e->getMessage(), 'error',["positionClass" => "toast-bottom-right"]);
            // return response()->json(['error' => $e->getMessage()], 500);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




}
