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

       
          <a class="btn btn-outline-success btn-sg" data-toggle="modal" data-target="#addYear">
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
                      <a href="{{url('/manage/year/delete')}}" class="btn btn-danger btn-sm delete-confirm" data-toggle="tooltip" title="ลบ"><i class="fas fa-trash-alt"></i></a>
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
<div class="modal fade" id="addYear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">คุณต้องการเพิ่มปีการศึกษา {{Term::getLastYear()+1}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <a class="btn btn-success" href="{{url('manage/year/add')}}">เพิ่ม</a>
      </div>
    </div>
  </div>
</div>
@stop