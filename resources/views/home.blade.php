@extends('layouts.app')

@section('content')

    <div style="font-family: 'B Nazanin'; font-size: medium;">
            {{--///////////////////////////////////////namayesh natije/////////////////////////////////////////////////////////////--}}

            <div class="modal-sm">
                <div class="position-absolute" style="left: 7%;top: 10.5%;">
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
                            <hr>
                            <button type="submit" class="btn btn-outline-info" onclick="print();">چاپ</button>
                            <br>
                        </div>

                        <div  class="card card-body" id="printable">

                            <table  cellpadding="7" border="1" class="table table-info table-striped" id="testtableshow">
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

                {{--////////////////////////////////////show result//////////////////////////////////////////////////--}}




            {{--////////////////////////////js show tests function///////////////////////////////////////--}}
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

                function print()
                {
                     var content=document.getElementById('printable');
                    newWin= window.open("");
                    newWin.document.write(content.outerHTML);
                    newWin.print();
                    newWin.close();
                }

            </script>

            {{--////////////////////////////js show tests function///////////////////////////////////////--}}


            {{----------------------show records ------------------------------------------------------------}}
            <div class="position-absolute" style="left: 60%;top:10.5%;">


                        <div class="card card-body">
                            <div class="card card-header">
                                <label>سوابق آزمایشگاهی</label>
                            </div>
                            <hr>
                            <div  class="card card-body">

                                <table cellpadding="5" class="table table-info table-striped" id="recordtableshow">
                                    <tr>
                                        <th>شماره پذیرش</th>
                                        <th >تاریخ انجام آزمایش</th>
                                        <th >وضعیت</th>
                                    </tr>
                                    <tr >
                                        <td id="id"></td>
                                        <td id="reception_date"></td>
                                        <td id="status"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div>




                <script>
                    function showRecords()
                    {
                        var url = 'http://localhost:8000/indexreceptions';
                        fetch(url).then(res=>res.json())
                            .then(data=>{
                                var t = document.getElementById('recordtableshow');
                                for ( var d of data ) {
                                    t.innerHTML += "<tr><td>"+ d['id'] + "</td><td>" + d['reception_date'] + "</td><td>"+d['status']+"</td></tr>";
                                }
                            })
                    }
                    window.onload=showRecords();
                </script>

            {{----------------------show records ------------------------------------------------------------}}



        </div>

@endsection