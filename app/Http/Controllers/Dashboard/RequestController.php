<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        if( $request->ajax() === True ) {
            $limit = $request->input('length');
            $start = $request->input('start');
            $columns = $request->get('columns');
            $column = $columns[$request->input('order.0.column')]['data'];
            $order = $request->input('order.0.dir');

            $query = \App\CustomerRequest::with(['customer']);

            //filter by keyword
            if( isset( $_GET['keyword'] ) && $_GET['keyword'] != null ){
                $keyword = $_GET['keyword'];
                $query->whereHas('customer', function( $q ) use ( $keyword ) {
                    $q->orWhereRaw("lower(name) LIKE '%" . strtolower($keyword) . "%'");
                    $q->orWhereRaw("lower(email) LIKE '%" . strtolower($keyword) . "%'");
                    $q->orWhereRaw("lower(id) LIKE '%" . strtolower($keyword) . "'");
                    $q->orWhereHas('customer', function ($q) use ($keyword) {
                        $q->WhereRaw("lower(cell_1) LIKE '%" . strtolower($keyword) . "'");
                        $q->WhereRaw("lower(cell_2) LIKE '%" . strtolower($keyword) . "'");
                    });
                });
            }

            //filter by email
            if( isset( $_GET['status'] ) && $_GET['status'] != null ) {
                $status = $_GET['status'];
                $query->where( function($q) use ($status) {
                    $q->Where('status', $status);
                });
            }

            //filter by email
            if( isset( $_GET['mobile'] ) && $_GET['mobile'] != null ) {
                $mobile = $_GET['mobile'];
                
                $q->WhereHas('customer', function ($q) use ($mobile) {
                    $q->WhereRaw("lower(cell_1) LIKE '%" . strtolower($mobile) . "'");
                    $q->orWhereRaw("lower(cell_2) LIKE '%" . strtolower($mobile) . "'");
                });
            }

            $total = $query->count();

            $query->offset($start);
            $query->limit($limit);
            $query->orderBy($column, $order);
            $requests = $query->get();

            //sanitize data
            $returnArr = array();
            if( $requests ) {
                foreach( $requests as $req ) {
                    $row['name'] = $req->customer['name'];
                    $row['email'] = $req->customer['email'];
                    $row['mobile'] = $req->customer['cell_1'];
                    $row['status'] = ( $req->status == 1 ) ? 'Active' : 'Disabled';
                    $row['status'] = ( $req->status == 0 ) ? 'Pending' : $row['status'];
                    $row['btns'] = '<a href="#" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>';
                    array_push( $returnArr, $row );
                }
            }

            $data = [
                'draw' => $request->get('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $returnArr
            ];

            return response()->json( $data );
        }
        return view('admin.customer.request.index')->withTitle('Customer Requests')->withCount(0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.request.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.customer.request.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.customer.request.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
