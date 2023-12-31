<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $privileges = [
            [
                'name' => 'Consignment Search',
                'module' => ''
            ],
            [
                'name' => 'Complain List',
                'module' => ''
            ],
            [
                'name' => 'Complain Search',
                'module' => ''
            ],
            [
                'name' => 'Mobile_Dept.',
                'module' => ''
            ],
            [
                'name' => 'E-Commerce',
                'module' => ''
            ],
            [
                'name' => 'To-Pay',
                'module' => ''
            ],
            [
                'name' => 'Foreign',
                'module' => ''
            ],
            [
                'name' => 'Non_Complain',
                'module' => ''
            ],
            [
                'name' => 'PSL_Complain',
                'module' => ''
            ],
            [
                'name' => 'General_Documents',
                'module' => ''
            ],
            [
                'name' => 'Total Complain',
                'module' => ''
            ],
            [
                'name' => 'Pending Complain',
                'module' => ''
            ],
            [
                'name' => 'SolverWise_Pending',
                'module' => ''
            ],
            [
                'name' => 'Complain Receiver',
                'module' => ''
            ],
            [
                'name' => 'Complain Solver',
                'module' => ''
            ],
            [
                'name' => 'ComplainFeedBack',
                'module' => ''
            ],
            [
                'name' => 'Helal Incharge',
                'module' => ''
            ],
            [
                'name' => 'Rechecker1',
                'module' => ''
            ],
            [
                'name' => 'Rechecker2',
                'module' => ''
            ],
            [
                'name' => 'Rechecker3',
                'module' => ''
            ],
            [
                'name' => 'FinalChecker',
                'module' => ''
            ],
            [
                'name' => 'Statement File',
                'module' => ''
            ],
            [
                'name' => 'Receiver Summary',
                'module' => ''
            ],
            [
                'name' => 'Complain Summary',
                'module' => ''
            ],
            [
                'name' => 'Solving Summary',
                'module' => ''
            ],
            [
                'name' => 'Service Wise Complain',
                'module' => ''
            ],
            [
                'name' => 'Forwording History',
                'module' => ''
            ],
            [
                'name' => 'User List',
                'module' => ''
            ],
            [
                'name' => 'Roles',
                'module' => ''
            ],
        ];

        DB::table('privileges')->insert($privileges);

        $privilegesInternal = [
            [
                'privileges_id' => '100',
                'name' => 'Create Complain',
                'module' => ''
            ],
            [
                'privileges_id' => '101',
                'name' => 'Forward',
                'module' => ''
            ],
            [
                'privileges_id' => '102',
                'name' => 'Reply',
                'module' => ''
            ],
            [
                'privileges_id' => '103',
                'name' => 'Call',
                'module' => ''
            ],
            [
                'privileges_id' => '104',
                'name' => 'Solve',
                'module' => ''
            ],
        ];
        DB::table('privileges')->insert($privilegesInternal);
    }
}
