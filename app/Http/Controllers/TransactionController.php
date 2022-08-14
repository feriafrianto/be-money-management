<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Auth;

class TransactionController extends Controller
{
    public function store(Request $request){
        if (Auth::check()) {
            $data = new Transaction();

            $data->category_id = $request->category;
            $data->user_id = Auth::user()->id;
            $data->type = $request->type;
            $data->date = $request->date;
            $data->note = $request->note;
            $data->amount = $request->amount;

            $data->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil ditambahkan',
                'data' => $data
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'messege' => 'User not authorized'
            ],401);
        }
    }

    public function index(){
        if (Auth::check()) {
            $data = Transaction::with('category')->where('user_id',Auth::user()->id)->get();
            return response()->json([
                'status' => 'success',
                'data' => $data
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authorized'
            ],401);
        }
    }
    public function show($id){
        $data = Transaction::with('category')->find($id);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ],200);
    }
    public function destroy($id){
        $data = Transaction::where('id', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi berhasil dihapus'
        ],200);
    }
}
