@extends('manage.layout')
@section('title')
ปีการศึกษา
@stop
@section('subtitle')
จัดการปีการศึกษา
@stop
@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">

       
          <a class="btn btn-outline-success btn-sg" href="{{url('/manage/year/add')}}">
            <i class="fa fa-plus"></i> เพิ่มปีการศึกษา
          </a>
         
      </div>
      <div class="card-body p-0 text-center">
        <table class="table mb-0 ">
          <thead class="bg-light">
              <tr>
                <th class="text-center">ลำดับที่</th>
                <th class="text-center">ปีการศึกษา</th>
                <th class="text-center">จำนวนกิจกรรมที่จัด</th>
                <th class="text-center">จัดการปีการศึกษา</th>
            </tr>
          </thead>
          <tbody>
            @foreach($years as  $i => $year)
              <tr>
                <td>{{ Tool::calIndex($i,1,100) }}</td>
                <td class="text-center">{{$year}}</td>
                <td class="text-center">{{ActivityDetail::where('term_year',$year)->count()}}</td>
                <td class="text-center">
                    @if($now_year == $year)  
                      <a href="" class="btn btn-danger btn-sm delete-confirm" data-toggle="tooltip" title="ลบ"><i class="fas fa-trash-alt"></i></a>
                    @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer bg-light border-top text-muted">
        
      </div>
    </div>
  </div>
</div>

@stop