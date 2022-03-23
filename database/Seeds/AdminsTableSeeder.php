<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->delete();
        $adminRecords = [
        	['id'=>1, 'name'=>'steco', 'type'=>'admin', "mobile"=>'+237675577785', 'email'=>'moyo.stephane@gmail.com','password'=>'$2y$10$l4y0XMJYt2wIkloK7I3T9OnV2GDqV8odS3PbRw8EcGEYtElxgkmS2', 'image'=>'','status'=>1,
			],

        ];
        DB::table('admins')->insert($adminRecords);

        /*foreach ($adminRecords as $key => $record) {
        	\App\Admin::create($record);
        	# code...
        }*/
    }
}
