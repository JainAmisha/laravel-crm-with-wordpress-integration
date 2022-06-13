<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer List') }}
            <a href="{{ route('customer.export') }}" style="display: inline-block;
                text-decoration: none;
                cursor: pointer;
                padding: 0.375rem 0.75rem;
                border-radius: 0.25rem;
                color: #fff;
                background-color: #0d6efd;
                font-size:12px; vertical-align: bottom;
                border-color: #0d6efd;">Export All Customers</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="display-messages">
            </div>
            <br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <table class="" style="width:100%; text-align:left; overflow:auto;">
                        <thead style="background-color: #0d6efd;">
                            <tr>
                                <th class="px-6 py-2 font-medium" style="color:white;">S.No.</th>
                                <th class="px-6 py-2 font-medium" style="color:white;">Name</th>
                                <th class="px-6 py-2 font-medium" style="color:white;">Phone Number</th>
                                <th class="px-6 py-2 font-medium" style="color:white;">Email</th>
                                <th class="px-6 py-2 font-medium" style="color:white;">Desired Budget</th>
                                <th class="px-6 py-2 font-medium" style="color:white;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($customers))
                                @php $sno = $customers->firstItem(); @endphp
                                @foreach ($customers as $customer)
                                    <tr class="border-b border-gray-200">
                                        <td class="px-6 py-2">{{ $sno++ }}</td>
                                        <td class="px-6 py-2">
                                            <a href="{{ route('customer.profile.show', $customer->id) }}" target="_blank" style="text-decoration: underline;">
                                                {{ $customer->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-2">{{ $customer->phone_number }}</td>
                                        <td class="px-6 py-2">{{ $customer->email }}</td>
                                        <td class="px-6 py-2">{{ $customer->desired_budget }}</td>
                                        <td class="px-6 py-2 create-wordpress-account-parent">
                                            @if($customer->wordpress_profile_status == 1)
                                                WP User Created
                                            @else
                                                <a href="#" style="display: inline-block;
                                                    text-decoration: none;
                                                    cursor: pointer;
                                                    padding: 0.375rem 0.75rem;
                                                    border-radius: 0.25rem;
                                                    color: #fff;
                                                    background-color: #0d6efd;
                                                    font-size:12px;
                                                    border-color: #0d6efd;" data-id="{{ $customer->id }}" class="create-wordpress-account-btn">Create WordPress Account</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="p-2">
                {{ $customers->links() }}
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function()
        {
            function hideAlert()
            {
                setTimeout(function() {jQuery('.display-messages').hide()}, 5000);
            }

            jQuery('.display-messages').hide();
            jQuery('.display-messages').addClass('p-2 border border-gray-200 sm:rounded-lg');
            
            jQuery('.create-wordpress-account-btn').on('click', function(e)
            {
                e.preventDefault();
                id = jQuery(this).data('id');
                btnParent = jQuery(this).parent('.create-wordpress-account-parent');
                url = "{{ route('customer.create.wpuser') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {"id":id, "_token": "{{ csrf_token() }}"},
                    dataType: "json",
                    success: function(resultData) 
                    {
                        wpresponse = JSON.parse(resultData.response);
                        if(wpresponse.id){
                            btnParent.text('WP User Created');
                            jQuery('.display-messages').text('User Created Successfully').css({"background": "#d1e7dd", "color": "#0f5132"}).show();
                        }
                        else if(wpresponse.code && wpresponse.message){
                            jQuery('.display-messages').text(wpresponse.message).css({"background": "#f8d7da", "color": "#842029"}).show();
                        }
                        else{
                            jQuery('.display-messages').text('Some error occurred').css({"background": "#f8d7da", "color": "#842029"}).show();
                        }
                    },
                    error: function(){
                        jQuery('.display-messages').text('Some error occurred').css({"background": "#f8d7da", "color": "#842029"}).show();
                    }
                });

                hideAlert();
            });
        });
    </script>
</x-app-layout>
