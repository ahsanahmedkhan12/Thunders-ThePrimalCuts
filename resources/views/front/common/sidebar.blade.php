<div class="leftside">
					<div class="leftsieicon"><i class="bi bi-person-circle"></i></div>
	                <div class="leftsietitlename">{{Str::title(Auth::user()->name)}}</div>
					<ul>
						<li class="{{'user/dashboard' == request()->path() ? 'active' : ''}}"><i class="bi bi-speedometer" style="color: #fff;margin-right: 10px;"></i><a href="{{url('/user/dashboard')}}">Dashboard</a></li>

                        <li class="{{'user/order-history' == request()->path() ? 'active' : ''}}"><i class="bi bi-bag-check-fill" style="color: #fff;margin-right: 10px;"></i><a href="{{url('/user/order-history')}}">Order History</a></li>

						<li class="{{'user/personal-detail' == request()->path() ? 'active' : ''}}"><i class="bi bi-person-badge" style="color: #fff;margin-right: 10px;"></i><a href="{{url('/user/personal-detail')}}">Personal Detail</a></li>

						<li class="{{'user/change-password' == request()->path() ? 'active' : ''}}"><i class="bi bi-file-lock2" style="color: #fff;margin-right: 10px;"></i><a href="{{url('/user/change-password')}}">Change Password</a></li>

						<li><i class="bi bi-box-arrow-right" style="color: #fff;margin-right: 10px;"></i> <a  onclick="event.preventDefault();
	                      document.getElementById('logout-form').submit();" style="color: #fff; cursor: pointer;" >Logout</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form></li>
					</ul>
			    </div>