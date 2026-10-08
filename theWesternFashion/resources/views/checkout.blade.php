<div class="grid sm:grid-cols-2 gap-4">
  <div>
    <input class="field" name="customer_name" placeholder="Full name" value="{{ old('customer_name', $user->name) }}" required>
    @error('customer_name')<p class="text-brick text-[12px] mt-1">{{ $message }}</p>@enderror
  </div>
  <div>
    <input class="field" type="tel" name="customer_phone" placeholder="Phone" value="{{ old('customer_phone') }}" required>
    @error('customer_phone')<p class="text-brick text-[12px] mt-1">{{ $message }}</p>@enderror
  </div>
</div>

<div>
  <input class="field" type="email" name="customer_email" placeholder="Email" value="{{ old('customer_email', $user->email) }}" required>
  @error('customer_email')<p class="text-brick text-[12px] mt-1">{{ $message }}</p>@enderror
</div>

<div>
  <input class="field" name="shipping_address" placeholder="Address (street, apartment, suite)" value="{{ old('shipping_address') }}" required>
  @error('shipping_address')<p class="text-brick text-[12px] mt-1">{{ $message }}</p>@enderror
</div>

<div class="grid sm:grid-cols-3 gap-4">
  <div>
    <input class="field" name="shipping_city" placeholder="City" value="{{ old('shipping_city') }}" required>
    @error('shipping_city')<p class="text-brick text-[12px] mt-1">{{ $message }}</p>@enderror
  </div>
  <input class="field" name="shipping_state" placeholder="State / Province" value="{{ old('shipping_state') }}">
  <div>
    <input class="field" name="shipping_postal" placeholder="Postal code" value="{{ old('shipping_postal') }}" required>
    @error('shipping_postal')<p class="text-brick text-[12px] mt-1">{{ $message }}</p>@enderror
  </div>
</div>

<div>
  <select class="field" name="shipping_country" required>
    <option value="">Country</option>
    @foreach($countries as $code => $label)
      <option value="{{ $code }}" @selected(old('shipping_country') === $code)>{{ $label }}</option>
    @endforeach
  </select>
  @error('shipping_country')<p class="text-brick text-[12px] mt-1">{{ $message }}</p>@enderror
</div>