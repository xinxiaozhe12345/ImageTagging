{{--
 Created by jin-yc10 on 15/10/22.
 --}}
{{--
--}}
@extends('layouts.master')
@section('title', '数据标注平台｜首页')
@section('tag', 'active')
@section("content")
    {{--@include('tag.head')--}}
    {{-- message part --}}
    <div class="breadcrumbs" style="margin-bottom: 0px; padding-top:15px;padding-bottom:15px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h2 style="margin-top:10px;">{{$dataset->name}}</h2>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right" style="margin-top:13px; font-size: 14px;">
                        <li><a href="{{url("/")}}">首页</a></li>
                        <li>{{$dataset->name}}</li>
                        <li>{{$standard->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="progress progress-striped" style="border-radius: 0px;">
            <div class="progress-bar progress-bar-info" role="progressbar"
                 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                 style="width:{{100*(1-($batch->remain_count-1)/count($standard->items))}}%;">
                <span class="sr-only">30% 完成（信息）</span>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 20px">
        <div>
            <div class="col-md-4" style="margin-top: 100px; text-align: right;">
                <h3 style="margin-right: 50px;">标准图片</h3>
                <img src="{{asset($standard->path)}}" style="height: 200px; margin-right: 50px;">
            </div>
            <div class="col-md-8" style="border-left: 1px solid #000; text-align: left;">
                <h3 style="margin-left: 60px;">标注</h3>
                <div class="col-md-4" style="margin-left: 50px">
                    <form action="{{url("/tag/".$dataset->id)}}" method="POST" class="form-inline" id="yes-form">
                        <input type="hidden" name="label" value="True">
                        <input type="hidden" name="item" value="{{$item->id}}">
                        <input type="hidden" name="batch" value="{{$batch->id}}">
                        {!! csrf_field() !!}
                        <input id="yes" type="button" value="是" class="btn btn-success once-btn" style="width:80%;">
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="{{url("/tag/".$dataset->id)}}" method="POST" class="form-inline" id="no-form">
                        <input type="hidden" name="label" value="False">
                        <input type="hidden" name="item" value="{{$item->id}}">
                        <input type="hidden" name="batch" value="{{$batch->id}}">
                        {!! csrf_field() !!}
                        <input id="no" type="button" value="不是" class="btn btn-danger once-btn" style="width:80%;">
                    </form>
                </div>
                <div class="col-md-8">
                    <img src="{{asset($item->path)}}" style="height: 400px; margin:20px 50px 50px 50px;">
                </div>
                {{--<div id="point" style="--}}
                        {{--position: absolute;--}}
                        {{--top:0px;--}}
                        {{--right:0px;--}}
                        {{--height:40px;--}}
                        {{--text-align: center;--}}
                        {{--">--}}
                    {{--<span style="font-size: 24px; vertical-align: middle;">{{Auth::user()->points}}</span>--}}
                    {{--<img src="{{asset("/imgs/coin_us_dollar_64px_1187372_easyicon.net.png")}}" style="height: 24px;">--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="application/javascript">
        $("#yes").on("click",function(e) {
            $("#yes-form").submit();
            $(".once-btn").attr("disabled", "disabled");
        });
        $("#no").on("click",function(e) {
            $("#no-form").submit();
            $(".once-btn").attr("disabled", "disabled");
        });
    </script>
@endsection

