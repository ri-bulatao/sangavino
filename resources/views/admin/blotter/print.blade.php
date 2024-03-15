<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <img class="img-fluid d-block mx-auto" src="{{ asset('img/logo/logo2.png') }}" width="200" alt="logo">
        <br>
        <h3 class="text-center">Blotter Record</h3> <br>
        <table class="table table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Complainant</th>
                    <th>Respondent</th>
                    <th>In-Charge</th>
                    <th>Location</th>
                    <th>Date of Incident</th>
                    <th>Status</th>
                    <th>Reported At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blotters as $blotter)
                    <tr>
                        <td>{{ $blotter->id }}</td>
                        <td>{{ $blotter->complainant }}</td>
                        <td>{{ $blotter->respondent ?? 'N/A' }}</td>
                        <td>{{ $blotter->official->name }}</td>
                        <td>{{ $blotter->location }}</td>
                        <td>{{ formatDate($blotter->date_of_incident, 'dateTime') }}</td>
                        <td>{{ $blotter->is_solved ? 'Solved' : 'Pending' }}</td>
                        <td>{{ formatDate($blotter->created_at) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            window.print();
        });
        onafterprint = function() {
            window.location.href = @json(route('admin.blotters.index'));
        }
    </script>
</body>

</html>
