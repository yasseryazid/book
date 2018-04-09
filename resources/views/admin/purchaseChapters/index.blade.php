@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Purchase Chapters</div>

                    <div class="panel-body table-responsive">
                        {{-- <input type="hidden" id="example" name="example" value="{{ Auth::user()->id }}"> --}}
                        <router-view name="purchaseChapters"></router-view>
                        <router-view></router-view>	
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
