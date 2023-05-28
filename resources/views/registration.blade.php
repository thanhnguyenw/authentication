@include('nav')

<h3>Welcome to login page</h3>
<form action="{{route('registration_submit')}}" method="post">
  @csrf
  <div>
    Name
  </div>
  <div>
    <input type="text" name="name">
  </div>
  <div>
    Email Address
  </div>
  <div>
    <input type="text" name="email">
  </div>
  <div>
    Password
  </div>
  <div>
    <input type="password" name="password">
  </div>
  <div>
    retype password
  </div>
  <div>
    <input type="password" name="retype_password">
  </div>

  <div>
    <input style="margin-top: 10px;" type="submit" value="Make Registration">
  </div>
</form>