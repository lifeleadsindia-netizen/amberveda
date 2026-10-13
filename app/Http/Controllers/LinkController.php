<?php

namespace App\Http\Controllers;

use App\Models\ProductLink;
use App\Models\LinkOrderRequest;
use App\Models\MemberDetail;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function createRequest()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        return view('member.orders.create-requests')->with($result);
    }
    public function requestDetails()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['sdata'] = LinkOrderRequest::where('memberid', $result['data']['memberid'])->orderBy('created_at', 'DESC')->get();
        return view('member.orders.request-details')->with($result);
    }
    public function linkordrDetails(Request $request)
    {
        $request->validate([
            'memberid' => 'required',
            'ecommers' => 'required',
            'amount' => 'required',
            'order_id' => 'required|unique:link_order_requests,order_id',
            'product'=>'required',
            'image' => 'required'
        ]);
        $memberid = $request->post('memberid');
        $ecommers = $request->post('ecommers');
        $amount = $request->post('amount');
        $orderid = $request->post('order_id');
        $pro_id = $request->post('product');
        $image = $request->post('image');
        
        $pro = ProductLink::find($pro_id);

        $var = new LinkOrderRequest();
        $var->memberid = $memberid;
        $var->ecommers = $ecommers;
        $var->name = $pro->title;
        $var->amount = $amount;
        $var->bv = $pro->bv;
        $var->order_id = $orderid;
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        if ($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg') {
            session()->flash('failedMsg', 'Allowed image type is jpg, jpeg, png. Please change image type');
            return redirect()->back();
        }
        $filename = 'txn' . time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->image = $filename;
        $var->save();

        session()->flash('successMsg', 'Your request has been created successfully.');
        return redirect()->back();
        
    }
    

    public function acceptOrderReq(Request $request, $id)
    {
        $var = LinkOrderRequest::find($id);
        $memberid = $var->memberid;
        $amount = $var->amount;
        $bv = $var->bv;
        $var->status = 'Accepted';
        $var->created_at = date('Y-m-d');
        $var->save();
        
        $qry = MemberDetail::where('memberid', $memberid)->first();
        $bv_wallet = $qry->bv_wallet;
        $qry->bv_wallet += $bv;
        $qry->save();

        // p2pwalletTransfer($memberid, $amount, 'debit', $p2pwallet, 'P2P Fund Transfer', 'Order requested transfered into user fund wallet');
        session()->flash('successMsg', 'Requested Amount has been transfered to bv wallet');
        return redirect()->back();

        // session()->flash('wMessage', 'Withdrawal request has been accepted successfully!');
        // return redirect()->back();
    }

    public function rejectOrderReq(Request $request, $id)
    {
        $var = LinkOrderRequest::find($id);
        $memberid = $var->memberid;
        $var->status = 'Cancelled';
        $var->save();

        session()->flash('failedMsg', 'Link Order request has been rejected successfully');
        return redirect()->back();
    }

    public function getProducts(Request $request)
    {
        $ecommers = $request->post('ecommers');
        $data = ProductLink::where('plateform', $ecommers)->get();
        if (count($data) == 0) {
            $result['data'] = '<option value="">Product not available</option>';
            return response()->json($result);
        } else {
            $result['data'] = [];
            $result['data'] = '<option value="">Select Product</option>';
            foreach ($data as $value) {
                $result['data'] .= '<option value="' . $value->id . '">' . $value->title . '</option>';
            }
            return response()->json($result);
        }
    }
}
