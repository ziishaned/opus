<?php		

namespace Database\Seeds\Components\Integration;

use Illuminate\Database\Seeder;		
use App\Models\IntegrationAction;		
		
/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class IntegrationActionsTableSeeder extends Seeder		
{	
    /**
     * Path to integration_action.json file.
     * 
     * @var string
     */
    private $integrationActionsFilePath = 'database/seeds/Components/Integration/integration_actions.json';

    /**		
     * Run the database seeds.		
     *		
     * @return void		
     */		
    public function run()		
    {
        $integrationActions = $this->getIntegrationActions();
        
        foreach ($integrationActions as $action) {
            IntegrationAction::create([
                'name' => $action['name'],
            ]);
        }
    }	

    /**
     * Get the integration actions from json file. 
     * 
     * @return array $integrationActions
     */
    private function getIntegrationActions()
    {
        $integrationActions = file_get_contents(base_path($this->integrationActionsFilePath));

        return json_decode($integrationActions, true);
    }	
}