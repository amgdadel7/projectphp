@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم الحفظ بنجاح
        </div>
        <div class="flex-center position-ref full-height">


            <div class="content" >

                <div class="title m-b-md">
                    {{__('messages.Add your offer')}}
                </div>
                @if(Session::has('success')
    )
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                <br>
                <form method="POST" id="offerForm" enctype="multipart/form-data" > {{-- enctype هي التي تسمح برفغ الملفات--}}
                    @csrf
                    {{--                    <input name="_token" value="{{csrf_token()}}">--}}

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer photo')}}</label>
                        <input type="file" class="form-control" name="photo">
                        @error('photo')
                        <div id="emailHelp" class="form-text text-danger" >{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name_ar')}}</label>
                        <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.Enter Offer Name_ar')}}">
                        @error('name_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name_en')}}</label>
                        <input type="text" class="form-control" name="name_en" placeholder="{{__('messages.Enter Offer Name_en')}}">
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Price')}}</label>
                        <input type="text" class="form-control" name="price" placeholder="{{__('messages.Enter Offer Price')}}">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details_ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" placeholder="{{__('messages.Enter Offer Details_ar')}}">
                        @error('details_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details_en')}}</label>
                        <input type="text" class="form-control" name="details_en" placeholder="{{__('messages.Enter Offer Details_en')}}">
                        @error('details_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>

            </div>
        </div>
    </div>
    @stop
@section('scripts')
{{--    <script>--}}

{{--        $(document).on('click', '#save_offer', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var formData = new FormData($('#offerForm')[0]);--}}
{{--            $.ajax({--}}
{{--                type: 'post',--}}
{{--                url: "{{route('ajax.offers.store')}}",--}}
{{--                data : {--}}
{{--                    '_token':"{{csrf_token()}}",--}}
{{--                    // 'photo':$("input[name='photo']").val(),--}}
{{--                    'name_ar':$("input[name='name_ar']").val(),--}}
{{--                    'name_en':$("input[name='name_en']").val(),--}}
{{--                    'price':$("input[name='price']").val(),--}}
{{--                    'details_ar':$("input[name='details_ar']").val(),--}}
{{--                    'details_en':$("input[name='details_en']").val(),--}}
{{--                },--}}
{{--                success: function (data){--}}
{{--                }, error: function (reject) {if (data.status == true) {--}}
{{--                    $('#success_msg').show();}--}}
{{--                var response = $.parseJSON(reject.responseText);--}}
{{--                $.each(response.errors, function (key, val) {--}}
{{--                    $("#" + key + "_error").text(val[0]);}--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}


{{--    </script>--}}
    <script>
        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();
            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                }, error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });
    </script>
    @stop
