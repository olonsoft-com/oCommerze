@extends('admin.layout._layout')

@section('content')
<div id="home_quicklinks">
                                <a class="quicklink link1" href="dashboard/order">
                                    <span class="ql_caption">
                                        <span class="outer">
                                            <span class="inner">
                                                <h2>Orders</h2>
                                            </span>
                                        </span>
                                    </span>
                                    <span class="ql_top"></span>
                                    <span class="ql_bottom"></span>
                                </a>

                                <a class="quicklink link2" href="dashboard/stock">
                                    <span class="ql_caption">
                                        <span class="outer">
                                            <span class="inner">
                                                <h2>Stocks</h2>
                                            </span>
                                        </span>
                                    </span>
                                    <span class="ql_top"></span>
                                    <span class="ql_bottom"></span>
                                </a>

                                <a class="quicklink link3" href="dashboard/report">
                                    <span class="ql_caption">
                                        <span class="outer">
                                            <span class="inner">
                                                <h2>Reports </h2>
                                            </span>
                                        </span>
                                    </span>
                                    <span class="ql_top"></span>
                                    <span class="ql_bottom"></span>
                                </a>

                                <div class="clear"></div>
                            </div>

@endsection

@section('footer')

@endsection