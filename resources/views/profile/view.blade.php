<x-app-layout>
    <div x-data="{
        flashMessage: '{{ \Illuminate\Support\Facades\Session::get('flash_message') }}',
        init() {
            if (this.flashMessage) {
                setTimeout(() => this.$dispatch('notify', {message: this.flashMessage}), 200)
            }
        }
    }" class="container mx-auto lg:w-2/3 p-5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            <div class="bg-white p-3 shadow rounded-lg md:col-span-2">
                <form x-data="{
                    countries: {{ json_encode($countries) }},
                    billingAddress: {{ json_encode([
                        'address1' => old('billing.address1', $billingAddress->address1),
                        'address2' => old('billing.address2', $billingAddress->address2),
                        'city' => old('billing.city', $billingAddress->city),
                        'county' => old('billing.county', $billingAddress->county),
                        'country_code' => old('billing.country_code', $billingAddress->country_code),
                        'zipcode' => old('billing.zipcode', $billingAddress->zipcode),
                    ]) }},
                    shippingAddress: {{ json_encode([
                        'address1' => old('shipping.address1', $shippingAddress->address1),
                        'address2' => old('shipping.address2', $shippingAddress->address2),
                        'city' => old('shipping.city', $shippingAddress->city),
                        'county' => old('shipping.county', $shippingAddress->county),
                        'country_code' => old('shipping.country_code', $shippingAddress->country_code),
                        'zipcode' => old('shipping.zipcode', $shippingAddress->zipcode),
                    ]) }},
                    get billingCountryCounties() {
                        const country = this.countries.find(c => c.code === this.billingAddress.country_code)

                        if (country && country.counties) {
                            return JSON.parse(country.counties);
                        }
                        return null;
                    },
                    get shippingCountryCounties() {
                        const country = this.countries.find(c => c.code === this.shippingAddress.country_code)

                        if (country && country.counties) {
                            return JSON.parse(country.counties);
                        }
                        return null;
                    }
                }" action="{{ route('profile.update') }}" method="post">
                    @csrf

                    <!-- Profile Details -->
                    <h2 class="text-3xl font-semibold mb-2">Profile Details</h2>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <x-input type="text" name="first_name" value="{{old('first_name', $customer->first_name)}}" placeholder="First Name" />
                        <x-input type="text" name="last_name" value="{{old('last_name', $customer->last_name)}}" placeholder="Last Name" />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="email" value="{{old('email', $user->email)}}" placeholder="Email" />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="phone" value="{{old('phone', $customer->phone)}}" placeholder="Phone Number" />
                    </div>

                    <!-- Billing Address -->
                    <h2 class="text-3xl mt-10 font-semibold mb-2">Billing Address</h2>
                    <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-3 mb-3">
                        <x-input type="text" name="billing[address1]" x-model="billingAddress.address1" placeholder="Address 1" />
                        <x-input type="text" name="billing[address2]" x-model="billingAddress.address2" placeholder="Address 2" />
                    </div>
                    <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-3 mb-3">
                        <x-input type="text" name="billing[city]" x-model="billingAddress.city" placeholder="City" />
                        <x-input type="text" name="billing[zipcode]" x-model="billingAddress.zipcode" placeholder="Zipcode" />
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input 
                                type="select" 
                                name="billing[country_code]" 
                                x-model="billingAddress.country_code">
                                <option value="">Select Country</option>
                                <template x-for="country of countries" :key="country.code">
                                    <option 
                                        :selected="country.code === billingAddress.country_code" :value="country.code" 
                                        x-text="country.name">
                                    </option>
                                </template>
                            </x-input>
                        </div>
                        <div>
                            <template x-if="billingCountryCounties">
                                <x-input 
                                    type="select" 
                                    name="billing[county]" 
                                    x-model="billingAddress.county">
                                    <option value="">Select County</option>
                                    <!-- Iterate over every entry in counties array using key & value -->
                                    <template x-for="[code, county] of Object.entries(billingCountryCounties)" :key="code">
                                        <option :selected="code === billingAddress.county" :value="code" x-text="county">
                                        </option>
                                    </template>
                                </x-input>
                            </template>
                            <template x-if="!billingCountryCounties">
                                <x-input 
                                    type="text" 
                                    name="shipping[county]" 
                                    x-model="shippingAddress.county" 
                                    placeholder="County" 
                                />
                            </template>
                        </div>
                    </div>

                    <!-- Checkbox -->
                    <div class="flex justify-between mt-10 mb-2">
                        <h2 class="text-3xl font-semibold">Shipping Address</h2>
                        <label for="sameAsBillingAddress" class="text-gray-700 mt-5">
                            <input @change="$event.target.checked ? shippingAddress = {...billingAddress} : ''" id="sameAsBillingAddress" type="checkbox" class="text-stone-600 focus:ring-stone-600 mr-2 rounded-sm"> Billing Address
                        </label>
                    </div>

                    <!-- Shipping Address -->
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input type="text" name="shipping[address1]" x-model="shippingAddress.address1" placeholder="Address 1" class="w-full focus:border-stone-600 focus:ring-stone-600 border-gray-300 rounded" />
                        </div>
                        <div>
                            <x-input type="text" name="shipping[address2]" x-model="shippingAddress.address2" placeholder="Address 2" class="w-full focus:border-stone-600 focus:ring-stone-600 border-gray-300 rounded" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input type="text" name="shipping[city]" x-model="shippingAddress.city" placeholder="City" class="w-full focus:border-stone-600 focus:ring-stone-600 border-gray-300 rounded" />
                        </div>
                        <div>
                            <x-input name="shipping[zipcode]" x-model="shippingAddress.zipcode" type="text" placeholder="ZipCode" class="w-full focus:border-stone-600 focus:ring-stone-600 border-gray-300 rounded" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input type="select" name="shipping[country_code]" x-model="shippingAddress.country_code" class="w-full focus:border-stone-600 focus:ring-stone-600 border-gray-300 rounded">
                                <option value="">Select Country</option>
                                <template x-for="country of countries" :key="country.code">
                                    <option :selected="country.code === shippingAddress.country_code" :value="country.code" x-text="country.name"></option>
                                </template>
                            </x-input>
                        </div>
                        <div>
                            <template x-if="shippingCountryCounties">
                                <x-input type="select" name="shipping[county]" x-model="shippingAddress.county" class="w-full focus:border-stone-600 focus:ring-stone-600 border-gray-300 rounded">
                                    <option value="">Select County</option>
                                    <template x-for="[code, county] of Object.entries(shippingCountryCounties)" :key="code">
                                        <option :selected="code === shippingAddress.county" :value="code" x-text="county"></option>
                                    </template>
                                </x-input>
                            </template>
                            <template x-if="!shippingCountryCounties">
                                <x-input type="text" name="shipping[county]" x-model="shippingAddress.county" placeholder="County" class="w-full focus:border-stone-600 focus:ring-stone-600 border-gray-300 rounded" />
                            </template>
                        </div>
                    </div>

                    <x-primary-button class="w-full text-lg mt-5">Update</x-primary-button>
                </form>
            </div>
            <div class="bg-white p-3 shadow rounded-lg">
                <form action="#" method="post">
                    @csrf
                    <h2 class="text-3xl font-semibold mb-2">Update Password</h2>
                    <div class="mb-3">
                        <x-input type="password" name="old_password" placeholder="Your Current Password" />
                    </div>
                    <div class="mb-3">
                        <x-input type="password" name="new_password" placeholder="New Password" />
                    </div>
                    <div class="mb-3">
                        <x-input type="password" name="new_password_confirmation" placeholder="Repeat New Password" />
                    </div>
                    <x-primary-button class="text-lg mt-5">Update</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>