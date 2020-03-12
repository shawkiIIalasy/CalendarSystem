@extends('layouts/app')
@section('content')
    <div class="container w-75">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <a href="/home" class="fa fa-stop-circle float-right alert alert-primary m-0 mr-1"></a>
                        <a href="/home" class="fa fa-backward float-right alert alert-primary m-0 mr-1"></a>
                        <h5 class="mt-2">{{$event[0]->title}}</h5>
                    </div>
                    <div class="card-body" id="ta">

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <span class="fa fa-clock"></span>
                                    {{\Carbon\Carbon::parse($event[0]->start_time)->format('g:i a')}}
                                    --
                                    {{\Carbon\Carbon::parse($event[0]->end_time)->format('g:i a')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <span class="fa fa-bell"></span>
                                    {{\Carbon\Carbon::parse($event[0]->start_date.' '.$event[0]->start_time)->longRelativeDiffForHumans()}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <span class="fa fa-align-justify"></span>
                                    {{$event[0]->description}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <span class="fa fa-calendar"></span>
                                    {{$event[0]->start_date}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <span class="fa fa-calendar"></span>
                                    {{$event[0]->end_date}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <span class="fa fa-user"></span>
                                    {{$event[0]->user->name}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <span class="fa fa-at"></span>
                                    {{$event[0]->user->email}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label>Guests</label>
                            </div>
                            @foreach($event[0]->guest as $guest)
                                <div class="col-12">
                                    <div class="form-group alert alert-primary">
                                        <span class="fa fa-user"></span>
                                        {{$guest->user->name}} || {{$guest->user->email}}
                                        <span class="float-right">{{Status::getStatus($guest->status)}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
