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
                        <button class="btn btn-outline-primary">ورود به صفحه پذیرش</button>
                    </a>
                </div>
            </div>
        </div>

        {{-----//////////////////////////////////////redirect to reception page///////////////////////////////////////////////////////--}}

        <div class="position-absolute" style="left: 1%;top: 10.5%;" >

            <div class="card card-body">
                <div class="card-header">ثبت نتایج</div>
                <hr>
                <div class="card card-body">
                    <label>شماره پذیرش را وارد کنید</label>
                    <input type="text" name="reception_id" id="reception-id">
                    <input id="csrf" type="hidden" name="__token" value={{csrf_token()}} >
                    <hr>
                    <button type="submit" class="btn btn-outline-info" onclick="reception()">جستجو</button>
                </div>

                <div  class="card card-text">

                    <table id="testtable" class="table table-info table-striped">
                        <tr>

                            <th>شماره</th>
                            <th>نام</th>
                            <td>نتیجه</td>
                            <td>توضیحات</td>

                        </tr>
                        <tr>
                            <td id="id"></td>
                            <td id="name"></td>
                        </tr>
                    </table>
                </div>
            </div>




        </div>

        {{--///////////////////////////////////////namayesh natije/////////////////////////////////////////////////////////////--}}

        <div class="modal-sm">
            <div class="position-absolute" style="left: 50%;top: 10.5%;">
                <div class="card card-body">
                    <div class="card card-header">
                        <label>نمایش نتایج</label>
                    </div>
                    <hr>
                    <div class="card card-body">
                        <label>شماره پذیرش</label>
                        <input type="text" name="reception_id" id="receptionid">
                        <hr>
                        <button type="submit" class="btn btn-outline-info" onclick="showresult();">جستجو</button>
                    </div>

                    <div  class="card card-text">

                        <table border="1" cellpadding="7" class="table table-info table-striped" id="testtableshow">
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
                    <button type="submit" class="btn btn-outline-info" onclick="print();">چاپ</button>
                </div>
            </div>
        </div>
        <script>
            function print()
            {
                var content=document.getElementById('testtableshow');
                newWin= window.open("");
                newWin.document.write(content.outerHTML);
                newWin.print();
                newWin.close();
            }

        </script>

        <script>
            function reception()
            {
                var reception_id = document.getElementById('reception-id').value;

                var url = 'http://localhost:8000/testsearch?reception_id=' + reception_id;
                fetch(url).then(res=>res.json())
                    .then(data=>{
                        var t = document.getElementById('testtable');
                        for ( var d of data ) {
                            t.innerHTML += "<tr><td>"+ d['id'] + "</td><td>" + d['name'] + "</td><td><input type='text' id='result"+d['id'] +"'/></td><td><input type='text' id='description" + d['id'] +"'/</td>"
                                +"<td><button class='btn btn-outline-info' onclick='submittest(" + d['id']+")'>save</button></td></tr>";
                        }
                    })
            }
        </script>

        {{--------------------------------------------------------js show result --------------------------------------------}}

        <script>
            function showresult()
            {
                var reception_id = document.getElementById('receptionid').value;
                var url = 'http://localhost:8000/testindex?reception_id=' + reception_id;
                fetch(url).then(res=>res.json())
                    .then(data=>{
                        var t = document.getElementById('testtableshow');
                        for ( var d of data ) {
                            t.innerHTML += "<tr><td>"+ d['id'] + "</td><td>" + d['name'] + "</td><td>"+d['result']+"</td><td>"+d['description']+"</td></tr>";
                        }
                    })

            }
        </script>

        {{---------------------------------------------------------------------------------------------------------------}}
        <script>
            function submittest(id) {
                var result = document.getElementById('result' + id).value;
                var description = document.getElementById('description'+id).value;
                var url = 'http://localhost:8000/updatetest';
                fetch(url, {
                    method: 'POST',
                    body: JSON.stringify({id: id, result: result, description: description}),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        "X-CSRF-Token": document.getElementById('csrf').value
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        alert( 'ثبت شد' );
                    })
            }
        </script>
        {{--------------------------------------------------------js show result --------------------------------------------}}


        {{--///////////////////////////////////////namayesh natije/////////////////////////////////////////////////////////////--}}

    </div>
@endsection