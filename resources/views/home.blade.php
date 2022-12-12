@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
                </div>
                <div class="d-flex align-items-center flex-wrap text-nowrap">
                <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
                <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
                <input type="text" class="form-control">
                </div>
            </div>
					
        </div>
        <div class="profile-page tx-13">
          <div class="row">
			<div class="col-12 grid-margin">
				<div class="profile-header">
					<div class="cover">
						<div class="gray-shade"></div>
						<figure>
							<img class="profile-pi" src="https://i.ibb.co/Hzrt2GX/abstract-blue-grunge-texture-background-free-vector.jpg" />
						</figure>
						<div class="cover-body d-flex justify-content-between align-items-center">
							<div>
								@if (Auth::user()->profile_photo == null)
									<img class="profile-pic" style="width: 90px;height:90px;" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" />
								@else
									<img class="profile-pic" style="width: 90px;height:90px;" src="{{asset('uploads/profile')}}/{{Auth::user()->profile_photo}}" alt="profile">
								@endif
								<span class="profile-name">{{Auth::user()->name}}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row profile-body">
			<!-- left wrapper start -->
			<div class="d-none d-md-block col-md-4 col-xl-8 m-auto left-wrapper">
				<div class="card rounded">
					<div class="card-body">
						<h3>Hi! I'm {{Auth::user()->name}}.</h3>
						<div class="mt-3">
							<label class="tx-11 font-weight-bold mb-0 text-uppercase">Joined:</label>
							<p class="text-muted">{{Auth::user()->created_at->format('d M Y')}}</p>
						</div>
						<div class="mt-3">
							<label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
							<p class="text-muted">{{Auth::user()->email}}</p>
						</div>
					</div>
				</div>
			</div>
			<!-- left wrapper end -->
		</div>
        </div>
     </div>
</div>
@endsection
