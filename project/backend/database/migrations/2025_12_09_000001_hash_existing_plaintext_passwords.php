<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->orderBy('id')->chunkById(100, function ($users) {
            foreach ($users as $user) {
                // password_get_info returns algo 0 when the value is not a hash
                $info = password_get_info($user->password);
                if (($info['algo'] ?? 0) === 0) {
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update([
                            'password' => Hash::make($user->password),
                            'updated_at' => now(),
                        ]);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No-op: original plaintext values are not recoverable
    }
};

