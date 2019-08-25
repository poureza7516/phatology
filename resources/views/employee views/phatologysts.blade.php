@extends('layouts.app')

@section('content')
    <div style="font-family: 'B Nazanin'; font-size: medium;">
        {{-----//////////////////////////////////////redirect to reception page///////////////////////////////////////////////////////--}}

        <div class="modal-sm">
            <div class="position-absolute" style="left: 80%;top: 10.5%;">
                <div class="card card-body">
                    <div class="card card-header">
                        <label>پذیرش </label>
                    </div>
                    <hr>
                    <a href="/employeehome">
                        <button class="btn-outline-primary">ورود به صفحه پذیرش</button>
                    </a>

                </div>
            </div>
        </div>


        {{-----//////////////////////////////////////redirect to reception page///////////////////////////////////////////////////////--}}

        <div class="position-absolute" style="left: 5%;top: 10.5%;" >

                    <div class="card card-body">
                        <div class="card-header">ثبت نتایج</div>
                        <hr>
                        <div class="card-body">
                            <label>شماره پذیرش را وارد کنید</label>
                            <input type="text" name="reception_id" id="reception-id">
                            <hr>
                            <button type="submit" class="btn-outline-info" onclick="show();">جستجو</button>
                        </div>

                        <div  class="card card-text">

                            <table class="table table-info table-striped">
                                <tr>

                                    <th >نام</th>
                                    <th >نتیجه</th>
                                    <th >توضیحات</th>
                                </tr>
                                <tr >
                                    <td id="name"></td>
                                    <td id="result"></td>
                                    <td id="description"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

            {{----------------------------------------------js show test for enter results----------------------------------------------}}
                    <script>
                        function show(){
                            var reception_id=document.getElementById('reception-id').value;


                            alert(reception_id);
                        }
                    </script>

            {{----------------------------------------------js show test for enter results----------------------------------------------}}



            {{--<div class="card">--}}
                        {{--<div class="card-header">همه سوابق بیمار</div>--}}
                        {{--<hr>--}}
                        {{--<div class="card-body">--}}
                            {{--<label>شماره ملی را وارد کنید</label>--}}
                            {{--<input type="text" name="national_id" id="national-id">--}}
                            {{--<hr>--}}
                            {{--<button type="submit" class="btn-outline-info">جستجو</button>--}}

                        {{--</div>--}}
                    {{--</div>--}}

        </div>

        {{--///////////////////////////////////////namayesh natije/////////////////////////////////////////////////////////////--}}

        <div class="modal-sm">
            <div class="position-absolute" style="left: 40%;top: 10.5%;">
                <div class="card card-body">
                    <div class="card card-header">
                        <label>نمایش نتایج</label>
                    </div>
                    <hr>
                    <div class="card-body">
                        <label>شماره پذیرش</label>
                        <input type="text" name="reception_id" id="reception-id">
                        <hr>
                        <button type="submit" class="btn-outline-info" onclick="showresult();">جستجو</button>
                    </div>

                    <div  class="card card-text">

                        <table class="table table-info table-striped">
                            <tr>
                                <th>شماره</th>
                                <th >نام</th>
                                <th >نتیجه</th>
                                <th >توضیحات</th>
                            </tr>
                            <tr >
                                <td id="id"></td>
                                <td id="name"></td>
                                <td id="result"></td>
                                <td id="description"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        {{--///////////////////////////////////////namayesh natije/////////////////////////////////////////////////////////////--}}

    </div>
@endsection