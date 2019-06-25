<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
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

            $query = \App\Package::withCount('customers');

            //filter by keyword
            if( isset( $_GET['keyword'] ) && $_GET['keyword'] != null ){
                $keyword = $_GET['keyword'];
                $query->where(function( $q ) use ( $keyword ) {
                    $q->orWhereRaw("lower(name) LIKE '%" . strtolower($keyword) . "%'");
                    $q->orWhereRaw("lower(code) LIKE '%" . strtolower($keyword) . "%'");
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
                    $row['id'] = $customer->id;
                    $row['name'] = $customer->name;
                    $row['code'] = $customer->code;
                    $row['customer_count'] = $customer->customers_count;
                    $row['btns'] = '<a href="javascript:void(0)" class="btn btn-default btn-xs edit" data-id="' . $customer->id . '"><i class="fa fa-edit"></i></a>';
                    $row['btns'] .= '<a href="javascript:void(0)" class="btn btn-primary btn-xs stats" data-id="' . $customer->id . '"><i class="fa fa-chart-line"></i></a>';
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
        return view('admin.customer.package.index')->withTitle('Packages')->withCount(0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.package.create')->withTitle('Add new package')->withCount(0);
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
        return view('admin.package.show')->withTitle('Package');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.package.edit')->withTitle('Package');
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
