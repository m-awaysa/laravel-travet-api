<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create  a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('Name of the new user');
        $user['email'] = $this->ask('email of the new user');
        $user['password'] = $this->secret('password of the new user');

        $roleName = $this->choice('role of the new user', ['admin', 'editor'], 1);

        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error('Role not found');
            return -1;
        }

        $validator = Validator::make($user, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:' . User::class],
            'password' => ['required','string'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->error()->all() as $error) {
                $this->error($error);
            }
            return -1;
        }

        DB::transaction(function () use ($role, $user) {
            $user['password'] = Hash::make($user['password']);
            $newUser = User::create($user);
            $newUser->roles()->attach($role->id);
        });

        $this->info('User' . $user['email'] . ' created successfully');
        return 0;
    }
}
