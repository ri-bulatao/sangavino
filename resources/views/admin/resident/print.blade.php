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
    <div class="container-fluid mt-5">
        <img class="img-fluid d-block mx-auto" src="{{ asset('img/logo/logo2.png') }}" width="200" alt="logo">
        <br>
        <h3 class="text-center">Resident Record</h3> <br>
        <table class="table table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Birth Date</th>
                    <th>Civil Status</th>
                    <th>Citizenship</th>
                    <th>Purok</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Is Voter</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($residents as $resident)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $resident->full_name }}</td>
                        <td>{{ $resident->gender }}</td>
                        <td>{{ getAge($resident->birth_date) }}</td>
                        <td>{{ formatDate($resident->birth_date) }}</td>
                        <td>{{ $resident->civil_status }}</td>
                        <td>{{ $resident->citizenship }}</td>
                        <td>{{ $resident->purok->name }}</td>
                        <td>{{ $resident->contact }}</td>
                        <td>{{ $resident->user?->email ?? 'N/A' }}</td>
                        <td>{{ $resident->is_voter ? 'Yes' : 'No' }}</td>
                        <td>{{ formatDate($resident->created_at) }}</td>
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
            window.location.href = @json(route('admin.residents.index'));
        }
    </script>
</body>

</html>
