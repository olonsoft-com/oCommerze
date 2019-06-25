<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;

class CustomerController extends Controller
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

            $query = \App\User::role('customer')->with(['customer']);

            //filter by keyword
            if( isset( $_GET['keyword'] ) && $_GET['keyword'] != null ){
                $keyword = $_GET['keyword'];
                $query->where(function( $q ) use ( $keyword ) {
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
            if( isset( $_GET['email'] ) && $_GET['email'] != null ) {
                $email = $_GET['email'];
                $query->where( function($q) use ($email) {
                    $q->orWhereRaw("lower(email) LIKE '%" . strtolower($email) . "%'");
                });
            }

            //filter by email
            if( isset( $_GET['status'] ) && $_GET['status'] != null ) {
                $status = $_GET['status'];
                $query->where( function($q) use ($status) {
                    $q->orWhereRaw("lower(status) LIKE '%" . strtolower($status) . "%'");
                });
            }

            //filter by email
            if( isset( $_GET['mobile'] ) && $_GET['mobile'] != null ) {
                $mobile = $_GET['mobile'];
                
                $q->orWhereHas('customer', function ($q) use ($mobile) {
                    $q->WhereRaw("lower(cell_1) LIKE '%" . strtolower($mobile) . "'");
                    $q->WhereRaw("lower(cell_2) LIKE '%" . strtolower($mobile) . "'");
                });
            }

            $total = $query->count();

            $query->offset($start);
            $query->limit($limit);
            $query->orderBy($column, $order);
            $customers = $query->get();

            //sanitize data
            $returnArr = array();
            if( $customers ) {
                foreach( $customers as $customer ) {
                    $row['name'] = $customer->name;
                    $row['email'] = $customer->email;
                    $row['mobile'] = $customer->customer['cell_1'];
                    $row['status'] = ( $customer->status == 1 ) ? 'Active' : 'Disabled';
                    $row['status'] = ( $customer->status == 0 ) ? 'Pending' : $row['status'];
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

        $requestCount = \App\CustomerRequest::where('status', 0)->count();

        return view('admin.customer.index')->withTitle('Customers')->withCount($requestCount);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create')->withTitle('Add new customer')->withCount(0);
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
        return view('admin.customer.show')->withTitle('Edit customer')->withCount(0);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.customer.edit')->withTitle('Edit customer')->withCount(0);
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
