<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Validator;
use App\Models\Team;
use App\Models\User;
use App\Helpers\TeamHelper;

class CreateTeam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:team {--email=} {--first_name=} {--last_name=} {--password=} {--team_name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a team and team admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $options = $this->options();
        $rules = Team::CREATE_TEAM_RULES;
        $rules['password'] = 'required|min:6'; // disabling password confirmation rule
        $validator = Validator::make($options, $rules);
        if($validator->fails()){
            echo "Please check if all options are present (--email, --first_name, --last_name, --password, --team_name) \n";
            echo $validator->errors();
            return false;
        }

        $user = (new User)->createUser($options);

        $teamRequestData = collect($options)->put('user_id', $user->id);
        $team            = (new Team)->postTeam($teamRequestData);

        TeamHelper::createAdminsRole($team);
        dd($options);
    }
}
