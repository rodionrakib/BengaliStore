 <aside class="sidebar col-lg-3">
    <div class="widget widget-dashboard">
        <h3 class="widget-title">My Account</h3>

        <ul class="list">
            <li ><a href="{{route('accounts.profile')}}">Account Profile</a></li>
            <li><a class="active" href="{{route('accounts.address')}}">Address Book</a></li>
            <li><a  href="{{route('accounts.order')}}">My Orders</a></li>
            <li><a href="{{route('wishlist.index')}}">My Wishlist</a></li>

        </ul>
    </div><!-- End .widget -->
</aside><!-- End .col-lg-3 -->