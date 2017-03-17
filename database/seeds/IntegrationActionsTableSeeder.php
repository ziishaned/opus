<?php		
		
use Illuminate\Database\Seeder;		
use App\Models\IntegrationAction;		
		
class IntegrationActionsTableSeeder extends Seeder		
{		
    /**		
     * Run the database seeds.		
     *		
     * @return void		
     */		
    public function run()		
    {		
        $integrationActions = [		
        	[		
        		'name' => 'wiki_created', 		
        	],		
        	[		
        		'name' => 'wiki_updated',		
        	],		
        	[		
        		'name' => 'wiki_deleted',		
        	],		
            [		
        		'name' => 'page_created', 		
        	],		
        	[		
        		'name' => 'page_updated',		
        	],		
        	[		
        		'name' => 'page_deleted',		
        	],		
        	[		
        		'name' => 'comment_created', 		
        	],		
        	[		
        		'name' => 'comment_updated',		
        	],		
        	[		
        		'name' => 'comment_deleted',		
        	],		
        	[		
        		'name' => 'join_team',		
        	],		
        ];		
		
        foreach ($integrationActions as $value) {		
        	IntegrationAction::create($value);		
        }		
    }		
}