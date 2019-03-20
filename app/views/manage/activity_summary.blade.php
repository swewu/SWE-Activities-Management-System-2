@extends('manage.layout')
@section('title')
กิจกรรมทั้งหมด
@stop
@section('subtitle')
จัดการกิจรรม
@stop
@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">

      <form class="input-group input-group-lg col-md-5 float-right">
            <input class="form-control py-2" type="search" value="" placeholder="ค้นหาจากชื่อกิจกรรม" name="q">
            <span class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">
                  <i class="fa fa-search"></i>
              </button>
            </span>
        </form>
      </div>
      <div class="card-body p-0 text-center">
        <table class="table mb-0 ">
          <thead class="bg-light">
            <tr>
              <th scope="col" class="border-0">ชื่อกิจกรรม</th>
              <th scope="col" class="border-0">ปี ภาคการศึกษา</th>
              <th scope="col" class="border-0">นักศึกษาที่ต้องเข้าร่วมกิจกรรม</th>
              <th scope="col" class="border-0">นักศึกษาที่เข้าร่วม</th>
              <th scope="col" class="border-0">นักศึกษาที่ไม่เข้าร่วม</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td class="text-left" style="vertical-align : middle;">SWE</td>
                <td>
                <div>
                    <h6 class="mb-0">ปีการศึกษา 2560</h6>
                    <span>ภาคการศึกษา 1</span>
                  </div>
                </td>
                <td>22</td>
                <td>18</td>
                <td>4</td>
              </tr>
          </tbody>
         </table>
      </div>
    </div>
  </div>

@stop
