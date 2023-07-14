<html>

<head>
    <title>Client Summary</title>
</head>
<style>
    * {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 13pt;
    }

    h1 {
        font-size: 22pt;
    }

    table {
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 2px;
        border: 1px solid #333;
    }
</style>

<body>
    <p style="text-align: center; margin-bottom: 18pt">
        <img src="{{ public_path('images/security-bank.png') }}" style="width: 200px;" alt=""> <br><br>
        {{-- <strong style="font-size: 16pt">Security Banking, Inc.</strong> <br> --}}
        27 Pacifico Castillo Street<br>
        Tagbilaran City, Bohol <br>
        Tel. No.:(038) 508 8638
    </p>

    <h1 style="padding-bottom: 10pt; border-bottom: 1px solid #333">Client Summary</h1>

    <table>
        <tr>
            <th>Name</th>
            <td>{{ $client->last_name }}, {{ $client->first_name }} {{ $client->middle_name }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $client->address }}</td>
        </tr>

        <tr>
            <th>Phone</th>
            <td>{{ $client->phone_number }}</td>
        </tr>

    </table>

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

            <td colspan="3">Beginning Balance</td>
            <td style="text-align:right">
                {{ number_format($client->initial_deposit, 2) }}
                <?php $bal = $client->initial_deposit; ?>
                @foreach ($client->transactions as $txn)
                    <tr>
                        <td>
                            {{ $txn->date }}
                        </td>
                        <td style="text-align: right">
                            {{ $txn->deposit ? number_format($txn->amount, 2) : '' }}
                        </td>
                        <td style="text-align: right">
                            {{ !$txn->deposit ? number_format($txn->amount, 2) : '' }}
                        </td>
                        <td style="text-align: right">
                            {{ $bal += $txn->deposit ? $txn->amount : 0 - $txn->amount }}
                        </td>
                    </tr>
                @endforeach
            </td>
        </tbody>
    </table>
</body>

</html>
