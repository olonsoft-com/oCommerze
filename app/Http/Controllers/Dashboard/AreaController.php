<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Area;

class AreaController extends Controller
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

            $query = \App\Area::withCount('customers');

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
                    $row['btns'] = '<a href="#" class="btn btn-default btn-xs"><i class="fa fa-chart-line"></i></a>';
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

        $areas = Area::withCount('customers')->get();

        return view('admin.area.index', compact(['areas']))->withTitle('Areas')->withCount(0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.area.create')->withTitle('Add new area')->withCount(0);
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
        return view('admin.area.show')->withTitle('Area');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.area.edit')->withTitle('Area');
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
