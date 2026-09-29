<a onclick="window.location.href='{{ route('vip.details', $package->id) }}'" class="product_card position">
  <div class="top_title">
    <div class="vip_title">{{ $package->name }}</div>
    <div class="vip_subtitle">{{ ucfirst($package->category) }} Package</div>
  </div>
  <div class="product_main">
    <div class="income">
      <p class="num">₦{{ number_format($package->daily_income, 2) }}</p>
      <p class="text">Daily Income</p>
    </div>
    <div class="duration">
      <p class="num">{{ $package->duration }} days</p>
      <p class="text">Duration</p>
    </div>
    <div class="price">
      <p class="num">₦{{ number_format($package->price, 2) }}</p>
      <p class="text">Price</p>
    </div>
  </div>
</a>
