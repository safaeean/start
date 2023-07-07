<?php
namespace Tests\Feature\ApiAuth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiAuthTestCase extends TestCase
{
    use RefreshDatabase;

    protected $invalidEmail = 'invalid@example.com';

    protected $invalidPassword = 'invalid';

    protected $getUserRoute;

    protected $loginRoute;

    protected $logoutRoute;

    protected $passwordEmailRoute;

    protected $passwordResetRoute;

    protected $registerRoute;

    /**
     * Don't use route() like the other ones routes defined here.
     * The test will call:
     * route($this->verificationRouteName, ['id' => $id, 'hash' => $hash])
     */
    protected $verificationRouteName = 'verification.verify';

    protected $resendVerificationEmailRoute;

    protected $validEmail = 'john@example.com';

    protected $validPassword = 'password';

    protected function enableCsrfProtection()
    {
        // csrf is disabled when running tests, but we want to turn it on
        // so our token actually gets verified
        // just needs to be something other than 'testing'
        $this->app['env'] = 'development';
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->loginRoute = route('login');
        $this->logoutRoute = route('logout');
        $this->getUserRoute = route('user');
        $this->passwordEmailRoute = route('password.email');
        $this->passwordResetRoute = route('password.update');
        $this->registerRoute = route('register');
        $this->resendVerificationEmailRoute = route('verification.resend');
    }

    protected function createUser()
    {
        return User::factory()->create([
            'email' => $this->validEmail,
            'password' => Hash::make($this->validPassword),
        ]);
    }
}
