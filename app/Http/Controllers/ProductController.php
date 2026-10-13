<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FranchiseDetail;
use App\Models\IndiaState;
use App\Models\InvoiceTable;
use App\Models\IssueInventorie;
use App\Models\MemberDetail;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductLink;
use App\Models\RoiRate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function category()
    {
        $result['data'] = Category::all();

        return view('admin.masters.category')->with($result);
    }

    public function createCat(Request $request)
    {
        $request->validate([
            'category' => 'required|unique:categories,category',
        ]);

        $var = new Category;
        $var->category = $request->post('category');
        $var->save();

        session()->flash('createMsg', 'Category has been created successfully');

        return redirect()->back();
    }

    public function createProduct()
    {
        $result['data'] = Product::all();
        $result['catdata'] = Category::all();

        return view('admin.masters.create-products')->with($result);
    }

    public function productInsert(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'product' => 'required',
            'quantity' => 'required',
            'sp_value' => 'required',
            'product_price' => 'required',
            'gst' => 'required',
            'model_no' => 'required',
            'about' => 'required',
            'image' => 'required',
        ]);

        $var = new Product;
        $var->cat_id = $request->post('category');
        $var->product = $request->post('product');
        $var->quantity = $request->post('quantity');
        $var->product_price = $request->post('product_price');
        $sp_value = $request->post('sp_value');
        $var->sp_value = $sp_value;
        $gst = $request->post('gst');
        $var->gst = $gst;
        $var->distributor_price = $sp_value + $gst;
        $var->model_no = $request->post('model_no');
        $var->about = $request->post('about');
        $bimage = $request->file('image');
        $ext = $bimage->getClientOriginalExtension();
        if ($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg') {
            session()->flash('failedMsg', 'Allowed image type is jpg, jpeg, png. Please change image type');

            return redirect()->back();
        }
        $imagename = 'product' . time() . '.' . $ext;
        $bimage->move(public_path('uploads'), $imagename);
        $var->image = $imagename;

        $var->save();

        session()->flash('successMsg', 'Product has been created successfully');

        return redirect()->back();
    }

    public function products()
    {
        $result['data'] = Product::orderBy('created_at', 'DESC')->get();
        $result['catdata'] = Category::all();

        return view('admin.masters.all-products')->with($result);
    }

    public function updateProduct($id)
    {
        $result['data'] = Product::find($id);
        $result['catdata'] = Category::all();

        return view('admin.masters.edit-product-details')->with($result);
    }

    public function editProduct(Request $request)
    {
        $request->validate([
            'sp_value' => 'required',
        ]);

        $id = $request->post('id');
        $var = Product::find($id);
        $var->cat_id = $request->post('category');
        $var->product = $request->post('product');
        $var->quantity = $request->post('quantity');
        $var->product_price = $request->post('product_price');
        $sp_value = $request->post('sp_value');
        $var->sp_value = $sp_value;
        $gst = $request->post('gst');
        $var->gst = $gst;
        $var->distributor_price = $sp_value + $gst;
        $var->model_no = $request->post('model_no');
        $var->about = $request->post('about');
        if ($request->hasFile('image')) {
            $bimage = $request->file('image');
            $ext = $bimage->getClientOriginalExtension();
            $imagename = 'product' . time() . '.' . $ext;
            $bimage->move(public_path('uploads'), $imagename);
            $var->image = $imagename;
        }

        $var->save();

        session()->flash('successMsg', 'Product has been updated successfully');

        return redirect()->back();
    }

    public function pendOrders()
    {
        $result['orders'] = OrderDetail::where('status', 'Pending')->get();

        return view('admin.orders.pending-orders')->with($result);
    }

    public function completedOrders()
    {
        $result['orders'] = OrderDetail::where('status', 'Delivered')->get();

        return view('admin.orders.completed-orders')->with($result);
    }

    public function orderAddress($id)
    {
        $orders = OrderDetail::find($id);
        $memberid = $orders->memberid;
        $result['add'] = BillingDetail::where('memberid', $memberid)->first();

        return view('admin.orders.address')->with($result);
    }

    public function completeOrders($id)
    {
        $var = OrderDetail::find($id);
        $var->status = 'Completed';
        $var->save();

        session()->flash('kycMesg', 'Order has been marked completed');

        return redirect()->back();
    }

    public function getBrand(Request $request)
    {
        $cat_id = $request->post('cat_id');
        $data = Brand::where('cat_id', $cat_id)->get();
        $count = count($data);
        if ($count > 0) {
            $html = '';
            foreach ($data as $key) {
                $html .= '<option value="'.$key->id.'">'.$key->brand.'</option>';
            }
        } else {
            $html = '<option value="">No Brand Found</option>';
        }

        return $html;
    }

    public function getProduct(Request $request)
    {
        $data = Product::where('status', 'Live')->get();
        $count = count($data);
        if ($count > 0) {
            $html = '';
            foreach ($data as $key) {
                $url = url('/').'/'; // 'http://127.0.0.1:8000/';
                $html .= '<div class="col-xl-3">';
                $html .= '<div class="card bg-body-secondary border-0">';
                $html .= '<div class="card-body p-2">';
                $html .= '<div class="bg-body">';
                $html .= '<a href="javascript:;"><img style="height:175px"
                                            src="'.$url.'uploads/'.$key->image.'" alt="" class="img-fluid rounded"></a>';
                $html .= '</div>';
                $html .= '<div class="mt-2">';
                $html .= "<span class='float-end fw-semibold clearfix'>Qty : $key->quantity</span>";
                $html .= "<h6><a href='javascript:;'>$key->product</a></h6>";

                $html .= "<p class='text-muted fs-md mb-0'><a href='#!'
                                            class='text-reset text-decoration-underline'><span class='badge bg-success'>Off
                                                Discount</span></a></p>";
                $html .= '</div>';
                $html .= "<p class=' fw-semibold mt-0 pt-0'>PV : ₹ $key->price</p>";
                $html .= "<a href='/member/funds/add-fund/$key->id' class='btn btn-outline-primary w-100'>";
                $html .= "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18'
                                        fill='currentColor' class='bi bi-plus' viewBox='0 0 16 16'>";
                $html .= " <path
                                            d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z' />";
                $html .= '</svg>Buy Product</a>';

                $html .= ' </div>';
                $html .= '</div>';
                $html .= '</div>';
            }
        } else {
            $html = '<p>No Product Found</p>';
        }

        return $html;
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric',
        ]);

        $id = session('MEMBER_ID');
        $result['data'] = MemberDetail::find($id);
        $memberid = $result['data']['memberid'];
        $qty = $request->post('qty');

        // $quantity = getProductQuantity($request->post('pro_id'), $result['data']->city, $result['data']->state);
        $proData = Product::find($request->post('pro_id'));
        if (!$proData) {
            session()->flash('failedMsg', 'Please select product');

            return redirect()->back();
        }
        if ($qty <= 0) {
            session()->flash('failedMsg', 'Please enter valid quantity');

            return redirect()->back();
        }
        if ($qty > $proData->quantity) {
            session()->flash('failedMsg', 'Product stock is not available');

            return redirect()->back();
        }
        $price = $proData['distributor_price'];
        // $bv = $proData['bv'];

        $check = OrderDetail::where([['memberid', $memberid], ['pro_id', $proData->id], ['status', 'Temp']])->first();
        if ($check) {
            session()->flash('failedMsg', 'Product has been already in your cart');

            return redirect()->back();
        }

        $new = new OrderDetail;
        $new->memberid = $memberid;
        $new->order_id = Str::random(14);
        $new->pro_id = $proData['id'];
        $new->cat_id = $proData['cat_id'];
        $new->quantity = $qty;
        $new->price = $proData['sp_value'];
        $new->gst_amount = $proData['gst'] * $new->quantity;
        $new->total_amount = ($price * $new->quantity);
        $new->status = 'Temp';
        $new->save();

        session()->flash('successMsg', 'Product has been added to cart successfully');
        return redirect()->back();
    }

    public function getCart(Request $request)
    {
        $mem = MemberDetail::find(session('MEMBER_ID'));
        $orderData = OrderDetail::where([['memberid', $mem->memberid], ['status', 'Temp']])->get();
        $count = count($orderData);
        $result = [];
        if ($count > 0) {
            $totals = OrderDetail::where([
                ['memberid', $mem->memberid],
                ['status', 'Temp'],
            ])->selectRaw('SUM(quantity) as total_quantity, SUM(total_amount) as total_amount')
                ->first();
            $result['totQty'] = $totals->total_quantity;
            // $result['totBV'] = $totals->bv;
            $result['totAmount'] = number_format($totals->total_amount, 2, '.', '');
            $itext = '';
            // $html .= 'Please select product.';
            foreach ($orderData as $key) {
                $proData = Product::find($key->pro_id);
                $unitPrice = $key->price;
                $unitGst = $proData ? $proData->gst : 0;
                $unitTotal = $proData ? $proData->distributor_price : ($unitPrice + $unitGst);
                $rowAmount = number_format($unitPrice * $key->quantity, 2, '.', '');

                $url = url('/').'/'; // 'http://127.0.0.1:8000/';
                $itext .= '<tr>';
                //  $itext .= '<td>';
                // $itext .= '<div class="flex-shrink-0">';
                // //$itext .= '<img src="''" alt="" height="50" class="rounded">';
                // $itext .= '</div>';
                // $itext .= '</td>';
                $itext .= '<td scope="row" class="text-center">';
                $itext .= "<h6 class='mb-1'>".getProductName($key->pro_id).'</h6>';
                $itext .= '</td>';

                $itext .= '<td>';
                $itext .= "<h6 class='mb-1 text-end'>₹ $key->price</h6>";
                $itext .= '</td>';

                // $itext .= '<td>';
                // $itext .= "<h6 class='mb-1 text-center'>$key->bv PV</h6>";
                // $itext .= '</td>';

                $itext .= '<td class="text-center">';
                $itext .= "<div class='input-group input-group-sm justify-content-center mx-auto' style='width: 110px;'>";
                $itext .= "<button type='button' class='btn btn-outline-secondary btn-sm btn-qty-minus' style='padding: 0.2rem 0.5rem; font-weight: bold; cursor: pointer;' title='Decrease' onclick='changeQty(this, -1)'>-</button>";
                $itext .= "<input type='number' min='1' value='$key->quantity' class='form-control form-control-sm text-center cart-qty px-1' style='max-width: 50px;' data-id='$key->id' data-price='$unitPrice' data-gst='$unitGst' data-total-unit='$unitTotal' onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput='handleQtyChange(this)' onchange='handleQtyBlur(this)' />";
                $itext .= "<button type='button' class='btn btn-outline-secondary btn-sm btn-qty-plus' style='padding: 0.2rem 0.5rem; font-weight: bold; cursor: pointer;' title='Increase' onclick='changeQty(this, 1)'>+</button>";
                $itext .= "</div>";
                $itext .= '</td>';

                $itext .= '<td>';
                $itext .= "<h6 class='mb-1 text-center row-amount'>₹ $rowAmount </h6>";
                $itext .= '</td>';

                $itext .= '<td class="text-end">';
                $itext .= "<button style='border-radius: 0 5px 5px 0;' title='Delete Item' class='btn btn-danger btn-sm rounded' onclick='DeleteCartItem($key->id)'><i class='mdi mdi-trash-can-outline'></i></button>";
                $itext .= '</td>';

                $itext .= '</tr>';
            }
            $result['itext'] = $itext;
        } else {
            $itext = '<p>Cart is Empty</p>';
        }

        return $result;
    }

    public function updateCartQuantity(Request $request)
    {
        $itemId = $request->input('itemId');
        $newQuantity = (int) $request->input('quantity');

        // Find the cart item
        $orderItem = OrderDetail::find($itemId);

        // If item exists and the quantity is valid
        if ($orderItem && $newQuantity > 0) {
            $proData = Product::find($orderItem->pro_id);
            $orderItem->quantity = $newQuantity;
            if ($proData) {
                $orderItem->gst_amount = $proData->gst * $newQuantity;
                $orderItem->total_amount = $proData->distributor_price * $newQuantity;
            } else {
                $orderItem->total_amount = $orderItem->price * $newQuantity;
            }
            $orderItem->save();

            $totals = OrderDetail::where([
                ['memberid', $orderItem->memberid],
                ['status', 'Temp'],
            ])->selectRaw('SUM(quantity) as total_quantity, SUM(total_amount) as total_amount')
                ->first();

            $totqty = $totals->total_quantity;
            $totamount = number_format($totals->total_amount, 2, '.', '');

            return response()->json([
                'status' => 'success',
                'totQty' => $totqty,
                'totAmount' => $totamount,
            ]);
        }

        return response()->json(['error' => 'Item not found or invalid quantity'], 400);
    }

    public function deleteCartItem(Request $request)
    {
        $orderId = $request->post('order_id');
        $var = OrderDetail::find($orderId)->delete();
        $count = countCart();
        if ($var) {
            return response()->json([
                'code' => 1,
                'data' => 'Order Deleted Successfully!',
                'qty' => $count,
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'data' => 'No Order Found',
                'qty' => 0,
            ]);
        }
    }

    public function finalCheckout(Request $request)
    {
        $mem = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $mem->memberid;
        $placementid = $mem->placementid;
        $position = $mem->position;
        $p2p_wallet = $mem->p2p_wallet;
        $sponsorid = $mem->sponsorid;
        $name = $mem->name;
        // if ($mem->address == '' || $mem->city == '') {
        //     return response()->json([
        //         'code' => 0,
        //         'data' => 'Please fill your address in profile details before checkout',
        //     ]);
        // }

        $orders = OrderDetail::where([['memberid', $memberid], ['status', 'Temp']])->get();
        if (count($orders) <= 0) {
            return response()->json([
                'code' => 0,
                'data' => 'No product found for checkout',
            ]);
        }
        $totals = OrderDetail::where([
            ['memberid', $mem->memberid],
            ['status', 'Temp'],
        ])->selectRaw('SUM(quantity) as total_quantity, SUM(total_amount) as total_amount')
            ->first();
        $totqty = $totals->total_quantity;
        // $totbv = $totals->bv;
        $total_amount = $totals->total_amount;
        // $total_bv = $totbv * $totqty;
        $pro_id = $totals->pro_id;

        foreach ($orders as $od_value) {
            $pro_id = $od_value->pro_id;
            $proData = Product::find($pro_id);
            if ($od_value->quantity > $proData['quantity']) {
                return response()->json([
                    'code' => 0,
                    'data' => 'Product stock is not available for '.getProductName($pro_id).'. Please reduce quantity or remove from cart.',
                ]);
            }
        }

        if ($total_amount > ($p2p_wallet)) {
            return response()->json([
                'code' => 0,
                'data' => 'You do not have enough balance for checkout. Please import fund in p2p walllet.',
            ]);
        }

        foreach ($orders as $od_value) {
            $pro_id = $od_value->pro_id;
            $proData = Product::find($pro_id);
            $proData->quantity -= $od_value->quantity;
            $proData->save();
        }
        $invoiceNo = getinvoiceno();

        // $fran = FranchiseDetail::where('state', $mem->state)->where('city', $mem->city)->first();
        // $franchise_id = ($fran) ? $fran->franchise_id : '';
        // if ($fran) {
        //     $franchise_id = $fran->franchise_id;

        // } else {
        //     $franchise_id = '';
        // }

        $update = OrderDetail::where([['memberid', $memberid], ['status', 'Temp']])->update(['status' => 'Completed', 'invoice_no' => $invoiceNo]);

        $new = new InvoiceTable;
        $new->memberid = $memberid;
        $new->invoice_no = $invoiceNo;
        $new->invoice_series = getinvoiceseries();
        $new->amount = $total_amount;
        $new->session = financialyear();
        $new->save();

        if ($mem->status == 'Temp') {
            $mem->status = 'Active';
            $mem->activated_at = date('Y-m-d H:i:s');
            updateDownline($sponsorid);
            // updateUpline($sponsorid, $memberid);
        }

        $wallet = $mem->p2p_wallet;
        $mem->p2p_wallet -= $total_amount;
        walletTransfer($memberid, $total_amount, 'credit', $wallet, 'Order Purchased', ' ₹ '.$total_amount.' have been deducted from p2p wallet to purchased order');
        $mem->package = $total_amount;
        $mem->self_biz += $total_amount;
        $mem->team_biz += $total_amount;
        $mem->save();

        foreach ($orders as $od_value) {
            $amount = $od_value->total_amount;
            // levelIncome($sponsorid, $memberid, $name, $amount);
        }

         $rate = RoiRate::first();

        $sp = $total_amount / $rate->sp_rate;

        team_biz_update($sponsorid, $total_amount);
        binary_biz_update($memberid, $placementid, $position, $sp);

        return response()->json([
            'code' => 1,
            'data' => 'Order Created Successfully!',
        ]);
    }

    public function dispatchOrder()
    {
        $result['orders'] = OrderDetail::where('status', 'Completed')->get();

        return view('admin.dispatch.dispatch-order')->with($result);
    }

    public function dispatchOrderForm($id)
    {
        $result['orders'] = OrderDetail::find($id);

        return view('admin.dispatch.dispatch-order-form')->with($result);
    }

    public function dispatchOrderP(Request $request)
    {
        $request->validate([
            'courier_name' => 'required',
            'tracking_id' => 'required',
            'dispatch_date' => 'required',
        ]);

        $id = $request->post('id');

        $var = OrderDetail::find($id);

        if ($var['status'] == 'Dispatched') {
            session()->flash('failedMsg', 'You are already dispatched.');

            return redirect()->back();
        }

        $var->courier_name = $request->post('courier_name');
        $var->tracking_id = $request->post('tracking_id');
        $var->dispatch_date = $request->post('dispatch_date');
        $var->status = 'Dispatched';
        $var->save();

        session()->flash('successMsg', 'Dispatch order has been created successfully');

        return redirect('/admin/dispatch-order-dis');
    }

    public function dispatchOrderDis()
    {
        $result['orders'] = OrderDetail::where('status', 'Dispatched')->get();

        return view('admin.dispatch.dispatch-order-dis')->with($result);
    }

    public function myCart()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));

        return view('member.product.cart')->with($result);
    }

    public function buyProduct()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        // if (empty($result['data']['state']) || empty($result['data']['city'])) {
        //     session()->flash('failedMsg', 'Please fill your state and city in profile details before buying products');

        //     return redirect()->to('/member/profile/profile-details');
        // }
        // $result['franchise'] = FranchiseDetail::where('status', 'Active')->get();
        $result['products'] = Product::where('status', 'Live')->get();

        return view('member.product.buy-products')->with($result);
    }

    public function productDetails(Request $request, $id)
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['pro_data'] = Product::find($id);

        return view('member.product.product-details')->with($result);
    }

    public function viewProduct(Request $request, $id)
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['pData'] = Product::find($id);

        return view('member.product.view-product')->with($result);
    }

    public function orderHistory()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));

        return view('member.product.order-history')->with($result);
    }

    public function getOrderHistory(Request $request)
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        if ($request->ajax()) {
            $query = OrderDetail::where([['memberid', $memberid], ['status', '!=', 'Temp']])->orderBy('created_at', 'DESC');

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->editColumn('pro_id', function ($row) {
                    return getProductName($row->pro_id);
                })
                ->make(true);
        }
    }

    public function checkout()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['pendOrders'] = OrderDetail::where([['memberid', $result['data']['memberid']], ['status', 'Temp']])->get();
        $totals = OrderDetail::where([
            ['memberid', $result['data']['memberid']],
            ['status', 'Temp'],
        ])->selectRaw('SUM(quantity) as total_quantity, SUM(total_amount) as total_amount')
            ->first();

        $result['total_quantity'] = $totals->total_quantity;
        // $result['total_bv'] = $totals->total_bv;
        $result['total_amount'] = $totals->total_amount;
        $p2p_wallet = $result['data']['p2p_wallet'];
        $repurchase_wallet = $result['data']['repurchase_wallet'];
        if (($p2p_wallet + $repurchase_wallet) < $result['total_amount']) {
            session()->flash('failedMsg', 'You do not have enough balance for checkout. Please import fund in p2p walllet.');

            return redirect()->back();
        }

        // if ($result['data']['address'] == '') {
        //     session()->flash('failedMsg', 'Please fill your address in profile details before checkout');
        //     return redirect()->to('/member/profile/profile-details');
        // }
        // if ($result['data']['state'] == '') {
        //     session()->flash('failedMsg', 'Please fill your state in profile details before checkout');
        //     return redirect()->to('/member/profile/profile-details');
        // }
        // if ($result['data']['city'] == '') {
        //     session()->flash('failedMsg', 'Please fill your city in profile details before checkout');
        //     return redirect()->to('/member/profile/profile-details');
        // }
        return view('member.product.checkout')->with($result);
    }

    public function printInvoice(Request $request, $invoice_no)
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['inv_data'] = InvoiceTable::where([['invoice_no', $invoice_no], ['memberid', $result['data']['memberid']]])->first();
        $result['ordData'] = OrderDetail::with('product:id,product')
            ->where([['invoice_no', $invoice_no], ['memberid', $result['data']['memberid']]])
            ->get();
        $result['invoiceSubtotal'] = round((float) $result['ordData']->sum(
            fn ($item) => (float) $item->price * (int) $item->quantity
        ), 2);
        $result['totalGst'] = round((float) $result['ordData']->sum('gst_amount'), 2);
        $result['productDiscount'] = 0.00;
        $result['invoiceTotal'] = round((float) $result['ordData']->sum('total_amount'), 2);

        return view('member.product.print-invoice')->with($result);
    }

    public function linkProduct()
    {
        $result['linkdata'] = ProductLink::all();

        return view('admin.masters.add-link-product')->with($result);
    }

    public function createLink(Request $request)
    {
        $request->validate([
            'plateform' => 'required',
            'title' => 'required',
            'price' => 'required',
            // 'bv' => 'required',
            'description' => 'required',
            'link' => 'required|unique:categories,category',
            'image' => 'required',
        ]);

        $var = new ProductLink;
        $var->plateform = $request->post('plateform');
        $var->title = $request->post('title');
        $var->price = $request->post('price');
        // $var->bv = $request->post('bv');
        $var->description = $request->post('description');
        $var->link = $request->post('link');
        if ($request->hasFile('image')) {
            $bimage = $request->file('image');
            $ext = $bimage->getClientOriginalExtension();
            $imagename = 'product'.time().'.'.$ext;
            $bimage->move(public_path('uploads'), $imagename);
            $var->image = $imagename;
        }
        $var->save();

        session()->flash('createMsg', 'Link has been created successfully');

        return redirect()->back();
    }

    public function editLinkPro(Request $request, $id)
    {
        $result['udata'] = ProductLink::find($id);

        return view('admin.masters.edit-link-product')->with($result);
    }

    public function updateLinkProduct(Request $request)
    {
        $id = $request->post('id');
        // $request->validate([
        //     'plateform' => 'required',
        //     'title' => 'required',
        //     'price' => 'required',
        //     'description' => 'required',
        //     'link' => 'required|unique:categories,category',
        //     'image' => 'required',
        // ]);
        $var = ProductLink::find($id);
        $var->plateform = $request->post('plateform');
        $var->title = $request->post('title');
        $var->price = $request->post('price');
        // $var->bv = $request->post('bv');
        $var->description = $request->post('description');
        $var->link = $request->post('link');
        if ($request->hasFile('image')) {
            $bimage = $request->file('image');
            $ext = $bimage->getClientOriginalExtension();
            $imagename = 'product'.time().'.'.$ext;
            $bimage->move(public_path('uploads'), $imagename);
            $var->image = $imagename;
        }
        $var->save();

        session()->flash('updateErr', 'Product Details have been updated');

        return redirect()->back();
    }

    public function productStatus(Request $request, $id)
    {
        $var = ProductLink::find($id);
        $status = $var->status;
        if ($status == 'Not Live') {
            $var->status = 'Live';
            $var->save();
            session()->flash('successMsg', 'Product status has been changed successfully');

            return redirect()->back();
        } elseif ($status == 'Live') {
            $var->status = 'Not Live';
            $var->save();
            session()->flash('successMsg', 'Product status has been changed successfully');

            return redirect()->back();
        }
    }

    public function linkProductAmazon()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['alink'] = ProductLink::where([['status', 'Live'], ['plateform', 'Amazon']])->get();

        return view('member.linkProduct.amazon-product')->with($result);
    }

    public function linkProductFlipkart()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['flink'] = ProductLink::where([['status', 'Live'], ['plateform', 'Flipkart']])->get();

        return view('member.linkProduct.flipkart-product')->with($result);
    }

    public function dispatchedOrder()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));

        return view('member.product.dispatched')->with($result);
    }

    public function getDispatchedOrder(Request $request)
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        if ($request->ajax()) {
            $query = OrderDetail::where([['memberid', $memberid], ['status', 'Dispatched']])->orderBy('created_at', 'DESC');

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->editColumn('pro_id', function ($row) {
                    return getProductName($row->pro_id);
                })
                ->make(true);
        }
    }

    public function orderDetails($id)
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['cdata'] = OrderDetail::find($id);

        return view('member.product.order-details')->with($result);
    }

    public function issueInventory($id)
    {
        $result['data'] = Product::find($id);
        $result['idata'] = IndiaState::all();
        $result['fdata'] = FranchiseDetail::all();

        return view('admin.masters.issue-inventory')->with($result);
    }

    public function issueInventoryStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'franchise_id' => 'required|exists:franchise_details,franchise_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->post('product_id'));
        if (! $product) {
            session()->flash('failedMsg', 'Inventory not found.');

            return redirect()->back();
        }

        $issueQty = (int) $request->post('quantity');

        if ((int) $product->quantity < $issueQty) {
            session()->flash('failedMsg', 'Inventory stock is not available.');

            return redirect()->back()->withInput();
        }

        $issue = new IssueInventorie;
        $issue->franchise_id = $request->post('franchise_id');
        $issue->product = $product->product;
        $issue->pro_id = $product->id;
        $issue->quantity = $issueQty;
        $price = $product->price;
        $issue->price = $price;
        $issue->total_amount = $issueQty * $price;
        $issue->save();

        $product->quantity = (int) $product->quantity - $issueQty;
        $product->save();

        session()->flash('successMsg', 'Inventory has been issued successfully.');

        return redirect()->back();
    }

    public function allOrders()
    {
        $result['orders'] = OrderDetail::where('status', 'Completed')->orderBy('created_at', 'DESC')->get();

        return view('admin.orders.all-orders')->with($result);
    }

    public function undeliveredOrders()
    {
        $result['orders'] = OrderDetail::where('status', 'Undelivered')->get();

        return view('admin.orders.undelivered-orders')->with($result);
    }

    public function pendingOrders()
    {
        $result['orders'] = OrderDetail::where('status', 'Pending')->get();

        return view('admin.orders.pending-orders')->with($result);
    }

    public function addFranchise($id)
    {
        $result['order'] = OrderDetail::find($id);
        $result['data'] = Product::find($result['order']->pro_id);
        $result['fdata'] = FranchiseDetail::all();

        return view('admin.orders.add-franchise')->with($result);
    }

    public function addFranchiseStore(Request $request)
    {
        $request->validate([
            'order_detail_id' => 'required|integer|exists:order_details,id',
            'franchise_id' => 'required|exists:franchise_details,franchise_id',
        ]);

        $order = OrderDetail::find($request->post('order_detail_id'));
        if (! $order) {
            session()->flash('failedMsg', 'Order not found.');

            return redirect()->back()->withInput();
        }

        $order->franchise_id = $request->post('franchise_id');
        $order->status = 'Completed';
        $order->save();

        session()->flash('successMsg', 'Franchise has been assigned successfully.');

        return redirect()->back();
    }
}
