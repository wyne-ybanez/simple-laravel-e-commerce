<?php

namespace App\Http\Controllers;

use App\Enums\AddressType;
use App\Http\Requests\ProfileRequest;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function view(Request $request)
    {
        /** @var \App\Models\User  */
        $user = $request->user();

        /** @var \App\Models\Customer $customer */
        $customer = $user->customer;

        $shippingAddress = $customer->shippingAddress ?: new CustomerAddress(['type' => AddressType::Shipping]);
        $billingAddress = $customer->billingAddress ?: new CustomerAddress(['type' => AddressType::Billing]);
        // dd($customer, $shippingAddress->attributesToArray(), $billingAddress, $billingAddress->customer);

        $countries = Country::query()->orderBy('name')->get();

        return view('profile.view', compact('customer', 'user', 'shippingAddress', 'billingAddress', 'countries'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileRequest $request)
    {
        $customerData = $request->validated();

        // accesses data in 'ProfileRequest.php'
        $shippingData = $customerData['shipping'];
        $billingData = $customerData['billing'];

        /** @var \App\Models\User  */
        $user = $request->user();

        /** @var \App\Models\Customer $customer */
        $customer = $user->customer;

        $shippingAddress = $customer->shippingAddress ?: new CustomerAddress(['type' => AddressType::Shipping]);
        $billingAddress = $customer->billingAddress ?: new CustomerAddress(['type' => AddressType::Billing]);

        // updates are from request
        $customer->update($customerData);
        $shippingAddress->update($shippingData);
        $billingAddress->update($billingData);

        $request->session()->flash('flash_message', 'Profile was successfully updated');

        return redirect()->route('profile');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
