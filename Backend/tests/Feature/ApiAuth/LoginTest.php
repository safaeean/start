<?php

namespace Tests\Feature\ApiAuth;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Cookie;

class LoginTest extends ApiAuthTestCase
{
    /** @test */
    public function cannotLoginWithWrongEmail()
    {
        $this->attemptLoginAndExpectFail([
            'email' => $this->invalidEmail,
        ], 'email');
    }

    /** @test */
    public function cannotLoginWithWrongPassword()
    {
        $this->attemptLoginAndExpectFail([
            'password' => $this->invalidPassword,
        ], 'email');
    }

    /** @test */
    public function emailFieldIsRequired()
    {
        $this->attemptLoginAndExpectFail([
            'email' => '',
        ], 'email');
    }

    /** @test */
    public function guestCanLoginWithCorrectCredentials()
    {
        $response = $this->attemptLogin([
            'email' => $this->validEmail,
            'password' => $this->validPassword,
        ]);
        $user = User::query()->where('email' , $this->validEmail)->first();

        $response->assertStatus(200);
        $this->assertTrue($response->user->email == $user->email);

        $token = $response['access_token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get(route('user'));

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            // سایر فیلدهای موردنیاز
        ]);


    }

    /** @test */
    public function guestCannotAttemptToLoginMoreThanFiveTimesInOneMinute()
    {
        $loginAttempts = Collection::times(6, function ($number) {

            if ($number !== 6) {
                return $this->attemptLogin([
                    'email' => $this->validEmail,
                    'password' => $this->invalidPassword,
                ]);
            }


            // 6th time, we pass in correct credentials, but we should
            // be throttled at this point
            return $this->attemptLoginAndExpectFail([
                'email' => $this->validEmail,
                'password' => $this->validPassword,
            ], 'email', 429);
        });
    }

    /** @test */
    public function guestCannotLoginWithoutRegistering()
    {
        $this->attemptLoginAndExpectFail([
            'email' => 'not-registered@example.com',
            'password' => 'password',
        ], 'email');
    }

    /** @test */
    public function passwordFieldIsRequired()
    {
        $this->attemptLoginAndExpectFail([
            'password' => '',
        ], 'password');
    }

    /** @test */
    public function sanctumRouteSetsXsrfTokenCookie()
    {
        $response = $this->fetchXsrfToken();

        $response->assertStatus(204);
        $response->assertCookie('XSRF-TOKEN', Session::get('_token'));
    }

    protected function attemptLogin($params = [])
    {
        $this->enableCsrfProtection();

        $user = User::whereEmail($this->validEmail)
            ->get()
            ->first();
        if (! $user) {
            $user = User::factory()->create([
                'email' => $this->validEmail,
                'password' => Hash::make($this->validPassword),
            ]);
        }

        // set the xsrf token header, just like axios does automatically
        $this->withHeader('X-XSRF-TOKEN', $this->getXsrfTokenFromResponse($this->fetchXsrfToken()));

        $response = $this->postJson($this->loginRoute, array_merge([
            'email' => $this->validEmail,
            'password' => $this->validPassword,
        ], $params));


        // add the user to the response so we can make additional assertions
        $response->user = $user;

        return $response;
    }

    protected function attemptLoginAndExpectFail(array $params, string $fieldWithError, int $status = 422)
    {


        $response = $this->attemptLogin($params);

        $response->assertStatus($status);

        $this->assertGuest();

        return $response;
    }

    protected function fetchXsrfToken()
    {
        return $this->getJson(rtrim(config('sanctum.prefix', 'sanctum'), '/').'/csrf-cookie');
    }

    protected function getXsrfTokenFromResponse(TestResponse $response): string {
        $cookie = collect($response->headers->getCookies())->first(function (Cookie $cookie) {
            return $cookie->getName() === 'XSRF-TOKEN';
        });

        return $cookie ? $cookie->getValue() : '';
    }
}
