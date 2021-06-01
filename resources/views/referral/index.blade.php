<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Referral') }}
        </h2>
    </x-slot>
   
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose ">
            @include('layouts.alert')
            <div class="error-alert"></div>
                <label for="email">Enter Recepient</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon">Email</span>
                        </div>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="basic-addon">
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="button" id="add-email">Add</button>
                        </div>
                    </div>  

                @include('referral.list')
            </div>
        </div>
    </div>

    @push('scripts')
<script>

    $("#add-email").click(function(){
        
        $('.error-alert').html("");
        var email = $('#email').val();
        var email_list = getEmailList();
        

        $.ajax({
            type: 'GET',
            url: '/api/check_email',
            data: { 
                'email' : email,
                'email_list' : email_list,
            },
            success: function(data){
                $(".email-list").append(data);
                $('[name=emails]').val(getEmailList());
            },
            error: function(xhr, status, error){
                var err = JSON.parse(xhr.responseText);
                $(".error-alert").html("<p style='color:red'>"+err+"</p>");
            }

        });
    });


    function getEmailList(){
        var array = [];
        $("#email-table > tbody .email-text").each(function () {
            array.push($(this).text());
        });
        
        return array;
    }

</script>
@endpush

</x-app-layout>

