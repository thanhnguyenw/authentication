
<h3>Welcome to login page</h3>
<form action="{{route('admin_login_submit')}}" method="post">
  @csrf
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
    <input style="margin-top: 10px;" type="submit" value="Login">
  
  </div>
</form>