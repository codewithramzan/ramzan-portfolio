<?php

class AuthController extends Controller
{
    private User $userModel;
    private LoginAttempt $loginAttemptModel;
    public function __construct()
    {
        $this->userModel = new User();

        $this->loginAttemptModel = new LoginAttempt();
    }
    public function adminLogin(): void
    {
        if (Auth::check()) {

            if (Auth::isAdmin()) {
                Response::redirect('/admin/dashboard');
            }

            Response::redirect('/client/dashboard');
        }

        $this->view(
            'auth/admin-login',
            [
                'title' => 'Admin Login'
            ]
        );
    }

    public function clientLogin(): void
    {
        if (Auth::check()) {

            if (Auth::isAdmin()) {
                Response::redirect('/admin/dashboard');
            }

            Response::redirect('/client/dashboard');
        }

        $this->view(
            'auth/client-login',
            [
                'title' => 'Client Login'
            ]
        );
    }

    public function register(): void
    {
        if (Auth::check()) {
            Response::redirect('/client/dashboard');
        }

        $this->view(
            'auth/register',
            [
                'title' => 'Client Registration'
            ]
        );
    }

    public function authenticateAdmin(): void
    {
        $this->authenticate('admin');
    }

    public function authenticateClient(): void
    {
        $this->authenticate('client');
    }

    private function authenticate(string $requiredRole): void
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        if (!Csrf::verify(
            Request::input('_csrf')
        )) {

            Session::flash(
                'error',
                'Invalid security token.'
            );

            Response::redirect(
                $requiredRole === 'admin'
                    ? '/admin/login'
                    : '/client/login'
            );
        }
        $email = strtolower(
            trim(
                (string) Request::input('email')
            )
        );

        $password = (string) Request::input(
            'password'
        );

        if ($email === '' || $password === '') {

            Session::flash(
                'error',
                'Email and password are required.'
            );

            Response::redirect(
                $requiredRole === 'admin'
                    ? '/admin/login'
                    : '/client/login'
            );
        }

        if (!filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )) {

            Session::flash(
                'error',
                'Please enter a valid email address.'
            );

            Response::redirect(
                $requiredRole === 'admin'
                    ? '/admin/login'
                    : '/client/login'
            );
        }
                /*
        |--------------------------------------------------------------------------
        | Login Attempt Protection
        |--------------------------------------------------------------------------
        */

        if (
            $this->loginAttemptModel->isBlocked(
                $email,
                $ipAddress,
                $requiredRole
            )
        ) {

            Session::flash(
                'error',
                'Too many failed login attempts. Please try again later.'
            );

            Response::redirect(
                $requiredRole === 'admin'
                    ? '/admin/login'
                    : '/client/login'
            );
        }

            $user = $this->userModel
                ->findByEmail($email);

        if (
            !$user ||
            !password_verify(
                $password,
                $user['password']
            )
        ) {

            $this->loginAttemptModel->record(
                $email,
                $ipAddress,
                $requiredRole
            );

            Session::flash(
                'error',
                'Invalid email or password.'
            );

            Response::redirect(
                $requiredRole === 'admin'
                    ? '/admin/login'
                    : '/client/login'
            );
        }
        if ($user['status'] !== 'active') {

            Session::flash(
                'error',
                'Your account is not active.'
            );

            Response::redirect(
                $requiredRole === 'admin'
                    ? '/admin/login'
                    : '/client/login'
            );
        }
        if ($user['role_name'] !== $requiredRole) {

            $this->loginAttemptModel->record(
                $email,
                $ipAddress,
                $requiredRole
            );

            Session::flash(
                'error',
                'You are not authorized to use this login.'
            );

            Response::redirect(
                $requiredRole === 'admin'
                    ? '/admin/login'
                    : '/client/login'
            );
        }

        Auth::login($user);

        $this->loginAttemptModel->clear(
            $email,
            $ipAddress,
            $requiredRole
        );

        $this->userModel->updateLastLogin(
            (int) $user['id']
        );
        if ($requiredRole === 'admin') {
            Response::redirect('/admin/dashboard');
        }

        Response::redirect('/client/dashboard');
    }

    public function storeRegistration(): void
    {
        if (!Csrf::verify(
            Request::input('_csrf')
        )) {

            Session::flash(
                'error',
                'Invalid security token.'
            );

            Response::redirect('/client/register');
        }

        $name = trim(
            (string) Request::input('name')
        );

        $email = trim(
            (string) Request::input('email')
        );

        $phone = trim(
            (string) Request::input('phone')
        );

        $password = (string) Request::input(
            'password'
        );

        $confirmPassword = (string) Request::input(
            'password_confirmation'
        );

        if (
            $name === '' ||
            $email === '' ||
            $password === ''
        ) {

            Session::flash(
                'error',
                'Name, email and password are required.'
            );

            Response::redirect('/client/register');
        }

        if (!filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )) {

            Session::flash(
                'error',
                'Please enter a valid email address.'
            );

            Response::redirect('/client/register');
        }

        if (
            strlen($password) < 8
        ) {

            Session::flash(
                'error',
                'Password must contain at least 8 characters.'
            );

            Response::redirect('/client/register');
        }

        if ($password !== $confirmPassword) {

            Session::flash(
                'error',
                'Passwords do not match.'
            );

            Response::redirect('/client/register');
        }

        if ($this->userModel->emailExists($email)) {

            Session::flash(
                'error',
                'An account with this email already exists.'
            );

            Response::redirect('/client/register');
        }

        $userId = $this->userModel->createClient(
            $name,
            $email,
            $phone,
            $password
        );

        $user = $this->userModel->findById(
            $userId
        );

        Auth::login($user);

        Response::redirect('/client/dashboard');
    }

    public function logout(): void
    {
        Auth::logout();

        Response::redirect('/');
    }
}