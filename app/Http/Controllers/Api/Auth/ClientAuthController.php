<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ClientAuthController extends Controller
{
    /**
     * POST /api/client/register
     *
     * Register a new client account.
     * Returns a Sanctum API token immediately.
     *
     * @param  RegisterClientRequest  $request
     * @return JsonResponse
     */
    public function register(RegisterClientRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Create client with hashed password
        $client = Client::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'company_name' => $validated['company_name'] ?? null,
            'city' => $validated['city'] ?? null,
            'country' => $validated['country'] ?? 'Lebanon',
        ]);

        // Generate Sanctum API token
        $token = $client->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful.',
            'token' => $token,
            'client' => new ClientResource($client),
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
        $credentials = $request->validate([
            'email' => 'required_without:phone|email',
            'phone' => 'required_without:email|string',
            'password' => 'required|string|min:6',
        ]);

        // Find client by email or phone
        $client = Client::where(function ($query) use ($credentials) {
            if (isset($credentials['email'])) {
                $query->where('email', $credentials['email']);
            } elseif (isset($credentials['phone'])) {
                $query->where('phone', $credentials['phone']);
            }
        })->first();

        if (! $client || ! Hash::check($credentials['password'], $client->password ?? '')) {
            throw ValidationException::withMessages([
                'credentials' => 'Invalid email/phone or password.',
            ]);
        }

        // Generate Sanctum API token
        $token = $client->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'token' => $token,
            'client' => new ClientResource($client),
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
        $client = $request->user('client-api');

        return response()->json([
            'client' => new ClientResource($client),
        ], 200);
    }
}
