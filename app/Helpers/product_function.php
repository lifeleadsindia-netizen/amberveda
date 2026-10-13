<?php

use App\Models\Category;
use App\Models\MemberDetail;
use App\Models\OrderDetail;
use App\Models\Product;

function categoryName($id)
{
    $var = Category::find($id);
    return $var['category'];
}

function getproductName($id)
{
    $var = Product::find($id);
    return $var['product'];
}

function getproductData($id)
{
    $var = Product::find($id);
    return $var;
}

function countCart()
{
    if (session()->has('MEMBER_LOGIN')) {
        $id = session('MEMBER_ID');
        $result['data'] = MemberDetail::find($id);
        $memberid = $result['data']['memberid'];
    } else {
        $memberid = session()->get('tempMemberid');
    }

    $count = OrderDetail::where([['memberid', $memberid], ['status', 'Temp']])->count();
    return $count;
}

function getProductImage($id)
{
    $path = Product::where('id',$id)->select('image')->first();
    return $path->image;
}
