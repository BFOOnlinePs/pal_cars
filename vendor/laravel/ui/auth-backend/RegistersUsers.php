<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cities;
use App\Models\SystemSettingsModel;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $data = Cities::get();
        $terms_of_use = SystemSettingsModel::first()->terms_of_use;

        // Split the text into an array using <br> as the delimiter
        $termsArray = explode('<br>', $terms_of_use);

        // Remove empty elements from the array
        $termsArray = array_filter($termsArray);

        // $terms_of_use = explode(PHP_EOL, $terms_of_use);
        // $terms_of_use = explode('،', $terms_of_use);

        // return view('auth.register',['data'=>$data,'terms'=>$terms_of_use]);
        return view('auth.register',['data'=>$data,'terms'=>$termsArray]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
