<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{

    protected $model = UserAddress::class;

    public function definition()
    {
        $addresses = [
            ["臺北市", "大同區"],
            ["宜蘭縣", "頭城鎮"],
            ["新竹縣", "竹北市"],
            ["桃園市", "龜山區"],
            ["臺中市", "神岡區"],
        ];
        $address   = $this->faker->randomElement($addresses);
    
        return [
            //'province'      => $address[0],
            'city'          => $address[0],
            'district'      => $address[1],
            'address'       => sprintf('第%d街道第%d號', $this->faker->randomNumber(2), $this->faker->randomNumber(3)),
            'zip'           => $this->faker->postcode,
            'contact_name'  => $this->faker->name,
            'contact_phone' => $this->faker->phoneNumber,
        ];
    }
}
