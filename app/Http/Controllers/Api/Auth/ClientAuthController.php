<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    /**
     * POST /api/client/register
     *
     * Register a new client account.
     * Returns a Sanctum API token immediately.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|unique:clients,phone',
            'password' => 'required|string|min:6|confirmed',
            'company_name' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $client = Client::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            // IMPORTANT: hash the password before saving
            'password' => Hash::make($validated['password']),
            'company_name' => $validated['company_name'] ?? null,
            'city' => $validated['city'] ?? null,
            'country' => $validated['country'] ?? 'Lebanon',
        ]);

        $token = $client->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'client' => $client,
            'token' => $token,
        ], 201);
    }

    /**
     * POST /api/client/login
     *
     * Authenticate a client using email/phone and password.
     * Returns a Sanctum API token.
     *
     * @param  Request  $request
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required_without:phone|email',
            'phone' => 'required_without:email|string',
            'password' => 'required|string',
        ]);

        $client = null;
        if ($request->filled('email')) {
            $client = Client::where('email', $request->email)->first();
        } elseif ($request->filled('phone')) {
            $client = Client::where('phone', $request->phone)->first();
        }

        if (! $client || ! Hash::check($request->password, $client->password)) {
            return response()->json([
                'message' => 'Invalid login details',
            ], 401);
        }

        $token = $client->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'client' => $client,
            'token' => $token,
        ], 200);
    }

    /**
     * POST /api/client/logout
     *
     * Revoke all API tokens for the authenticated client.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user('client-api')?->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully.',
        ], 200);
    }

    /**
     * GET /api/client/me
     *
     * Return the current authenticated client profile.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'client' => new ClientResource($request->user()),
        ]);
    }
}
