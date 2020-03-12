
@extends('layouts.app')

@section('content')

    <script type="text/javascript" src="{{asset('js/calender.1.0.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/calender.1.1.js')}}"></script>

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <flash message=""></flash>
                        <div class="card-header">Calender<calender-component></calender-component>
                        </div>
                        <div class="card-body" id="ta">
                            <div id="content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script>
        var object=new site();
    </script>
@endsection
