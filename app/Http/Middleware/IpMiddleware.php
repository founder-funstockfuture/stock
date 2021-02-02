<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IpMiddleware
{
    //public $blockIps = ['103.212.146.23'];
    public $allowIps = ['59.124.64.141'];

    public $blockIps = [];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 黑名單
        if (in_array($request->ip(), $this->blockIps)) {
    
            return response()->json(['message' => "You don't have permission to access this website."]);
        }

        // 白名單或內網
        if (!in_array($request->ip(), $this->allowIps)) {
            if(!$this->isPrivateIP($request->ip())){
                return response()->json(['message' => $request->ip()." don't have ip permission to access this website."]);
            }
        }

        return $next($request);
    }

    private function isPrivateIP ($ip) {
        $pri_addrs = array (
                          '10.0.0.0|10.255.255.255', // single class A network
                          '172.16.0.0|172.31.255.255', // 16 contiguous class B network
                          '192.168.0.0|192.168.255.255', // 256 contiguous class C network
                          '169.254.0.0|169.254.255.255', // Link-local address also refered to as Automatic Private IP Addressing
                          '127.0.0.0|127.255.255.255' // localhost
                         );
    
        $long_ip = ip2long ($ip);
        if ($long_ip != -1) {
    
            foreach ($pri_addrs AS $pri_addr) {
                list ($start, $end) = explode('|', $pri_addr);
    
                 // IF IS PRIVATE
                 if ($long_ip >= ip2long ($start) && $long_ip <= ip2long ($end)) {
                     return true;
                 }
            }
        }
    
        return false;
    }


}
