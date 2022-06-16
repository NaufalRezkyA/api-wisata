<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiTransaksiController extends Controller
{
    public function createTransaction(Request $request, $id_wisata)
    {
        // $validator = Validator::make($request->all(), [
        //     'email_customer' => 'required',
        //     'total_price' => 'required',
        //     'packet' => 'required',

        // ]);
        // if ($validator->fails()) {
        //     return response(['errors' => $validator->errors()->all()], 422);
        // }
        // Get Harga Paket Wisata
        $paket_wisata = Wisata::findOrFail($id_wisata)->first();

        $data = Transaksi::create([
            // 'id_user' => '1',
            'id_user' => Auth::id(),
            'id_wisata' => $id_wisata,
            'email_customer' => $request->email_customer,
            'packet' => $request->packet,
            'total_price' => $paket_wisata->harga * $request->packet,
            'nama_wisata' =>  $paket_wisata->nama,
            'payment_status' => 'Unpaid',
            'payment_date' => "senin",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction success!',
            'data' => $data
        ], 201);
    }

    public function allTransaction()
    {
        $data = DB::table('transaksi')
            ->join('users', 'transaksi.id_user', '=', 'users.id')
            ->join('paket_wisata', 'transaksi.id_paket_wisata', '=', 'paket_wisata.id')
            ->select('transaksi.id', 'users.nama', 'paket_wisata.nama_paket', 'transaksi.email_customer', 'transaksi.total_price', 'paket_wisata.harga', 'transaksi.packet', 'transaksi.payment_status', 'transaksi.created_at')
            ->get();

        if (!$data->isEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Transaction successfully fetched!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No transaction found'
            ], 404);
        }
    }


    public function historyTransaction()
    {
        $data = DB::table('transaksi')
            ->join('users', 'transaksi.id_user', '=', 'users.id')
            ->join('paket_wisata', 'transaksi.id_paket_wisata', '=', 'paket_wisata.id')
            ->select('paket_wisata.nama_paket', 'transaksi.email_customer', 'transaksi.total_price', 'paket_wisata.harga', 'transaksi.payment_status', 'transaksi.created_at')
            ->where('transaksi.id_user', '=', auth()->user()->id)
            ->get();

        if (!$data->isEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Transaction successfully fetched!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No transaction found'
            ], 404);
        }
    }

    // public function acceptTransaction($id)
    // {
    //     try {
    //         $data = Transaction::findOrFail($id);
    //         $data->update([
    //             'status' => 'Accepted'
    //         ]);
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Transaction status has been accept!'
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Accept transaction error!',
    //             'errors' => $e->getMessage()
    //         ], 422);
    //     }
    // }
    public function rejectTransaction($id)
    {
        try {
            $data = Transaction::find($id);
            $data->update([
                'status' => 'Rejected'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Transaction status has been rejected!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Reject transaction error!',
                'errors' => $e->getMessage()
            ], 422);
        }
    }
}
