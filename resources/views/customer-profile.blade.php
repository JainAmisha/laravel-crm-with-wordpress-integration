<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <br>
                <div class="bg-white border-b border-gray-200">
                    <table style="width:100%; text-align:left;">
                        <tbody>
                            <tr>
                                <th class="p-2 px-6" style="width:30%">Customer Name</th>
                                <td style="width:80%">{{ $customer->name }}</td>
                            </tr>
                            <tr>
                                <th class="p-2 px-6" style="width:30%">Phone Number</th>
                                <td style="width:80%">{{ $customer->phone_number }}</td>
                            </tr>
                            <tr>
                                <th class="p-2 px-6" style="width:30%">Email</th>
                                <td style="width:80%">{{ $customer->email }}</td>
                            </tr>
                            <tr>
                                <th class="p-2 px-6" style="width:30%">Desired Budget</th>
                                <td style="width:80%">{{ $customer->desired_budget }}</td>
                            </tr>
                            <tr>
                                <th class="p-2 px-6" style="width:30%">Message</th>
                                <td style="width:80%">{{ $customer->message }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
