<!DOCTYPE html>
<html>

<head>
    <title>Bank Account Summary</title>
    <style>
        * {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif';
font-size: 10pt;
        }

        h1 {
            font-size: 22pt;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <p style="text-align: center; margin-bottom: 18pt">
        <img src="{{ public_path('images/security-bank.png') }}" style="width: 200px;" alt=""> <br><br>
        {{-- <strong style="font-size: 16pt">Security Banking, Inc.</strong> <br> --}}
        WXX7+XJH, Metrobank <br>
        Tagbilaran North Road <br>
        Tubigon City, 6329 Bohol <br>
        Tel. No.:(038) 508 8638
    </p>

    <h1 style="text-align: center">Security Bank Account Summary</h1>
    <p>
        <strong>Name:</strong> {{ $client->first_name }} {{ $client->middle_name }} {{ $client->last_name }} <br>
        <strong>Address:</strong> {{ $client->address }} <br>
        <strong>Phone:</strong> {{ $client->phone_number }} <br>
    </p>

    <hr>

    <table style="width: 100%">
        <thead style="background-color: #000000; color: white;">
            <tr>
                <th>Date</th>
                <th>Deposit</th>
                <th>Withdrawal</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3">Beginning Balance</td>
                <td style="text-align: center">{{ number_format($client->initial_deposit, 2) }}</td>
            </tr>
            <?php $bal = $client->initial_deposit; ?>
            @foreach ($client->transactions as $transac)
                <tr>
                    <td>{{ $transac->date }}</td>
                    <td style="text-align: center">{{ $transac->deposit ? number_format($transac->amount, 2) : '' }}
                    </td>
                    <td style="text-align: center">{{ !$transac->deposit ? number_format($transac->amount, 2) : '' }}
                    </td>
                    <td style="text-align: center">
                        {{ number_format($bal += $transac->deposit ? $transac->amount : 0 - $transac->amount, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
