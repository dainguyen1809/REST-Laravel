<table border="1" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Postal Code</th>
        </tr>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->city }}</td>
                <td>{{ $customer->state }}</td>
                <td>{{ $customer->postal_code }}</td>
            </tr>
        @endforeach
    </tbody>
    </thead>
</table>
{{ $customers->links() }}


