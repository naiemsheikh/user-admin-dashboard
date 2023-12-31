<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $roles = [
            ['name' => 'Admin', 'privileges' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,23,24,25,26,27,28,29,100,101,102,103,104'],
            ['name' => 'Operator', 'privileges' => '1,2,3,13'],
            ['name' => 'System', 'privileges' => '1,2,3,13'],
        ];

        DB::table('role')->insert($roles);

        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456'),
                'role_id' => 1,
                'log_id' => 'admin'
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@user.com',
                'password' => Hash::make('123456'),
                'role_id' => 2,
                'log_id' => 'user'
            ],
            [
                'name' => 'online_solver',
                'username' => 'online_solver',
                'email' => 'online_solver@online_solver.com',
                'password' => Hash::make('123456'),
                'role_id' => 3,
                'log_id' => 'online_solver'
            ],
        ];

        DB::table('users')->insert($users);


        $options = [
            'Fruits_Complain',
            'KLP_Priyanka_(OUT_DHK)',
            'HKG_Medicine_Section',
            'KLP_Kuntala(DHK_North)',
            'HKG_mobile',
            'KMP_Mukta_(RNG)',
            'HKG_Rabbi_(CTG)',
            'HKG_Tanzil_(MYM & SYL)',
            'CTG_C4',
            'HLS_C4',
            'KLP_mobile',
            'E_Commerce',
            'Condition_Section',
            'Alamin',
            'Omar Shen',
            'Sorif',
            'Sajol',
            'Reazul',
            'Anower',
            'Tamim',
            'Monir',
            'Mahfuz',
            'Parvez',
            'Ayesha',
            'Sabbir',
            'Meghla',
            'Rasel',
            'Bonna',
            'Nasir',
            'KMP_Rechecker_Sultana',
            'HKG_Rechecker_ Kuntala',
            'KMP_Written_Complain',
            'HKG_Written_Complain',
            'KMP_Mita(CTG)',
            'KMP_Mukta(BSL)',
            'KLP_Sultana_(RAJ)',
            'HKG_Tayub_(KHL)',
            'KMP_Rabbi(SYL)',
            'KMP_Riaz(MYM)',
            'KLP_Sultana(KHL)',
            'KMP_Rechecker',
            'KLP_C4',
            'HKG_Ranu_(DHK South)',
            'HKG_Saddam_(KHL)',
            'HKG_Nasim_(BSL)',
            'HKG_ Rabbi_(CTG)',
            'Rechecker1',
            'Rechecker2',
            'Rechecker3',
            'FinalChecker',
            'Statement_File',
            'Solved',
            'Helal_Incharge'
        ];
        
        // Convert options to array
        $userArray = [];
        foreach ($options as $option) {
            $exist = User::where('username', $option)->count();
            if(!$exist){
                $userArray = [
                    'name' => $option,
                    'username' => $option,
                    'password' => Hash::make('123456'),
                    'role_id' => 1,
                    'log_id' => $option
                ];
    
                DB::table('users')->insert($userArray);
            }
        }
    }
}
