@include('nav')

<h3>Forget Password</h3>
<form action="{{route('forget_password_submit')}}" method="post">
  @csrf
  <div>
    Email Address
  </div>
  <div>
    <input type="text" name="email">
  </div>
  
  <div>
    <input style="margin-top: 10px;" type="submit" value="Submit">
    <br>
    <a href="{{route('login')}}">Back to Login</a>
  </div>
</form>