<div class="product_card position" onclick="buyDialog(
  '{{ $package->id }}',
  '{{ $package->name }}',
  '{{ asset($package->photo) }}',
  '{{ price($package->price) }}',
  '{{ $package->validity }}',
  '{{ price($package->commission_with_avg_amount / $package->validity) }}',
  '{{ price($package->commission_with_avg_amount) }}',
  '{{ $package->max_share }}',
  '{{ $package->vip_level ?? 0 }}',
  '',
  'Days',
  'Daily Income'
)">
  <div class="product_content">
    <div class="product_title flex_left">
      <img class="product_image" src="{{ asset($package->photo) }}" style="width: 60px; height: 60px; margin-right: 10px;">
      <div style="width: 100%;">
        <div class="product_name">{{ $package->name }}</div>
        <div class="product_vip">
          <img src="/public/v2/img/common/vip_icon.png" style="width: 16px;height: 16px;">
          <span>VIP{{ $package->vip_level ?? 0 }}</span>
        </div>
      </div>
    </div>
    <div class="product_info">
      <div class="product_item flex_space"><p class="label">Duration</p><p class="value">{{ $package->validity }} Days</p></div>
      <div class="product_item flex_space"><p class="label">Daily</p><p class="value">{{ price($package->commission_with_avg_amount / $package->validity) }}</p></div>
      <div class="product_item flex_space"><p class="label">Total</p><p class="value">{{ price($package->commission_with_avg_amount) }}</p></div>
    </div>
    <div class="product_page_buy_btn flex_space">
      <p style="width: 48%;text-align: center;color: #4D70ED">{{ price($package->price) }}</p>
      <p style="width: 48%;text-align: center">Invest Now</p>
    </div>
  </div>
</div>
