<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use Auth;
	use DB;

class Wishlist
{
    /**
     * getCount.
     * @return int
     */
    public function getCount(): int
    {
        return DB::table('wishlist')
            ->where('user_id', Auth::id())
            ->count();
    }
}
}
