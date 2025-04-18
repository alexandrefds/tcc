<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create
                            {name : Nome do usuário}
                            {email : E-mail do usuário}
                            {password : Senha do usuário}';

    protected $description = 'Cria um novo usuário no sistema';

    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            $this->error('Erro de validação:');
            foreach ($validator->errors()->all() as $error) {
                $this->line('- ' . $error);
            }
            return 1;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        $this->info('Usuário criado com sucesso!');
        $this->line('ID: ' . $user->id);
        $this->line('Nome: ' . $user->name);
        $this->line('E-mail: ' . $user->email);

        return 0;
    }
}
