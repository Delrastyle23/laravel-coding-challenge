<table class="table table-striped" id="email-table">
    <thead>
        <tr>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody class="email-list">
  
    </tbody>
   
</table>
<form action="{{url('/referral')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="emails">
    <button class="btn btn-outline-primary" type="submit">Send</button>
</form>
