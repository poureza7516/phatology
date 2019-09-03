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
                            <button type="submit" class="btn-outline-info" onclick="">جستجو</button>
                        </div>

                        <div  class="card card-text">

                            <table class="table table-info table-striped">
                                <tr>

                                    <th >شماره</th>
                                    <th >نام</th>

                                </tr>
                                <tr >
                                    <td id="id"></td>
                                    <td id="name"></td>

                                </tr>
                            </table>
                        </div>
                    </div>

            {{----------------------------------------------js show test for enter results----------------------------------------------}}



            <script>
                function disptest(){
                    win=window.confirm('از ذخیره آزمایش مطمئن هستید؟');
                    if(win)
                    {
                        var testname = document.getElementById("test-name").value;
                        var para=document.createElement("tablerow");
                        para.type='';
                        para.name="test_name";
                        para.className="tablerow"
                        para.value=testname;
                        document.getElementById("testshowname").appendChild(para);
                        document.getElementById("testshowname").innerHTML += testname + '<br />';

                        /////////////////////////////create test //////////////////////////////////////////
                        // var test_name = document.getElementById('test-name').value;
                        // var url = 'http://localhost:8000/createtest';
                        // fetch(url, {
                        //     method: 'POST',
                        //     body: JSON.stringify({/*reception_id: reception_id ,*/ name: test_name}),
                        //     headers: {
                        //         'Content-Type': 'application/json',
                        //         'Accept': 'application/json',
                        //         "X-CSRF-Token": document.getElementById('csrf').value
                        //     }
                        // })
                        //     .then(res => res.json())
                        //     .then(data => alert(JSON.stringify(data)))
                        //
                        // //////////////////////////////////////////////////////////////////////

                    }
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
                        <input type="text" name="reception_id" id="receptionid">
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


        {{--------------------------------------------------------js show result --------------------------------------------}}

        <script>
            function showresult()
            {
                var reception_id = document.getElementById('receptionid').value;
                var url = 'http://localhost:8000/testindex?reception_id=' + reception_id;
                alert(url);
                fetch(url)
                    .then(function(res)
                    {
                        return res.json()
                    })
                    .then(function(data)
                    {
                        ////////////////////////////////////////////////
                        document.getElementById('id').innerHTML = data.id;
                        document.getElementById('name').innerHTML = data.name;
                        ////////////////////////////////////////////////
                    }
                        .then(res => res.json())
                        .then(data => alert(JSON.stringify(data))))

            }
        </script>
        {{--------------------------------------------------------js show result --------------------------------------------}}


        {{--///////////////////////////////////////namayesh natije/////////////////////////////////////////////////////////////--}}

    </div>
@endsection