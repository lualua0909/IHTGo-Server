<?php

namespace App\Http\Middleware;

use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class RefreshToken extends BaseMiddleware {

    /**
     * @param $request
     * @param \Closure $next
     * @return bool|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|mixed|void
     * @throws JWTException
     */
    public function handle($request, \Closure $next) {

        $token = $this->checkForToken($request); // Check presence of a token.

        if ($token){
            return $token;
        }

        try {
            if (!$this->auth->parseToken()->authenticate()) { // Check user not found. Check token has expired.
                return response()->json(MessageApi::error(['User not found'], HttpCode::ITEM_NOT_EXISTS));
                //throw new UnauthorizedHttpException('jwt-auth', 'User not found');
            }
            $payload = $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray();
            return $next($request); // Token is valid. User logged. Response without any token.
        } catch (TokenExpiredException $t) { // Token expired. User not logged.
            $payload = $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray();
            $key = 'block_refresh_token_for_user_' . $payload['sub'];
            $cachedBefore = (int) Cache::has($key);
            if ($cachedBefore) { // If a token alredy was refreshed and sent to the client in the last JWT_BLACKLIST_GRACE_PERIOD seconds.
                \Auth::onceUsingId($payload['sub']); // Log the user using id.
                return $next($request); // Token expired. Response without any token because in grace period.
            }
            try {
                $newtoken = $this->auth->refresh(); // Get new token.
                $gracePeriod = $this->auth->manager()->getBlacklist()->getGracePeriod();
                $expiresAt = Carbon::now()->addSeconds($gracePeriod);
                Cache::put($key, $newtoken, $expiresAt);
            } catch (JWTException $e) {
                return response()->json(MessageApi::error([$e->getMessage()]), 200);
                //throw new UnauthorizedHttpException('jwt-auth', $e->getMessage(), $e, $e->getCode());
            }
        }

        $response = $next($request); // Token refreshed and continue.

        return $this->setAuthenticationHeader($response, $newtoken); // Response with new token on header Authorization.
    }

    public function checkForToken(Request $request)
    {
        if (! $this->auth->parser()->setRequest($request)->hasToken()) {
            return response()->json(MessageApi::error(['Token not provided']), 200);
            //throw new UnauthorizedHttpException('jwt-auth', 'Token not provided');
        }
        return false;
    }

}