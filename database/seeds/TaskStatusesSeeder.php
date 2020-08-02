<?php

use Illuminate\Database\Seeder;

class TaskStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_statuses')->insert([
            'value' => 'Completed',
        ]);
        DB::table('task_statuses')->insert([
            'value' => 'Overdue',
        ]);
        DB::table('task_statuses')->insert([
            'value' => 'Snoozed',
        ]);
    }
}
