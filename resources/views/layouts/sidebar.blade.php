		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ url('/') }}">
					<span class="align-middle">Shopify</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item {{ Request::routeIs('dashboard') ? 'active' : '' }}"> {{-- Example for dashboard --}}
						<a class="sidebar-link" href="/dashboard">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>


					<li class="sidebar-item {{ Request::routeIs('products.*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('products.index') }}">
							<i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Products</span>
						</a>
					</li>

					<li class="sidebar-item {{ Request::routeIs('categories.*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('categories.index') }}">
							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Categories</span>
						</a>
					</li>

					<li class="sidebar-item {{ Request::routeIs('users.*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('users.index') }}">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
						</a>
					</li>


					<li class="sidebar-item {{ request()->is('profile') ? 'active':''}}">
						<a class="sidebar-link" href="{{ url('/profile') }}">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
						</a>
					</li>

					<li class="sidebar-item {{ request()->is('settings') ? 'active':''}}">
						<a class="sidebar-link" href="{{ url('/settings') }}">
							<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
						</a>
					</li>






					<div class="sidebar-cta">
						<div class="sidebar-cta-content">
							<strong class="d-inline-block mb-2">Upgrade to Pro</strong>
							<div class="mb-3 text-sm">
								Are you looking for more components? Check out our premium version.
							</div>
							<div class="d-grid">
								<a href="https://adminkit.io/pricing" target="_blank" class="btn btn-primary">Upgrade to Pro</a>
							</div>
						</div>
					</div>
			</div>
		</nav>